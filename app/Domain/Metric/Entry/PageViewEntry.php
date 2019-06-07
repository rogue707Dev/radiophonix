<?php
declare(strict_types=1);

namespace Radiophonix\Domain\Metric\Entry;

use Illuminate\Http\Request;
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
        return [
            'url' => $this->request->fullUrl(),
            'method' => $this->request->method(),
            'user_agent' => $this->request->userAgent(),
            'fingerprint' => $this->request->fingerprint(),
            'ip' => $this->request->ip(),
            'is_ajax' => $this->request->ajax(),
            'headers' => $this->request->headers->all(),
        ];
    }
}
