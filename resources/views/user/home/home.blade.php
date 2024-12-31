@extends('layouts.app')

@section('content')
<section class="relative bg-cover bg-center h-screen w-full" style="background-image: url('{{ asset('images/home.jpg') }}');">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

    <div class="h-full flex items-center justify-center">
        <div class="text-center text-white relative z-10">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Welcome to TutorSpace</h1>
            <p class="text-lg md:text-2xl mb-8">Find the best courses and tutors to enhance your skills</p>
            <a href="{{ route('courses.index') }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                Explore Courses
            </a>
        </div>
    </div>
</section>
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6 lg:px-12">
        <div class="max-w-4xl mx-auto text-center mb-12">
            <h2 class="text-4xl font-extrabold text-gray-800 mb-6">
                About <span class="text-indigo-600">TutorSpace</span>
            </h2>
            <p class="text-gray-600 text-lg leading-relaxed">
                At TutorSpace, we are dedicated to connecting students with the best tutors and courses available. 
                Whether you are looking to improve your skills, learn something new, or get help with your studies, 
                TutorSpace offers a wide range of resources to help you achieve your goals.
            </p>
        </div>

        <div class="grid gap-8 md:grid-cols-3">
            <div class="text-center">
                <div class="mb-4">
                    <span class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 text-indigo-600">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 14c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"></path>
                            <path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-3">Experienced Tutors</h3>
                <p class="text-gray-600 text-base leading-relaxed">
                    Learn from qualified and experienced tutors who are passionate about teaching and committed to your success.
                </p>
            </div>

            <div class="text-center">
                <div class="mb-4">
                    <span class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 text-indigo-600">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 6H4v12h16V6z" opacity=".3"></path>
                            <path d="M4 6c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2H4zm0 10V8h16v8H4z"></path>
                        </svg>
                    </span>
                </div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-3">Flexible Learning</h3>
                <p class="text-gray-600 text-base leading-relaxed">
                    Enjoy the flexibility of online learning with courses that fit your schedule and adapt to your pace.
                </p>
            </div>

            <div class="text-center">
                <div class="mb-4">
                    <span class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 text-indigo-600">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM6 17.46c1.4.92 3.1 1.54 5 1.54s3.6-.62 5-1.54c-1.4-1.1-3.1-1.92-5-1.92s-3.6.82-5 1.92zM12 6c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4z"></path>
                        </svg>
                    </span>
                </div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-3">Proven Results</h3>
                <p class="text-gray-600 text-base leading-relaxed">
                    Achieve your academic goals with our platform that is designed to deliver measurable results and success stories.
                </p>
            </div>
        </div>
    </div>
</section>
<section class="py-12 bg-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-extrabold text-gray-800 tracking-tight mb-10 border-b-4 border-blue-500 inline-block pb-2">Latest Announcements</h2>        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($newsItems as $item)
                <div class="bg-gray-100 p-6 rounded-lg shadow-md border">
                    <figure>
                        <img src="{{ asset('storage/' . $item->image_path) }}" 
                             alt="{{ $item->title }}" 
                             class="w-full max-h-80 object-scale-down rounded-t-lg mb-4">
                    </figure>
                    <h3 class="text-xl font-bold mb-2">{{ $item->title }}</h3>
                    <p class="text-gray-700 mb-4">{{ $item->content }}</p>
                    <p class="text-gray-500 text-sm">{{ $item->created_at->format('F j, Y') }}</p>
                </div>
            @endforeach
        </div>

        <a href="{{ route('home.show') }}" class="underline hover:text-blue-500">See all Announcements</a>
    </div>
</section>


@endsection