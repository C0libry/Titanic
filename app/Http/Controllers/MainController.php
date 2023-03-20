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
        return view('chat');
    }
}
