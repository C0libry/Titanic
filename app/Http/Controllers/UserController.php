<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('user');
    }

    public function edit()
    {
        return view('user_edit');
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $request->validate([
            'name' => ['required', 'string', 'regex:/(^[A-Z][a-z]+$)|(^[А-Я][а-я]+$)/u', 'max:255'],
            'surname' => ['required', 'string', 'regex:/(^[A-Z][a-z]+$)|(^[А-Я][а-я]+$)/u', 'max:255']
        ]);

        $user->name = $request->input('name');
        $user->surname = $request->input('surname');

        if (Auth::user()->username != $request->input('username')) {
            $request->validate([
                'username' => ['required', 'string', 'max:255', 'unique:users']
            ]);
            $user->username = $request->input('username');
        }

        if (Auth::user()->email != $request->input('email')) {
            $request->validate([
                'email' => ['required', 'string', 'email', 'regex:/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/u', 'max:255', 'unique:users']
            ]);
            $user->email = $request->input('email');
        }

        if ($request->file('profile_picture')) {
            if (Auth::user()->profile_picture != '/uploads/public/images/Users profile pictures/default_profile_picture.svg')
                dd(mb_substr(Auth::user()->profile_picture, 9));
            Storage::disk('public_uploads')->delete(mb_substr(Auth::user()->profile_picture, 9));
            $request->validate([
                'profile_picture' => ['required', 'image:jpg, jpeg, png', 'dimensions:min_width:300, min_height:300']
            ]);
            $image = Image::make($request->file('profile_picture'));
            $filename = time() . $request->file('profile_picture')->getClientOriginalName();

            $name = (string) $filename;

            $path = 'uploads/public/images/Users profile pictures/' . $name;
            $image = Image::make($image)->resize(300, 300);
            $image->save($path);
            $user->profile_picture = '/' . $path;
        }
        $user->update();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function check_username($username)
    {
        if (!User::where('username', $username)->exists())
            return 1;
        else
            return 0;
    }

    public function find_user($username)
    {
        return User::query()
            ->where('username', 'like', '{$username}%');
    }
}
