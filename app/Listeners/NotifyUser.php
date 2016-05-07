<?php

namespace maze\Listeners;

use maze\Events\UserWasNotified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use maze\Notifications\Notifier;
use maze\Mention;
use Auth;

class NotifyUser
{

    public $has_parent = [
        'Reply',
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
     * @param  ReplyWasCreated  $event
     * @return void
     */
    public function handle($event)
    {
        if (isset($event->notifiable)) {
            $notifiable_base = class_basename($event->notifiable);

            //jeigu struktura turi containeri, notifinam containerio seimininka.
            if (in_array($notifiable_base, $this->has_parent)) {
                Notifier::notify($notifiable_base, $event->notifiable, $event->notifiable->parent_container->user);
            }
            //kitu atveju tiesiog notifikuojam strukturos savininka
            else {
                Notifier::notify($notifiable_base, $event->notifiable, $event->notifiable->user);
            }
        }
    }
}
