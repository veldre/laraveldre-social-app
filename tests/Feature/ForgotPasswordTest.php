<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use phpDocumentor\Reflection\Types\Void_;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    public function testRoute(): void
    {
        $response = $this->get('/password/reset');

        $response->assertStatus(200);
    }

    public function testRequiredFields(): void
    {
        $this
            ->from('/password/reset')
            ->post('/password/email', [])
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'email' => 'The email field is required.'
            ]);
    }

    public function testRequiredFieldsView(): void
    {
        $this->followingRedirects()
            ->from('/password/reset')
            ->post('/password/email', [])
            ->assertOk();
    }

    public function testInvalidEmail(): void
    {
        $this->from('/password/reset')
            ->post('/password/email', [
                'email' => 'invalid_email'
            ])
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'email' => 'The email must be a valid email address.'
            ]);
    }

    public function testEmailDoesNotExist(): void
    {
        $this
            ->from('/password/reset')
            ->post('/password/email', [
                'email' => 'test@test.com'
            ])
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'email' => 'We can\'t find a user with that e-mail address.'
            ]);
    }

    public function testForgotPassword(): void
    {
        Notification::fake();  // epastu notifikācijas vienmēr jāmocko

        $user = factory(User::class)->create();

        $this->followingRedirects()
            ->from('/password/reset')
            ->post('/password/email', [
                'email' => $user->email
            ])
            ->assertOk();
//            ->assertDontSeeText('We have e-mailed your password reset link!');

        $this->assertDatabaseHas('password_resets', [
            'email' => $user->email
        ]);

        Notification::assertSentTo([$user], ResetPassword::class);

    }


}
