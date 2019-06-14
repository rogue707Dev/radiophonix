<?php
declare(strict_types=1);

namespace Radiophonix\Domain\Dto;

class SagaLikesDto
{
    /** @var string[] */
    public $names;

    /** @var int */
    public $total;

    public function __construct(array $names, int $total)
    {
        $this->names = $names;
        $this->total = $total;
    }
}
