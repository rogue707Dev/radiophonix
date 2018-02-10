<?php

namespace Radiophonix\Http\Controllers\Api\V1\Invite;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\InviteTransformer;
use Radiophonix\Models\Invite;
use Radiophonix\Models\Team;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ListTeamPendingInvites extends ApiController
{
    /**
     * @param Team $team
     * @return ApiResponse
     */
    public function __invoke(Team $team)
    {
        if (!$team->isOwner($this->user())) {
            throw new AccessDeniedHttpException;
        }

        return $this->collection(Invite::fromTeam($team), new InviteTransformer);
    }
}
