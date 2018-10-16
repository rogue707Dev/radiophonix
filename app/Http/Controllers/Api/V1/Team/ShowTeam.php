<?php

namespace Radiophonix\Http\Controllers\Api\V1\Team;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\TeamTransformer;
use Radiophonix\Models\Team;

class ShowTeam extends ApiController
{
    /**
     * @param Team $team
     * @return ApiResponse
     */
    public function __invoke(Team $team)
    {
        $team->load('sagas.authors', 'sagas.team', 'authors');
        $this->include('sagas', 'sagas.authors', 'sagas.team', 'authors');

        return $this->item($team, new TeamTransformer);
    }
}
