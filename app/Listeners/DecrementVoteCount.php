<?php

namespace maze\Listeners;

use maze\Events\DownVoted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DecrementVoteCount
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
     * @param  DownVoted  $event
     * @return void
     */
    public function handle($event)
    {
        $event->entity->decrement('vote_count', $event->karma);
    }
}
