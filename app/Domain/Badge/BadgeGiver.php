<?php

namespace Radiophonix\Domain\Badge;

use Radiophonix\Models\User;

interface BadgeGiver
{
    public function canBeAwarded(User $user): bool;
}
