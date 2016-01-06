<?php

namespace maze\Listeners;

use maze\Events\StatusWasDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use maze\Events\StatusCommentWasDeleted;

use maze\StatusComment;

use Auth;

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
        $status_comments = StatusComment::where('status_id', $event->status->id)->get();
        foreach($status_comments as $status_comment)
        {
            $status_comment->delete();
            event(new StatusCommentWasDeleted($status_comment, Auth::user()));
        }
    }
}
