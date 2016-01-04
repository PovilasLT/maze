<?php

namespace maze\Listeners;

use maze\Events\StatusWasDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use maze\StatusComment;

class CleanStatus
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
     * @param  StatusWasDeleted  $event
     * @return void
     */
    public function handle(StatusWasDeleted $event)
    {
        StatusComment::where('status_id', $event->status->id)->delete();
    }
}
