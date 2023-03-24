@extends('layout')

@section('head')
    <title>Chat list</title>
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
@endsection

@section('main_content')
<section class="vh-100" style="background-color: #eee;">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-4">
            @if (!$chats->isEmpty())
                <div class="card mb-4">
                    <div class="card-body">
                        @foreach($chats as $element)
                        <a href="{{ route('chat', $element->id) }}" class="row">
                            <div class="col-sm-3">
                                <img class="chat_picture" src="{{ $element->chat_picture }}" alt="avatar">
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $element->name }}</p>
                                <a class="d-flex justify-content-center ml-4 btn btn-primary btn-lg" href="{{ route('delete_chat', $element->id) }}">Delete chat</a>
                            </div>
                        </a>
                        <hr>
                        @endforeach
                    </div>
                </div>
            @endif
            <a class="d-flex justify-content-center ml-4 btn btn-primary btn-lg" href="{{ route('add_chat_page') }}">Create chat</a>
        </div>
    </div>
</section>
@endsection