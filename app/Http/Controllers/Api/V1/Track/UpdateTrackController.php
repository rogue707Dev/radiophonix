<?php

namespace Radiophonix\Http\Controllers\Api\V1\Track;

use Illuminate\Auth\Access\AuthorizationException;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\UpdateTrackRequest;
use Radiophonix\Http\Transformers\TrackTransformer;
use Radiophonix\Models\Track;

class UpdateTrackController extends ApiController
{
    /**
     * @param UpdateTrackRequest $request
     * @param Track $track
     * @return ApiResponse
     * @throws AuthorizationException
     */
    public function __invoke(UpdateTrackRequest $request, Track $track)
    {
        $this->authorize('update', $track);

        $track->fill($request->all());

        $track->save();

        $track->album->saga->refreshLastPublishedAt();

        return $this->item($track, new TrackTransformer);
    }
}
