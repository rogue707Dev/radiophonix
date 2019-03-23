<?php

namespace Radiophonix\Notifications\Backup;

use Spatie\Backup\Notifications\Notifications\BackupHasFailed as BaseNotification;

class BackupHasFailed extends BaseNotification
{
    use BackupNotification;
}
