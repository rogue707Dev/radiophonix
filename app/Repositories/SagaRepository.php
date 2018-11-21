<?php

namespace Radiophonix\Repositories;

use Illuminate\Auth\AuthManager;
use Radiophonix\Http\Requests\CreateSagaRequest;
use Radiophonix\Models\Saga;
use Radiophonix\Models\Team;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class SagaRepository
{
    /**
     * @var AuthManager
     */
    protected $guard;

    function __construct(AuthManager $auth)
    {
        $this->guard = $auth->guard();
    }

    public function create(CreateSagaRequest $request)
    {
        $saga = new Saga;

        $saga->fill($request->only($saga->getFillable()));

        if ($request->has('team_id')) {
            /** @var Team $team */
            $team = Team::findOrFail($request->get('team_id'));

            if (!$team->hasMember($this->guard->user())) {
                throw new AccessDeniedHttpException('You need to be a member of this team to create a saga in it');
            }

            if (!$team->isOwner($this->guard->user())) {
                // @todo gérer les notifications depuis des events de model
                $team->owner->notify('', '');
            }

            $saga->setOwner($team);
        } else {
            $saga->setOwner($this->guard->user());
        }

        $saga->save();

        return $saga;
    }
}
