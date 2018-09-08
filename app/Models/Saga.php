<?php

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;
use Radiophonix\Models\Support\FindableFromSlug;
use Radiophonix\Models\Support\HasFakeId;
use Radiophonix\Models\Support\HasMediaMetadata;
use Radiophonix\Models\Support\SagaOwner;
use Radiophonix\Models\Support\Scopes\FilterByScope;
use Radiophonix\Models\Support\Scopes\SortByScope;
use Radiophonix\Models\Support\SagaStats;
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
 * @property int $author_id
 * @property string $name
 * @property string $synopsis
 * @property Carbon $creation_date
 * @property string $licence
 * @property string $link_netowiki
 * @property string $link_site
 * @property string $link_topic
 * @property string $link_rss
 * @property string $link_facebook
 * @property string $link_twitter
 * @property bool $finished
 * @property int $visibility
 * @property string $last_publish_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Author $author
 * @property-read \Illuminate\Database\Eloquent\Collection|Bravo[] $bravos
 * @property-read \Illuminate\Database\Eloquent\Collection|Collection[] $collections
 * @property-read \Illuminate\Database\Eloquent\Collection|Genre[] $genres
 * @method static Builder|Saga filterBy($filters)
 * @method static Builder|Saga paginate()
 * @method static Builder|Saga sortby($sort)
 * @method static Builder|Saga visibles()
 */
class Saga extends Model implements HasMedia, HasMediaMetadata
{
    use FilterByScope;
    use SortByScope;
    use HasFakeId;
    use HasMediaTrait;
    use HasSlug;
    use FindableFromSlug;
    use Searchable;

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
        'link_topic',
        'link_rss',
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
     * Saves the given owner as the Author.
     *
     * @param SagaOwner $owner
     *
     * @return self
     */
    public function setOwner(SagaOwner $owner)
    {
        $author = $owner->getAuthorModel();

        $this->author()->associate($author);

        return $this;
    }

    /**
     * Return true if the given owner owns the Saga via an Author model.
     *
     * @param SagaOwner $owner
     * @return bool
     */
    public function isOwnedBy(SagaOwner $owner)
    {
        return $this->author->isOwnedBy($owner);
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
            ->crop(Manipulations::CROP_CENTER, 400, 400)
            ->sharpen(10)
            ->optimize()
            ->performOnCollections('cover');

        $this->addMediaConversion('thumb')
            ->crop(Manipulations::CROP_CENTER, 200, 200)
            ->sharpen(10)
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
            $query->orWhereHas('author', function ($query) {
                $query->where('owner_id', '=', Auth::guard('api')->id());
                $query->where('owner_type', '=', User::class);
            });
        }

        return $query;
    }

    /**
     * The profile of this saga's owner.
     *
     * @return BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

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
     * All the bravos.
     *
     * @return HasMany
     */
    public function bravos()
    {
        return $this->hasMany(Bravo::class);
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
