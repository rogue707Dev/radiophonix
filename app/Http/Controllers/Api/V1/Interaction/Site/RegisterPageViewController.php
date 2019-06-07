<?php
declare(strict_types=1);

namespace Radiophonix\Http\Controllers\Api\V1\Interaction\Site;

use Illuminate\Http\Request;
use Radiophonix\Domain\Metric\Entry\PageViewEntry;
use Radiophonix\Domain\Metric\Metrics;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;

class RegisterPageViewController extends ApiController
{
    /** @var Metrics */
    private $metrics;

    public function __construct(Metrics $metrics)
    {
        $this->metrics = $metrics;
    }

    public function __invoke(Request $request): ApiResponse
    {
        // @todo récupérer les infos de la page front (route)

        $this->metrics->push(new PageViewEntry($request));

        return $this->ok();
    }
}
