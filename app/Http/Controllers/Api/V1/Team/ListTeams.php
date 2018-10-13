<?php

namespace Radiophonix\Http\Controllers\Api\V1\Team;

use Illuminate\Database\Eloquent\Builder;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\TeamTransformer;
use Radiophonix\Models\Team;
use Radiophonix\Models\Track;

class ListTeams extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function __invoke()
    {
        return $this->collection(Team::all(), new TeamTransformer());
    }
}
