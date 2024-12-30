@extends('layouts.profile')
@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Update Password</h1>

    @if (session('status') === 'password-updated')
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            Password updated successfully!
        </div>
    @endif
        @if ($errors->updatePassword->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->updatePassword->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="bg-white shadow-md rounded-lg p-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="space-y-2">
            <label for="current_password" class="block text-lg font-medium text-gray-700">Current Password</label>
            <input type="password" name="current_password" id="current_password" class="block w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            @error('current_password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="password" class="block text-lg font-medium text-gray-700">New Password</label>
            <input type="password" name="password" id="password" class="block w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="password_confirmation" class="block text-lg font-medium text-gray-700">Confirm New Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            @error('password_confirmation')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Update Password</button>
        </div>
    </form>
</div>
@endsection