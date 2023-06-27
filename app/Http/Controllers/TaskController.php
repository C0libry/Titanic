<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class TaskController extends Controller
{
    public function create($current_chat_id)
    {
        return view('task_create')
            ->with('current_chat_id', $current_chat_id);
    }

    public function store(Request $request, $current_chat_id)
    {
        if ($user = DB::table('users')->where('users.username', '=', $request->username)->first()) {
            $task = new Task();
            $task->chat_id = $current_chat_id;
            $task->task_to_user_id = $user->id;
            $task->content = $request->Task;
            $task->task_priority = $request->Priority;
            $task->save();
        }
        return redirect()->route('task_manager.index', $current_chat_id);
    }

    public function destroy($current_task_id)
    {
        $current_task = Task::find($current_task_id);
        $current_chat = DB::table('chats')->where('id', '=', $current_task->chat_id)->first();
        if ($current_chat->creator_user_id == Auth::user()->id)
            DB::table('tasks')->where('id', '=', $current_task_id)->delete();
        return redirect()->route('task_manager.index', $current_chat->id);
    }

    public function done_task($current_task_id)
    {
        $current_task = Task::find($current_task_id);
        $current_chat = DB::table('chats')->where('id', '=', $current_task->chat_id)->first();
        if ($current_task->task_to_user_id == Auth::user()->id)
            DB::table('tasks')->where('id', '=', $current_task_id)->delete();
        return redirect()->route('task_manager.index', $current_chat->id);
    }
}
