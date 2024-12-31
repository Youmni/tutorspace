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
            <x-input-label for="profile_photo" :value="__('Profile Picture')" />
            <input type="file" name="profile_photo" id="profile_photo" class="block w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @if ($user->profile_photo)
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Picture" class="w-32 h-32 rounded-full border border-gray-300 shadow-sm">
                </div>
            @endif
        </div>

        <div class="space-y-2">
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name', $user->first_name)" required autofocus />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name', $user->last_name)" required />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username', $user->username)" required />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <x-input-label for="about_me" :value="__('About Me')" />
            <textarea id="about_me" class="block mt-1 w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="about_me" rows="4">{{ old('about_me', $user->about_me) }}</textarea>
            <x-input-error :messages="$errors->get('about_me')" class="mt-2" />
        </div>

        <div class="text-right">
            <x-primary-button>
                {{ __('Update Profile') }}
            </x-primary-button>
        </div>
    </form>

</div>
@endsection