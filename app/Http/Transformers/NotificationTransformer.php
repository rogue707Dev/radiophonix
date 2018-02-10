<?php

namespace Radiophonix\Http\Transformers;

use Illuminate\Notifications\DatabaseNotification;
use Radiophonix\Http\Transformers\Support\Transformer;

class NotificationTransformer extends Transformer
{
    /**
     * @param DatabaseNotification $notification
     * @return array
     */
    public function transform(DatabaseNotification $notification)
    {
        return [
            'id' => $notification->id,
            'data' => $notification->data,
            'type' => $notification->type,
            'read' => $notification->read_at != null,
        ];
    }
}
