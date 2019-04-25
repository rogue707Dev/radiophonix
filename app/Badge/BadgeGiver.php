<?php

namespace Radiophonix\Badge;

use Radiophonix\Models\User;

interface BadgeGiver
{
    public function canBeAwarded(User $user): bool;
}
