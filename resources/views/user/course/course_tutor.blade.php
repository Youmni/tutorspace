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
                <figure class="relative bg-white border-2 border shadow-lg rounded-lg overflow-hidden transform transition-all hover:scale-105 hover:shadow-2xl hover:border-indigo-500 p-6 group flex flex-col items-center">
                    <img 
                        src="{{ $tutor->tutor->profile_photo ? asset('storage/' . $tutor->tutor->profile_photo) : asset('storage/images/default.jpg') }}" 
                        alt="{{ $tutor->tutor->first_name }} {{ $tutor->tutor->last_name }}" 
                        class="w-32 h-32 rounded-full border-4 border-indigo-500 shadow-lg transition-transform transform hover:scale-105"
                    />                    
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

                    <a href="{{ route('profile.chats.startOrOpen', ['tutorId' => $tutor->user_id]) }}" 
                    class="absolute bottom-0 left-0 right-0 bg-indigo-600 text-white p-4 text-center transform translate-y-full group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center space-x-2">
                        <i class="fas fa-comment-alt"></i> 
                        <span>Message</span>
                    </a>

                </figure>
            @endforeach
        </div>
    @endif
</div>
@endsection
