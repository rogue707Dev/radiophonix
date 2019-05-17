<?php

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use InvalidArgumentException;
use Radiophonix\Events\Like\UserLikedSaga;
use Radiophonix\Models\Support\GeneratesUuid;
use Radiophonix\Models\Support\HasUuid;

/**
 * A Like is given by a User to a specific Saga.
 *
 * @property int $id
 * @property int $saga_id
 * @property int $user_id
 * @property int $likeable_id
 * @property string $likeable_type
 * @property string $likeable_uuid
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Saga $saga
 * @property-read User $user
 */
class Like extends Model
{
    /**
     * The user who's giving a like.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likeable()
    {
        return $this->morphTo();
    }

    public static function createFor(User $user, Model $likeable): void
    {
        if (!$likeable instanceof HasUuid) {
            throw new InvalidArgumentException(
                vsprintf(
                    'Le model `%s` doit implémenter l\'interface `%s`',
                    [
                        get_class($likeable),
                        HasUuid::class,
                    ]
                )
            );
        }

        $like = new Like;

        $like->likeable()->associate($likeable);
        $like->user()->associate($user);

        $like->likeable_uuid = $likeable->uuid();

        $like->save();

        if ($likeable instanceof Saga) {
            event(new UserLikedSaga($user, $likeable));
        }
    }
}
