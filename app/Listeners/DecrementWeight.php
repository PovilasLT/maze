<?php

namespace maze\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DecrementWeight
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
     * @param  ReplyWasDeleted  $event
     * @return void
     */
    public function handle($event)
    {
        if(isset($event->topic))
        $event->topic->decrement('weight', $event->weight);
    }
}
