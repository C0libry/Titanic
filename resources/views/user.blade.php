@extends('layout')

@section('head')
    <title>User</title>
@endsection

@section('main_content')
    <section class="vh-100" style="background-color: #eee;">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-3">
                <div class="card mb-4 d-flex justify-content-center">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3 d-flex justify-content-center">
                                <p class="mb-0">{{ __('user.ID') }}</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 d-flex justify-content-center">{{ Auth::user()->id }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3 d-flex justify-content-center">
                                <p class="mb-0">{{ __('user.Full Name') }}</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 d-flex justify-content-center">{{ Auth::user()->name }}
                                    {{ Auth::user()->surname }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3 d-flex justify-content-center">
                                <p class="mb-0 d-flex justify-content-center">{{ __('user.Username') }}</p>
                            </div>
                            <div class="col-sm-9 d-flex justify-content-center">
                                <p class="text-muted mb-0">{{ Auth::user()->username }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3 d-flex justify-content-center">
                                <p class="mb-0">{{ __('user.Email') }}</p>
                            </div>
                            <div class="col-sm-9 d-flex justify-content-center">
                                <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="d-flex justify-content-center ml-4 btn btn-primary btn-lg"
                    href="{{ route('user.edit', Auth::user()->id) }}">{{ __('user.Edit') }}</a>
            </div>
        </div>
    </section>
@endsection
