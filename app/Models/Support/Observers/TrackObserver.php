<?php

namespace Radiophonix\Models\Support\Observers;

use Radiophonix\Models\Track;

class TrackObserver
{
    /**
     * Listen to the Track saving event.
     *
     * @param  Track $track
     * @return bool
     */
    public function saving(Track $track)
    {
        $track->refreshStatus();

        return true;
    }
}
