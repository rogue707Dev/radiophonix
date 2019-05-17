<?php

namespace Radiophonix\Http\Controllers\Api\V1\Invite;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Radiophonix\Exceptions\ValidationHttpException;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\CreateInviteRequest;
use Radiophonix\Http\Transformers\InviteTransformer;
use Radiophonix\Models\Invite;
use Radiophonix\Models\Team;
use Radiophonix\Models\User;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class SendInviteController extends ApiController
{
    /**
     * @param CreateInviteRequest $request
     * @param Team $team
     * @return ApiResponse
     */
    public function __invoke(CreateInviteRequest $request, Team $team)
    {
        if (!$team->hasMember($this->user())) {
            throw new AccessDeniedHttpException('Only members of a team can invite users to the team');
        }

        try {
            $invitedUser = User::fromUuId($request->get('invited_id'));
        } catch (ModelNotFoundException $e) {
            throw new ValidationHttpException('This user does not exist');
        }

        if ($invitedUser->id == $this->user()->id) {
            throw new ValidationHttpException('You cannot invite yourself');
        }

        $invite = Invite::where('team_id', $team->id)->where('invited_id', $invitedUser->id)->first();

        if ($invite != null) {
            throw new BadRequestHttpException('This user is already invited to join this team');
        }

        if ($team->hasMember($invitedUser)) {
            throw new BadRequestHttpException('This user is already in this team');
        }

        $invite = new Invite;

        $invite->team()->associate($team);
        $invite->inviting()->associate($this->user());
        $invite->invited()->associate($invitedUser);

        $invite->save();

        return $this->item($invite, new InviteTransformer);
    }
}
