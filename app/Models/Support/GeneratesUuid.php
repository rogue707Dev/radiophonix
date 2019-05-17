<?php

namespace Radiophonix\Models\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use PascalDeVink\ShortUuid\ShortUuid;

/**
 * This trait can be used on Models to allow them to have a uuid.
 * The goal of this is to hide the database id from outside the public api so
 * that ids can't be guessed.
 *
 * @mixin Model
 * @mixin Builder
 *
 * @property string $uuid
 */
trait GeneratesUuid
{
    public static function bootGeneratesUuid()
    {
        static::creating(function ($model) {
            /* @var Model $model */
            $model->attributes['uuid'] = ShortUuid::uuid4();
        });
    }

    /**
     * @param string $uuid
     * @return static
     */
    public static function fromUuId(string $uuid)
    {
        /** @var static $model */
        $model = static::query()
            ->where('uuid', $uuid)
            ->firstOrFail();

        return $model;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }
}
