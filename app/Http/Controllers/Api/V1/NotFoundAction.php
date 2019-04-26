<?php

namespace Radiophonix\Http\Controllers\Api\V1;

class NotFoundAction extends ApiController
{
    public function __invoke()
    {
        abort(404);
    }
}
