<?php

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Radiophonix\Models\Support\HasFakeId;

/**
 * A Like is given by a User to a specific Saga.
 *
 * @property int $id
 * @property int $saga_id
 * @property int $user_id
 * @property int $likeable_id
 * @property string $likeable_type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Saga $saga
 * @property-read User $user
 */
class Like extends Model
{
    use HasFakeId;

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
}
