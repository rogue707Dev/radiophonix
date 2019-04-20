<?php

namespace Radiophonix\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Radiophonix\Events\Author\AuthorSavingEvent;
use Radiophonix\Events\Like\UserLikedSaga;
use Radiophonix\Events\Like\UserUnlikedSaga;
use Radiophonix\Listeners\Author\SyncNameColumnListener;
use Radiophonix\Listeners\ImageColorListener;
use Radiophonix\Listeners\Like\ClearSagaCachedLikedCount;
use Spatie\MediaLibrary\Events\MediaHasBeenAdded;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        MediaHasBeenAdded::class => [
//            ImageColorListener::class,
        ],
        AuthorSavingEvent::class => [
            SyncNameColumnListener::class,
        ],
        UserLikedSaga::class => [
            ClearSagaCachedLikedCount::class,
        ],
        UserUnlikedSaga::class => [
            ClearSagaCachedLikedCount::class,
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
