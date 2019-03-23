<?php

namespace Radiophonix\Notifications\Backup;

use Spatie\Backup\Notifications\Notifications\HealthyBackupWasFound as BaseNotification;

class HealthyBackupWasFound extends BaseNotification
{
    use BackupNotification;
}
