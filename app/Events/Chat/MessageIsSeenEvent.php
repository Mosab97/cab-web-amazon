<?php

namespace App\Events\Chat;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageIsSeenEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $data;
    public $messages;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data,$messages)
    {
        $this->data = $data;
        $this->messages = $messages;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('users-chat.'.$this->data->id);

    }


    public function broadcastWith()
    {
        return [
            'chat_id' => $this->data->chat_id,
            'sender_id' => $this->data->sender_id,
            'messages' => $this->messages,
            'is_admin' => in_array(auth()->user()->type,['admin','superadmin']),
            'read_at' => $this->data->read_at->format('Y-m-d H:i'),
        ];
    }
}
