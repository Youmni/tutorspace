@extends('layouts.app')

@section('content')
<style>
    body {
        overflow: hidden;
    }
</style>
<div class="flex flex-col h-screen">
    <a href="{{ route('profile.chats.index') }}" 
    class="px-4 py-2 text-navy-500 underline rounded-md hover:text-navy-800 transition">
        Back
    </a>    
    <h1 class="text-3xl font-extrabold text-center text-indigo-600 mb-8">
        Chat with 
        @if($conversation->type === 'private')
            {{ $conversation->users->where('user_id', '!=', auth()->id())->first()->first_name ?? 'Unknown User' }}
        @else
            {{ $conversation->title }}
        @endif
    </h1>
    
    <div id="messages-container" class="flex-1 bg-white border-2 border shadow-lg rounded-lg p-6 mb-6 overflow-y-auto" style="max-height: 60vh;">
        @foreach($conversation->messages as $message)
            <div class="mb-4 flex {{ $message->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-xs p-4 rounded-lg shadow-md 
                    {{ $message->user_id === auth()->id() ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-900' }}">
                    <strong>{{ $message->user->first_name . ' ' . $message->user->last_name }}</strong>
                    <span class="block text-xs text-gray-400">{{ $message->created_at->format('d M Y - H:i') }}</span>
                    <p class="mt-2">{{ $message->message }}</p>
                    @if($message->attachment)
                        <img src="{{ asset('storage/' . $message->attachment) }}" alt="Attachment" class="mt-2 max-w-full rounded-lg">
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <form action="{{ route('profile.chats.message.store', $conversation->id) }}" method="POST" enctype="multipart/form-data" class="fixed bottom-0 left-0 w-full bg-white border-t p-4 flex items-center gap-3">
        @csrf
        <input type="text" name="message" class="flex-1 p-3 border rounded-full shadow-sm focus:ring focus:ring-indigo-300" placeholder="Type a message...">
        <button type="submit" class="bg-indigo-600 text-white px-5 py-3 rounded-full shadow-md hover:bg-indigo-700">
            ➤
        </button>
    </form>
</div>
<script>
    function scrollToBottom() {
        var chatContainer = document.getElementById('messages-container');
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    window.onload = scrollToBottom;
    document.querySelector('form').addEventListener('submit', function() {
        setTimeout(scrollToBottom, 100);
    });
</script>
@endsection