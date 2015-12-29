<?php

namespace maze\Listeners;

use maze\Events\UpVoted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class IncrementVoteCount
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
     * @param  UpVoted  $event
     * @return void
     */
    public function handle($event)
    {
        $event->entity->increment('vote_count', $event->karma);
    }
}
