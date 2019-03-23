<?php

namespace Radiophonix\Notifications\Backup;

use Spatie\Backup\Notifications\Notifications\UnhealthyBackupWasFound as BaseNotification;

class UnhealthyBackupWasFound extends BaseNotification
{
    use BackupNotification;
}
