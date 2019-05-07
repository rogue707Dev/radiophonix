<?php
declare(strict_types=1);

namespace Tests\Feature\Api\V1\Auth;

use Radiophonix\Models\User;
use Tests\Feature\Api\V1\ApiTestCase;

class DeleteAccountTest extends ApiTestCase
{
    /** @test */
    public function a_user_can_delete_his_own_account()
    {
        /* *** Initialisation *** */
        /** @var User $user */
        $user = factory(User::class)->create([
            'name' => 'John-Smith',
            'password' => bcrypt('password'),
        ]);

        $this->assertDatabaseHas(
            'users',
            [
                'id' => $user->id,
            ]
        );

        /* *** Process *** */
        $response = $this
            ->actingAs($user)
            ->json(
                'DELETE',
                '/api/v1/account',
                [
                    'password' => 'password',
                ]
            );

        /* *** Assertion *** */
        $response->assertStatus(204);

        $this->assertDatabaseMissing(
            'users',
            [
                'id' => $user->id,
            ]
        );
    }

    /** @test */
    public function a_user_cannot_delete_his_account_without_a_password()
    {
        /* *** Initialisation *** */
        $user = factory(User::class)->create([
            'name' => 'John-Smith',
        ]);

        /* *** Process *** */
        $response = $this
            ->actingAs($user)
            ->json(
            'DELETE',
            '/api/v1/account'
        );

        /* *** Assertion *** */
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('password');
    }

    /** @test */
    public function a_user_cannot_delete_his_account_with_an_invalid_password()
    {
        /* *** Initialisation *** */
        $user = factory(User::class)->create([
            'name' => 'John-Smith',
        ]);

        /* *** Process *** */
        $response = $this
            ->actingAs($user)
            ->json(
                'DELETE',
                '/api/v1/account',
                [
                    'password' => 'invalid_password',
                ]
            );

        /* *** Assertion *** */
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('password');
    }
}
