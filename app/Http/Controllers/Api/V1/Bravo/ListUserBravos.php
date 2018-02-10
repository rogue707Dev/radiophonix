<?php

namespace Radiophonix\Http\Controllers\Api\V1\Bravo;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\SagaTransformer;
use Radiophonix\Models\Bravo;

class ListUserBravos extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function __invoke()
    {
        $bravos = Bravo::with('saga')
            ->where('user_id', '=', $this->user()->id)
            ->get();

        $sagas = $bravos->pluck('saga');

        return $this->collection($sagas, new SagaTransformer);
    }
}
