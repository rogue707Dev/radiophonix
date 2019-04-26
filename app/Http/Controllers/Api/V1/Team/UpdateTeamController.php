<?php

namespace Radiophonix\Http\Controllers\Api\V1\Team;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\UpdateTeamRequest;
use Radiophonix\Http\Transformers\TeamTransformer;
use Radiophonix\Models\Team;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class UpdateTeamController extends ApiController
{
    /**
     * @param UpdateTeamRequest $request
     * @param Team $team
     * @return ApiResponse
     */
    public function __invoke(UpdateTeamRequest $request, Team $team)
    {
        if (!$team->isOwner($this->user())) {
            throw new AccessDeniedHttpException('Only the owner of a team can update it.');
        }

        $team->fill($request->all());

        $team->save();

        return $this->item($team, new TeamTransformer);
    }
}
