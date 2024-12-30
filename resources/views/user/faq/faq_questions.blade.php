@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-extrabold text-center text-indigo-600 mb-8">FAQ Questions</h1>
    
    @if($questions->isEmpty())
        <p class="text-gray-500 text-center">No questions available.</p>
    @else
        <div class="space-y-6">
            @foreach($questions as $question)
                <div class="bg-white shadow-lg border rounded-lg p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $question->question }}</h2>
                    <p class="text-gray-600">{{ $question->answer }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection