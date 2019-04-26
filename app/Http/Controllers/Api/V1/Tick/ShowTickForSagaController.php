<?php

namespace Radiophonix\Http\Controllers\Api\V1\Tick;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\TickTransformer;
use Radiophonix\Models\Saga;
use Radiophonix\Models\Tick;

class ShowTickForSagaController extends ApiController
{
    /**
     * @param Saga $saga
     * @return ApiResponse
     */
    public function __invoke(Saga $saga)
    {
        $tick = Tick::where('user_id', '=', $this->user()->id)
            ->where('saga_id', $saga->id)
            ->firstOrFail();

        return $this->item($tick, new TickTransformer);
    }
}
