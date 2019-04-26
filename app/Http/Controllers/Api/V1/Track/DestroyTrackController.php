<?php

namespace Radiophonix\Http\Controllers\Api\V1\Track;

use Illuminate\Auth\Access\AuthorizationException;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Models\Saga;
use Radiophonix\Models\Track;
use Symfony\Component\HttpFoundation\Response;

class DestroyTrackController extends ApiController
{
    /**
     * @param Track $track
     * @return Response
     * @throws \Exception
     * @throws AuthorizationException
     */
    public function __invoke(Track $track)
    {
        $this->authorize('delete', $track);

        /** @var Saga $saga */
        $saga = $track->collection->saga;

        $track->delete();

        $saga->refreshLastPublishedAt();

        return $this->ok();
    }
}
