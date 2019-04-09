<?php

namespace Radiophonix\Http\Controllers\Api\V1\Like;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\SagaTransformer;
use Radiophonix\Models\Like;

class ListUserLikes extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function __invoke()
    {
        $likes = Like::with('saga')
            ->where('user_id', '=', $this->user()->id)
            ->get();

        $sagas = $likes->pluck('saga');

        return $this->collection($sagas, new SagaTransformer);
    }
}
