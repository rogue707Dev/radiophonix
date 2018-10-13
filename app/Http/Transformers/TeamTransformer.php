<?php

namespace Radiophonix\Http\Transformers;

use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Team;

class TeamTransformer extends Transformer
{
    protected $availableIncludes = [
        'authors',
    ];

    public function transform(Team $team)
    {
        return [
            'id' => $team->fakeId(),
            'name' => $team->name,
            'bio' => $team->bio,
            'stats' => $team->stats()->toArray(),
            'created_at' => $this->getFormatedDate($team->created_at),
            'updated_at' => $this->getFormatedDate($team->updated_at),
        ];
    }

    public function includeMembers(Team $team)
    {
        return $this->collection($team->authors, new UserTransformer);
    }
}
