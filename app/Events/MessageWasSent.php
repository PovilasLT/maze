<?php

namespace maze\Events;

use maze\Events\Event;
use maze\Messenger\Message;
use maze\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageWasSent extends Event implements ShouldBroadcast
{
    
    public $message;
    public $user;
    public $conversation;
    public $view;

    public function __construct(Message $message, User $user)
    {
        $this->message = $message;
        $this->user = $user;
        $this->conversation = $message->conversation;
        $this->view = view('message.item', ['message' => $message])->render();
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['messages'];
    }

    public function broadcastWith()
    {
        return [
            'channel' => $this->user->secret,
            'data' => [
                'body'              => $this->view,
                'conversation_id'   => $this->conversation->id,
                'message_id'        => $this->message->id,
                'user_online'       => $this->message->user->is_online,
                'user_id'           => $this->message->user_id,
            ]
        ];
    }
}
