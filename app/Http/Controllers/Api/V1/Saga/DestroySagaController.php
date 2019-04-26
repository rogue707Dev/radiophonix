<?php

namespace Radiophonix\Http\Controllers\Api\V1\Saga;

use Illuminate\Auth\Access\AuthorizationException;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Models\Saga;
use Symfony\Component\HttpFoundation\Response;

class DestroySagaController extends ApiController
{
    /**
     * @param Saga $saga
     * @return Response
     * @throws \Exception
     * @throws AuthorizationException
     */
    public function __invoke(Saga $saga)
    {
        $this->authorize('delete', $saga);

        $saga->delete();

        return $this->ok();
    }
}
