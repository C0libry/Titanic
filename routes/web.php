<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MainController@home');

Route::get('/user', 'MainController@user');

Route::get('/chat', 'MainController@chat');

Route::get('/user', function () {
    return view('user');
})->middleware(['auth'])->name('user');

require __DIR__.'/auth.php';
