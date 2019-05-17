<?php

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;
use Radiophonix\Models\Support\FindableFromSlug;
use Radiophonix\Models\Support\HasCountCache;
use Radiophonix\Models\Support\HasFakeId;
use Radiophonix\Models\Support\Stats\GenreStats;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Album|Saga[] $sagas
 * @property-read int $cached_sagas_count
 */
class Genre extends Model implements HasMedia
{
    use HasFakeId;
    use Searchable;
    use HasMediaTrait;
    use HasSlug;
    use FindableFromSlug;
    use HasCountCache;

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

    /**
     * Slug generation configuration.
     *
     * @see https://github.com/spatie/laravel-sluggable
     *
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * @return int
     */
    public function getCachedSagasCountAttribute(): int
    {
        return $this->cacheCount('sagas', function () {
            return $this->sagas->count();
        });
    }
}
