<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'regex:/(^[A-Z][a-z]+$)|(^[А-Я][а-я]+$)/u', 'max:255'],
            'surname' => ['required', 'string', 'regex:/(^[A-Z][a-z]+$)|(^[А-Я][а-я]+$)/u', 'max:255'],
            'username' => ['required', 'string', 'regex:/^[a-zA-Z0-9_]+$/', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'regex:/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/u', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'agreement' => ['accepted'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
