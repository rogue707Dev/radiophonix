<?php
declare(strict_types=1);

namespace Radiophonix\Domain\Metric\Entry;

use Radiophonix\Domain\Metric\MetricEntry;
use Radiophonix\Models\Tick;
use Radiophonix\Models\Track;

class TickEntry implements MetricEntry
{
    /** @var Track */
    private $track;

    /** @var Tick */
    private $tick;

    /** @var int */
    private $oldProgress;

    public function __construct(Track $track, Tick $tick, int $oldProgress)
    {
        $this->track = $track;
        $this->tick = $tick;
        $this->oldProgress = $oldProgress;
    }

    public function type(): string
    {
        return 'tick';
    }

    public function version(): int
    {
        return 1;
    }

    public function data(): array
    {
        return [
            'track_id' => $this->track->id,
            'tick_id' => $this->tick->uuid,
            'progress' => [
                'old' => $this->oldProgress,
                'new' => $this->tick->progress,
            ],
        ];
    }
}
