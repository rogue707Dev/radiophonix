<?php

namespace Radiophonix\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Collection;
use Radiophonix\Models\Like;
use Radiophonix\Models\Support\Likeable;

class LikeRepository
{
    /**
     * @param User $user
     * @return Collection|Like[]
     */
    public function forUser(User $user): Collection
    {
        return Like::query()
            ->where('user_id', '=', $user->getAuthIdentifier())
            ->get();
    }

    public function forUserAndLikeable(User $user, Model $likeable): ?Like
    {
        $type = collect(Relation::morphMap())
            ->search(get_class($likeable));

        /** @var Like|null $like */
        $like = Like::query()
            ->where('user_id', '=', $user->getAuthIdentifier())
            ->where('likeable_type', $type)
            ->where('likeable_id', $likeable->id)
            ->first();

        return $like;
    }
}
