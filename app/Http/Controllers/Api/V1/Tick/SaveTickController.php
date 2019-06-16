<?php

namespace Radiophonix\Http\Controllers\Api\V1\Tick;

use Illuminate\Support\Str;
use Radiophonix\Domain\Metric\Entry\TickEntry;
use Radiophonix\Domain\Metric\Metrics;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\Tick\SaveTickRequest;
use Radiophonix\Models\Tick;
use Radiophonix\Models\Track;
use Symfony\Component\HttpFoundation\Response;

class SaveTickController extends ApiController
{
    /**
     * @var Metrics
     */
    private $metrics;

    /**
     * @param Metrics $metrics
     */
    public function __construct(Metrics $metrics)
    {
        $this->metrics = $metrics;
    }

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
            ->orderBy('updated_at', 'desc')
            ->first();

        if (null === $tick) {
            $tick = new Tick();
            $tick->uuid = Str::orderedUuid();
        }

        $oldProgress = (int)$tick->progress;

        $tick->user()->associate($this->user());
        $tick->track()->associate($track);
        $tick->progress = (int)$request->get('progress');

        $tick->save();

        $this->metrics->record(new TickEntry($track, $tick, $oldProgress));

        return $this->ok();
    }
}
