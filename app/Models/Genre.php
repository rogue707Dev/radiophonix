<?php

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;
use Radiophonix\Models\Support\Genre\GenreStats;
use Radiophonix\Models\Support\HasFakeId;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection|Saga[] $sagas
 */
class Genre extends Model implements HasMedia
{
    use HasFakeId;
    use Searchable;
    use HasMediaTrait;

    /**
     * @var array
     */
    protected $fillable = ['name'];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('main')
            ->crop(Manipulations::CROP_CENTER, 400, 400)
            ->sharpen(10)
            ->optimize()
            ->performOnCollections('image');
    }

    /**
     * @return GenreStats
     */
    public function stats(): GenreStats
    {
        return new GenreStats($this);
    }

    /**
     * Sagas having this genre.
     *
     * @return BelongsToMany
     */
    public function sagas()
    {
        return $this->belongsToMany(Saga::class);
    }
}
