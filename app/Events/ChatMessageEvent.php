<?php

namespace App\Events;

use App\Models\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    private string $message; 
    private User $user;

    public function __construct(string $message, User $user)
    {
        $this->message = $message; 
        $this->user = $user; 
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
    
        return new PresenceChannel('presence.chat.1'); 
        
    }

    public function broadcastAs(){
        return 'chat-message';
    }

    public function broadcastWith(){
        return[
            'message' => $this->message, 
            'user' => $this->user->only(['name', 'email'])
        ]; 
    }
}
