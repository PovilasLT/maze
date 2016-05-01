<?php

namespace maze\Events;

use maze\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use maze\Node;
use maze\User;

class NodeWasCreated extends Event
{
    use SerializesModels;

    public $node;
    public $user;
    public $entity;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Node $node, User $user)
    {
        $this->node = $node;
        $this->usre = $user;
        $this->entity = $node;


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
