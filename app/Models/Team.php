<?php

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as IlluminateUser;
use Radiophonix\Models\Support\FindableFromSlug;
use Radiophonix\Models\Support\HasCountCache;
use Radiophonix\Models\Support\HasFakeId;
use Radiophonix\Models\Support\Stats\TeamStats;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $bio
 * @property string $link_netowiki
 * @property string $link_site
 * @property string $link_facebook
 * @property string $link_twitter
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection|Author[] $authors
 * @property-read Collection|Saga[] $sagas
 * @property-read User $owner
 * @property-read int $cached_sagas_count
 */
class Team extends Model implements HasMedia
{
    use HasFakeId;
    use HasSlug;
    use FindableFromSlug;
    use HasMediaTrait;
    use HasCountCache;

    /**
     * @var array
     */
    protected $fillable = ['name', 'bio'];

    /**
     * @param User $user
     * @param bool|false $owner
     * @return $this
     */
    public function addMember(User $user, $owner = false)
    {
        $this->members()->save($user);

        if ($owner === true) {
            $this->owner()->associate($user);
        }

        return $this;
    }

    /**
     * Return true if the given User is in this Team
     *
     * @param User $user
     * @return bool
     */
    public function hasMember(User $user)
    {
        return collect($this->members)
            ->contains('id', '=', $user->id);
    }

    /**
     * Return true if the given User is the owner of this Team
     * @param IlluminateUser $user
     * @return bool
     */
    public function isOwner(IlluminateUser $user)
    {
        return $this->owner_id == $user->id;
    }

    /**
     * The user who's in charge of this team.
     *
     * @return BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    /**
     * @return HasMany
     */
    public function sagas()
    {
        return $this->hasMany(Saga::class);
    }

    /**
     * @return TeamStats
     */
    public function stats(): TeamStats
    {
        return new TeamStats($this);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * @todo trait en commun avec Author
     *
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
     * @return int
     */
    public function getCachedSagasCountAttribute(): int
    {
        return $this->cacheCount('sagas', function () {
            return $this->sagas->count();
        });
    }
}
