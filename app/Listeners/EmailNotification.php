<?php

namespace maze\Listeners;

use maze\Events\UserWasNotified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        //
    }
}
