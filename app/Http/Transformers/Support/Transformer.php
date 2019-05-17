<?php

namespace Radiophonix\Http\Transformers\Support;

use DateTime;
use DateTimeInterface;
use League\Fractal\TransformerAbstract;

abstract class Transformer extends TransformerAbstract
{
    protected function getFormatedDate(?DateTimeInterface $date, string $format = 'c'): ?string
    {
        if ($date instanceof DateTime) {
            return $date->format($format);
        }

        return null;
    }
}
