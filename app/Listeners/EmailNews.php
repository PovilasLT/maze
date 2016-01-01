<?php

namespace maze\Listeners;

use maze\Events\NewsWasPosted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use maze\User;
use Mail;

class EmailNews
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
     * @param  NewsWasPosted  $event
     * @return void
     */
    public function handle(NewsWasPosted $event)
    {
        $users = User::where('email_news', 1)->get();

        $data = [
            'title' => $topic->title,
            'body'  => $topic->body
        ];

        foreach($users as $user)
        {
            Mail::queue('emails.news', $data, function($message) use($user, $topic)
            {
                $message->to($user->email)->subject('Maze Naujienos: '.utf8_urldecode($topic->title));
            });
        }
    }
}
