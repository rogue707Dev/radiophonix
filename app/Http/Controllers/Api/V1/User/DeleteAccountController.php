<?php

namespace Radiophonix\Http\Controllers\Api\V1\User;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;

class DeleteAccountController extends ApiController
{
    public function __invoke(): ApiResponse
    {
        $this->user()->delete();

        return $this->ok();
    }
}
