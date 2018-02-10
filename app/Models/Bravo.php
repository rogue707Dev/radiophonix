<?php

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * A Bravo is given by a User to a specific Saga.
 *
 * @property int $id
 * @property int $saga_id
 * @property int $user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Saga $saga
 * @property-read User $user
 */
class Bravo extends Model
{
    /**
     * The user who's giving a bravo.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The concerned saga.
     *
     * @return BelongsTo
     */
    public function saga()
    {
        return $this->belongsTo(Saga::class);
    }
}
