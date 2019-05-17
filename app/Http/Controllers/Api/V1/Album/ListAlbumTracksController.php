<?php

namespace Radiophonix\Http\Controllers\Api\V1\Album;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\TrackTransformer;
use Radiophonix\Models\Album;

class ListAlbumTracksController extends ApiController
{
    public function __invoke(Album $album): ApiResponse
    {
        return $this->collection($album->tracks, new TrackTransformer);
    }
}
