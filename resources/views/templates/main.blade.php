<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('media/img/logo.png') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('own_js_top')

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/solid.css" integrity="sha384-ioUrHig76ITq4aEJ67dHzTvqjsAP/7IzgwE7lgJcg2r7BRNGYSK0LwSmROzYtgzs" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('fonts/FontAwesome/fontawesome.css') }}">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
        @yield('own_css')
    </head>
    <body>
        <div id="mySidenav" class="sidenav">
            <a class="mb-5 text-center" href="{{ url('/') }}">
                <img src="{{ asset('media/img/logo_white.png') }}" alt="AdriaMayne Logo">
            </a>
            <a href="{{ url('/') }}"><i class="fas fa-home"></i> Landing</a>
            <a href="{{ url('/contacts') }}"><i class="fas fa-comments"></i> Contacto</a>
            <a href="{{ url('/languages') }}"><i class="fas fa-code"></i> Lenguajes</a>
            <a href="{{ url('/projects') }}"><i class="fas fa-briefcase"></i> Proyectos</a>
            <a href="{{ url('/tags') }}"><i class="fas fa-tag"></i> Tags</a>
            <a href="{{ url('/testimonials') }}"><i class="fas fa-quote-left"></i> Testimonials</a>
            <a class="signout" href="{{ url('/logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        <div id="app">
            <main class="py-2">
                <div class="container-fluid">
                    <a id="navController">
                        <span style="font-size:25px;cursor:pointer">&#9776;</span>
                    </a>
                </div>
                @yield('content')
            </main>
        </div>
    </body>
    <script src="{{ asset('js/sidebar.js') }}"></script>
</html>
