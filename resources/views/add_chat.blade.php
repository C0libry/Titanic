@extends('layout')

@section('head')
    <title>Create chat</title>
@endsection

@section('main_content')
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">
                                        {{ __('add_chat.Create chat') }}</p>

                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4 error" :errors="$errors" />

                                    <form class="mx-1 mx-md-4" method="POST" action="{{ route('add_chat') }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input id="name" class="form-control block mt-1 w-full" type="text"
                                                    name="name" :value="old('name')" required autofocus />
                                                <label class="form-label">{{ __('add_chat.Сhat name') }}</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="file" class="form-control block mt-1 w-full"
                                                    id="chat_picture" name="chat_picture">
                                                <label class="form-label">{{ __('add_chat.Сhat picture') }}</label>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <div class="flex items-center justify-end mt-4">
                                                <button class="ml-4 btn btn-primary btn-lg">
                                                    {{ __('add_chat.Create chat') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
