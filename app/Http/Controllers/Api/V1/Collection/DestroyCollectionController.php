<?php

namespace Radiophonix\Http\Controllers\Api\V1\Collection;

use Illuminate\Auth\Access\AuthorizationException;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Models\Collection;
use Symfony\Component\HttpFoundation\Response;

class DestroyCollectionController extends ApiController
{
    /**
     * @param Collection $collection
     * @return Response
     * @throws \Exception
     * @throws AuthorizationException
     */
    public function __invoke(Collection $collection)
    {
        $this->authorize('delete', $collection);

        $saga = $collection->saga;

        $collection->delete();

        $saga->refreshLastPublishedAt();

        return $this->ok();
    }
}
