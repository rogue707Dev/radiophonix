<?php

namespace Radiophonix\Http\Controllers\Api\V1\User;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;

class ShowCurrentUserController extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function __invoke()
    {
        return $this->simple($this->user());
    }
}
