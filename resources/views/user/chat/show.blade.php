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
    <h1 class="text-3xl font-extrabold text-center text-indigo-600 mb-8 break-text break-all">
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
                    <strong class="break-words break-all">{{ $message->user->first_name . ' ' . $message->user->last_name }}</strong>
                    <span class="block text-xs text-gray-400">{{ $message->created_at->format('d M Y - H:i') }}</span>
                    <p class="mt-2 break-words break-all">{{ $message->message }}</p>
                    @if($message->attachment)
                        <img src="{{ asset('storage/' . $message->attachment) }}" alt="Attachment" class="mt-2 max-w-full rounded-lg">
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <form action="{{ route('profile.chats.message.store', $conversation->id) }}" method="POST" enctype="multipart/form-data" class="fixed bottom-0 left-0 w-full bg-white border-t p-4 flex items-center gap-3">
        @csrf
        <div class="relative flex-1">
            <input 
                type="text" 
                name="message" 
                id="message-input" 
                maxlength="256"
                class="w-full p-3 pr-16 border rounded-full shadow-sm focus:ring focus:ring-indigo-300" 
                placeholder="Type a message..."
            >
            <!-- Teller die het aantal getypte karakters toont -->
            <div 
                id="char-count" 
                class="absolute right-5 top-1/2 transform -translate-y-1/2 text-xs text-gray-500"
            >
                0/256
            </div>
        </div>
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
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    // Zet logging aan voor debugdoeleinden (zet dit uit in productie)
    Pusher.logToConsole = true;

    var pusher = new Pusher('caaba6478c6990b23aec', {
      cluster: 'eu'
    });

    // Abonneer op het kanaal dat overeenkomt met de huidige conversatie
    var channel = pusher.subscribe('conversation.{{ $conversation->id }}');

    // Luister naar het 'message.sent' event
    channel.bind('message.sent', function(data) {
      // Maak een nieuw bericht-element aan en voeg dit toe aan de chat container
      var container = document.getElementById('messages-container');
      var messageDiv = document.createElement('div');
      var alignment = data.user_id == {{ auth()->id() }} ? 'justify-end' : 'justify-start';
      messageDiv.className = 'mb-4 flex ' + alignment;
      
      var innerDiv = document.createElement('div');
      var bgClass = data.user_id == {{ auth()->id() }} ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-900';
      innerDiv.className = 'max-w-xs p-4 rounded-lg shadow-md ' + bgClass;
      innerDiv.innerHTML = '<strong class="break-words break-all">' + data.user.first_name + ' ' + data.user.last_name + '</strong>' +
                           '<span class="block text-xs text-gray-400">' + data.created_at + '</span>' +
                           '<p class="mt-2 break-words break-all">' + data.message + '</p>';
      if(data.attachment) {
          innerDiv.innerHTML += '<img src="' + data.attachment + '" alt="Attachment" class="mt-2 max-w-full rounded-lg">';
      }
      
      messageDiv.appendChild(innerDiv);
      container.appendChild(messageDiv);
      // Scroll automatisch naar beneden
      container.scrollTop = container.scrollHeight;
    });
</script>
<script>
    const messageInput = document.getElementById('message-input');
    const charCount = document.getElementById('char-count');

    messageInput.addEventListener('input', () => {
        // Indien de invoer toch meer dan 256 tekens bevat, snijd dan de overtollige tekens af.
        if (messageInput.value.length > 256) {
            messageInput.value = messageInput.value.substring(0, 256);
        }
        charCount.textContent = messageInput.value.length + '/256';
    });
</script>
@endsection