<?php

namespace Radiophonix\Http\Controllers\Api\V1\Notification;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Transformers\NotificationTransformer;

class ListUserNotifications extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function __invoke()
    {
        return $this->collection($this->user()->notifications, new NotificationTransformer);
    }
}
