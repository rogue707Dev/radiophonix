<?php

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $saga_id
 * @property int $user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Saga $saga
 * @property-read User $user
 */
class Subscription extends Model
{
    /**
     * Helper to list all subscriptions for one Saga.
     *
     * @param Saga $saga
     * @return Subscription[]
     */
    public static function forSaga(Saga $saga)
    {
        return self::where('saga_id', $saga->id)->get();
    }

    /**
     * The user who subscribed to this saga.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The saga subscribed to.
     *
     * @return BelongsTo
     */
    public function saga()
    {
        return $this->belongsTo(Saga::class);
    }
}
