<?php

namespace Radiophonix\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;
use Radiophonix\Events\Author\AuthorSavingEvent;
use Radiophonix\Models\Support\FindableFromSlug;
use Radiophonix\Models\Support\HasCountCache;
use Radiophonix\Models\Support\HasFakeId;
use Radiophonix\Models\Support\Stats\AuthorStats;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * This class is used as a container for the public information about a saga's author.
 * Behind the scenes, an author can be a User or a Team.
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $bio
 * @property string $link_netowiki
 * @property string $link_site
 * @property string $link_topic
 * @property string $link_facebook
 * @property string $link_twitter
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read Model|\Eloquent|User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|Saga[] $sagas
 * @property-read int $cached_sagas_count
 */
class Author extends Model implements HasMedia
{
    use HasFakeId;
    use HasSlug;
    use HasMediaTrait;
    use FindableFromSlug;
    use Searchable;
    use HasCountCache;

    /**
     * @var array
     */
    protected $dispatchesEvents = [
        'saving' => AuthorSavingEvent::class,
    ];

    /**
     * @return AuthorStats
     */
    public function stats(): AuthorStats
    {
        return new AuthorStats($this);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function (Author $author) {
                return $author->user === null
                    ? 'temp'
                    : $author->user->name;
            })
            ->saveSlugsTo('slug');
    }

    /**
     * @param Media|null $media
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('main')
            ->crop(Manipulations::CROP_CENTER, 400, 400)
            ->sharpen(10)
            ->optimize()
            ->performOnCollections('picture');

        $this->addMediaConversion('thumb')
            ->crop(Manipulations::CROP_CENTER, 200, 200)
            ->sharpen(10)
            ->optimize()
            ->performOnCollections('picture');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }

    /**
     * @return BelongsToMany
     */
    public function sagas()
    {
        return $this->belongsToMany(Saga::class);
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
