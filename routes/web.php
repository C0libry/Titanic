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

Route::get('/', 'MainController@home')-> name('home');

Route::get('/chat', 'ChatController@chat')->middleware(['auth'])->name('chat');

Route::get('/user', 'UserController@user')->middleware(['auth'])->name('user');

require __DIR__.'/auth.php';

Route::get('/user/{id}/edit', 'UserController@edit_user_data')->name('edit_user_data');

Route::post('/user/{id}/edit', 'UserController@update_user_data')->name('update_user_data');