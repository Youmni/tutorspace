<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;
use App\Models\Message;
use App\Models\Conversation;

class ReservationCreated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;

        $tutorId = $reservation->tutor_id;
        $participantId = $reservation->participant_id;

        // Zoek een private conversatie
        $conversation = Conversation::where('type', 'private')
            ->whereHas('messages', function ($query) use ($tutorId, $participantId) {
                $query->whereIn('user_id', [$tutorId, $participantId]);
            })
            ->first();

        // Maak een bericht aan als er een conversatie is gevonden
        if ($conversation) {
            Message::create([
                'conversation_id' => $conversation->id,
                'user_id' => $tutorId,
                'message' => 'Er is een nieuwe reservatie gemaakt: ' . $reservation->id,
            ]);
        }
    }

    /**
     * Bepaal op welk kanaal het event moet worden uitgezonden.
     */
    public function broadcastOn()
    {
        return new Channel('reservations');
    }

    /**
     * Optioneel: Definieer de naam van het event op het kanaal.
     */
    public function broadcastAs()
    {
        return 'reservation.created';
    }
}
