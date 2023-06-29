@extends('layout')

@section('head')
    <title>Chat</title>
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <script type="text/javascript" src="{{ asset('js/chat.js') }}" defer></script>
@endsection

@section('main_content')
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-12">
                <button class="btn btn-outline-primary" id="show_menu">{{ __('chat.Side menu') }}</i></button>
                <div class="card chat-app">
                    <div id="plist" class="people-list">
                        @if ($current_chat->creator_user_id == Auth::user()->id)
                            <form class="input-group" method="POST"
                                action="{{ route('chat.user.store', $current_chat->id) }}">
                                @csrf
                                <div class="input-group-prepend">
                                    <button class="input-group-text">
                                        <ion-icon class="add_user" name="person-add-outline"></ion-icon>
                                    </button>
                                </div>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="{{ __('chat.Add by username') }}">
                            </form>
                            <br>
                            <form class="input-group" method="POST"
                                action="{{ route('chat.user.destroy', $current_chat->id) }}">
                                @csrf
                                @method('DELETE')
                                <div class="input-group-prepend">
                                    <button class="input-group-text">
                                        <ion-icon class="delete" name="close-circle-outline"></ion-icon>
                                    </button>
                                </div>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="{{ __('chat.Delete by username') }}">
                            </form>
                        @endif
                        <ul class="list-unstyled chat-list mt-2 mb-0">
                            @foreach ($current_chat_users as $users)
                                <li class="clearfix">
                                    <a href="{{ route('user') }}"><img class="" src="{{ $users->profile_picture }}"
                                            alt="avatar"></a>
                                    <div class="about">
                                        <div class="username">{{ $users->username }}</div>
                                        @if ($users->is_online)
                                            <div class="status"> <i class="fa fa-circle online"></i>
                                                {{ __('user.online') }} </div>
                                        @else
                                            <div class="status"> <i class="fa fa-circle offline">
                                                </i> {{ $users->updated_at->diffForHumans() }} </div>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-6">
                                    <img src="{{ $current_chat->chat_picture }}" alt="avatar">
                                    </a>
                                    <div class="chat-about name">
                                        <h6 class="m-b-0">{{ $current_chat->name }}</h6>
                                    </div>
                                </div>
                                <div class="col-lg-6 hidden-sm text-right">
                                    <a href="{{ route('task_manager.index', $current_chat->id) }}"
                                        class="btn btn-outline-primary">{{ __('task_manager.Task manager') }}</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history" id="chat-history">
                            <ul class="m-b-0">
                                @foreach ($messages as $message)
                                    @if (Auth::user()->id == $message->sender_user_id)
                                        <li class="clearfix">
                                            <div class="message-data my-message-data">
                                                <span class="username">
                                                    {{ $message->user->username }}
                                                </span>
                                                <div class="my-message-data-container">
                                                    @if ($message->is_read == false)
                                                        <i class="fa fa-circle unread"></i>
                                                    @endif
                                                    <form method="POST" action="{{ route('chat.message.destroy') }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="message_id"
                                                            value="{{ $message->id }}">
                                                        <input type="hidden" name="current_chat_id"
                                                            value="{{ $current_chat->id }}">
                                                        <button class="clear-btn">
                                                            <ion-icon id="delete-message" class="delete-message"
                                                                name="trash-outline"></ion-icon>
                                                        </button>
                                                    </form>
                                                    <span class="message-data-time">{{ $message->created_at->diffForHumans() }}</span>
                                                    <a href="{{ route('user') }}"><img class="profile_picture"
                                                            src="{{ Auth::user()->profile_picture }}" alt="avatar"></a>
                                                </div>
                                            </div>
                                            <div class="message my-message float-right">{{ $message->content }}</div>
                                        </li>
                                    @else
                                        <li class="clearfix">
                                            <div class="message-data other-message-data">
                                                <span class="username">
                                                    {{ $message->user->username }}
                                                </span>
                                                <div class="other-message-data-container">
                                                    <a href="{{ route('user') }}"><img class="profile_picture"
                                                            src="{{ $message->user->profile_picture }}" alt="avatar"></a>
                                                    <span class="message-data-time">{{ $message->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                            <div class="message other-message">{{ $message->content }}</div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <form class="chat-message clearfix" id="chatForm" method="POST">
                            @csrf
                            <div class="input-group mb-0">
                                <div class="input-group-prepend">
                                    <button class="input-group-text"><i class="fa fa-send"></i></button>
                                </div>
                                <input type="text" class="form-control" name="user_message"
                                    placeholder="{{ __('chat.Enter text here...') }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
