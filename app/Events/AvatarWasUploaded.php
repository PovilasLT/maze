<?php

namespace maze\Events;

use maze\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Filesystem\Filesystem;

class AvatarWasUploaded extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $path;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['avatars'];
    }

    public function broadcastWith()
    {
        return [
            'path' => $this->path,
        ];
    }
}
