<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $users = User::query()
            ->where('user_id', 'LIKE', "$search")
            ->orWhere('first_name', 'LIKE', "%{$search}%")
            ->orWhere('last_name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('role', 'LIKE', "%{$search}%")
            ->get();
    
        return view('admin.user.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.user_create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'date_of_birth' => 'nullable|date',
            'profile_photo' => 'nullable|string|max:255',
            'about_me' => 'nullable|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:client,tutor,admin',
        ]);
    
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->username = $request->input('username');
        $user->date_of_birth = $request->input('date_of_birth');
        $user->profile_photo = $request->input('profile_photo');
        $user->about_me = $request->input('about_me');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role = $request->input('role');
        $user->save();
    
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.user_show', compact('user'));
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
        $user = User::findOrFail($id);
        $user->role = $request->input('role');
        $user->save();

        return redirect()->route('admin.users.show', $user->user_id)->with('success', 'User role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}