<?php

namespace Radiophonix\Jobs;

use Radiophonix\Models\Track;
use Illuminate\Bus\Queueable;
use Radiophonix\Models\Subscription;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Radiophonix\Notifications\TrackPublished;

/**
 * This job notifies all followers of the specified track's saga
 */
class NotifyPublishedTrack implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $track;

    /**
     * Create a new job instance.
     *
     * @param Track $track
     */
    public function __construct(Track $track)
    {
        $this->track = $track;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $saga = $this->track->collection->saga;

        $notification = new TrackPublished($this->track);

        $subscriptions = Subscription::forSaga($saga);

        foreach ($subscriptions as $subscription) {
            $subscription->user->notify($notification);
        }
    }
}
