<?php

namespace Radiophonix\Http\Controllers\Api\V1\Notification;

use Illuminate\Notifications\DatabaseNotification;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Symfony\Component\HttpFoundation\Response;

class MarkNotificationAsRead extends ApiController
{
    /**
     * @param DatabaseNotification $notification
     * @return Response
     */
    public function __invoke(DatabaseNotification $notification)
    {
        $notification->markAsRead();

        return $this->ok();
    }
}
