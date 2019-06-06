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
            ->with('track.album.saga')
            ->where('user_id', '=', $this->user()->id)
            ->orderBy('updated_at', 'desc')
            ->groupBy('track_id')
            ->get();

        return $this->collection($ticks, new TickTransformer);
    }
}
