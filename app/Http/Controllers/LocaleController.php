<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    public function set_locale($locale)
    {
        session(['locale' => $locale]);
        App::setLocale($locale);
        // dump(App::getLocale());
        // dd(session('locale'));
        return redirect()->back();
    }

    // public function locale()
    // {
    //     // session(['locale' => $request->locale]);
    //     // session()
    //     if (session('locale') === 'en') {
    //         session(['locale' => 'ru']);
    //         App::setLocale(session('locale'));
    //     } else {
    //         session(['locale' => 'en']);
    //         App::setLocale(session('locale'));
    //     }

    //     // dump(session()->all());
    //     return view('home');
    // }
}
