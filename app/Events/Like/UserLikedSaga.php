<?php

namespace Radiophonix\Events\Like;

use Illuminate\Queue\SerializesModels;
use Radiophonix\Models\Saga;
use Radiophonix\Models\User;

class UserLikedSaga
{
    use SerializesModels;

    /** @var User */
    public $user;

    /** @var Saga */
    public $saga;

    public function __construct(User $user, Saga $saga)
    {
        $this->user = $user;
        $this->saga = $saga;
    }
}
