<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}
    @yield('head')
</head>

<body>
    @if (Auth::check())
        <header>
            <a class="logo" href="{{ route('home.index') }}">
                <ion-icon name="planet-outline" alt="logo"></ion-icon>
            </a>
            <nav>
                <ul class="nav__links">
                    <li><a href="{{ route('chat_list.index') }}">{{ __('menu.Chat list') }}</a></li>
                    <li><a href="{{ route('user') }}">{{ Auth::user()->username }}</a></li>
                    <li><a href="{{ route('set_locale', __('menu.set_locale')) }}">{{ __('menu.locale') }}</a></li>
                </ul>
            </nav>
            <li><a href="{{ route('user') }}"><img class="profile_picture" src="{{ Auth::user()->profile_picture }}"
                        alt="avatar"></a></li>
            <form class="cta" method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link class="logout" :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('menu.Log Out') }}
                </x-responsive-nav-link>
            </form>
            <p class="menu cta">{{ __('menu.Menu') }}</p>
        </header>

        <div class="overlay">
            <a class="close">
                <ion-icon class="close" name="close-outline">&times;</ion-icon>
            </a>
            <div class="overlay__content">
                <a href="{{ route('set_locale', __('menu.set_locale')) }}">{{ __('menu.locale') }}</a>
                <a href="{{ route('chat_list.index') }}">{{ __('menu.Chat list') }}</a>
                <a href="{{ route('user') }}">{{ Auth::user()->username }}</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('menu.Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    @else
        <header>
            <a class="logo" href="{{ route('home.index') }}">
                <ion-icon name="planet-outline" alt="logo"></ion-icon>
            </a>
            <nav>
                <ul class="nav__links">
                    <li><a href="{{ route('login') }}">{{ __('menu.Login') }}</a></li>
                    <li><a href="{{ route('set_locale', __('menu.set_locale')) }}">{{ __('menu.locale') }}</a></li>
                </ul>
            </nav>
            <a class="cta" href="{{ route('register') }}">{{ __('menu.Sign Up') }}</a>
            <p class="menu cta">{{ __('menu.Menu') }}</p>
        </header>

        <div class="overlay">
            <a class="close">
                <ion-icon class="close" name="close-outline">&times;</ion-icon>
            </a>
            <div class="overlay__content">
                <a href="{{ route('set_locale', __('menu.set_locale')) }}">{{ __('menu.locale') }}</a>
                <a href="{{ route('login') }}">{{ __('menu.Login') }}</a>
                <a href="{{ route('register') }}">{{ __('menu.Sign Up') }}</a>
            </div>
        </div>
    @endif

    @yield('main_content')
    <script type="text/javascript" src="{{ asset('js/mobile.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
