<?php

namespace Radiophonix\Models\Support\Stats;

use Illuminate\Contracts\Support\Arrayable;
use Radiophonix\Models\Team;

class TeamStats implements Arrayable
{
    /**
     * @var Team
     */
    private $team;

    /**
     * @param Team $team
     */
    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            // @todo sagas visibles
            'sagas' => $this->team->cached_sagas_count,
        ];
    }
}
