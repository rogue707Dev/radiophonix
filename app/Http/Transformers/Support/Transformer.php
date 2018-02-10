<?php

namespace Radiophonix\Http\Transformers\Support;

use DateTime;
use Illuminate\Support\Facades\App;
use League\Fractal\TransformerAbstract;

abstract class Transformer extends TransformerAbstract
{
    /**
     * @param DateTime|null $date
     * @return null|string
     */
    protected function getFormatedDate($date)
    {
        if ($date instanceof DateTime) {
            return $date->format('c');
        }

        return null;
    }
}
