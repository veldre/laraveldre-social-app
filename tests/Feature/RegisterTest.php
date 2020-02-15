<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Notifications\Notification;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function testExample()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function testAlreadyAuthorized(): void
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->get('/register');
        $response->assertStatus(302);
    }

    public function testRequiredFields(): void
    {
        $this->followingRedirects()
            ->from('/register')
            ->post('/register')
            ->assertOk()
            ->assertSeeText("The name field is required.")
            ->assertSeeText("The email field is required.")
            ->assertSeeText("The password field is required.");
    }

    public function testInvalidEmail(): void
    {
        $this->from('/register')
            ->post('/register', [
                'email' => 'invalid email'
            ])
            ->assertStatus(302)
            ->assertSessionHasErrors(['email' => 'The email must be a valid email address.']);
    }

    public function testPasswordConfirms(): void
    {
        $this->from('/register')
            ->post('/register', [
                'email' => 'test@test.com',
                'name' => 'John',
                'password' => '123456789',   // 'password' ir view lapā name lauks
                'password_confirmation' => '987654321'
            ])
            ->assertStatus(302)
            ->assertSessionHasErrors(['password' => 'The password confirmation does not match.']);
    }

    public function testEmailExists(): void
    {
        $user = factory(User::class)->create();

        $this->from('/register')
            ->post('/register', [
                'email' => $user->email,
                'name' => 'John',
                'password' => '12345678',
                'password_confirmation' => '12345678'])
            ->assertStatus(302)
            ->assertSessionHasErrors(['email' => 'The email has already been taken.']);
    }

    public function testRegister(): void
    {
        // create ievieto datubāzē, make izveido objektu
        $user = factory(User::class)->make();

        $this->from('/register')
            ->post('/register', [
                'email' => $user->email,
                'name' => $user->name,
                'surname' => $user->surname,
                'password' => '12345678',
                'password_confirmation' => '12345678'])
            ->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
            'name' => $user->name,
        ]);
        $this->assertTrue(auth()->check());
    }


}
