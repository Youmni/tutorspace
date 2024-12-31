@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div id="success-message" class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <div class="flex justify-between">
        <h1 class="text-2xl font-bold mb-4">User Management</h1>
        <a href="{{ route('admin.users.create') }}" class="underline">Create User</a>    
    </div>

    <form method="get" action="{{ route('admin.users.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="search" placeholder="Search users..." value="{{ request('search') }}" class="border rounded py-2 px-4 w-full">
        <button type="submit" class="bg-navy-500 text-white py-2 px-4 rounded hover:bg-blue-700">Search</button>
    </form>

    @if($users->isEmpty())
        <p class="text-gray-500">No users available.</p>
    @else
    <div class="overflow-y-auto max-h-96">
        <table class="min-w-full border bg-white border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 border-b text-start">ID</th>
                    <th class="py-2 px-4 border-b text-start">First Name</th>
                    <th class="py-2 px-4 border-b text-start">Last Name</th>
                    <th class="py-2 px-4 border-b text-start">Email</th>
                    <th class="py-2 px-4 border-b text-start">Role</th>
                </tr>
            </thead>
            <tbody id="userTable">
                @foreach ($users as $user)
                    <tr class="user-row cursor-pointer hover:bg-gray-50" data-url="{{ route('admin.users.show', $user->user_id) }}">
                        <td class="py-2 px-4 border-b text-start">{{ $user->user_id }}</td>
                        <td class="py-2 px-4 border-b text-start">{{ $user->first_name }}</td>
                        <td class="py-2 px-4 border-b text-start">{{ $user->last_name }}</td>
                        <td class="py-2 px-4 border-b text-start">{{ $user->email }}</td>
                        <td class="py-2 px-4 border-b text-start">{{ $user->role }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <script>
        document.querySelectorAll('.user-row').forEach(row => {
            row.addEventListener('click', function() {
                window.location.href = this.dataset.url;
            });
        });

    </script>
@endsection