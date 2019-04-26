<?php

namespace Radiophonix\Http\Controllers\Api\V1\Saga;

use Illuminate\Auth\Access\AuthorizationException;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\UpdateSagaRequest;
use Radiophonix\Http\Transformers\SagaTransformer;
use Radiophonix\Models\Saga;

class UpdateSagaController extends ApiController
{
    /**
     * @param UpdateSagaRequest $request
     * @param Saga $saga
     * @return ApiResponse
     * @throws AuthorizationException
     */
    public function __invoke(UpdateSagaRequest $request, Saga $saga)
    {
        $this->authorize('update', $saga);

        $saga->fill($request->all());

        $saga->save();

        return $this->item($saga, new SagaTransformer);
    }
}
