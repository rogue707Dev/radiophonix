<?php

namespace Radiophonix\Models\Support;

trait FindableFromSlug
{
    /**
     * To query a model by slug or fakeId
     *
     * @param string|int $slugOrFakeId
     * @return null|self
     */
    public static function findFromSlugOrFakeId($slugOrFakeId): ?self
    {
        if (is_numeric($slugOrFakeId)) {
            return static::fromFakeId((int)$slugOrFakeId);
        }

        return static::fromSlug($slugOrFakeId);
    }

    /**
     * Returns a Model instance based on the given slug.
     *
     * @param string $slug
     * @return self
     */
    public static function fromSlug(string $slug)
    {
        return self::where('slug', $slug)->first();
    }
}
