<?php

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $saga_id
 * @property int $track_id
 * @property int $seconds
 * @property bool $finished
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Saga $saga
 * @property-read Track $track
 * @property-read User $user
 */
class Tick extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['seconds'];

    /**
     * The User who's listening to this Track
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The associated Saga
     *
     * @return BelongsTo
     */
    public function saga()
    {
        return $this->belongsTo(Saga::class);
    }

    /**
     * The associated Track
     *
     * @return BelongsTo
     */
    public function track()
    {
        return $this->belongsTo(Track::class);
    }
}
