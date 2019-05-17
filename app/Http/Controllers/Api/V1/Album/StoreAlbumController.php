<?php

namespace Radiophonix\Http\Controllers\Api\V1\Album;

use Illuminate\Auth\Access\AuthorizationException;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\CreateAlbumRequest;
use Radiophonix\Http\Transformers\AlbumTransformer;
use Radiophonix\Models\Album;
use Radiophonix\Models\Saga;

class StoreAlbumController extends ApiController
{
    /**
     * @param CreateAlbumRequest $request
     * @param Saga $saga
     * @return ApiResponse
     * @throws AuthorizationException
     */
    public function __invoke(CreateAlbumRequest $request, Saga $saga)
    {
        $this->authorize('create', [Album::class, $saga]);

        $album = new Album;

        $album->fill($request->only($album->getFillable()));

        $album->saga()->associate($saga);

        // todo this should be done somewhere else
        // We grab the highest sort value and increment it
        $lastSort = $saga->albums->max('sort');
        $album->sort = ++$lastSort;

        $album->save();

        return $this->item($album, new AlbumTransformer);
    }
}
