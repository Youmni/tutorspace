@extends('layouts.profile')

@section('content')
<div class="container mx-auto p-6 h-[calc(100vh-175px)] overflow-y-auto">
    <h1 class="text-3xl font-extrabold text-center text-indigo-600 mb-8">Your Chats</h1>

    @if($conversations->isEmpty())
        <p class="text-gray-500 text-center">You have no chats yet.</p>
    @else
        <div class="flex flex-col gap-4">
        @foreach($conversations as $conversation)
            <a href="{{ route('profile.chats.show', $conversation->id) }}" 
            class="bg-white border border-gray-200 shadow-md rounded-lg p-6 hover:bg-gray-100">
                <h2 class="text-2xl font-semibold text-gray-800 mb-2 flex items-center justify-between">
                    <span>
                        {{ $conversation->users->first() 
                            ? $conversation->users->first()->first_name . ' ' . $conversation->users->first()->last_name 
                            : 'Unknown User' 
                        }}
                    </span>
                    <span class="text-sm text-gray-500">
                        @if($conversation->messages->isNotEmpty())
                            {{ $conversation->messages->last()->created_at->format('d M Y, H:i') }}
                            @endif
                    </span>
                </h2>
                <p class="text-gray-600">
                    {{ $conversation->messages->last()->message ?? 'No messages yet.' }}
                </p>
            </a>
        @endforeach
        </div>
    @endif
</div>
@endsection