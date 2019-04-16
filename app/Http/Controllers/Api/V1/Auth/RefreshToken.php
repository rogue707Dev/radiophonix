<?php

namespace Radiophonix\Http\Controllers\Api\V1\Auth;

use Radiophonix\Http\Controllers\Api\V1\ApiController;

class RefreshToken extends ApiController
{
    public function __invoke()
    {
        return $this->simple([
            'access_token' => auth()->refresh(),
        ]);
    }
}
