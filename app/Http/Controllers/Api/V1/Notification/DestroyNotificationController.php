<?php

namespace Radiophonix\Http\Controllers\Api\V1\Notification;

use Illuminate\Notifications\DatabaseNotification;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Symfony\Component\HttpFoundation\Response;

class DestroyNotificationController extends ApiController
{
    /**
     * @param DatabaseNotification $notification
     * @return Response
     * @throws \Exception
     */
    public function __invoke(DatabaseNotification $notification)
    {
        $notification->delete();

        return $this->ok();
    }
}
