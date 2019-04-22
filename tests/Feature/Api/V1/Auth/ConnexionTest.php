<?php

namespace Tests\Feature\Api\V1\Auth;

use Radiophonix\Models\User;
use Tests\Feature\Api\V1\ApiTestCase;

class ConnexionTest extends ApiTestCase
{
    /** @test */
    public function a_user_cannot_login_with_wrong_password()
    {
        /* *** Initialisation *** */
        factory(User::class)->create([
            'password' => bcrypt('password'),
        ]);

        /* *** Process *** */
        $response = $this->json(
            'POST',
            '/api/v1/auth/login?email=john.smith@radiophonix.org&password=wrong-password'
        );

        /* *** Assertion *** */
        $response->assertStatus(401);
    }

    /** @test */
    public function a_user_cannot_login_with_wrong_email()
    {
        /* *** Initialisation *** */
        factory(User::class)->create([
            'email' => 'john.smith@radiophonix.org',
        ]);

        /* *** Process *** */
        $response = $this->json(
            'POST',
            '/api/v1/auth/login?email=wrong-email@radiophonix.org&password=password'
        );

        /* *** Assertion *** */
        $response->assertStatus(401);
    }

    /** @test */
    public function a_user_can_login_with_the_correct_credentials()
    {
        /* *** Initialisation *** */
        factory(User::class)->create([
            'email' => 'john.smith@radiophonix.org',
            'password' => bcrypt('password'),
        ]);

        /* *** Process *** */
        $response = $this->json(
            'POST',
            '/api/v1/auth/login?email=john.smith@radiophonix.org&password=password'
        );

        /* *** Assertion *** */
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in',
            'user' => [
                'id',
                'name',
                'email',
                'avatar',
                'created_at',
                'updated_at',
            ],
            'likes',
        ]);
    }
}
