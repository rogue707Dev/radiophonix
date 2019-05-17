<?php

namespace Radiophonix\Http\Controllers\Api\V1\Album;

use Illuminate\Auth\Access\AuthorizationException;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\UpdateAlbumRequest;
use Radiophonix\Http\Transformers\AlbumTransformer;
use Radiophonix\Models\Album;

class UpdateAlbumController extends ApiController
{
    /**
     * @param UpdateAlbumRequest $request
     * @param Album $album
     * @return ApiResponse
     * @throws AuthorizationException
     */
    public function __invoke(UpdateAlbumRequest $request, Album $album)
    {
        $this->authorize('update', $album);

        $album->fill($request->all());

        $album->save();

        return $this->item($album, new AlbumTransformer);
    }
}
