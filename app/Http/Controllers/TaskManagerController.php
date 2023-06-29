<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatUser;
use App\Models\Chat;
use App\Models\Task;

class TaskManagerController extends Controller
{
    public function index($current_chat_id)
    {
        $access_check = ChatUser::query()
            ->where('chat_id', $current_chat_id)
            ->where('user_id', Auth::user()->id)
            ->get();
        if ($access_check->isEmpty())
            return redirect()->route('chat_list.index');

        $current_chat = Chat::find($current_chat_id);

        $tasks = Task::query()->where('chat_id', $current_chat_id)->with(['user'])->get();

        return view('task_manager')
            ->with('tasks', $tasks)
            ->with('current_chat', $current_chat);
    }
}
