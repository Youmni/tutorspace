<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function users(Request $request)
    {
        $search = $request->input('search');
    
        $users = User::query()
            ->where('user_id', 'LIKE', "$search")
            ->orWhere('first_name', 'LIKE', "%{$search}%")
            ->orWhere('last_name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('role', 'LIKE', "%{$search}%")
            ->get();
    
        return view('admin.users', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user_show', compact('user'));
    }
    
    public function create()
    {
        return view('admin.user_create'); 
    }


    public function store(Request $request): RedirectResponse
    {
        //validate
        $request->validate([
            'first_name' => ['required', 'string','min:3', 'max:30'],
            'last_name' => ['required', 'string','min:3', 'max:30'],
            'username' => ['required', 'string','min:3', 'max:30', 'unique:users'], 
            'date_of_birth' => ['nullable', 'date', 'before:-16 years'], 
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'], 
            'about_me' => ['nullable', 'string'], 
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'], 
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,tutor,client'],
        ], [
            'date_of_birth.before' => 'You must be atleast 16 years old.',
        ]);


        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'date_of_birth' => $request->date_of_birth, 
            'profile_photo' => $this->handleProfilePhoto($request), 
            'about_me' => $request->about_me, 
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        return redirect(route('admin.users', absolute: false));
    }

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
