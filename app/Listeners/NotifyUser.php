<?php

namespace maze\Listeners;

use maze\Events\UserWasNotified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use maze\Notifications\Notifier;

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
            $type = snake_case($notifiable_base);

            //patikrinam ar reikia notifinti save
            if(in_array($notifiable_base, $this->self_notifiable))
            {
                Notifier::notify($type, $event->notifiable, Auth::user());
            }
            else
            {
                Notifier::notify($type, $event->notifiable, $event->notifiable->parent_container->user);
            }

            //patikrinam ar reikia followeriams notificationu
            if(in_array($notifiable_base, $this->followers_notifiable))
            {
                foreach($event->user->followers as $follower)
                {
                    Notifier::notify($type, $event->notifiable, $follower->follower);
                }
            }
        }
    }
}
