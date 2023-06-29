<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class MessageController extends Controller
{

    public function store(Request $request, $current_chat_id)
    {
        $request->validate([
            'user_message' => ['required', 'string', 'max:3000']
        ]);
        $message = new Message();
        $message->chat_id = $current_chat_id;
        $message->sender_user_id = Auth::user()->id;
        $message->content = $request->user_message;
        $message->is_read = false;
        $message->save();
        return redirect()->route('chat.index', $current_chat_id);
    }

    public function destroy(Request $request)
    {
        Message::query()->where('id', $request->message_id)->delete();
        return redirect()->route('chat.index', $request->current_chat_id);
    }
}
