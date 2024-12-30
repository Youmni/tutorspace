<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\Course; 
use App\Models\TutorCourse; 
use App\Models\User;


use App\Models\Institution; 




class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('user.profile.overview', compact('user'));
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = Auth::user();
        return view('user.profile.security', compact('user'));    }

    public function courses(Request $request): View
    {
        $user_id = Auth::id();
        $search = $request->input('search');
        $institution_id = $request->input('institution');
        $country = $request->input('country');
    
        $courseIds = TutorCourse::where('user_id', $user_id)->pluck('course_id');
    
        $courses = Course::whereIn('course_id', $courseIds)
            ->when($search, function ($query, $search) {
                return $query->where('title', 'LIKE', "%{$search}%")
                             ->orWhere('description', 'LIKE', "%{$search}%")
                             ->orWhereHas('institution', function ($query) use ($search) {
                                 $query->where('name', 'LIKE', "%{$search}%");
                             });
            })
            ->get();
    
        $institutions = Institution::all();
        $countries = Institution::distinct()->pluck('country');
    
        return view('user.profile.courses', compact('courses', 'institutions', 'countries'));
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->user_id . ',user_id'],
            'about_me' => ['nullable', 'string', 'max:128'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->user_id . ',user_id'],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
        ]);
    
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->username = $request->input('username');
        $user->about_me = $request->input('about_me');
        $user->email = $request->input('email');

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_pictures', 'public');
            $user->profile_photo = $path;
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.index')->with('status', 'profile-updated');
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
