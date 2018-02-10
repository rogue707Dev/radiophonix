<?php

namespace Radiophonix\Notifications;

use Radiophonix\Models\Track;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class TrackPublished extends Notification
{
    use Queueable;

    protected $track;

    /**
     * Create a new notification instance.
     *
     * @param Track $track
     */
    public function __construct(Track $track)
    {
        $this->track = $track;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => $this->track->collection->saga->name,
            'message' => 'Un nouvel épisode est sortit !<br />' . $this->track->title,
            'type' => 'track',
            'type_id' => $this->track->fakeId(),
        ];
    }
}
