@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-extrabold text-center text-indigo-600 mb-8">Become a Tutor for {{ $course->title }}</h1>
    <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $course->title }}</h2>
        <p class="text-gray-700 mb-4">{{ $course->description }}</p>
        <p class="text-gray-500 mb-2">Institution: {{ $course->institution->name }}</p>
        <p class="text-gray-500">Country: {{ $course->institution->country }}</p>
    </div>
    <form action="{{ route('courses.storeTutor', ['id' => $course->course_id]) }}" method="post" class="bg-white shadow-lg rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox text-indigo-600" name="agreement" required>
                <span class="ml-2 text-gray-700">I will respect the rules of TutorSpace</span>
            </label>
        </div>
        <div class="text-center">
            <input type="submit" value="Become Tutor" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
        </div>
    </form>
</div>
@endsection