<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $userId = Auth::id();
    
        $conversations = Conversation::whereHas('users', function ($query) use ($userId) {
                $query->where('conversation_user.user_id', $userId);
            })
            ->with(['users' => function ($query) use ($userId) {
                $query->where('users.user_id', '!=', $userId);
            }])
            ->with(['messages' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }])
            ->get()
            ->sortByDesc(function ($conversation) {
                return $conversation->messages->last()->created_at ?? now();
            });
    
        return view('user.chat.index', compact('conversations'));
    }
    
    public function typing(Request $request, Conversation $conversation)
    {
        $isTyping = $request->input('typing', false);

        broadcast(new UserTyping(
            $conversation->id,
            auth()->id(),
            $isTyping
        ))->toOthers();

        return response()->json(['status' => 'ok']);
    }

    public function startOrOpen($tutorId)
    {
        $userId = Auth::id();

        if($userId == $tutorId) {
            return redirect()->route('profile.chats.index')->with('error', 'You cannot chat with yourself.');
        }
    
        $conversation = Conversation::whereHas('users', function ($query) use ($userId) {
                $query->where('conversation_user.user_id', $userId);
            })
            ->whereHas('users', function ($query) use ($tutorId) {
                $query->where('conversation_user.user_id', $tutorId);
            })
            ->whereHas('users', function ($query) {
                $query->havingRaw('COUNT(conversation_user.user_id) = 2');
            }, '=', 2)
            ->first();
    
        if (!$conversation) {
            $conversation = Conversation::create();
            $conversation->users()->attach([$userId, $tutorId]);
        }
    
        return redirect()->route('profile.chats.show', $conversation->id);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($conversationId)
    {
        $conversation = Conversation::find($conversationId);
    
    
        if (!$conversation->users->contains('user_id', auth()->id())) {
            return redirect()->route('profile.chats.index')->with('error', 'You are not authorized to view this conversation.');
        }

    
        $messages = $conversation->messages()->orderBy('created_at', 'asc')->get(); 
        return view('user.chat.show', compact('conversation', 'messages'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
