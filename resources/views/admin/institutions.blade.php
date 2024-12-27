@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Institution Management</h1>
    <div class="flex justify-end gap-5 mb-4">
        <a href="{{ route('admin.institutions.add') }}" class="underline text-black hover:text-blue-700">Add institution</a>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($institutions as $institution)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $institution->institution_id }}</td>
                            <td class="border px-4 py-2">{{ $institution->name }}</td>
                            <td class="border px-4 py-2">{{ $institution->country }}</td>
                            <td class="border px-4 py-2">{{ $institution->created_at }}</td>
                            <td class="border px-4 py-2">{{ $institution->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection