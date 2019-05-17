<?php

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Radiophonix\Models\Support\AlbumType;
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
 * @property-read Collection|Track[] $tracks
 * @property-read int $cached_tracks_count
 */
class Album extends Model
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

    public function saga()
    {
        return $this->belongsTo(Saga::class);
    }

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }

    public function setTypeAttribute(string $value): void
    {
        if ($value == null) {
            $value = AlbumType::SEASON;
        }

        $this->attributes['type'] = $value;
    }

    public function getCachedTracksCountAttribute(): int
    {
        return $this->cacheCount('tracks', function () {
            return $this->tracks->count();
        });
    }
}
