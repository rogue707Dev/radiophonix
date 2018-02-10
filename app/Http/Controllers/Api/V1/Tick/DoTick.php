<?php

namespace Radiophonix\Http\Controllers\Api\V1\Tick;

use Illuminate\Http\Request;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Models\Tick;
use Radiophonix\Models\Track;
use Symfony\Component\HttpFoundation\Response;

class DoTick extends ApiController
{
    /**
     * @param Request $request
     * @param Track $track
     * @return Response
     */
    public function __invoke(Request $request, Track $track)
    {
        /** @var Tick $tick */
        $tick = Tick::where('user_id', '=', $this->user()->id)
            ->where('track_id', $track->id)
            ->first();

        if ($tick == null) {
            $tick = new Tick;
        }

        $data = $request->all();

        $tick->user()->associate($this->user());
        $tick->track()->associate($track);
        $tick->seconds = $data['seconds'];

        $tick->save();

        return $this->ok();
    }
}
