<?php

namespace Radiophonix\Http\Controllers\Api\V1;

class NotFoundController extends ApiController
{
    public function __invoke()
    {
        abort(404);
    }
}
