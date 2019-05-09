<?php
declare(strict_types=1);

namespace Tests\Feature\Api\V1\Sagas;

use Radiophonix\Http\Transformers\SagaTransformer;
use Radiophonix\Models\Saga;
use Tests\Feature\Api\V1\ApiTestCase;

class GetSagaTest extends ApiTestCase
{
    /** @test */
    public function can_query_a_single_saga_using_the_fake_id()
    {
        /* *** Initialisation *** */
        /** @var Saga $saga */
        $saga = factory(Saga::class)->create();

        /* *** Process *** */
        $response = $this->json('GET', '/api/v1/sagas/' . $saga->fakeId());

        /* *** Assertion *** */
        $response->assertStatus(200);
        $response->assertJson($this->transformItem($saga, new SagaTransformer()));
    }

    /** @test */
    public function can_query_a_single_saga_using_the_slug()
    {
        /* *** Initialisation *** */
        /** @var Saga $saga */
        $saga = factory(Saga::class)->create();

        /* *** Process *** */
        $response = $this->json('GET', '/api/v1/sagas/' . $saga->slug);

        /* *** Assertion *** */
        $response->assertStatus(200);
        $response->assertJson($this->transformItem($saga, new SagaTransformer()));
    }

    /** @test */
    public function cannot_query_a_saga_using_the_real_id()
    {
        /* *** Initialisation *** */
        /** @var Saga $saga */
        $saga = factory(Saga::class)->create();

        /* *** Process *** */
        $response = $this->json('GET', '/api/v1/sagas/' . $saga->id);

        /* *** Assertion *** */
        $response->assertStatus(404);
    }
}
