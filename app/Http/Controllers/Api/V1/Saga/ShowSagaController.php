<?php

namespace Radiophonix\Http\Controllers\Api\V1\Saga;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\SagaTransformer;
use Radiophonix\Models\Saga;

class ShowSagaController extends ApiController
{
    /**
     * @param Saga $saga
     * @return ApiResponse
     */
    public function __invoke(Saga $saga)
    {
        $saga->load('genres', 'team', 'authors');
        $this->include('genres', 'team', 'authors');

        return $this->item($saga, new SagaTransformer);
    }
}
