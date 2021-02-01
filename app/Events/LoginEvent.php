<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class LoginEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    /**
     * Create a new event instance.
     *
     * @param \App\Models\User
     * 
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->user  = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
      public function broadcastOn()
    {
        return new Channel('login-channel');
    }

    /**
     * Get the event the channels to broadcast to
     * The event broadast name
     * 
     * @return void
     */
    public function broadcastAs()
    {
        return 'login-event';
    }
}
