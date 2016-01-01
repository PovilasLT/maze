<?php

namespace maze\Events;

use maze\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use maze\User;

class UserWasNotified extends Event
{
    use SerializesModels;

    public $object;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($object, User $user)
    {
        $this->object = $object;
        $this->user = $user;
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
