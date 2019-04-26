<?php

namespace Radiophonix\Domain\Badge\Badges;

use Illuminate\Support\Facades\Date;
use Radiophonix\Domain\Badge\BadgeGiver;
use Radiophonix\Models\User;

class BetaTestBadge implements BadgeGiver
{
    public function canBeAwarded(User $user): bool
    {
        return $user->created_at->between(
            Date::create(2019, 5, 1),
            Date::create(2019, 8, 31)
        );
    }
}
