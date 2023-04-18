@extends('layout')

@section('head')
    <title>Chat list</title>
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
@endsection

@section('main_content')
    <section class="vh-100" style="background-color: #eee;">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-5">
                @if (!$chats->isEmpty())
                    <div class="card">
                        <div class="card-body">
                            @foreach ($chats as $element)
                                <div class="row mb-3">
                                    <a class="col-md-3 d-flex justify-content-center themed-grid-col"
                                        href="{{ route('chat', $element->id) }}"><img class="chat_picture"
                                            src="{{ $element->chat_picture }}" alt="avatar"></a>
                                    <a class="col-md-6 d-flex justify-content-center themed-grid-col"
                                        href="{{ route('chat', $element->id) }}">
                                        <p class="text-muted mb-0">{{ $element->name }}</p>
                                    </a>
                                    @if (Auth::user()->id == $element->creator_user_id)
                                        <div class="col-md-3 d-flex justify-content-center themed-grid-col"><a
                                                class=" ml-4 btn btn-primary btn-lg"
                                                href="{{ route('delete_chat', $element->id) }}">Delete chat</a></div>
                                    @else
                                        <div class="col-md-3 d-flex justify-content-center themed-grid-col"><a
                                                class=" ml-4 btn btn-primary btn-lg"
                                                href="{{ route('leave_chat', $element->id) }}">Leave chat</a></div>
                                    @endif
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                @endif
                <a class="d-flex justify-content-center ml-4 btn btn-primary btn-lg"
                    href="{{ route('add_chat_page') }}">Create chat</a>
            </div>
        </div>
    </section>
@endsection
