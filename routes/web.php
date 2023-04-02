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

Route::get('/chat_list', 'ChatController@chat_list')->middleware(['auth'])->name('chat_list');

Route::get('/add_chat', 'ChatController@add_chat_page')->middleware(['auth'])->name('add_chat_page');


Route::post('/chat_list', 'ChatController@add_chat')->middleware(['auth'])->name('add_chat');

Route::get('/chat/{id}', 'ChatController@chat')->whereNumber('id')->middleware(['auth'])->name('chat');

Route::post('/chat/{id}', 'ChatController@add_message')->whereNumber('id')->middleware(['auth'])->name('add_message');

Route::post('/chat/add_user_to_chat/{id}', 'ChatController@add_user_to_chat')->whereNumber('id')->middleware(['auth'])->name('add_user_to_chat');

Route::post('/chat/delete_user_from_chat/{id}', 'ChatController@delete_user_from_chat')->whereNumber('id')->middleware(['auth'])->name('delete_user_from_chat');

Route::get('/chat/delete_chat/{id}', 'ChatController@delete_chat')->whereNumber('id')->middleware(['auth'])->name('delete_chat');

Route::get('/chat/leave_chat/{id}', 'ChatController@leave_chat')->whereNumber('id')->middleware(['auth'])->name('leave_chat');

Route::get('/chat/delet_chat_user/{id}', 'ChatController@delet_chat_user')->whereNumber('id')->middleware(['auth'])->name('delet_chat_user');

Route::get('/chat/task_manager/{id}', 'ChatController@task_manager')->whereNumber('id')->middleware(['auth'])->name('task_manager');

Route::get('/chat/add_task_page/{id}', 'ChatController@add_task_page')->whereNumber('id')->middleware(['auth'])->name('add_task_page');

Route::post('/chat/add_task/{chat_id}', 'ChatController@add_task')->whereNumber('id')->middleware(['auth'])->name('add_task');


Route::get('/user', 'UserController@user')->middleware(['auth'])->name('user');

require __DIR__.'/auth.php';

Route::get('/user/{id}/edit', 'UserController@edit_user_data_page')->whereNumber('id')->middleware(['auth'])->name('edit_user_data_page');

Route::post('/user/{id}/edit', 'UserController@update_user_data')->whereNumber('id')->middleware(['auth'])->name('update_user_data');