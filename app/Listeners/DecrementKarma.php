<?php

namespace maze\Listeners;

use maze\Events\ReplyWasDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DecrementKarma
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
        $event->user->decrement('karma_count', $event->karma);
    }
}
