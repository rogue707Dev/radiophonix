<?php

namespace Radiophonix\Domain\Badge;

use Illuminate\Config\Repository as Config;
use Illuminate\Support\Collection;
use Log;
use Radiophonix\Models\Badge;
use Radiophonix\Models\User;

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
    public function types(): Collection
    {
        return collect($this->config->get('radiophonix.badges'))
            ->mapWithKeys(function ($data, $key) {
                return [
                    $key => new BadgeType(
                        $key,
                        $data['title'],
                        $data['description']
                    )
                ];
            });
    }

    public function award(string $key, User $user): void
    {
        /** @var Badge|null $badge */
        $badge = Badge::query()->where('key', $key)->first();

        if (null === $badge) {
            Log::warning('Assignation d\'un badge inexistant : ' . $key);

            return;
        }

        $badge->awardTo($user);
    }
}
