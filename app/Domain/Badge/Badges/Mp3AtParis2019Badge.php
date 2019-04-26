<?php

namespace Radiophonix\Domain\Badge\Badges;

use Radiophonix\Domain\Badge\BadgeGiver;
use Radiophonix\Models\User;

class Mp3AtParis2019Badge implements BadgeGiver
{
    public function canBeAwarded(User $user): bool
    {
        // Ce badge est assigné manuellement

        return false;
    }
}
