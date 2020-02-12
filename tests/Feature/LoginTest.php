<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
//    use RefreshDatabase;

    public function testRouteExists()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function testInvalidLogin()
    {
        $this->followingRedirects()
            ->from('/login')
            ->post('/login')
            ->assertOk()
            ->assertSeeText("The email field is required.")
            ->assertSeeText("The password field is required.");

    }

    public function testInvalidCredentialsLogin(): void
    {
        $this->followingRedirects()
            ->from('/login')
            ->post('/login', [
                'email' => 'test@test.com',
                'password' => '12345678'
            ])
            ->assertOk()
            ->assertSeeText("These credentials do not match our records.");
    }

    public function testLogin(): void
    {
        $password = 'codelex123';
        $user = factory(User::class)->create(['password' => bcrypt($password)]);

        $this->followingRedirects()
            ->from('/login')
            ->post('/login', [
                'email' => $user->email,
                'password' => $password
            ])
            ->assertOk();

        $this->assertTrue(auth()->check());
    }

    public function testRedirectAuthenticated()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)  //ar actingAs ielogo iekšā fake jūzeri
        ->get('/login')
            ->assertStatus(302);
    }

    public function testAlreadyAuthorized(): void
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->get('/login');
        $response->assertStatus(302);
    }

}
