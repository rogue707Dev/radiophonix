<?php

namespace Radiophonix\Http\Controllers\Api\V1\Team;

use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Models\Team;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class DestroyTeamController extends ApiController
{
    /**
     * @param Team $team
     * @return Response
     * @throws \Exception
     */
    public function __invoke(Team $team)
    {
        if (!$team->isOwner($this->user())) {
            throw new AccessDeniedHttpException('Only the owner of a team can update it.');
        }

        $team->delete();

        return $this->ok();
    }
}
