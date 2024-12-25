<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
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
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
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
