<?php

namespace Radiophonix\Http\Transformers;

use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Team;
use Radiophonix\Services\FakeId\FakeIdManager;

class TeamTransformer extends Transformer
{
    protected $availableIncludes = [
        'members'
    ];

    public function transform(Team $team)
    {
        $fakeIdManager = app(FakeIdManager::class);

        return [
            'id' => $team->fakeId(),
            'name' => $team->name,
            'bio' => $team->bio,
            'owner_id' => $fakeIdManager->connection('users')->encode($team->owner_id),
            'created_at' => $this->getFormatedDate($team->created_at),
            'updated_at' => $this->getFormatedDate($team->updated_at),
        ];
    }

    public function includeMembers(Team $team)
    {
        return $this->collection($team->members, new UserTransformer);
    }
}
