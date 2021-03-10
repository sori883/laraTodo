<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Notification;

class UserControllerErrorTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    public function testValidRegister(): void
    {
        $response = $this->json('post', route('user.register'), [
            'name' => str_repeat('a', 2),
            'email' => 'not email',
            'password' => str_repeat('a', 7),
            'password_confirmation' => str_repeat('a', 7),
        ]);

        $response
        ->assertStatus(422)
        ->assertJsonCount(3, 'errors');
    }

    public function testDuplicateRegister(): void
    {
        $response = $this->json('post', route('user.register'), [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response
        ->assertStatus(422)
        ->assertJsonCount(2, 'errors');
    }

    public function testNotRegistedUserLogin(): void
    {
        $response = $this->json('post', route('user.login'), [
            'email' => 'not email',
            'password' => str_repeat('a', 7),
        ]);

        $response
        ->assertStatus(422)
        ->assertJsonCount(1, 'errors');
    }

    public function testNotRegistedSendPasswordConfirmMail(): void
    {
        Notification::fake();

        $email = $this->faker->unique()->safeEmail();

        $response = $this->json('post', route('password.email'), [
            'email' => $email,
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonCount(1, 'errors');

            Notification::assertNothingSent();
    }
}
