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
    private function cacheCount(string $id, Closure $count): int
    {
        return (int)Cache::remember($this->cacheKey($id), now()->addSeconds(15), $count);
    }

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

    public function clearCountCache(string $key): void
    {
        Cache::forget($this->cacheKey($key));
    }
}
