@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row">
    <main class="w-full md:w-3/4">
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
        @endif
    </main>
</div>
@endsection