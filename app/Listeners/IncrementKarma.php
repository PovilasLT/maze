<?php

namespace maze\Listeners;

use maze\Events\ReplyWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class IncrementKarma
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
        $event->user->increment('karma_count', $event->karma);
    }
}
