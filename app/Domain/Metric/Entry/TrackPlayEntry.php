<?php
declare(strict_types=1);

namespace Radiophonix\Domain\Metric\Entry;

use Radiophonix\Domain\Metric\MetricEntry;
use Radiophonix\Models\Track;
use Radiophonix\Models\User;

class TrackPlayEntry implements MetricEntry
{
    /** @var Track */
    private $track;

    /** @var User|null */
    private $user;

    public function __construct(Track $track, ?User $user)
    {
        $this->track = $track;
        $this->user = $user;
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

        if ($this->user instanceof User) {
            $data['user_id'] = $this->user->id;
        }

        return $data;
    }
}
