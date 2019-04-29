<?php

namespace Tests\Feature\Api\V1\Auth;

use Radiophonix\Models\SiteInvite;
use Tests\Feature\Api\V1\ApiTestCase;

class InviteTest extends ApiTestCase
{
    /** @test */
    public function a_user_cannot_register_with_a_not_existing_invite_code()
    {
        /* *** Process *** */
        $response = $this->json(
            'POST',
            '/api/v1/auth/register',
            [
                'email' => 'john.smith@radiophonix.org',
                'username' => 'John-Smith',
                'password' => 'password',
                'invite' => 'a215af69-b0c4-4ca1-83ca-b2571995dca6',
            ]
        );

        /* *** Assertion *** */
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('invite');
    }

    /** @test */
    public function a_user_cannot_register_with_an_invalid_invite_code()
    {
        /* *** Process *** */
        $response = $this->json(
            'POST',
            '/api/v1/auth/register',
            [
                'email' => 'john.smith@radiophonix.org',
                'username' => 'John-Smith',
                'password' => 'password',
                'invite' => 'invalid-uuid',
            ]
        );

        /* *** Assertion *** */
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('invite');
    }

    /** @test */
    public function a_user_cannot_register_with_a_different_email_than_the_invited_one()
    {
        /* *** Initialisation *** */
        $invite = factory(SiteInvite::class)->create([
            'email' => 'foo@radiophonix.org',
        ]);

        /* *** Process *** */
        $response = $this->json(
            'POST',
            '/api/v1/auth/register',
            [
                'email' => 'bar@radiophonix.org',
                'username' => 'John-Smith',
                'password' => 'password',
                'invite' => $invite->uuid,
            ]
        );

        /* *** Assertion *** */
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('invite');
    }

    /** @test */
    public function a_user_can_register_with_a_valid_invite()
    {
        /* *** Initialisation *** */
        /** @var SiteInvite $invite */
        $invite = factory(SiteInvite::class)->create([
            'email' => 'john.smith@radiophonix.org',
        ]);

        /* *** Process *** */
        $response = $this->json(
            'POST',
            '/api/v1/auth/register',
            [
                'email' => 'john.smith@radiophonix.org',
                'username' => 'John-Smith',
                'password' => 'password',
                'invite' => $invite->uuid,
            ]
        );

        $invite = $invite->fresh();

        /* *** Assertion *** */
        $response->assertStatus(200);
        $this->assertNotNull($invite->used_at);
    }
}
