<?php

namespace Radiophonix\Listeners\Auth;

use Illuminate\Support\Facades\Date;
use Radiophonix\Domain\Badge\BadgeRegistry;
use Radiophonix\Events\Auth\UserRegisteredEvent;
use Radiophonix\Models\SiteInvite;

class AwardRegistrationBadgesListener
{
    /** @var BadgeRegistry */
    private $badgeRegistry;

    public function __construct(BadgeRegistry $badgeRegistry)
    {
        $this->badgeRegistry = $badgeRegistry;
    }

    public function handle(UserRegisteredEvent $event): void
    {
        if ($event->invite && $event->invite->type === SiteInvite::TYPE_MP3_AT_PARIS_2019) {
            $this->badgeRegistry->award(SiteInvite::TYPE_MP3_AT_PARIS_2019, $event->user);
        }

        $start = Date::create(2019, 5, 1);
        $end = Date::create(2019, 8, 31);

        if ($event->user->created_at->between($start, $end)) {
            $this->badgeRegistry->award('beta-test', $event->user);
        }
    }
}
