@extends('layout')

@section('head')
    <title>Register</title>
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

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">{{ __('menu.Register') }}</p>

                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4 error" :errors="$errors" />

                                    <form class="mx-1 mx-md-4" method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input id="name" class="form-control block mt-1 w-full" type="text"
                                                    name="name" :value="old('name')" required autofocus />
                                                <label class="form-label">{{ __('user.Name') }}</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input id="surname" class="form-control block mt-1 w-full" type="text"
                                                    name="surname" :value="old('surname')" required autofocus />
                                                <label class="form-label">{{ __('user.Surname') }}</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input id="username" class="form-control block mt-1 w-full" type="text"
                                                    name="username" :value="old('username')" required autofocus />
                                                <label class="form-label">{{ __('user.Username') }}</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input id="email" class="form-control block mt-1 w-full" type="email"
                                                    name="email" :value="old('email')" required />
                                                <label class="form-label">{{ __('user.Email') }}</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input id="password" class="form-control block mt-1 w-full" type="password"
                                                    name="password" required autocomplete="new-password" />
                                                <label class="form-label">{{ __('user.Password') }}</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input id="password_confirmation" class="form-control block mt-1 w-full"
                                                    type="password" name="password_confirmation" required />
                                                <label class="form-label">{{ __('register.Repeat your password') }}</label>
                                            </div>
                                        </div>

                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <input class="form-check-input me-2" type="checkbox" value=""
                                                id="form2Example3c" />
                                            <label class="form-check-label">
                                                {{ __('register.I agree all statements in') }} <a
                                                    href="#!">{{ __('register.Terms of service') }}</a>
                                            </label>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <div class="flex items-center justify-end mt-4">
                                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                                    href="{{ route('login') }}">
                                                    {{ __('register.Already registered?') }}
                                                </a><br><br>

                                                <button class="ml-4 btn btn-primary btn-lg">
                                                    {{ __('menu.Register') }}
                                                </button>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                        class="img-fluid" alt="Sample image">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
