<?php

namespace maze\Listeners;

use maze\Events\ReplyWasDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use maze\Notification;
use maze\Mention;

class CleanUpNotifications
{

    //strukturos, kuriose buna paminejimu notificationai
    public $mentionable = [
        'Reply',
        'Topic',
        'Status',
        'StatusComment',
    ];

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ReplyWasDeleted  $event
     * @return void
     */
    public function handle($event)
    {
        $name = class_basename($event->notifiable);
        $type = snake_case($name);

        Notification::where('object_type', $type)->where('object_id', $event->notifiable->id)->delete();

        //jeigu strukturoje veikia paminejimu notificationai
        //istrinam notificationus
        //ir paminejimus
        if(in_array($type, $this->mentionable))
        {
            Notification::where('object_type', 'mention')->where('object_id', $event->notifiable->id)->delete();
            Mention::where('object_type', $name)->where('object_id', $event->notifiable->id)->delete();
        }

    }
}
