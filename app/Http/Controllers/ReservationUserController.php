<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation; 

class ReservationUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_id = Auth::id();
    
        $query = Reservation::where(function ($query) use ($user_id) {
                        $query->where('tutor_id', $user_id)
                              ->orWhere('participant_id', $user_id);
                    })
                    ->with(['tutor', 'participant']);
    
        if ($request->has('search_reservation') && $request->search_reservation) {
            $search = $request->search_reservation;
            $query->where(function ($query) use ($search) {
                $query->whereHas('tutor', function ($query) use ($search) {
                        $query->where('first_name', 'like', "%{$search}%")
                              ->orWhere('last_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('participant', function ($query) use ($search) {
                        $query->where('first_name', 'like', "%{$search}%")
                              ->orWhere('last_name', 'like', "%{$search}%");
                    })
                    ->orWhere('status', 'like', "%{$search}%");
            });
        }
    
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('start_time', '=', $request->start_date);
        }
    
        $reservations = $query->get();
    
        return view('user.reservation.index', compact('reservations'));
    }
    

    public function show($id)
    {
        $user = auth()->user();
        $reservation = Reservation::where(function ($query) use ($user) {
            if ($user->role == 'tutor') {
                $query->where('tutor_id', $user->id);
            } else {
                $query->where('participant_id', $user->id);
            }
        })->findOrFail($id);

        return view('reservations.show', compact('reservation'));
    }
}
