<?php

namespace Radiophonix\Models\Support\Stats;

use Illuminate\Contracts\Support\Arrayable;
use Radiophonix\Models\Album;
use Radiophonix\Models\Saga;

class SagaStats implements Arrayable
{
    /**
     * @var Saga
     */
    private $saga;

    /**
     * @param Saga $saga
     */
    public function __construct(Saga $saga)
    {
        $this->saga = $saga;
    }

    /**
     * @return int
     */
    public function tracks(): int
    {
        return (int)$this->saga->cached_tracks_count;
    }

    /**
     * @return int
     */
    public function likes(): int
    {
        return (int)$this->saga->cached_likes_count;
    }

    /**
     * @return int
     */
    public function albums(): int
    {
        return (int)$this->saga->cached_albums_count;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'likes' => $this->likes(),
            'albums' => $this->albums(),
            'tracks' => $this->tracks(),
        ];
    }
}
