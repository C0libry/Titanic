<?php

use Illuminate\Support\Facades\Route;

Route::middleware('set_locale')->group(function () {
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::get('/set_locale/{locale}', 'LocaleController@set_locale')->name('set_locale');

    Route::middleware('auth')->group(function () {
        Route::prefix('chat_list')->group(function () {
            Route::get('/', 'ChatListController@index')->name('chat_list.index');

            Route::get('/chat_create', 'ChatListController@chat_create')->name('chat_list.chat.create');

            Route::post('/store', 'ChatListController@store')->name('chat_list.store');

            Route::delete('/delete_chat/{id}', 'ChatListController@destroy')->whereNumber('id')->name('chat_list.chat.destroy');

            Route::patch('/leave_chat/{id}', 'ChatListController@leave_chat')->whereNumber('id')->name('chat_list.chat.leave_chat');
        });

        Route::prefix('chat')->group(function () {
            Route::get('/{id}', 'ChatController@index')->whereNumber('id')->name('chat.index');

            Route::post('/{id}', 'MessageController@store')->whereNumber('id')->name('chat.message.store');

            Route::delete('/delete_message', 'MessageController@destroy')->name('chat.message.destroy');

            Route::post('/chat_user_store/{id}', 'ChatController@user_store')->whereNumber('id')->name('chat.user.store');

            Route::delete('/chat_user_destroy/{id}', 'ChatController@user_destroy')->whereNumber('id')->name('chat.user.destroy');

            Route::prefix('task_manager')->group(function () {
                Route::get('/{id}', 'TaskManagerController@index')->whereNumber('id')->name('task_manager.index');

                Route::prefix('task')->group(function () {
                    Route::get('/create/{id}', 'TaskController@create')->whereNumber('id')->name('task.create');

                    Route::post('/store/{chat_id}', 'TaskController@store')->whereNumber('chat_id')->name('task.store');

                    Route::delete('/delete_task/{task_id}', 'TaskController@destroy')->whereNumber('task_id')->name('task.destroy');

                    Route::delete('/done_task/{task_id}', 'TaskController@done_task')->whereNumber('task_id')->name('task.done_task');
                });
            });
        });

        Route::prefix('user')->group(function () {
            Route::get('/', 'UserController@index')->name('user');

            Route::get('/edit/{id}', 'UserController@edit')->whereNumber('id')->name('user.edit');

            Route::patch('/update/{id}', 'UserController@update')->whereNumber('id')->name('user.update');
        });
    });
});

require __DIR__ . '/auth.php';
