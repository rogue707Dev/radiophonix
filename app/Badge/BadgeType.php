<?php

namespace Radiophonix\Badge;

use Radiophonix\Models\User;

class BadgeType implements BadgeGiver
{
    /** @var string */
    private $key;

    /** @var string */
    private $title;

    /** @var string */
    private $description;

    /** @var BadgeGiver */
    private $giver;

    public function __construct(string $key, string $title, string $description, BadgeGiver $giver)
    {
        $this->key = $key;
        $this->title = $title;
        $this->description = $description;
        $this->giver = $giver;
    }

    public function canBeAwarded(User $user): bool
    {
        return $this->giver->canBeAwarded($user);
    }

    public function key(): string
    {
        return $this->key;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }
}
