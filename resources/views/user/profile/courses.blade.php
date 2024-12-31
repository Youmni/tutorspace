@extends('layouts.profile')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Courses you tutor</h1>

    @if($courses->isEmpty())
        <p>No courses found.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($courses as $course)
                <div class="block bg-gray-100 border-l-4 border-navy-500 p-6 rounded-lg shadow-md hover:bg-gray-200 transition">
                    <div>
                        <h2 class="text-xl font-bold mb-2 text-navy-500">{{ $course->title }}</h2>
                        <p class="text-gray-700 mb-4">{{ $course->description }}</p>
                        <p class="text-gray-500">Institution: {{ $course->institution->name }}</p>
                        <p class="text-gray-500">Country: {{ $course->institution->country }}</p>
                    </div>
                    <div class="flex justify-between items-center mt-4">
                        <a href="{{ route('courses.tutors', ['id' => $course->course_id]) }}" class="text-navy-500 hover:underline hover:text-blue-500">View all Tutors</a>
                        <form action="{{ route('tutor_course.destroy', $course->course_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection