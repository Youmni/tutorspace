@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <a href="{{ Auth::check() ? route('courses.createTutor', ['id' => $course->course_id]) : route('login') }}" class="underline float-right hover:text-blue-500 cursor-pointer">
        Become tutor for {{ $course->title }}
    </a>    
    <h1 class="text-3xl font-extrabold text-center text-indigo-600 mb-8">Tutors for {{ $course->title }}</h1>
    
    @if($tutors->isEmpty())
        <p class="text-gray-500 text-center">No tutors available for this course.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($tutors as $tutor)
                <figure class="bg-white shadow-lg rounded-lg overflow-hidden transform transition-all hover:scale-105 hover:shadow-2xl hover:border-indigo-500 border-2 border-transparent p-6 group">
                    <img src="{{ file_exists(public_path('storage/app/public/images' . $tutor->tutor->image_path)) ? asset('storage/' . $tutor->tutor->image_path) : asset('storage/images/default.jpg') }}" alt="{{ $tutor->tutor->first_name }} {{ $tutor->tutor->last_name }}" class="w-full h-48 object-cover rounded-lg mb-6">
                    <figcaption class="text-center">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $tutor->tutor->first_name }} {{ $tutor->tutor->last_name }}</h2>
                        
                        @php
                            $dateOfBirth = \Carbon\Carbon::parse($tutor->tutor->date_of_birth);
                            $age = $dateOfBirth->age;
                        @endphp
                        <p class="text-gray-600 mb-4">{{ $age }} years old</p>
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <p class="text-gray-600 mb-4">{{ $tutor->tutor->about_me }}</p>
                        </div>
                        
                        <p class="text-gray-500 text-sm">Email: <a href="mailto:{{ $tutor->tutor->email }}" class="text-indigo-600 hover:underline">{{ $tutor->tutor->email }}</a></p>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    @endif
</div>
@endsection
