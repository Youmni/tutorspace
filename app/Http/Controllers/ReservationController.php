<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course; 
use App\Models\User; 
use App\Models\Reservation; 
use App\Models\TutorCourse;
use Illuminate\Support\Facades\Auth;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function create(Request $request)
    {
        $tutorCourses = TutorCourse::where('user_id', Auth::id())->get();
        $courses = Course::whereIn('course_id', $tutorCourses->pluck('course_id'))->get();
        $tutors = User::where('role', 'tutor')->get();
    
        $clientsQuery = User::where('role', 'client');
        
        if ($request->has('search_client') && $request->search_client != '') {
            $search = $request->search_client;
            $clientsQuery->where(function($query) use ($search) {
                $query->where('user_id', 'LIKE', "%$search%")
                      ->orWhere('first_name', 'LIKE', "%$search%")
                      ->orWhere('last_name', 'LIKE', "%$search%");
            });
        }
    
        $clients = $clientsQuery->paginate(10);
    
        return view('user.reservation.create', compact('courses', 'tutors', 'clients'));
    }
    
    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:scheduled,pending,canceled',
        ]);
    
        $reservation->status = $request->input('status');
        $reservation->save();
    
        return redirect()->route('profile.reservations.index')->with('success', 'Status updated successfully');
    }
    



    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,course_id',
            'participant_id' => 'required|exists:users,user_id|different:tutor_id',
            'start_time' => 'required|date|after:tomorrow',
            'end_time' => 'required|date|after:start_time',
            'session_type' => 'required|in:online,physical',
            'price' => 'required|numeric|min:0',
            'payment_status' => 'required|in:paid,pending,canceled',
            'comments' => 'nullable|string|max:1000',
            'feedback' => 'nullable|string|max:1000',
            'material_links' => 'nullable|array',
            'material_links.*' => 'nullable|url',
        ], [
            'start_time.after' => 'De starttijd moet in de toekomst liggen.',
            'end_time.after' => 'De eindtijd moet na de starttijd liggen.',
            'participant_id.different' => 'De deelnemer kan niet dezelfde persoon zijn als de tutor.',
            'course_id.exists' => 'De geselecteerde cursus bestaat niet.',
            'participant_id.exists' => 'De geselecteerde deelnemer bestaat niet.',
            'tutor_id.exists' => 'De geselecteerde tutor bestaat niet.',
            'material_links.*.url' => 'Elke link in de materiaal links moet een geldige URL zijn.',
            'price.numeric' => 'De prijs moet een geldig getal zijn.',
        ]);
    
        $data = $request->all();
        $data['tutor_id'] = Auth::id();
    
        Reservation::create($data);
    
        return redirect()->route('profile.reservations.index')->with('success', 'Reservation created successfully');
    }
    
    

    public function edit(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id); 
        $tutorCourses = TutorCourse::where('user_id', Auth::id())->get();
        $courses = Course::whereIn('course_id', $tutorCourses->pluck('course_id'))->get();
        $tutors = User::where('role', 'tutor')->get();
    
        $clientsQuery = User::where('role', 'client');
        
        if ($request->has('search_client') && $request->search_client != '') {
            $search = $request->search_client;
            $clientsQuery->where(function($query) use ($search) {
                $query->where('user_id', 'LIKE', "%$search%")
                      ->orWhere('first_name', 'LIKE', "%$search%")
                      ->orWhere('last_name', 'LIKE', "%$search%");
            });
        }
    
        $clients = $clientsQuery->paginate(10);
    
        return view('user.reservation.edit', compact('reservation', 'courses', 'tutors', 'clients'));
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
    
        $request->validate([
            'course_id' => 'required|exists:courses,course_id',
            'participant_id' => 'required|exists:users,user_id|different:tutor_id',
            'start_time' => 'required|date|after:tomorrow',
            'end_time' => 'required|date|after:start_time',
            'session_type' => 'required|in:online,physical',
            'price' => 'required|numeric|min:0',
            'payment_status' => 'required|in:paid,pending,canceled',
            'comments' => 'nullable|string|max:1000',
            'feedback' => 'nullable|string|max:1000',
            'material_links' => 'nullable|array',
            'material_links.*' => 'nullable|url',
        ], [
            'start_time.after' => 'De starttijd moet in de toekomst liggen.',
            'end_time.after' => 'De eindtijd moet na de starttijd liggen.',
            'participant_id.different' => 'De deelnemer kan niet dezelfde persoon zijn als de tutor.',
            'course_id.exists' => 'De geselecteerde cursus bestaat niet.',
            'participant_id.exists' => 'De geselecteerde deelnemer bestaat niet.',
            'tutor_id.exists' => 'De geselecteerde tutor bestaat niet.',
            'material_links.*.url' => 'Elke link in de materiaal links moet een geldige URL zijn.',
            'price.numeric' => 'De prijs moet een geldig getal zijn.',
        ]);
    
        $reservation->update([
            'course_id' => $request->course_id,
            'participant_id' => $request->participant_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'session_type' => $request->session_type,
            'price' => $request->price,
            'payment_status' => $request->payment_status,
            'comments' => $request->comments,
            'feedback' => $request->feedback,
            'material_links' => $request->material_links,
        ]);
        
        return redirect()->route('profile.reservations.index')->with('success', 'Reservation updated successfully');
    }
    

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully');
    }
}
