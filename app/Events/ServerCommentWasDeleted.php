<?php

namespace maze\Events;

use maze\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ServerCommentWasDeleted extends Event
{
    use SerializesModels;

    public $comment;
    public $server;
    public $user;
    public $notifiable;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ServerComment $comment, GameServer $server, User $user) 
    {
        $this->comment = $comment;
        $this->server = $server;
        $this->user = $user;
        $this->notifiable = $comment;
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
