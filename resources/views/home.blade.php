@extends('layout')

@section('head')
    <title>Home</title>
@endsection

@section('main_content')
    <div class="home">
        <div class="intro home__intro">
            <h1 class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">{{ __('home.Welcome') }}</h1>
            <div class="intro__info">
                <img src="img/chat.png">
                <div>{{ __('home.info-chat') }}</div>
            </div>
            <div class="intro__info">
                <div>{{ __('home.info-tasks') }}</div>
                <img src="img/tasks.png">
            </div>
            <div>{{ __('home.Source code') }}
                <a href="https://github.com/C0libry/Titanic">GitHub</a>
            </div>

            <a class="cta cta--home" href="{{ route('register') }}">{{ __('menu.Sign Up') }}</a>

            <div class="contacts">

                <div class="contacts__info">
                    <div class="contacts__info-block">
                        <ion-icon name="call-outline"></ion-icon>
                        <div class="contacts__info-text">+7 978 110 59 79</div>
                    </div>

                    <div class="contacts__info-block">
                        <ion-icon name="mail-outline"></ion-icon>
                        <div class="contacts__info-text">pe.pe.l@yandex.ru</div>
                    </div>
                </div>

                <div class="contacts__icons">
                    <a href="https://github.com/C0libry/"><ion-icon name="logo-github"></ion-icon></a>
                    <a href="https://vk.com/c0libry"><ion-icon name="logo-vk"></ion-icon></a>
                    <a href=""><ion-icon name="logo-linkedin"></ion-icon></a>
                </div>
            </div>
        </div>
    </div>
@endsection
