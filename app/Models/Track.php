<?php

namespace Radiophonix\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use Radiophonix\Exceptions\CannotPublishTrackException;
use Radiophonix\Models\Support\HasFakeId;

/**
 * @property int $id
 * @property int $collection_id
 * @property string $number
 * @property string $title
 * @property string $synopsis
 * @property Carbon $published_at
 * @property int $status
 * @property int $length
 * @property string $url
 * @property array $percentages
 * @property array $chapters
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection $collection
 */
class Track extends Model
{
    use HasFakeId;
    use Searchable;

    // When creating an empty Track
    const STATUS_DRAFT = 0;

    // When all required info (except the file) are completed
    const STATUS_COMPLETE = 1;

    // When a publish date has been selected
    const STATUS_PUBLISHING = 2;

    // When the track is available online
    const STATUS_PUBLISHED = 3;

    /**
     * @var array
     */
    protected $casts = [
        'percentages' => 'array',
        'chapters' => 'array',
        'status' => 'int',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'number',
        'title',
        'synopsis',
        'published_at',
        'status',
        'length',
        'percentages',
        'chapters',
        'url',
    ];

    /**
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * @var array
     */
    protected $touches = [
        'collection',
    ];

    public function publish()
    {
        if (!$this->isPublishable()) {
            throw new CannotPublishTrackException($this);
        }

        $this->status = self::STATUS_PUBLISHED;
    }

    /**
     * Returns true if the track is ready to be published.
     *
     * @return bool
     */
    public function isPublishable(): bool
    {
        return $this->isInformationComplete() && $this->published_at != null;
    }

    /**
     * Return true if all informations needed to publish the track are filled.
     *
     * @return bool
     */
    public function isInformationComplete(): bool
    {
        return strlen($this->title) > 0
            && strlen($this->url) > 0;
    }

    /**
     * Refresh the status depending on the current state of the Track.
     *
     * @return self
     */
    public function refreshStatus(): self
    {
        if ($this->isPublished()) {
            if (!$this->isPublishable()) {
                $this->status = self::STATUS_DRAFT;

                return $this->refreshStatus();
            }

            return $this;
        }

        if ($this->isPublishable()) {
            $this->status = self::STATUS_PUBLISHING;
        } else {
            if ($this->isInformationComplete()) {
                $this->status = self::STATUS_COMPLETE;
            } else {
                $this->status = self::STATUS_DRAFT;
            }
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isDraft(): bool
    {
        return $this->isStatus(self::STATUS_DRAFT);
    }

    /**
     * @return bool
     */
    public function isComplete(): bool
    {
        return $this->isStatus(self::STATUS_COMPLETE);
    }

    /**
     * @return bool
     */
    public function isPublishing(): bool
    {
        return $this->isStatus(self::STATUS_PUBLISHING);
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->isStatus(self::STATUS_PUBLISHED);
    }

    /**
     * @param $status
     * @return bool
     */
    private function isStatus($status): bool
    {
        return $this->status == $status;
    }

    /**
     * The collection in which this track is.
     *
     * @return BelongsTo
     */
    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    /**
     * @param $value
     */
    public function setStatusAttribute($value)
    {
        if ($value == null) {
            $value = self::STATUS_DRAFT;
        }

        $this->attributes['status'] = $value;
    }
}
