<?php
declare(strict_types=1);

namespace Tests\Feature\Api\V1\Albums;

use Radiophonix\Http\Transformers\AlbumTransformer;
use Radiophonix\Models\Album;
use Radiophonix\Models\Saga;
use Tests\Feature\Api\V1\ApiTestCase;

class GetSagaAlbumsTest extends ApiTestCase
{
    /** @test */
    public function can_get_a_list_of_albums_from_a_saga_uuid()
    {
        /* *** Initialisation *** */

        // SAGA A
        /** @var Saga $sagaA */
        $sagaA = factory(Saga::class)->create();
        /** @var \Illuminate\Database\Eloquent\Collection|Album[] $albumsA */
        $albumsA = factory(Album::class)->times(2)->make();

        $sagaA->albums()->saveMany($albumsA);

        // SAGA B
        /** @var Saga $sagaB */
        $sagaB = factory(Saga::class)->create();
        /** @var \Illuminate\Database\Eloquent\Collection|Album[] $albumsB */
        $albumsB = factory(Album::class)->times(2)->make();

        $sagaB->albums()->saveMany($albumsB);

        /* *** Process *** */
        $response = $this->json(
            'GET',
            '/api/v1/sagas/' . $sagaA->uuid() . '/albums'
        );

        $albumsA = $albumsA->fresh();

        /* *** Assertion *** */
        $response->assertStatus(200);
        $response->assertExactJson(
            $this->transformCollection($albumsA, (new AlbumTransformer())->setDefaultIncludes(['tracks']))
        );
    }

    /** @test */
    public function can_get_a_list_of_albums_from_a_saga_slug()
    {
        /* *** Initialisation *** */

        // SAGA A
        /** @var Saga $sagaA */
        $sagaA = factory(Saga::class)->create();
        /** @var \Illuminate\Database\Eloquent\Collection|Album[] $albumsA */
        $albumsA = factory(Album::class)->times(2)->make();

        $sagaA->albums()->saveMany($albumsA);

        // SAGA B
        /** @var Saga $sagaB */
        $sagaB = factory(Saga::class)->create();
        /** @var \Illuminate\Database\Eloquent\Collection|Album[] $albumsB */
        $albumsB = factory(Album::class)->times(2)->make();

        $sagaB->albums()->saveMany($albumsB);

        /* *** Process *** */
        $response = $this->json(
            'GET',
            '/api/v1/sagas/' . $sagaA->slug . '/albums'
        );

        $albumsA = $albumsA->fresh();

        /* *** Assertion *** */
        $response->assertStatus(200);
        $response->assertExactJson(
            $this->transformCollection($albumsA, (new AlbumTransformer())->setDefaultIncludes(['tracks']))
        );
    }

    /** @test */
    public function cannot_get_a_list_of_albums_from_a_saga_real_id()
    {
        /* *** Initialisation *** */
        /** @var Saga $saga */
        $saga = factory(Saga::class)->create();
        /** @var \Illuminate\Database\Eloquent\Collection|Album[] $albums */
        $albums = factory(Album::class)->times(2)->make();

        $saga->albums()->saveMany($albums);

        /* *** Process *** */
        $response = $this->json(
            'GET',
            '/api/v1/sagas/' . $saga->id . '/albums'
        );

        /* *** Assertion *** */
        $response->assertStatus(404);
    }
}
