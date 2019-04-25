<?php

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $uuid
 * @property int $user_id
 * @property int $saga_id
 * @property int $track_id
 * @property int $progress
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Saga $saga
 * @property-read Track $track
 * @property-read User $user
 */
class Tick extends Model
{
    /** @var string */
    protected $primaryKey = 'uuid';

    /** @var string */
    protected $keyType = 'string';

    /** @var bool */
    public $incrementing = false;

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function track()
    {
        return $this->belongsTo(Track::class);
    }
}
