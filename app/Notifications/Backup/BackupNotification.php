<?php

namespace Radiophonix\Notifications\Backup;

use NotificationChannels\Discord\DiscordMessage;
use Spatie\Backup\Notifications\BaseNotification;

/**
 * @mixin BaseNotification
 */
trait BackupNotification
{
    public function toDiscord()
    {
        $type = substr(strrchr(static::class, '\\'), 1);

        $body = $this->backupDestinationProperties()
            ->map(function ($value, $name) {
                return "{$name} : $value";
            })
            ->prepend("**[$type]**")
            ->implode("\n");

        return DiscordMessage::create()->body($body);
    }
}
