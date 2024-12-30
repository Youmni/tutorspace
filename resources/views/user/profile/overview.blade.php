@extends('layouts.profile')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Profile</h1>

    @if (session('status') === 'profile-updated')
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            Profile updated successfully!
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6 space-y-6">
        @csrf
        @method('PUT')

    <div class="space-y-2">
        <label for="profile_photo" class="block text-lg font-medium text-gray-700">Profile Picture</label>
        <input type="file" name="profile_photo" id="profile_photo" class="block w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        @if ($user->profile_photo)
            <div class="mt-4">
                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Picture" class="w-32 h-32 rounded-full border border-gray-300 shadow-sm">
            </div>
        @endif
    </div>

    <div class="space-y-2">
        <label for="first_name" class="block text-lg font-medium text-gray-700">First Name</label>
        <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}" class="block w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div class="space-y-2">
        <label for="last_name" class="block text-lg font-medium text-gray-700">Last Name</label>
        <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}" class="block w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div class="space-y-2">
        <label for="username" class="block text-lg font-medium text-gray-700">Username</label>
        <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" class="block w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div class="space-y-2">
            <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="block w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div class="space-y-2">
        <label for="about_me" class="block text-lg font-medium text-gray-700">About Me</label>
        <textarea name="about_me" id="about_me" rows="4" class="block w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('about_me', $user->about_me) }}</textarea>
    </div>

    <div class="text-right">
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Update Profile</button>
    </div>
</form>

</div>
@endsection