<?php

namespace Tests\Feature\Api\V1\Like;

use Illuminate\Support\Collection;
use Radiophonix\Models\Saga;
use Radiophonix\Models\User;
use Tests\Feature\Api\V1\ApiTestCase;

class LikeSagaTest extends ApiTestCase
{
    /** @test */
    public function a_user_can_like_a_saga()
    {
        /* *** Initialisation *** */
        /** @var Saga $saga */
        $saga = factory(Saga::class)->create();
        $user = factory(User::class)->create();

        /* *** Process *** */
        $response = $this
            ->actingAs($user)
            ->json(
                'POST',
                '/api/v1/likes/saga/' . $saga->fakeId()
            );

        /* *** Assertion *** */
        $response->assertStatus(200);
        $response->assertExactJson([
            'saga' => [$saga->fakeId()],
        ]);
    }

    /** @test */
    public function a_user_can_unlike_a_saga()
    {
        /* *** Initialisation *** */
        /** @var Saga $saga */
        $saga = factory(Saga::class)->create();

        /** @var User $user */
        $user = factory(User::class)->create();

        $saga->addLikeFrom($user);

        /* *** Process *** */
        $response = $this
            ->actingAs($user)
            ->json(
                'DELETE',
                '/api/v1/likes/saga/' . $saga->fakeId()
            );

        /* *** Assertion *** */
        $response->assertStatus(200);
        $response->assertJson([
            'saga' => [],
        ]);
    }

    /** @test */
    public function a_user_can_retrieve_the_list_of_likes()
    {
        /* *** Initialisation *** */
        /** @var Collection|Saga[] $sagas */
        $sagas = factory(Saga::class)->times(2)->create();

        /** @var User $user */
        $user = factory(User::class)->create();

        foreach ($sagas as $saga) {
            $saga->addLikeFrom($user);
        }

        /* *** Process *** */
        $response = $this
            ->actingAs($user)
            ->json(
                'GET',
                '/api/v1/likes'
            );

        $ids = $sagas
            ->map(function (Saga $saga) {
                return $saga->fakeId();
            })
            ->sort()
            ->values();

        /* *** Assertion *** */
        $response->assertStatus(200);
        $response->assertExactJson([
            'saga' => $ids,
        ]);
    }

    /** @test */
    public function a_user_without_a_token_cannot_like_a_saga()
    {
        /* *** Initialisation *** */
        /** @var Saga $saga */
        $saga = factory(Saga::class)->create();

        /* *** Process *** */
        $response = $this
            ->json(
                'POST',
                '/api/v1/likes/saga/' . $saga->fakeId()
            );

        /* *** Assertion *** */
        $response->assertStatus(401);
    }

    /** @test */
    public function a_user_with_an_invalid_token_cannot_like_a_saga()
    {
        /* *** Initialisation *** */
        /** @var Saga $saga */
        $saga = factory(Saga::class)->create();

        /* *** Process *** */
        $response = $this
            ->actingAsUserWithInvalidToken()
            ->json(
                'POST',
                '/api/v1/likes/saga/' . $saga->fakeId()
            );

        /* *** Assertion *** */
        $response->assertStatus(401);
    }
}
