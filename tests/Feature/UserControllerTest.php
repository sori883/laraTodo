<?php

namespace Tests\Feature;

use App\User;
use Auth;
use Tests\TestCase;
use App\Notifications\PasswordResetNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    public function testRegister(): void
    {
        $email = $this->faker->unique()->safeEmail();
        $response = $this->json('post', route('user.register'), [
            'name' => $this->faker->unique()->regexify('[a-z]{4}[0-9]{4}'),
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $registedUser = Auth::user();

        $response->assertStatus(201);
        $this
            ->assertAuthenticatedAs($registedUser)
            ->assertEquals($email, $registedUser->email);
        $this->assertDatabaseHas('users', ['email' => $email]);
    }

    public function testLogin(): void
    {
        $response = $this->json('post', route('user.login'), [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(204);
        $this->assertAuthenticatedAs($this->user);
    }

    public function testLogout(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->json('post', route('user.logout'));

        $response->assertStatus(204);
        $this->assertGuest();
    }

    public function testGetUser(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->get(route('user'));

        $response
            ->assertStatus(200)
            ->assertJson([
                'name' => $this->user->name,
            ]);
    }

    public function testSendPasswordConfirmMail(): void
    {
        Notification::fake();
        Notification::assertNothingSent();

        $user = $this->user;
        $userOther = factory(User::class)->create();

        $response = $this->json('post', route('password.email'), [
            'email' => $user->email,
        ]);

        $response->assertStatus(200);

        Notification::assertSentTo(
            $user,
            PasswordResetNotification::class,
            function (PasswordResetNotification $resetNotifier) use ($user) {
                $mail = $resetNotifier->toMail($user);
                $address = $mail->to[0]['address'];

                $this->assertEquals($user->email, $address);
                $this->assertEquals('emails.password_reset', $mail->textView);
                $this->assertEquals(route('password.reset', [
                    'token' => $resetNotifier->token,
                    'email' => $address
                ]), $mail->viewData['url']);
                $this->get($mail->viewData['url'])
                    ->assertStatus(302)
                    ->assertCookie('RESETTOKEN')
                    ->assertCookie('EMAIL');

                return true;
            }
        );

        Notification::assertNotSentTo(
            [$userOther],
            PasswordResetNotification::class
        );
    }
}
