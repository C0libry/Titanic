<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Chat;
use App\Models\ChatUser;
use Intervention\Image\Facades\Image;

class ChatListController extends Controller
{
    public function index()
    {
        $chats = Chat::query()
            ->join('chat_users', 'chats.id', 'chat_users.chat_id')
            ->where('chat_users.user_id', Auth::user()->id)
            ->select('chats.*')
            ->get();
        return view('chat_list', ['chats' => $chats]);
    }

    public function chat_create()
    {
        return view('chat_create');
    }

    public function store(Request $request)
    {
        $chat = new Chat();

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:chats']
        ]);
        $chat->name = $request->input('name');

        if ($request->file('chat_picture')) {
            $request->validate([
                'chat_picture' => ['required', 'image:jpg, jpeg, png', 'dimensions:min_width:300, min_height:300']
            ]);
            $image = Image::make($request->file('chat_picture'));
            $filename  = time() . $request->file('chat_picture')->getClientOriginalName();

            $name = (string) $filename;

            $path = 'uploads/public/images/Chats pictures/' . $name;
            $image = Image::make($image)->resize(300, 300);
            $image->save($path);
            $chat->chat_picture = '/' . $path;
        }

        $chat->creator_user_id = Auth::user()->id;

        $chat->save();

        $chat_user = new ChatUser();
        $chat_user->chat_id = $chat->id;
        $chat_user->user_id = Auth::user()->id;
        $chat_user->save();

        return redirect()->route('chat_list.index');
    }

    public function destroy($current_chat_id)
    {
        $chat = Chat::query()
            ->where('chats.id', $current_chat_id)
            ->where('chats.creator_user_id', Auth::user()->id)
            ->select('chats.*')
            ->first();
        if ($chat !== null) {
            if ($chat->chat_picture != '/uploads/public/images/Chats pictures/default_chat_picture.svg')
                Storage::disk('public_uploads')->delete(mb_substr($chat->chat_picture, 9));
            Chat::find($current_chat_id)->delete();
        }
        return redirect()->route('chat_list.index');
    }

    public function leave_chat($current_chat_id)
    {
        ChatUser::query()->where('user_id', Auth::user()->id)->where('chat_id', $current_chat_id)->delete();
        return redirect()->route('chat_list.index');
    }
}
