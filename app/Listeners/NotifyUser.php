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

    public $followers_notifiable = [
        'Topic',
        'Status',
    ];

    public $self_notifiable = [
        'Topic',
        'Status',
    ];

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
        if(isset($event->notifiable))
        {
            $notifiable_base = class_basename($event->notifiable);

            //patikrinam ar reikia notifinti save
            if(in_array($notifiable_base, $this->self_notifiable))
            {
                Notifier::notify($notifiable_base, $event->notifiable, Auth::user());
            }
            //jeigu struktura turi containeri, notifinam containerio seimininka.
            if(in_array($notifiable_base, $this->has_parent))
            {
                Notifier::notify($notifiable_base, $event->notifiable, $event->notifiable->parent_container->user);
            }
            //kitu atveju tiesiog notifikuojam strukturos savininka
            else
            {
                Notifier::notify($notifiable_base, $event->notifiable, $event->notifiable->user);
            }
        }
    }
}
