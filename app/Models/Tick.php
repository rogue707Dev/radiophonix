<?php

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Radiophonix\Models\Scopes\TickCompleteScope;

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
    /**
     * Indique le pourcentage (sur 100000) à partir duquel on considère qu'un
     * épisode a été lu entièrement.
     */
    public const MIN_PROGRESS_TO_BE_COMPLETE = 99500;

    /** @var string */
    protected $primaryKey = 'uuid';

    /** @var string */
    protected $keyType = 'string';

    /** @var bool */
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TickCompleteScope());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }
}
