<?php

namespace Radiophonix\Http\Controllers\Api\V1\Tick;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\Tick\SaveTickRequest;
use Radiophonix\Models\Tick;
use Radiophonix\Models\Track;
use Symfony\Component\HttpFoundation\Response;

class SaveTickController extends ApiController
{
    /**
     * @param SaveTickRequest $request
     * @param Track $track
     * @return Response
     */
    public function __invoke(SaveTickRequest $request, Track $track)
    {
        /** @var Tick|null $tick */
        $tick = Tick::query()->where('user_id', '=', $this->user()->id)
            ->where('track_id', $track->id)
            ->first();

        if (null === $tick) {
            $tick = new Tick();
            $tick->uuid = Str::orderedUuid();
        }

        $tick->user()->associate($this->user());
        $tick->track()->associate($track);
        $tick->progress = (int)$request->get('progress');

        $tick->save();

        return $this->ok();
    }
}
