<?php

namespace Radiophonix\Http\Controllers\Api\V1\Collection;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\TrackTransformer;
use Radiophonix\Models\Collection;

class ListCollectionTracksController extends ApiController
{
    /**
     * @param Collection $collection
     * @return ApiResponse
     */
    public function __invoke(Collection $collection)
    {
        return $this->collection($collection->tracks, new TrackTransformer);
    }
}
