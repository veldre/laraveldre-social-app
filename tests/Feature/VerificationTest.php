<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerificationTest extends TestCase
{
//    use RefreshDatabase;

    public function testVerifyEmail(): void
    {
        $user = factory(User::class)->create([
            'email_verified_at' => null   // tikai tos, kuriem registracijas laiks ir null
        ]);

        $this->followingRedirects()
            ->from('/home')
            ->get(route('verification.verify', [
                'id' => $user->id,
                'hash' => sha1($user->email)]))
            ->assertOk();

        $user->refresh();

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
            'email_verified_at' => $user->email_verified_at
        ]);
    }


}
