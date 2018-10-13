<?php

namespace Radiophonix\Listeners\Author;

use Radiophonix\Events\Author\AuthorSavingEvent;

class SyncNameColumnListener
{
    /**
     * Handle the event.
     *
     * @param AuthorSavingEvent $event
     * @return void
     */
    public function handle($event)
    {
        $author = $event->author;

        $author->name = $author->user->name;
    }
}
