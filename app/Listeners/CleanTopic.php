<?php

namespace maze\Listeners;

use maze\Events\TopicWasDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use maze\Events\ReplyWasDeleted;

use maze\Reply;

class CleanTopic
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
     * @param  TopicWasDeleted  $event
     * @return void
     */
    public function handle(TopicWasDeleted $event)
    {
       $replies = Reply::where('topic_id', $event->topic->id)->get();
       foreach($replies as $reply)
       {
            $reply->delete();
            event(new ReplyWasDeleted($reply, $event->topic, Auth::user()));
       } 
    }  
}
