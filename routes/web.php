<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MainController@home')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/chat_list', 'ChatController@chat_list')->name('chat_list');

    Route::get('/add_chat', 'ChatController@add_chat_page')->name('add_chat_page');

    Route::post('/chat_list', 'ChatController@add_chat')->name('add_chat');

    Route::prefix('chat')->group(function () {
        Route::get('/{id}', 'ChatController@chat')->whereNumber('id')->name('chat');

        Route::post('/{id}', 'ChatController@add_message')->whereNumber('id')->name('add_message');

        Route::post('/add_user_to_chat/{id}', 'ChatController@add_user_to_chat')->whereNumber('id')->name('add_user_to_chat');

        Route::post('/delete_user_from_chat/{id}', 'ChatController@delete_user_from_chat')->whereNumber('id')->name('delete_user_from_chat');

        Route::get('/delete_chat/{id}', 'ChatController@delete_chat')->whereNumber('id')->name('delete_chat');

        Route::get('/leave_chat/{id}', 'ChatController@leave_chat')->whereNumber('id')->name('leave_chat');

        Route::get('/delet_chat_user/{id}', 'ChatController@delet_chat_user')->whereNumber('id')->name('delet_chat_user');

        Route::get('/task_manager/{id}', 'ChatController@task_manager')->whereNumber('id')->name('task_manager');

        Route::get('/add_task_page/{id}', 'ChatController@add_task_page')->whereNumber('id')->name('add_task_page');

        Route::post('/add_task/{chat_id}', 'ChatController@add_task')->whereNumber('chat_id')->name('add_task');

        Route::get('/done_task/{task_id}', 'ChatController@done_task')->whereNumber('task_id')->name('done_task');

        Route::get('/delete_task/{task_id}', 'ChatController@delete_task')->whereNumber('task_id')->name('delete_task');
    });

    Route::prefix('user')->group(function () {
        Route::get('/', 'UserController@user')->name('user');

        Route::get('/{id}/edit', 'UserController@edit_user_data_page')->whereNumber('id')->name('edit_user_data_page');

        Route::post('/{id}/edit', 'UserController@update_user_data')->whereNumber('id')->name('update_user_data');
    });
});

require __DIR__ . '/auth.php';
