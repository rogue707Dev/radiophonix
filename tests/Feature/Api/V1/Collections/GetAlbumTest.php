<?php
declare(strict_types=1);

namespace Tests\Feature\Api\V1\Albums;

use Radiophonix\Http\Transformers\AlbumTransformer;
use Radiophonix\Models\Album;
use Radiophonix\Models\Saga;
use Tests\Feature\Api\V1\ApiTestCase;

class GetAlbumTest extends ApiTestCase
{
    /** @test */
    public function can_get_album_from_fake_id()
    {
        /* *** Initialisation *** */
        /** @var Saga $saga */
        $saga = factory(Saga::class)->create();
        /** @var Album $album */
        $album = factory(Album::class)->make();

        $saga->albums()->save($album);

        /* *** Process *** */
        $response = $this->json(
            'GET',
            '/api/v1/albums/' . $album->fakeId()
        );

        $album = $album->fresh();

        /* *** Assertion *** */
        $response->assertStatus(200);
        $response->assertExactJson($this->transformItem($album, (new AlbumTransformer())->setDefaultIncludes(['tracks'])));
    }

    /** @test */
    public function cannot_get_album_from_real_id()
    {
        /* *** Initialisation *** */
        /** @var Saga $saga */
        $saga = factory(Saga::class)->create();
        /** @var Album $album */
        $album = factory(Album::class)->make();

        $saga->albums()->save($album);

        /* *** Process *** */
        $response = $this->json(
            'GET',
            '/api/v1/albums/' . $album->id
        );

        /* *** Assertion *** */
        $response->assertStatus(404);
    }
}
