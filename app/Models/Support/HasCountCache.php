<?php

namespace Radiophonix\Models\Support;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

/**
 * @mixin Model
 * @property Carbon $updated_at
 */
trait HasCountCache
{
    /**
     * @param string $id
     * @param Closure $count
     * @return mixed
     */
    private function cacheCount(string $id, Closure $count): int
    {
        return (int)Cache::remember($this->cacheKey($id), now()->addSeconds(15), $count);
    }

    /**
     * @param string $id
     * @return string
     */
    private function cacheKey(string $id): string
    {
        return sprintf(
            '%s/%s-%s:%s_count',
            $this->getTable(),
            $this->getKey(),
            $this->updated_at->timestamp,
            $id
        );
    }
}
