<?php use \App\Models\User; ?>

@extends('layout')

@section('head')
  <title>Chat</title>
  <link rel="stylesheet" href="{{ asset('css/chat.css') }}"/>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
@endsection

@section('main_content')
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card chat-app">
                    <div id="plist" class="people-list">
                        @if($current_chat->creator_user_id == Auth::user()->id)
                            <form class="input-group" method="POST" action="{{ route('add_user_to_chat', $current_chat->id) }}">
                                @csrf
                                <div class="input-group-prepend">
                                    <button class="input-group-text"><ion-icon class="add_user" name="person-add-outline"></ion-icon></button>
                                </div>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Add by username">
                            </form>
                            <br>
                            <form class="input-group" method="POST" action="{{ route('delete_user_from_chat', $current_chat->id) }}">
                                @csrf
                                <div class="input-group-prepend">
                                    <button class="input-group-text"><ion-icon class="add_user" name="close-circle-outline"></ion-icon></button>
                                </div>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Add by username">
                            </form>
                        @endif
                        <ul class="list-unstyled chat-list mt-2 mb-0">
                            @foreach($current_chat_users as $element)
                                <li class="clearfix">
                                    <a href="{{ route('user') }}"><img class="" src = "{{$element->profile_picture}}" alt="avatar"></a>
                                    <div class="about">
                                        <div class="username">{{$element->username}}</div>
                                        @if($element->is_online)
                                            <div class="status"> <i class="fa fa-circle online"></i> online </div>
                                        @else
                                            <div class="status"> <i class="fa fa-circle offline">
                                            </i> {{$element->updated_at}} </div>
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
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                        <img src="{{ $current_chat->chat_picture }}" alt="avatar">
                                    </a>
                                    <div class="chat-about">
                                        <h6 class="m-b-0">{{ $current_chat->name }}</h6>
                                    </div>
                                </div>
                                <div class="col-lg-6 hidden-sm text-right">
                                    <a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="fa fa-camera"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-info"><i class="fa fa-cogs"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-warning"><i class="fa fa-question"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history">
                            <ul class="m-b-0">
                                @foreach($messages as $element)
                                    @if (Auth::user()->id == $element->sender_user_id)
                                        <li class="clearfix">
                                            <div class="message-data text-right my-message-data">
                                                <span class="message-data-time">{{ $element->created_at }}</span>
                                                <a href="{{ route('user') }}"><img class="profile_picture" src = "{{ Auth::user()->profile_picture }}" alt="avatar"></a>
                                            </div>
                                            <div class="message my-message float-right">
                                                @if ($element->is_read == false)
                                                    <i class="fa fa-circle unread"></i>
                                                @endif
                                                <div>{{ $element->content }}</div>
                                            </div>
                                        </li>
                                    @else
                                        <li class="clearfix">
                                            <div class="message-data other-message-data">
                                                <a href="{{ route('user') }}"><img class="profile_picture" src = "{{ (User::find($element->sender_user_id)->profile_picture) }}" alt="avatar"></a>
                                                <span class="message-data-time">{{ $element->created_at }}</span>
                                            </div>
                                            <div class="message other-message">{{ $element->content }}</div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <form class="chat-message clearfix" method="POST" action="{{ route('add_message', $current_chat->id) }}">
                            @csrf
                            <div class="input-group mb-0">
                                <div class="input-group-prepend">
                                    <button class="input-group-text"><i class="fa fa-send"></i></button>
                                </div>
                                <input type="text" class="form-control" name="user_message" placeholder="Enter text here...">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/chat.js') }}"></script>
@endsection