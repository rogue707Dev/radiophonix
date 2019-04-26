<?php

namespace Radiophonix\Http\Controllers\Api\V1\Invite;

use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Models\Invite;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AcceptInviteController extends ApiController
{
    /**
     * @param Invite $invite
     * @return Response
     * @throws \Exception
     */
    public function __invoke(Invite $invite)
    {
        if ($invite->invited_id != $this->user()->id) {
            throw new AccessDeniedHttpException('Only the invited user can accept the invite.');
        }

        $invite->accepted = true;

        $invite->team->addMember($this->user())->save();

        // todo notify invited user

        $invite->delete();

        return $this->ok();
    }
}
