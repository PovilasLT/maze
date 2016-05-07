<?php

namespace maze\Listeners;

use maze\Events\ReplyWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use maze\Action;
use Auth;

class LogAction
{
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
        $event_name = class_basename($event);

        //paprastas event su notification
        if (property_exists($event, 'notifiable') && isset($event->notifiable)) {
            $item_name = class_basename($event->notifiable);
            $item_id = $event->notifiable->id;
        }
        //vote
        else {
            $item_name = class_basename($event->entity);
            $item_id = $event->entity->id;
        }

        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        Action::create([
            'user_id'   => Auth::user()->id,
            'name'      => $event_name,
            'item_name' => $item_name,
            'item_id'   => $item_id,
            'ip'        => $ip
        ]);
    }
}
