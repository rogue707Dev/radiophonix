<?php

namespace Radiophonix\Models\Support;

use Illuminate\Contracts\Support\Arrayable;
use Radiophonix\Models\Collection;
use Radiophonix\Models\Saga;

class SagaStats implements Arrayable
{
    /**
     * @var Saga
     */
    private $saga;

    /**
     * @param Saga $saga
     */
    public function __construct(Saga $saga)
    {
        $this->saga = $saga;
    }

    /**
     * @return int
     */
    public function tracks(): int
    {
        // todo cache in a db field

        return (int)collect($this->saga->collections)
            ->map(function (Collection $collection) {
                return $collection->tracks()->count();
            })
            ->sum();
    }

    /**
     * @return int
     */
    public function bravos(): int
    {
        return (int)$this->saga->bravos()->count();
    }

    /**
     * @return int
     */
    public function collections(): int
    {
        return (int)$this->saga->collections()->count();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'bravos' => $this->bravos(),
            'collections' => $this->collections(),
            'tracks' => $this->tracks(),
        ];
    }
}
