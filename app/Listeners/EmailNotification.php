<?php

namespace maze\Listeners;

use maze\Events\UserWasNotified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use maze\User;
use maze\Reply;
use Mail;
use Carbon\Carbon;

class EmailNotification
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
     * @param  UserWasNotified  $event
     * @return void
     */
    public function handle(UserWasNotified $event)
    {
        $user = $event->user;

        //TODO: pakeisti i universalesni sprendima.
        if ($event->object instanceof Reply && $user->email_replies && !$user->is_online) {
            $reply = $event->object;
            if (($reply->user_id != $reply->topic->user_id) && $reply->topic->user->email_replies) {
                $data = [
                    'user'      => $reply->topic->user->username,
                    'title'     => $reply->topic->title,
                    'content'   => $reply->body,
                    'slug'      => $reply->topic->slug,
                    'id'        => $reply->topic->id
                ];

                $topic = $reply->topic;
                $topic_user = $reply->topic->user;

                Mail::queue('emails.notifications.reply', $data, function ($message) use ($topic_user, $topic,$user) {
                    $user->save();
                    $message->to($topic_user->email)->subject('Naujas pranešimas temoje '.utf8_urldecode($topic->title));
                });
            }
        }
    }
}
