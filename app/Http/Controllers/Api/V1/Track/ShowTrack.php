<?php

namespace Radiophonix\Http\Controllers\Api\V1\Track;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\TrackTransformer;
use Radiophonix\Models\Track;

class ShowTrack extends ApiController
{
    /**
     * @param Track $track
     * @return ApiResponse
     */
    public function __invoke(Track $track)
    {
        return $this->item($track, new TrackTransformer);
    }
}
