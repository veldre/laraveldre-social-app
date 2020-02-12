<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function testLogout(): void
    {
        $this->actingAs(factory(User::class)->make());

        $this->followingRedirects()
            ->from('/home')
            ->post('/logout')
            ->assertOk();

        $this->assertFalse(auth()->check());
    }
}
