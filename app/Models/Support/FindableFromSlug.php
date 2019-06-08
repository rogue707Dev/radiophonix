<?php

namespace Radiophonix\Models\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @mixin Model
 * @mixin Builder
 */
trait FindableFromSlug
{
    public static function findFromSlugOrUuid(string $slugOrUuid): ?self
    {
        return static::query()
            ->where('uuid', $slugOrUuid)
            ->orWhere('slug', $slugOrUuid)
            ->first();
    }

    /**
     * Returns a Model instance based on the given slug.
     *
     * @param string $slug
     * @return self
     */
    public static function fromSlug(string $slug): self
    {
        return self::query()
            ->where('slug', $slug)
            ->first();
    }
}
