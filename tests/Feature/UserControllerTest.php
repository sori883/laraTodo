<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
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
        Notification::fake();
        $this->user = factory(User::class)->create();
    }

    public function testRegister(): void
    {
        $response = $this->json('post', route('user.register'), [
            'name' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201);
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
        Mail::fake();
        $response = $this->json('post', route('password.email'), [
            'email' => $this->user->email,
        ]);
        $response->assertStatus(200);

        Notification::assertSentTo($this->user, ResetPassword::class);
    }

}
