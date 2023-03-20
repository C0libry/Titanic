<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function user()
    {
        return view('user');
    }

    public function edit_user_data()
    {
        return view('edit_user_data');
    }

    public function update_user_data(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255']
        ]);

        $user -> name = $request->input('name');
        $user -> surname = $request->input('surname');

        if (Auth::user()->username != $request->input('username'))
        {
            $request->validate([
                'username' => ['required', 'string', 'max:255', 'unique:users']
            ]);
            $user -> username = $request->input('username');
        }

        if (Auth::user()->email != $request->input('email'))
        {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
            ]);
            $user -> email = $request->input('email');
        }

        if (Auth::user()->email != $request->input('email'))
        {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
            ]);
            $user -> email = $request->input('email');
        }

        if ($request->file('profile_picture'))
        {
            $request->validate([
                'profile_picture' => ['required', 'image:jpg, jpeg, png', 'dimensions:min_width:300, min_height:300']
            ]);
            //$image = $request->file('profile_picture');
            $image = \Image::make($request->file('profile_picture'));
            $filename  = time() . $request->file('profile_picture')->getClientOriginalName();

            $path = 'images/' . ((string) $filename);
            $request->validate([
                $path => ['string', 'max:255', 'unique:users']
            ]);
            $user -> profile_picture = $path;

            $path = 'app/public/' . $path;
            $image = \Image::make($image)->resize(300, 300);
            $image->save(storage_path($path));
        }
        $user->save();
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
