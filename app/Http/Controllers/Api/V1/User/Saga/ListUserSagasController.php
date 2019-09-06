<?php

namespace Radiophonix\Http\Controllers\Api\V1\User\Saga;

use Illuminate\Database\Eloquent\Builder;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\SagaTransformer;
use Radiophonix\Models\Saga;

class ListUserSagasController extends ApiController
{
    public function __invoke()
    {
        $user = $this->user();

        if ($user->author === null) {
            return $this->empty();
        }

        $this->include('team', 'authors');

        /** @var Saga|Builder $sagas */
        $sagas = $user->author->sagas()->with('team');
        $sagas = $sagas->get();

        return $this->collection($sagas, new SagaTransformer());
    }
}
