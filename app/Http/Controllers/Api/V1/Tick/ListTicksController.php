<?php

namespace Radiophonix\Http\Controllers\Api\V1\Tick;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\TickTransformer;
use Radiophonix\Models\Tick;

class ListTicksController extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function __invoke()
    {
        $ticks = Tick::query()
            ->with('track.collection.saga')
            ->where('user_id', '=', $this->user()->id)
            ->get();

        return $this->collection($ticks, new TickTransformer);
    }
}
