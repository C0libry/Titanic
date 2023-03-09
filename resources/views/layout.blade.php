<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    @yield('head')
</head>
<body>
    <header>
        <a class="logo" href="/"><ion-icon name="planet-outline" alt="logo"></ion-icon></a>
        <nav>
            <ul class="nav__links">
                <li><a href="#">Services</a></li>
                <li><a href="#">Projects</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
            </ul>
        </nav>
        <a class="cta" href="{{ route('register') }}">Signup</a>
        <p class="menu cta">Menu</p>
    </header>

    <div class="overlay">
        <a class="close">&times;</a>
        <div class="overlay__content">
            <a href="#">Services</a>
            <a href="#">Projects</a>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Signup</a>
        </div>
    </div>

    @yield('main_content')
    <script type="text/javascript" src="js/mobile.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>