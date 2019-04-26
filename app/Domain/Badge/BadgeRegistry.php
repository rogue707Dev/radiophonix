<?php

namespace Radiophonix\Domain\Badge;

use Illuminate\Config\Repository as Config;
use Illuminate\Support\Collection;

class BadgeRegistry
{
    /** @var Config */
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @return Collection|BadgeType[]
     */
    public function all(): Collection
    {
        return collect($this->config->get('radiophonix.badges'))
            ->mapWithKeys(function ($data, $key) {
                return [
                    $key => new BadgeType(
                        $key,
                        $data['title'],
                        $data['description'],
                        isset($data['class']) ? app($data['class']) : null
                    )
                ];
            });
    }
}
