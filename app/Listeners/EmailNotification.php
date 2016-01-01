<?php

namespace maze\Listeners;

use maze\Events\UserWasNotified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use maze\User;

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
        $type = class_basename($event->object);

        //TODO: pakeisti i universalesni sprendima.
        if($type == 'Reply');
        {
            if($user->id != $reply->topic->user_id && $this->canEmailReply($user)) {
                $last_reply = $reply->topic->replies()->where('user_id', '<>', $user->id)->orderBy('created_at', 'desc')->first();
                if(!$last_reply || ($last_reply && $last_reply->created_at->diffInHours() > 24 && $reply->topic->user->email_replies))
                {
                    $data = [
                        'user'      => $reply->topic->user->username,
                        'title'     => $reply->topic->title,
                        'content'   => $reply->body,
                        'slug'      => $reply->topic->slug,
                        'id'        => $reply->topic->id
                    ];

                    $topic = $reply->topic;
                    $topic_user = $reply->topic->user;

                    Mail::queue('emails.reply', $data, function($message) use($topic_user, $topic, $user)
                    {
                        $user->last_reply_emailed = Carbon::now();
                        $user->save();
                        $message->to($topic_user->email)->subject('Naujas pranešimas temoje '.utf8_urldecode($topic->title));
                    });
                }
            }
        }
    }
}
