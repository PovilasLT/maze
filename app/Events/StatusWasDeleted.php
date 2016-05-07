<?php

namespace maze\Events;

use maze\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use maze\User;
use maze\Status;

class StatusWasDeleted extends Event
{
    use SerializesModels;

    public $status;
    public $user;
    public $notifiable;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Status $status, User $user)
    {
        $this->status = $status;
        $this->user = $user;
        $this->notifiable = $status;

        $user->decrement('status_count');
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
