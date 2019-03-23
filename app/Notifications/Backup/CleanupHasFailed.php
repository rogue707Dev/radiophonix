<?php

namespace Radiophonix\Notifications\Backup;

use Spatie\Backup\Notifications\Notifications\CleanupHasFailed as BaseNotification;

class CleanupHasFailed extends BaseNotification
{
    use BackupNotification;
}
