<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserTyping implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $conversationId;
    public $userId;
    public $isTyping;

    /**
     * @param int  $conversationId
     * @param int  $userId
     * @param bool $isTyping
     */
    public function __construct($conversationId, $userId, $isTyping)
    {
        $this->conversationId = $conversationId;
        $this->userId = $userId;
        $this->isTyping = $isTyping;
    }

    /**
     * Kanaalnaam (bijv. conversation.1)
     */
    public function broadcastOn()
    {
        return new Channel('conversation.' . $this->conversationId);
    }

    /**
     * Eventnaam
     */
    public function broadcastAs()
    {
        return 'typing';
    }

    /**
     * Payload
     */
    public function broadcastWith()
    {
        return [
            'user_id'   => $this->userId,
            'is_typing' => $this->isTyping,
        ];
    }
}
