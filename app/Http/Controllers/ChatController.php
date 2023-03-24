<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Chat;
use App\Models\Message;
use App\Models\ChatUser;

class ChatController extends Controller
{
    public function chat($current_chat_id)
    {
        $access_check = DB::table('chat_users')
        ->where('chat_users.chat_id', '=', $current_chat_id)
        ->where('chat_users.user_id', '=', Auth::user()->id)
        ->get();
        if ($access_check->isEmpty())
        return redirect()->route('chat_list');

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

    public function chat_list()
    {
        $chats = DB::table('chats')
        ->join('chat_users', 'chats.id', '=', 'chat_users.chat_id')
        ->where('chat_users.user_id', '=', Auth::user()->id)
        ->select('chats.*')
        ->get();
        // dd($chats);
        // DB::table('chats')->where('chats.id', '=', 19)->select('chats.chat_picture')->get()[0]->chat_picture;
        return view('chat_list', ['chats' => $chats]);
    }

    public function add_chat_page()
    {
        return view('add_chat');
    }

    public function add_chat(Request $request)
    {
        $chat = new Chat();

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:chats']
        ]);
        $chat -> name = $request->input('name');

        if ($request->file('chat_picture'))
        {
            $request->validate([
                'chat_picture' => ['required', 'image:jpg, jpeg, png', 'dimensions:min_width:300, min_height:300']
            ]);
            $image = \Image::make($request->file('chat_picture'));
            $filename  = time() . $request->file('chat_picture')->getClientOriginalName();
    
            $path = 'images/Chats pictures/' . ((string) $filename);
            $save_path = '/storage/' . $path;
            $request->validate([
                $save_path => ['string', 'max:255']
            ]);
            $chat -> chat_picture = $save_path;

            $path = 'app/public/' . $path;
            $image = \Image::make($image)->resize(300, 300);
            $image->save(storage_path($path));
        }

        $chat -> creator_user_id = Auth::user()->id;

        $chat->save();

        $chat_user = new ChatUser();
        $chat_user->chat_id = $chat->id;
        $chat_user->user_id = Auth::user()->id;
        $chat_user->save();

        return ChatController::chat_list();
    }
    
    public function delete_chat($current_chat_id)
    {
        $chat = DB::table('chats')
        ->where('chats.id', '=', $current_chat_id)
        ->where('chats.creator_user_id', '=', Auth::user()->id)
        ->select('chats.*')
        ->get();
        if (!$chat->isEmpty())
        {
            if($chat[0]->chat_picture != '/storage/images/Chats pictures/default_chat_picture.svg')
                Storage::delete(mb_substr($chat[0]->chat_picture, 9));
            DB::table('chats')->where('id', '=', $current_chat_id)->delete();
        }
        return redirect()->route('chat_list');
    }

    public function add_user_to_chat(Request $request, $current_chat_id)
    {
        $user = DB::table('users')
        ->where('users.username', '=', $request->username)
        ->select('users.*')
        ->get();
        if(!$user->isEmpty())
        {
            $check = DB::table('chat_users')
            ->where('chat_users.chat_id', '=', $current_chat_id)
            ->where('chat_users.user_id', '=', $user[0]->id)
            ->select('chat_users.*')
            ->get();
            //dd($check->isEmpty());
            if($check->isEmpty())
            {
                $chat_user = new ChatUser();
                $chat_user->chat_id = $current_chat_id;
                $chat_user->user_id = $user[0]->id;
                $chat_user->save();
            }
        }
        return ChatController::chat($current_chat_id);
    }

    public function delet_chat_user()
    {
        return redirect()->route('chat');
    }

    public function add_message(Request $request, $current_chat_id)
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
        return ChatController::chat($current_chat_id);
    }

    public function delete_message($message_id)
    {
        DB::table('messages')->where('id', '=', $message_id)->delete();
    }
}
