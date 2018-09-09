<?php

namespace Radiophonix\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Laravel\Scout\Searchable;
use Radiophonix\Events\Author\AuthorSavingEvent;
use Radiophonix\Models\Support\AuthorStats;
use Radiophonix\Models\Support\FindableFromSlug;
use Radiophonix\Models\Support\HasFakeId;
use Radiophonix\Models\Support\SagaOwner;
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
 * @property int $owner_id
 * @property string $name
 * @property string $slug
 * @property string $owner_type
 * @property string $bio
 * @property string $link_netowiki
 * @property string $link_site
 * @property string $link_topic
 * @property string $link_facebook
 * @property string $link_twitter
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read Model|\Eloquent|User|Team $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|Saga[] $sagas
 */
class Author extends Model implements HasMedia
{
    use HasFakeId;
    use HasSlug;
    use HasMediaTrait;
    use FindableFromSlug;
    use Searchable;

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
     * Checks if the given object owns this instance.
     *
     * @param SagaOwner $owner
     * @return bool
     */
    public function isOwnedBy(SagaOwner $owner)
    {
        if ($owner instanceof User) {
            // If a team owns this Author, we check that the $owner User is a member of this Team
            if ($this->owner instanceof Team) {
                return $this->owner->hasMember($owner);
            }

            return $this->owner instanceof User && $this->owner_id == $owner->id;
        }

        if ($owner instanceof Team) {
            return $this->owner instanceof Team && $this->owner_id == $owner->id;
        }

        return false;
    }

    /**
     * The owner of this profile. Can be a user or a team.
     *
     * @return MorphTo
     */
    public function owner()
    {
        return $this->morphTo();
    }

    /**
     * List of saga owned by this profile.
     *
     * @return HasMany
     */
    public function sagas()
    {
        return $this->hasMany(Saga::class);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function (Author $author) {
                return $author->owner === null
                    ? 'temp'
                    : $author->owner->name;
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
}
