@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-extrabold text-center text-indigo-600 mb-8">FAQ Categories</h1>
    
    @if($categories->isEmpty())
        <p class="text-gray-500 text-center">No FAQ categories available.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($categories as $category)
                <a href="{{ route('faq.show', ['id' => $category->category_id]) }}" class="bg-white shadow-lg rounded-lg overflow-hidden transform transition-all hover:scale-105 hover:shadow-2xl hover:border-indigo-500 border-2 border-transparent p-6 group cursor-pointer">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $category->name }}</h2>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection