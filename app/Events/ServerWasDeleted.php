<?php

namespace maze\Events;

use maze\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use maze\GameServer;
use maze\User;

class ServerWasDeleted extends Event
{
    use SerializesModels;

    public $server;
    public $user;
    public $notifiable;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(GameServer $server, User $user)
    {
        $this->server = $server;
        $this->user = $user;
        $this->notifiable = $server;
        $this->game->decrement('server_count');
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
