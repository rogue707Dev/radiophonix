<?php

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Radiophonix\Events\Like\UserLikedSaga;
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
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
 * @property Carbon $last_publish_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Author[] $authors
 * @property-read Team $team
 * @property-read Collection|Like[] $likes
 * @property-read Collection|Album[] $albums
 * @property-read Collection|Genre[] $genres
 * @property-read int $cached_tracks_count
 * @property-read int $cached_albums_count
 * @property-read int $cached_likes_count
 * @method static Builder|Saga filterBy($filters)
 * @method static Builder|Saga paginate()
 * @method static Builder|Saga sortby($sort)
 */
class Saga extends Model implements HasMedia
{
    use HasFakeId;
    use HasMediaTrait;
    use HasSlug;
    use FindableFromSlug;
    use Searchable;
    use HasCountCache;

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
    ];

    /**
     * @var array
     */
    protected $casts = [
        'finished' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'creation_date'];

    /**
     * @return Licence
     */
    public function getLicence(): Licence
    {
        $mapper = new LicenceMapper();

        return $mapper->map($this->licence);
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
                'id_album',
                $this->albums()->pluck('id')
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

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
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
     * @return Collection|Album[]
     */
    public function getAlbums(string $type)
    {
        return $this->albums()
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
     * @param mixed|bool $value
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
    public function getCachedAlbumsCountAttribute(): int
    {
        return $this->cacheCount('albums', function () {
            return $this->albums->count();
        });
    }

    /**
     * @return int
     */
    public function getCachedTracksCountAttribute(): int
    {
        return $this->cacheCount('tracks', function () {
            return (int)collect($this->albums)
                ->map(function (Album $album) {
                    return $album->cached_tracks_count;
                })
                ->sum();
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

    public function addLikeFrom(User $user): void
    {
        $like = new Like;

        $like->likeable()->associate($this);
        $like->user()->associate($user);

        $like->save();

        event(new UserLikedSaga($user, $this));
    }

    /**
     * @param string|UploadedFile $file
     */
    public function saveCoverImage($file): void
    {
        $this->addMedia($file)
            ->preservingOriginal()
            ->toMediaCollection('cover');
    }
}
