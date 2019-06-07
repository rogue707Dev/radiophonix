<?php
declare(strict_types=1);

namespace Radiophonix\Http\Controllers\Api\V1\Interaction\Play;

use Radiophonix\Domain\Metric\Entry\TrackPlayEntry;
use Radiophonix\Domain\Metric\Metrics;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Models\Track;

class RegisterTrackPlayMetricController extends ApiController
{
    /** @var Metrics */
    private $metrics;

    public function __construct(Metrics $metrics)
    {
        $this->metrics = $metrics;
    }

    public function __invoke(Track $track): ApiResponse
    {
        $this->metrics->record(new TrackPlayEntry($track));

        return $this->ok();
    }
}
