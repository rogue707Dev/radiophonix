<?php

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Radiophonix\Models\Support\CollectionType;
use Radiophonix\Models\Support\HasCountCache;
use Radiophonix\Models\Support\HasFakeId;

/**
 * @property int $id
 * @property int $saga_id
 * @property string $number
 * @property string $name
 * @property string $synopsis
 * @property string $type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Saga $saga
 * @property-read \Illuminate\Database\Eloquent\Collection|Track[] $tracks
 * @property-read int $cached_tracks_count
 */
class Collection extends Model
{
    use HasFakeId;
    use HasCountCache;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'synopsis',
        'type',
        'number',
    ];

    /**
     * @var array
     */
    protected $touches = [
        'saga',
    ];

    /**
     * The saga associated to this collection.
     *
     * @return BelongsTo
     */
    public function saga()
    {
        return $this->belongsTo(Saga::class);
    }

    /**
     * The list of tracks in this collection.
     *
     * @return HasMany
     */
    public function tracks()
    {
        return $this->hasMany(Track::class);
    }

    /**
     * Setter for the $type attribute.
     *
     * @param $value
     */
    public function setTypeAttribute($value)
    {
        if ($value == null) {
            $value = CollectionType::SEASON;
        }

        $this->attributes['type'] = $value;
    }

    /**
     * @return int
     */
    public function getCachedTracksCountAttribute(): int
    {
        return $this->cacheCount('tracks', function () {
            return $this->tracks->count();
        });
    }
}
