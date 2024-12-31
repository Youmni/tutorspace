@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 text-center">
    <a href="{{route('home.index')}}" class="underline hover:text-blue-500 float-left">Back</a>
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
</div>
@endsection



