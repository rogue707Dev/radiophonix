<?php

namespace Radiophonix\Http\Controllers\Api\V1\Team;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\SagaTransformer;
use Radiophonix\Models\Team;

class ListTeamSagasController extends ApiController
{
    /**
     * @param Team $team
     * @return ApiResponse
     */
    public function __invoke(Team $team)
    {
        $sagas = $team->sagas()->with('team')->get();

        return $this->collection($sagas, new SagaTransformer);
    }
}
