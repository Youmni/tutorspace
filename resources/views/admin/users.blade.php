@extends('layouts.admin')

@section('content')
    <div class="flex justify-between">
        <h1 class="text-2xl font-bold mb-4">User Management</h1>
        <a href="{{ route('admin.create') }}" class="underline">Create User</a>    
    </div>

    <div class="mb-4">
        <input type="text" id="search" placeholder="Search users..." class="p-2 border rounded w-full">
    </div>

    <div class="overflow-y-auto max-h-96">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
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
                    <tr class="user-row cursor-pointer" data-url="{{ route('admin.user.show', $user->user_id) }}">
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


    <script>
        document.getElementById('search').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#userTable .user-row');
            rows.forEach(row => {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });

        document.querySelectorAll('.user-row').forEach(row => {
            row.addEventListener('click', function() {
                window.location.href = this.dataset.url;
            });
        });
    </script>
@endsection