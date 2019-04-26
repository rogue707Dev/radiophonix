<?php

namespace Radiophonix\Http\Controllers\Api\V1\Invite;

use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Models\Invite;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class DeclineInviteController extends ApiController
{
    /**
     * @param Invite $invite
     * @return Response
     * @throws \Exception
     */
    public function __invoke(Invite $invite)
    {
        if ($invite->invited_id != $this->user()->id && $invite->inviting_id != $this->user()->id) {
            throw new AccessDeniedHttpException('Only the invited or the inviting user can decline the invite.');
        }

        if ($invite->invited_id != $invite->inviting_id) {
            // todo notify the inviting user that the invite was declined
        }

        $invite->delete();

        return $this->ok();
    }
}
