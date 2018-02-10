<?php

namespace Radiophonix\Http\Controllers\Api\V1\Subscription;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\SagaTransformer;
use Radiophonix\Models\Subscription;

class ListUserSubscriptions extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function __invoke()
    {
        $sagas = Subscription::with('saga')
            ->where('user_id', '=', $this->user()->id)
            ->get()
            ->pluck('saga');

        return $this->collection($sagas, new SagaTransformer);
    }
}
