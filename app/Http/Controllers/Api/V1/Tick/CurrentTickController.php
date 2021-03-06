<?php

namespace Radiophonix\Http\Controllers\Api\V1\Tick;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\TickTransformer;
use Radiophonix\Models\Tick;

class CurrentTickController extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function __invoke()
    {
        $tick = Tick::query()
            ->where('user_id', '=', $this->user()->id)
            ->orderBy('updated_at', 'desc')
            ->firstOrFail();

        return $this->item($tick, new TickTransformer);
    }
}
