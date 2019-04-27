<?php

namespace Radiophonix\Domain\Services\FakeId;

use Jenssegers\Optimus\Optimus;

class FakeIdConnection
{
    /**
     * @var Optimus
     */
    private $optimus;

    public function __construct(int $prime, int $inverse, int $xor)
    {
        $this->optimus = new Optimus($prime, $inverse, $xor);
    }

    /**
     * @param int $fakeId
     * @return int
     */
    public function decode($fakeId)
    {
        return $this->optimus->decode($fakeId);
    }

    /**
     * @param int $id
     * @return int
     */
    public function encode($id)
    {
        return $this->optimus->encode($id);
    }
}