<?php

namespace Radiophonix\Http\Controllers\Api\V1\Invite;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\InviteTransformer;
use Radiophonix\Models\Invite;

class ListInvites extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function __invoke()
    {
        return $this->collection(Invite::toUser($this->user()), new InviteTransformer);
    }
}
