<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * MessageSent constructor.
     *
     * @param \App\Models\Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
        // Zorg ervoor dat de relatie 'user' is geladen, zodat we de naam kunnen doorgeven
        $this->message->load('user');
    }

    /**
     * Het kanaal waarop gebroadcast wordt.
     *
     * Gebruik een conversation-specifiek kanaal zodat alleen de betrokken partijen het event ontvangen.
     */
    public function broadcastOn()
    {
        return new Channel('conversation.' . $this->message->conversation_id);
    }

    /**
     * Naam van het event zoals het naar de client gebroadcast wordt.
     */
    public function broadcastAs()
    {
        return 'message.sent';
    }

    /**
     * De payload die met het event meegegeven wordt.
     */
    public function broadcastWith()
    {
        return [
            'id'              => $this->message->id,
            'conversation_id' => $this->message->conversation_id,
            'user_id'         => $this->message->user_id,
            'message'         => $this->message->message,
            'attachment'      => $this->message->attachment ? asset('storage/' . $this->message->attachment) : null,
            'created_at'      => $this->message->created_at->format('d M Y - H:i'),
            'user'            => [
                'first_name' => $this->message->user->first_name,
                'last_name'  => $this->message->user->last_name,
            ],
        ];
    }
}
