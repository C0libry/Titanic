<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Chat;
use App\Models\ChatUser;
use App\Models\Message;

class ChatController extends Controller
{
    public function index($current_chat_id)
    {
        $access_check = ChatUser::query()
            ->where('chat_users.chat_id', $current_chat_id)
            ->where('chat_users.user_id', Auth::user()->id)
            ->get();
        if ($access_check->isEmpty())
            return redirect()->route('chat_list.index');

        $messages = Message::query()->where('chat_id', $current_chat_id)
            ->with('user')
            ->get();

        ChatController::read_unread_messages($messages);

        $current_chat = Chat::query()
            ->where('chats.id', $current_chat_id)
            ->select('chats.*')
            ->get()[0];

        $current_chat_users = User::query()
            ->join('chat_users', 'users.id', 'chat_users.user_id')
            ->where('chat_users.chat_id', $current_chat_id)
            ->select('users.username', 'users.profile_picture', 'users.is_online', 'users.updated_at')
            ->get();

        return view('chat')
            ->with('messages', $messages)
            ->with('current_chat', $current_chat)
            ->with('current_chat_users', $current_chat_users);
    }

    public function user_store(Request $request, $current_chat_id)
    {
        $user = User::query()
            ->where('users.username', $request->username)
            ->select('users.id')
            ->first();
        if ($user !== null) {
            $check = ChatUser::query()
                ->where('chat_users.chat_id', $current_chat_id)
                ->where('chat_users.user_id', $user->id)
                ->select('chat_users.*')
                ->get();
            if ($check->isEmpty()) {
                $chat_user = new ChatUser();
                $chat_user->chat_id = $current_chat_id;
                $chat_user->user_id = $user->id;
                $chat_user->save();
            }
        }
        return redirect()->route('chat.index', $current_chat_id);
    }

    public function user_destroy(Request $request, $current_chat_id)
    {
        $user = User::query()
            ->where('users.username', $request->username)
            ->select('users.id')
            ->first();
        if ($user !== null) {
            $check = Chat::query()
                ->where('chats.id', $current_chat_id)
                ->where('chats.creator_user_id', $user->id)
                ->select('chats.*')
                ->get();
            if ($check->isEmpty()) {
                ChatUser::query()
                    ->where('chat_users.chat_id', $current_chat_id)
                    ->where('chat_users.user_id', $user->id)
                    ->delete();
            }
        }
        return redirect()->route('chat.index', $current_chat_id);
    }

    private function read_unread_messages($messages)
    {
        foreach ($messages as $message) {
            if ((Auth::user()->id != $message->sender_user_id) and ($message->is_read == false)) {
                $message->update(['is_read' => true]);
            }
        }
    }
}
