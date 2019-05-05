<?php
declare(strict_types=1);

namespace Tests\Feature\Api\V1\Auth;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;
use Radiophonix\Models\User;
use Tests\Feature\Api\V1\ApiTestCase;

class ForgotPasswordTest extends ApiTestCase
{
    /** @test */
    public function a_user_can_ask_for_a_password_reset_email()
    {
        /* *** Initialisation *** */
        Notification::fake();

        $user = factory(User::class)->create([
            'email' => 'john.smith@radiophonix.org',
        ]);

        /* *** Process *** */
        $response = $this->json(
            'POST',
            '/api/v1/auth/password/email',
            [
                'email' => 'john.smith@radiophonix.org',
            ]
        );

        /* *** Assertion *** */
        $response->assertStatus(204);

        Notification::assertSentTo($user, ResetPassword::class);
    }
}
