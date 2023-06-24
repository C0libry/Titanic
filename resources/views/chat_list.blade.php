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
                                        href="{{ route('chat.index', $element->id) }}"><img class="chat_picture"
                                            src="{{ $element->chat_picture }}" alt="avatar"></a>
                                    <a class="col-md-6 d-flex justify-content-center themed-grid-col"
                                        href="{{ route('chat.index', $element->id) }}">
                                        <p class="text-muted mb-0">{{ $element->name }}</p>
                                    </a>
                                    @if (Auth::user()->id == $element->creator_user_id)
                                        <form class="col-md-3 d-flex justify-content-center themed-grid-col" method="POST"
                                            action="{{ route('chat_list.chat.destroy', $element->id) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class=" ml-4 btn btn-primary btn-lg">
                                                {{ __('chat_list.Delete chat') }}
                                            </button>
                                        </form>
                                    @else
                                        <form class="col-md-3 d-flex justify-content-center themed-grid-col" method="POST"
                                            action="{{ route('chat_list.chat.leave_chat', $element->id) }}">
                                            @csrf
                                            @method('PATCH')

                                            <button class=" ml-4 btn btn-primary btn-lg">
                                                {{ __('chat_list.Leave chat') }}
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                @endif
                <a class="d-flex justify-content-center ml-4 btn btn-primary btn-lg"
                    href="{{ route('chat_list.chat.create') }}">{{ __('chat_list.Create chat') }}</a>
            </div>
        </div>
    </section>
@endsection
