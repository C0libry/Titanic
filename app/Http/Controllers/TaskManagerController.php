<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskManagerController extends Controller
{
    public function index($current_chat_id)
    {
        $access_check = DB::table('chat_users')
            ->where('chat_users.chat_id', '=', $current_chat_id)
            ->where('chat_users.user_id', '=', Auth::user()->id)
            ->get();
        if ($access_check->isEmpty())
            return redirect()->route('chat_list.index');

        $current_chat = DB::table('chats')
            ->where('chats.id', '=', $current_chat_id)
            ->select('chats.*')
            ->first();

        $current_chat_users = DB::table('users')
            ->join('chat_users', 'users.id', '=', 'chat_users.user_id')
            ->where('chat_users.chat_id', '=', $current_chat_id)
            ->select('users.username', 'users.profile_picture', 'users.is_online', 'users.updated_at')
            ->get();

        $tasks = DB::table('tasks')->where('tasks.chat_id', '=', $current_chat_id)->get();

        return view('task_manager')
            ->with('tasks', $tasks)
            ->with('current_chat', $current_chat)
            ->with('current_chat_users', $current_chat_users);
    }
}
