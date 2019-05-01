<?php

namespace Tests\Feature\Api\V1\Auth;

use Radiophonix\Models\User;
use Tests\Feature\Api\V1\ApiTestCase;

class RegistrationTest extends ApiTestCase
{
    /** @test */
    public function a_user_cannot_register_with_an_already_existing_email()
    {
        /* *** Initialisation *** */
        factory(User::class)->create([
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
            ]
        );

        /* *** Assertion *** */
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function a_user_cannot_register_with_an_already_existing_username()
    {
        /* *** Initialisation *** */
        factory(User::class)->create([
            'name' => 'John-Smith',
        ]);

        /* *** Process *** */
        $response = $this->json(
            'POST',
            '/api/v1/auth/register',
            [
                'email' => 'john.smith@radiophonix.org',
                'username' => 'John-Smith',
                'password' => 'password',
            ]
        );

        /* *** Assertion *** */
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('username');
    }

    /**
     * @test
     * @dataProvider invalidUsernameDataProvider
     * @param $username
     */
    public function a_user_cannot_register_with_an_invalid_username($username)
    {
        /* *** Process *** */
        $response = $this->json(
            'POST',
            '/api/v1/auth/register',
            [
                'email' => 'john.smith@radiophonix.org',
                'username' => $username,
                'password' => 'password',
            ]
        );

        /* *** Assertion *** */
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('username');
    }

    /**
     * @return array
     */
    public function invalidUsernameDataProvider(): array
    {
        return [
            'empty' => [null],
            'too short' => ['a'],
            'too long' => [str_repeat('a', 51)],
            'with a space' => ['a a'],
            'with unicode' => ['🎙🎙'],
        ];
    }

    /**
     * @test
     * @dataProvider invalidPasswordDataProvider
     * @param $password
     */
    public function a_user_cannot_register_with_an_invalid_password($password)
    {
        /* *** Process *** */
        $response = $this->json(
            'POST',
            '/api/v1/auth/register',
            [
                'email' => 'john.smith@radiophonix.org',
                'username' => 'John-Smith',
                'password' => $password,
            ]
        );

        /* *** Assertion *** */
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('password');
    }

    /**
     * @return array
     */
    public function invalidPasswordDataProvider(): array
    {
        return [
            'empty' => [null],
            'too short' => [str_repeat('a', 7)],
            'too long' => [str_repeat('a', 256)],
        ];
    }

    /** @test */
    public function a_user_can_register_with_valid_data()
    {
        $response = $this->json(
            'POST',
            '/api/v1/auth/register',
            [
                'email' => 'john.smith@radiophonix.org',
                'username' => 'John-Smith',
                'password' => 'password',
            ]
        );

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
