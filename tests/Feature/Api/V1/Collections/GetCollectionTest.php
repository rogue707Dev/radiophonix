<?php
declare(strict_types=1);

namespace Tests\Feature\Api\V1\Collections;

use Radiophonix\Http\Transformers\CollectionTransformer;
use Radiophonix\Models\Collection;
use Radiophonix\Models\Saga;
use Tests\Feature\Api\V1\ApiTestCase;

class GetCollectionTest extends ApiTestCase
{
    /** @test */
    public function can_get_collection_from_fake_id()
    {
        /* *** Initialisation *** */
        /** @var Saga $saga */
        $saga = factory(Saga::class)->create();
        /** @var Collection $collection */
        $collection = factory(Collection::class)->make();

        $saga->collections()->save($collection);

        /* *** Process *** */
        $response = $this->json(
            'GET',
            '/api/v1/collections/' . $collection->fakeId()
        );

        $collection = $collection->fresh();

        /* *** Assertion *** */
        $response->assertStatus(200);
        $response->assertExactJson($this->transformItem($collection, (new CollectionTransformer())->setDefaultIncludes(['tracks'])));
    }

    /** @test */
    public function cannot_get_collection_from_real_id()
    {
        /* *** Initialisation *** */
        /** @var Saga $saga */
        $saga = factory(Saga::class)->create();
        /** @var Collection $collection */
        $collection = factory(Collection::class)->make();

        $saga->collections()->save($collection);

        /* *** Process *** */
        $response = $this->json(
            'GET',
            '/api/v1/collections/' . $collection->id
        );

        /* *** Assertion *** */
        $response->assertStatus(404);
    }
}
