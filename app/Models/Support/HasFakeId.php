<?php

namespace Radiophonix\Models\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Radiophonix\Domain\Services\FakeId\FakeIdManager;

/**
 * This trait can be used on Models to allow them to have a fake id based on
 * their database id.
 * The goal of this is to hide the database id from outside the public api so
 * that ids can't be guessed.
 *
 * @mixin Model
 * @mixin Builder
 */
trait HasFakeId
{
    /**
     * @param int $fakeId
     * @return static
     */
    public static function fromFakeId(int $fakeId)
    {
        $id = app(FakeIdManager::class)
            ->connection((new static)->getTable())
            ->decode($fakeId);

        /** @var static $model */
        $model = static::query()
            ->where('id', $id)
            ->firstOrFail();

        return $model;
    }

    public function fakeId(): int
    {
        return app(FakeIdManager::class)
            ->connection($this->getTable())
            ->encode($this->id);
    }
}
