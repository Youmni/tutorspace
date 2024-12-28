<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Institution;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index()
    {
        $statistics = [
            'totalUsers' => User::count(),
            'totalInstitutions' => Institution::count(),
            'totalCourses' => Course::count(),
        ];

        $userRoleCounts = [
            User::where('role', 'admin')->count(),
            User::where('role', 'tutor')->count(),
            User::where('role', 'client')->count(),
        ];
        $newStatistics = [
            User::where('created_at', '>=', now()->subMonth())->count(),
            Course::where('created_at', '>=', now()->subMonth())->count(),
            Institution::where('created_at', '>=', now()->subMonth())->count(),
        ];

        return view('admin.home', compact('statistics', 'userRoleCounts', 'newStatistics'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user_show', compact('user'));
    }


    // public function store(Request $request): RedirectResponse
    // {
    //     //validate
    //     $request->validate([
    //         'first_name' => ['required', 'string','min:3', 'max:30'],
    //         'last_name' => ['required', 'string','min:3', 'max:30'],
    //         'username' => ['required', 'string','min:3', 'max:30', 'unique:users'], 
    //         'date_of_birth' => ['nullable', 'date', 'before:-16 years'], 
    //         'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'], 
    //         'about_me' => ['nullable', 'string'], 
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'], 
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //         'role' => ['required', 'in:admin,tutor,client'],
    //     ], [
    //         'date_of_birth.before' => 'You must be atleast 16 years old.',
    //     ]);


    //     $user = User::create([
    //         'first_name' => $request->first_name,
    //         'last_name' => $request->last_name,
    //         'username' => $request->username,
    //         'date_of_birth' => $request->date_of_birth, 
    //         'profile_photo' => $this->handleProfilePhoto($request), 
    //         'about_me' => $request->about_me, 
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'role' => $request->role,
    //     ]);

    //     event(new Registered($user));

    //     return redirect(route('admin.users', absolute: false));
    // }

    protected function handleProfilePhoto($request)
    {
        if ($request->hasFile('profile_photo')) {
            $photo = $request->file('profile_photo');

            $path = $photo->storeAs('public/profile_photos', uniqid() . '.' . $photo->getClientOriginalExtension());

            return $path;
        }
        return null;
    }
}
