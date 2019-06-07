<?php
declare(strict_types=1);

namespace Radiophonix\Domain\Metric;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Str;
use Radiophonix\Models\Metric;

class Metrics
{
    /** @var Guard */
    private $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function record(MetricEntry $entry): void
    {
        $metric = new Metric();

        $data = $entry->data();
        $user = $this->auth->user();

        if ($user instanceof Authenticatable) {
            $data = array_merge($data, ['user_id' => $user->getAuthIdentifier()]);
        }

        $metric->uuid = Str::orderedUuid();
        $metric->type = $entry->type();
        $metric->version = $entry->version();
        $metric->data = $data;

        $metric->save();
    }
}
