<?php

namespace Radiophonix\Listeners\Like;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Radiophonix\Events\Like\UserLikedSaga;
use Radiophonix\Events\Like\UserUnlikedSaga;

class ClearSagaCachedLikedCount
{
    /**
     * @param UserLikedSaga|UserUnlikedSaga $event
     */
    public function handle($event)
    {
        $event->saga->clearCountCache('likes');
    }
}
