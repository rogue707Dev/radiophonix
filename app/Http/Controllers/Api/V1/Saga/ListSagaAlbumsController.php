<?php

namespace Radiophonix\Http\Controllers\Api\V1\Saga;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\AlbumTransformer;
use Radiophonix\Models\Saga;

class ListSagaAlbumsController extends ApiController
{
    public function __invoke(Saga $saga): ApiResponse
    {
        $saga->load('albums.tracks');

        $transformer = new AlbumTransformer;
        $transformer->setDefaultIncludes(['tracks']);

        return $this->collection($saga->albums, $transformer);
    }
}
