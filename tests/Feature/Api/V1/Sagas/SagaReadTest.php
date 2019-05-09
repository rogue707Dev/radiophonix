<?php

namespace Tests\Feature\Api\V1\Sagas;

use Radiophonix\Http\Transformers\SagaTransformer;
use Radiophonix\Models\Saga;
use Tests\Feature\Api\V1\ApiTestCase;

class SagaReadTest extends ApiTestCase
{
    /** @test */
    public function can_query_a_list_of_sagas()
    {
        /* *** Initialisation *** */
        $sagas = factory(Saga::class)->times(2)->create();

        /* *** Process *** */
        $response = $this->json('GET', '/api/v1/sagas');

        /* *** Assertion *** */
        $response->assertStatus(200);
        $response->assertJson($this->transformCollection($sagas, new SagaTransformer()));
    }
}
