<?php

namespace Radiophonix\Events\Auth;

use Illuminate\Queue\SerializesModels;
use Radiophonix\Models\SiteInvite;
use Radiophonix\Models\User;

class UserRegisteredEvent
{
    use SerializesModels;

    /** @var User */
    public $user;

    /** @var SiteInvite|null */
    public $invite;

    public function __construct(User $user, ?SiteInvite $invite)
    {
        $this->user = $user;
        $this->invite = $invite;
    }
}
