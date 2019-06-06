<?php
declare(strict_types=1);

namespace Radiophonix\Domain\Metric;

use Illuminate\Support\Str;
use Radiophonix\Models\Metric;

class Metrics
{
    public function push(MetricEntry $entry): void
    {
        $metric = new Metric();

        $metric->uuid = Str::orderedUuid();
        $metric->type = $entry->type();
        $metric->version = $entry->version();
        $metric->data = $entry->data();

        $metric->save();
    }
}
