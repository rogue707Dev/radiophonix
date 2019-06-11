<?php
declare(strict_types=1);

namespace Radiophonix\Domain\Metric\Entry;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Radiophonix\Domain\Metric\MetricEntry;

class PageViewEntry implements MetricEntry
{
    /** @var Request */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function type(): string
    {
        return 'page-view';
    }

    public function version(): int
    {
        return 1;
    }

    public function data(): array
    {
        $agent = new Agent();

        $withVersion = function($property) use ($agent): array
        {
            return [
                'name' => $property,
                'version' => $agent->version($property),
            ];
        };

        return [
            'path' => $this->request->post('path'),
            'fingerprint' => $this->request->fingerprint(),
            'os' => $withVersion($agent->platform()),
            'browser' => $withVersion($agent->browser()),
            'device' => $agent->device(),
            'is_desktop' => $agent->isDesktop(),
            'is_phone' => $agent->isPhone(),
            'is_tablet' => $agent->isTablet(),
            'robot' => $agent->robot(),
        ];
    }
}
