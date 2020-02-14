<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    public function testRoute(): void
    {
        $user = factory(User::class)->create();
        $token = Password::createToken($user);

        $response = $this->get('/password/reset/' . $token);
        $response->assertStatus(200);
    }

    public function testRequiredFields(): void
    {
        $user = factory(User::class)->create();
        $token = Password::createToken($user);

        $this
            ->from('/password/reset' . $token)
            ->post('/password/reset')
            ->assertStatus(302)  //status ir redirekts (302)
            ->assertSessionHasErrors([
                'email' => 'The email field is required.',
                'password' => 'The password field is required.'
            ]);
    }

    public function testPasswordDontMatch(): void
    {
        $user = factory(User::class)->create();
        $token = Password::createToken($user);

        $this
            ->from('/password/reset/' . $token)
            ->post('/password/reset', [
                'email' => $user->email,
                'password' => '123456789',
                'password_confirmation' => '987654321'
            ])
            ->assertStatus(302)  //status ir redirekts (302)
            ->assertSessionHasErrors([
                'password' => 'The password confirmation does not match.'
            ]);
    }

    public function testSuccessfulPasswordReset(): void
    {
        $user = factory(User::class)->create();
        $token = Password::createToken($user);

        $this->followingRedirects()
            ->from('password/reset/'. $token)
            ->post('password/reset', [
                'email' => $user->email,
                'password' => 'codelex12',
                'password_confirmation' => 'codelex12'
            ])
            ->assertOk();

        $this->assertDatabaseHas('users', [
            'email'=>$user->email,
            'password'=>Hash::check('codelex12',$user->password)   // pārbauda paroli ar nohašoto paroli
        ]);
    }


}
