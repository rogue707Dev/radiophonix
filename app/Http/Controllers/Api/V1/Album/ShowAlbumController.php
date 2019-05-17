<?php

namespace Radiophonix\Http\Controllers\Api\V1\Album;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\AlbumTransformer;
use Radiophonix\Models\Album;

class ShowAlbumController extends ApiController
{
    public function __invoke(Album $album): ApiResponse
    {
        $transformer = new AlbumTransformer;
        $transformer->setDefaultIncludes(['tracks']);

        return $this->item($album, $transformer);
    }
}
