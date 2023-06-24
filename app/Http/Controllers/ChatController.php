<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\ChatUser;

class ChatController extends Controller
{
    public function index($current_chat_id)
    {
        $access_check = DB::table('chat_users')
            ->where('chat_users.chat_id', '=', $current_chat_id)
            ->where('chat_users.user_id', '=', Auth::user()->id)
            ->get();
        if ($access_check->isEmpty())
            return redirect()->route('chat_list.index');

        $messages = DB::table('messages')->where('chat_id', '=', $current_chat_id)->get();

        $current_chat = DB::table('chats')
            ->where('chats.id', '=', $current_chat_id)
            ->select('chats.*')
            ->get()[0];

        $current_chat_users = DB::table('users')
            ->join('chat_users', 'users.id', '=', 'chat_users.user_id')
            ->where('chat_users.chat_id', '=', $current_chat_id)
            ->select('users.username', 'users.profile_picture', 'users.is_online', 'users.updated_at')
            ->get();

        return view('chat')
            ->with('messages', $messages)
            ->with('current_chat', $current_chat)
            ->with('current_chat_users', $current_chat_users);
    }

    public function user_store(Request $request, $current_chat_id)
    {
        $user = User::find_by_username($request->username);
        if ($user != null) {
            $check = DB::table('chat_users')
                ->where('chat_users.chat_id', '=', $current_chat_id)
                ->where('chat_users.user_id', '=', $user->id)
                ->select('chat_users.*')
                ->get();
            //dd($check->isEmpty());
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
        $user = User::find_by_username($request->username);
        if ($user !== null) {
            $check = DB::table('chats')
                ->where('chats.id', '=', $current_chat_id)
                ->where('chats.creator_user_id', '=', $user->id)
                ->select('chats.*')
                ->get();
            //dd($check->isEmpty());
            if ($check->isEmpty()) {
                DB::table('chat_users')
                    ->where('chat_users.chat_id', '=', $current_chat_id)
                    ->where('chat_users.user_id', '=', $user->id)
                    ->delete();
            }
        }
        return redirect()->route('chat.index', $current_chat_id);
    }
}
