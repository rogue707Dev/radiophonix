<?php

namespace Radiophonix\Http\Controllers\Api\V1\Team;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\SagaTransformer;
use Radiophonix\Models\Team;

class ListTeamSagas extends ApiController
{
    /**
     * @param Team $team
     * @return ApiResponse
     */
    public function __invoke(Team $team)
    {
        return $this->collection($team->sagas, new SagaTransformer);
    }
}
