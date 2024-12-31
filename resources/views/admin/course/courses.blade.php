@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Course Management</h1>
    <div class="flex justify-end gap-5 mb-4">
        <a href="{{ route('admin.courses.create') }}" class="underline text-black hover:text-blue-700">Add courses</a>
        <a href="{{ route('admin.institutions.index') }}" class="underline black hover:text-blue-700">Institution</a>
    </div>

    <form method="GET" action="{{ route('admin.courses.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="search" placeholder="Search courses..." value="{{ request('search') }}" class="border rounded py-2 px-4 w-full">
        <button type="submit" class="bg-navy-500 text-white py-2 px-4 rounded hover:bg-blue-700">Search</button>
    </form>

    @if($courses->isEmpty())
        <p class="text-gray-500">No courses available.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b text-left">ID</th>
                        <th class="py-2 px-4 border-b text-left">Title</th>
                        <th class="py-2 px-4 border-b text-left">Description</th>
                        <th class="py-2 px-4 border-b text-left">Institution</th>
                        <th class="py-2 px-4 border-b text-left">Update</th>
                        <th class="py-2 px-4 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $course->course_id }}</td>
                            <td class="border px-4 py-2">{{ $course->title }}</td>
                            <td class="border px-4 py-2">{{ $course->description }}</td>
                            <td class="border px-4 py-2">{{ $course->institution->name }}</td>
                            <td class="border px-4 py-2"><a class="text-blue-500 hover:text-blue-800" href="{{ route('admin.courses.edit', $course->course_id)}}">Update</a></td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('admin.courses.destroy', $course->course_id)}}" method="POST">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 ml-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection