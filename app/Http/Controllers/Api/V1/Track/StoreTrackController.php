<?php

namespace Radiophonix\Http\Controllers\Api\V1\Track;

use Illuminate\Auth\Access\AuthorizationException;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\CreateTrackRequest;
use Radiophonix\Http\Transformers\TrackTransformer;
use Radiophonix\Models\Album;
use Radiophonix\Models\Track;

class StoreTrackController extends ApiController
{
    /**
     * @param CreateTrackRequest $request
     * @param Album $album
     * @return ApiResponse
     * @throws AuthorizationException
     */
    public function __invoke(CreateTrackRequest $request, Album $album)
    {
        $this->authorize('create', [Track::class, $album]);

        $track = new Track;

        $track->fill($request->only($track->getFillable()));

        $track->album()->associate($album);

        $track->save();

        return $this->item($track, new TrackTransformer);
    }
}
