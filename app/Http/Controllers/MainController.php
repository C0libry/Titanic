<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MainController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function chat()
    {
        // $chat_id = 6;
        // $chat_history_id = 'chat_history_' . $chat_id;
        // Schema::create($chat_history_id, function (Blueprint $table) {
        //     $table->id();
        //     $table->bigInteger('sender_user_id')->unsigned()->index()->nullable();
        //     $table->foreign('sender_user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        //     $table->text('content');
        //     $table->timestamps();
        // });
        return view('chat');
    }
    
    public function store(UpdateUserDataRequest $request)
    {
        $image = $request->file('image');
        $path = $image->store('Profile pictures');
    }
    
    public function fileUpload(Request $request)
    {
        if($request->isMethod('post'))
        {
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $file->move(public_path() . '/path','filename.img');
            }
        }
        return view('user');
    }
}
