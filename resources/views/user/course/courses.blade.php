@extends('layouts.app')

@section('content')
<div class="flex flex-col p-4">
    <h1 class="text-4xl font-bold text-center text-indigo-600 mb-6">Courses</h1>
    
    <form method="GET" action="{{ route('courses.index') }}" class="space-y-4 md:space-y-0 md:flex md:gap-4 mb-4">
        <div class="flex-1">
            <label for="search" class="block text-sm font-medium text-gray-700">Search by course name or institution</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="flex items-end">
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-600">Filter</button>
        </div>
    </form>

    <main class="w-full">
        @if($courses->isEmpty())
            <p class="text-gray-500">No courses available.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses as $course)
                    <a href="{{ route('courses.tutors', ['id' => $course->course_id]) }}" class="block bg-gray-100 border-l-4 border-blue-500 p-6 rounded-lg shadow-md hover:bg-gray-200 transition">
                        <h2 class="text-xl font-bold mb-2 text-blue-500">{{ $course->title }}</h2>
                        <p class="text-gray-700 mb-4">{{ $course->description }}</p>
                        <p class="text-gray-500">Institution: {{ $course->institution->name }}</p>
                        <p class="text-gray-500">Country: {{ $course->institution->country }}</p>
                    </a>
                @endforeach
            </div>
            
            <div class="mt-6">
                {{ $courses->links() }}
            </div>
        @endif
    </main>
</div>
@endsection
