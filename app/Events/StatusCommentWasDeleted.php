<?php

namespace maze\Events;

use maze\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use maze\StatusComment;
use maze\User;

class StatusCommentWasDeleted extends Event
{
    use SerializesModels;

    public $status_comment;
    public $user;
    public $notifiable;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(StatusComment $status_comment, User $user)
    {
        $this->status_comment = $status_comment;
        $this->user = $user;
        $this->notifiable = $status_comment;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
