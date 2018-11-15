<?php

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;
use Radiophonix\Models\Support\FindableFromSlug;
use Radiophonix\Models\Support\HasCountCache;
use Radiophonix\Models\Support\HasFakeId;
use Radiophonix\Models\Support\Licence\Licence;
use Radiophonix\Models\Support\Licence\LicenceMapper;
use Radiophonix\Models\Support\Stats\SagaStats;
use Spatie\Image\Exceptions\InvalidManipulation;
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
 * @property string $synopsis
 * @property Carbon $creation_date
 * @property string $licence
 * @property string $link_netowiki
 * @property string $link_site
 * @property string $link_facebook
 * @property string $link_twitter
 * @property bool $finished
 * @property int $visibility
 * @property Carbon $last_publish_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Author[] $authors
 * @property-read Team $team
 * @property-read \Illuminate\Database\Eloquent\Collection|Like[] $likes
 * @property-read \Illuminate\Database\Eloquent\Collection|Collection[] $collections
 * @property-read \Illuminate\Database\Eloquent\Collection|Genre[] $genres
 * @property-read int $cached_tracks_count
 * @property-read int $cached_likes_count
 * @property-read int $cached_collections_count
 * @method static Builder|Saga filterBy($filters)
 * @method static Builder|Saga paginate()
 * @method static Builder|Saga sortby($sort)
 * @method static Builder|Saga visibles()
 */
class Saga extends Model implements HasMedia
{
    use HasFakeId;
    use HasMediaTrait;
    use HasSlug;
    use FindableFromSlug;
    use Searchable;
    use HasCountCache;

    // Public sagas are always visible even when not authenticated
    const VISIBILITY_PUBLIC = 0;

    // Hidden sagas are only visible by direct link and not in lists
    const VISIBILITY_HIDDEN = 1;

    // Private sagas are only visible to owners of the saga
    const VISIBILITY_PRIVATE = 2;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'synopsis',
        'creation_date',
        'licence',
        'link_netowiki',
        'link_site',
        'link_facebook',
        'link_twitter',
        'finished',
        'visibility',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'finished' => 'boolean',
        'visibility' => 'int',
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'creation_date'];

    /**
     * @var array
     */
    protected $sortable = ['name', 'last_publish_at'];

    /**
     * @var array
     */
    protected $filterable = [
        'licence',
        'visibility' => [
            'public' => self::VISIBILITY_PUBLIC,
            'hidden' => self::VISIBILITY_HIDDEN,
            'private' => self::VISIBILITY_PRIVATE,
        ],
        'finished',
    ];

    /**
     * @return Licence
     */
    public function getLicence(): Licence
    {
        $mapper = new LicenceMapper();

        return $mapper->map($this);
    }

    /**
     * Set the last_published_at column to the most recent published track.
     *
     * @return self
     */
    public function refreshLastPublishedAt()
    {
        $track = Track
            ::whereIn(
                'id_collection',
                $this->collections()->pluck('id')
            )
            ->orderBy('published_at', 'asc')
            ->first();

        if ($track == null) {
            $this->last_publish_at = null;
        } else {
            $this->last_publish_at = $track->published_at;
        }

        $this->save();

        return $this;
    }

    /**
     * @return SagaStats
     */
    public function stats(): SagaStats
    {
        return new SagaStats($this);
    }

    /**
     * Register the conversions that should be performed.
     * @param Media|null $media
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('main')
            ->fit(Manipulations::FIT_CONTAIN, 400, 400)
            ->optimize()
            ->performOnCollections('cover');

        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CONTAIN, 200, 200)
            ->optimize()
            ->performOnCollections('cover');
    }

    /**
     * Add a scope to query only visible sagas depending on the current user.
     *
     * Usage: Saga::visibles()->get();
     *
     * Since it's a scope, it can be chained with other methods:
     *
     * Saga::visibles()->where('name', 'john')->orderBy('slug')->get();
     *
     * Saga::where('id', '>', 10)->visibles()->get();
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeVisibles(Builder $query)
    {
        $query = $query->where('visibility', '=', self::VISIBILITY_PUBLIC);

        // The scope is only active if a user is authenticated.
        if (Auth::guard('api')->check()) {
            $query->orWhereHas('authors', function ($query) {
                $query->where('user_id', '=', Auth::guard('api')->id());
            });
        }

        return $query;
    }

    /**
     * @param Authenticatable $user
     * @return bool
     */
    public function isOwnedBy(Authenticatable $user): bool
    {
        $userId = $user->getAuthIdentifier();

        return null !== $this->authors()
                ->where('user_id', $userId)
                ->first();
    }

    /**
     * The profile of this saga's owner.
     *
     * @return BelongsToMany
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

//    public function owner()
//    {
//        return $this->belongsToMany(Author::class)->first();
//    }

    /**
     * The list of collections in this sagas.
     *
     * @return HasMany
     */
    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    /**
     * All the likes.
     *
     * @return HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * List of genres.
     *
     * @return BelongsToMany
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Collection|Collection[]
     */
    public function getCollections(string $type)
    {
        return $this->collections()
            ->with('tracks')
            ->where('type', '=', $type)
            ->get();
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
     * Setter for the $finished attribute to ensure a boolean.
     *
     * @param $value
     */
    public function setFinishedAttribute($value)
    {
        if (!is_bool($value)) {
            $value = false;
        }

        $this->attributes['finished'] = $value;
    }

    /**
     * @return int
     */
    public function getCachedCollectionsCountAttribute(): int
    {
        return $this->cacheCount('collections', function () {
            return $this->collections->count();
        });
    }

    /**
     * @return int
     */
    public function getCachedLikesCountAttribute(): int
    {
        return $this->cacheCount('likes', function () {
            return $this->likes->count();
        });
    }

    /**
     * @return int
     */
    public function getCachedTracksCountAttribute(): int
    {
        return $this->cacheCount('tracks', function () {
            return (int)collect($this->collections)
                ->map(function (Collection $collection) {
                    return $collection->cached_tracks_count;
                })
                ->sum();
        });
    }

    /**
     * @return bool
     */
    public function isPublic(): bool
    {
        return $this->visibility === self::VISIBILITY_PUBLIC;
    }

    /**
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->visibility === self::VISIBILITY_HIDDEN;
    }

    /**
     * @return bool
     */
    public function isPrivate(): bool
    {
        return $this->visibility === self::VISIBILITY_PRIVATE;
    }
}
