<?php

namespace Radiophonix\Console\Commands;

use Carbon\Carbon;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Collection;
use Radiophonix\Events\TrackPublishedEvent;
use Radiophonix\Jobs\NotifyPublishedTrack;
use Radiophonix\Models\Saga;
use Radiophonix\Models\Track;
use Illuminate\Console\Command;

/**
 * This command is used to publish tracks
 */
class PublishTracks extends Command
{
    /**
     * @var string
     */
    protected $signature = 'radiophonix:publish';

    /**
     * @var string
     */
    protected $description = 'Publish tracks when the publishing date is passed';

    /**
     * @var Dispatcher
     */
    protected $dispatcher;

    /**
     * @param Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher)
    {
        parent::__construct();

        $this->dispatcher = $dispatcher;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = Carbon::now();

        // First we list all tracks that can be published
        /** @var Collection $tracksToPublish */
        $tracksToPublish = Track::with('collection.saga')
            ->where('status', Track::STATUS_PUBLISHING)
            ->where('published_at', '<=', $now)
            ->get();

        if ($tracksToPublish->count() == 0) {
            return true;
        }

        $tracksToPublish
            ->each(function (Track $track) {
                $track->status = Track::STATUS_PUBLISHED;
                $track->save();

                $this->dispatcher->dispatch(new TrackPublishedEvent($track));
            })
            ->map(function (Track $track) {
                return $track->collection->saga;
            })
            ->unique('id')
            ->each(function (Saga $saga) {
                $saga->refreshLastPublishedAt();
            });

        return true;
    }
}
