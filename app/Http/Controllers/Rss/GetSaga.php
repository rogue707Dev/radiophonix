<?php

namespace Radiophonix\Http\Controllers\Rss;

use Radiophonix\Http\Controllers\Controller;
use Radiophonix\Http\Responses\Saga\RssResponse;
use Radiophonix\Models\Saga;

class GetSaga extends Controller
{
    /**
     * @param Saga $saga
     * @return RssResponse
     */
    public function __invoke(Saga $saga): RssResponse
    {
        return new RssResponse($saga);
    }
}
