<?php
declare(strict_types=1);

namespace Radiophonix\Domain\Metric\Entry;

use Radiophonix\Domain\Metric\MetricEntry;
use Radiophonix\Models\Tick;
use Radiophonix\Models\Track;
use Radiophonix\Models\User;

class TickEntry implements MetricEntry
{
    /** @var User */
    private $user;

    /** @var Track */
    private $track;

    /** @var Tick */
    private $tick;

    /** @var int */
    private $oldProgress;

    public function __construct(User $user, Track $track, Tick $tick, int $oldProgress)
    {
        $this->user = $user;
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
            'user_id' => $this->user->id,
            'track_id' => $this->track->id,
            'tick_id' => $this->tick->uuid,
            'progress' => [
                'old' => $this->oldProgress,
                'new' => $this->tick->progress,
            ],
        ];
    }
}
