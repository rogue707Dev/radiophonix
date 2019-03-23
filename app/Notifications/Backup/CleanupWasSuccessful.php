<?php

namespace Radiophonix\Notifications\Backup;

use Spatie\Backup\Notifications\Notifications\CleanupWasSuccessful as BaseNotification;

class CleanupWasSuccessful extends BaseNotification
{
    use BackupNotification;
}
