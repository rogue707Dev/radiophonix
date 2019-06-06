<?php
declare(strict_types=1);

namespace Radiophonix\Domain\Metric;

interface MetricEntry
{
    public function type(): string;

    public function version(): int;

    public function data(): array;
}
