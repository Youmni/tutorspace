@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">User: {{ $user->first_name }} {{ $user->last_name }}</h1>

    @if(session('success'))
        <div id="success-message" class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded p-6 mb-6">
        <div class="mb-4">
            <strong>ID:</strong> {{ $user->user_id }}
        </div>
        <div class="mb-4">
            <strong>First name:</strong> {{ $user->first_name }}
        </div>
        <div class="mb-4">
            <strong>Last name:</strong> {{ $user->last_name }}
        </div>
        <div class="mb-4">
            <strong>Username:</strong> {{ $user->username }}
        </div>
        <div class="mb-4">
            <strong>Date of Birth:</strong> {{ $user->date_of_birth }}
        </div>
        <div class="mb-4">
            <strong>Email:</strong> {{ $user->email }}
        </div>
        <div class="mb-4">
            <strong>Role:</strong> {{ $user->role }}
        </div>
        <div class="mb-4">
            <strong>Created At:</strong> {{ $user->created_at }}
        </div>
        <div class="mb-4">
            <strong>Updated At:</strong> {{ $user->updated_at }}
        </div>
        @if ($user->profile_photo)
            <div class="mb-4">
                <strong>Profile Photo:</strong>
                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" class="rounded-full w-24 h-24">
            </div>
        @endif
        @if ($user->about_me)
            <div class="mb-4">
                <strong>About Me:</strong> {{ $user->about_me }}
            </div>
        @endif
    </div>

    <div class="bg-white shadow-md rounded p-6">
        <form action="{{ route('admin.users.update', $user->user_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Change Role</label>
                <select name="role" id="role" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="client" {{ $user->role == 'client' ? 'selected' : '' }}>Client</option>
                    <option value="tutor" {{ $user->role == 'tutor' ? 'selected' : '' }}>Tutor</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Update Role
            </button>
        </form>
    </div>
    @if($user->role !== 'client')
        <div class="bg-white shadow-md rounded p-6 mb-6">
            <h2 class="text-xl font-bold mb-4">Courses Tutored</h2>
            @if($courses->isEmpty())
                <p class="text-gray-500">No courses available.</p>
            @else
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border-b text-left">Course Title</th>
                            <th class="py-2 px-4 border-b text-left">Description</th>
                            <th class="py-2 px-4 border-b text-left">Institution</th>
                            <th class="py-2 px-4 border-b text-left">Country</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td class="border px-4 py-2">{{ $course->title }}</td>
                                <td class="border px-4 py-2">{{ $course->description }}</td>
                                <td class="border px-4 py-2">{{ $course->institution->name }}</td>
                                <td class="border px-4 py-2">{{ $course->institution->country }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @endif
    <a class="underline hover:text-navy-500" href="{{ route('admin.users.index') }}">Back</a>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 3000);
            }
        });
    </script>
@endsection