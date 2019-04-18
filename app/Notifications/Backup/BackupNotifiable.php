<?php

namespace Radiophonix\Notifications\Backup;

use Spatie\Backup\Notifications\Notifiable;

class BackupNotifiable extends Notifiable
{
    public function routeNotificationForDiscord()
    {
        return config('services.discord.channel');
    }
}
