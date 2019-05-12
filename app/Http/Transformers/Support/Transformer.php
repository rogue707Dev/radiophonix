<?php

namespace Radiophonix\Http\Transformers\Support;

use DateTime;
use DateTimeInterface;
use League\Fractal\TransformerAbstract;
use Radiophonix\Domain\Services\FakeId\FakeIdManager;

abstract class Transformer extends TransformerAbstract
{
    /** @var FakeIdManager */
    private $fakeId;

    protected function getFormatedDate(?DateTimeInterface $date, string $format = 'c'): ?string
    {
        if ($date instanceof DateTime) {
            return $date->format($format);
        }

        return null;
    }

    protected function fakeId(): FakeIdManager
    {
        if (null === $this->fakeId) {
            $this->fakeId = app(FakeIdManager::class);
        }

        return $this->fakeId;
    }
}
