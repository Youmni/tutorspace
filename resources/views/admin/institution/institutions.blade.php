@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div id="success-message" class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <h1 class="text-2xl font-bold mb-4">Institution Management</h1>
    <div class="flex justify-end gap-5 mb-4">
        <a href="{{ route('admin.institutions.create') }}" class="underline text-black hover:text-blue-700">Add institution</a>
    </div>

    <form method="GET" action="{{ route('admin.institutions.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="search" placeholder="Search institutions..." value="{{ request('search') }}" class="border rounded py-2 px-4 w-full">
        <button type="submit" class="bg-navy-500 text-white py-2 px-4 rounded hover:bg-navy-700">Search</button>
    </form>

    @if($institutions->isEmpty())
        <p class="text-gray-500">No institutions available.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b text-left">ID</th>
                        <th class="py-2 px-4 border-b text-left">Name</th>
                        <th class="py-2 px-4 border-b text-left">Country</th>
                        <th class="py-2 px-4 border-b text-left">Created</th>
                        <th class="py-2 px-4 border-b text-left">Updated</th>
                        <th class="py-2 px-4 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($institutions as $institution)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $institution->institution_id }}</td>
                            <td class="border px-4 py-2">{{ $institution->name }}</td>
                            <td class="border px-4 py-2">{{ $institution->country }}</td>
                            <td class="border px-4 py-2">{{ $institution->created_at }}</td>
                            <td class="border px-4 py-2"><a class="text-blue-500 hover:text-blue-800" href="{{route('admin.institutions.edit', $institution->institution_id)}}">Update</a></td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('admin.institutions.destroy', $institution->institution_id)}}" method="POST">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 ml-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a class="underline hover:text-navy-500" href="{{ route('admin.courses.index') }}">Back</a>
        </div>
    @endif
@endsection