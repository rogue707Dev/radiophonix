<?php
declare(strict_types=1);

namespace Radiophonix\Domain\Metric\Entry;

use Radiophonix\Domain\Metric\MetricEntry;
use Radiophonix\Models\Track;

class TrackPlayEntry implements MetricEntry
{
    /** @var Track */
    private $track;

    public function __construct(Track $track)
    {
        $this->track = $track;
    }

    public function type(): string
    {
        return 'play';
    }

    public function version(): int
    {
        return 1;
    }

    public function data(): array
    {
        $data = [
            'track_id' => $this->track->id,
        ];

        return $data;
    }
}
