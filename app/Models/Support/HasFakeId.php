<?php

namespace Radiophonix\Models\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Radiophonix\Services\FakeId\FakeIdManager;

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
     * Get a model instance based on the given fake id.
     *
     * @param string $fakeId
     * @return static
     */
    public static function fromFakeId($fakeId)
    {
        $id = app(FakeIdManager::class)
            ->connection((new static)->getTable())
            ->decode($fakeId);

        return static::where('id', $id)->firstOrFail();
    }

    /**
     * Get a model's instance fake id based on it's id.
     *
     * @return string
     */
    public function fakeId()
    {
        return app(FakeIdManager::class)
            ->connection($this->getTable())
            ->encode($this->id);
    }
}
