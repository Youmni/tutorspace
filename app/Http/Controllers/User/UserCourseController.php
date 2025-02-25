<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course; 
use App\Models\Institution; 
use App\Models\TutorCourse; 


class UserCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $institution_id = $request->input('institution');
        $country = $request->input('country');
        
        $courses = Course::query()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'LIKE', "%{$search}%")
                             ->orWhere('description', 'LIKE', "%{$search}%")
                             ->orWhereHas('institution', function ($query) use ($search) {
                                 $query->where('name', 'LIKE', "%{$search}%");
                             });
            })
            ->paginate(9);
    
        $institutions = Institution::all();
        $countries = Institution::distinct()->pluck('country');
    
        return view('user.course.courses', compact('courses', 'institutions', 'countries'));
    }
    

    public function showTutors($id)
    {
        $course = Course::findOrFail($id);
        $tutors = $course->tutorCourses()->with('tutor')->get();
        return view('user.course.course_tutor', compact('course', 'tutors'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $course = Course::findOrFail($id);
        return view('user.course.course_tutor_add', compact(('course')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        $course = Course::findOrFail($id);
        $user = Auth::user();

        $existingTutorCourse = TutorCourse::where('user_id', $user->user_id)
        ->where('course_id', $course->course_id)
        ->first();

        if ($existingTutorCourse) {
            return redirect()->route('courses.tutors', $course->course_id)->with('error', 'You are already a tutor for this course.');
        }

        TutorCourse::create([
            'user_id' => $user->user_id,
            'course_id' => $course->course_id,
        ]);

        if($user->role != 'admin'){
            $user->role = 'tutor';
            $user->save();
        }

        return redirect()->route('courses.tutors', $course->course_id)->with('success', 'You have successfully become a tutor for this course.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($course_id)
    {
        $user_id = Auth::id();

        \Log::info('Destroy method called');
        \Log::info('User ID: ' . $user_id);
        \Log::info('Course ID: ' . $course_id);

        $tutorCourse = TutorCourse::where('user_id', $user_id)
            ->where('course_id', $course_id)
            ->firstOrFail();

        \Log::info('TutorCourse object: ', $tutorCourse->toArray());

        $tutorCourse->delete();

        $remainingTutorCourses = TutorCourse::where('user_id', $user_id)->count();

        if ($remainingTutorCourses === 0) {
            $user = Auth::user();
            $user->role = 'client';
            $user->save();
        }

        return redirect()->route('profile.courses')->with('status', 'Course deleted successfully.');
    }
}
