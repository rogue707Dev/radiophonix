<?php
declare(strict_types=1);

namespace Tests\Feature\Api\V1\Collections;

use Radiophonix\Http\Transformers\CollectionTransformer;
use Radiophonix\Models\Collection;
use Radiophonix\Models\Saga;
use Tests\Feature\Api\V1\ApiTestCase;

class GetSagaCollectionsTest extends ApiTestCase
{
    /** @test */
    public function can_get_a_list_of_collections_from_a_saga_fake_id()
    {
        /* *** Initialisation *** */

        // SAGA A
        /** @var Saga $sagaA */
        $sagaA = factory(Saga::class)->create();
        /** @var \Illuminate\Database\Eloquent\Collection|Collection[] $collectionsA */
        $collectionsA = factory(Collection::class)->times(2)->make();

        $sagaA->collections()->saveMany($collectionsA);

        // SAGA B
        /** @var Saga $sagaB */
        $sagaB = factory(Saga::class)->create();
        /** @var \Illuminate\Database\Eloquent\Collection|Collection[] $collectionsB */
        $collectionsB = factory(Collection::class)->times(2)->make();

        $sagaB->collections()->saveMany($collectionsB);

        /* *** Process *** */
        $response = $this->json(
            'GET',
            '/api/v1/sagas/' . $sagaA->fakeId() . '/collections'
        );

        $collectionsA = $collectionsA->fresh();

        /* *** Assertion *** */
        $response->assertStatus(200);
        $response->assertExactJson(
            $this->transformCollection($collectionsA, (new CollectionTransformer())->setDefaultIncludes(['tracks']))
        );
    }

    /** @test */
    public function can_get_a_list_of_collections_from_a_saga_slug()
    {
        /* *** Initialisation *** */

        // SAGA A
        /** @var Saga $sagaA */
        $sagaA = factory(Saga::class)->create();
        /** @var \Illuminate\Database\Eloquent\Collection|Collection[] $collectionsA */
        $collectionsA = factory(Collection::class)->times(2)->make();

        $sagaA->collections()->saveMany($collectionsA);

        // SAGA B
        /** @var Saga $sagaB */
        $sagaB = factory(Saga::class)->create();
        /** @var \Illuminate\Database\Eloquent\Collection|Collection[] $collectionsB */
        $collectionsB = factory(Collection::class)->times(2)->make();

        $sagaB->collections()->saveMany($collectionsB);

        /* *** Process *** */
        $response = $this->json(
            'GET',
            '/api/v1/sagas/' . $sagaA->slug . '/collections'
        );

        $collectionsA = $collectionsA->fresh();

        /* *** Assertion *** */
        $response->assertStatus(200);
        $response->assertExactJson(
            $this->transformCollection($collectionsA, (new CollectionTransformer())->setDefaultIncludes(['tracks']))
        );
    }

    /** @test */
    public function cannot_get_a_list_of_collections_from_a_saga_real_id()
    {
        /* *** Initialisation *** */
        /** @var Saga $saga */
        $saga = factory(Saga::class)->create();
        /** @var \Illuminate\Database\Eloquent\Collection|Collection[] $collections */
        $collections = factory(Collection::class)->times(2)->make();

        $saga->collections()->saveMany($collections);

        /* *** Process *** */
        $response = $this->json(
            'GET',
            '/api/v1/sagas/' . $saga->id . '/collections'
        );

        /* *** Assertion *** */
        $response->assertStatus(404);
    }
}
