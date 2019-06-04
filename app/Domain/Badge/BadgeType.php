<?php

namespace Radiophonix\Domain\Badge;

class BadgeType
{
    /** @var string */
    private $key;

    /** @var string */
    private $title;

    /** @var string */
    private $description;

    public function __construct(string $key, string $title, string $description)
    {
        $this->key = $key;
        $this->title = $title;
        $this->description = $description;
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
