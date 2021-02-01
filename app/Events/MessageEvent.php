<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    /**
     * Create a new event instance.
     * 
     * @param string
     *
     * @return void
     */
    public function __construct(string $message)
    {
        //
        $this->message  = $message;
    }

    /**
     * Get the data to broacast with
     * 
     * @return array
     */
    public function broadcastWith()
    {
        return [
            "hello" => "hey hey",
            "data" => "{$this->message} was sent"
        ];
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
     public function broadcastOn()
    {
        return new Channel('message-channel');
    }

    /**
     * Get the event the channels to broadcast to
     * The event broadast name
     * 
     * @return void
     */

    public function broadcastAs()
    {
        return 'message-event';
    }
}
