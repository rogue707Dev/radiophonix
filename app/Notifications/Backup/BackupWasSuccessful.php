<?php

namespace Radiophonix\Notifications\Backup;

use Spatie\Backup\Notifications\Notifications\BackupWasSuccessful as BaseNotification;

class BackupWasSuccessful extends BaseNotification
{
    use BackupNotification;
}
