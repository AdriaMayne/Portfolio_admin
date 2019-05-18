<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Landing - AdriaMayne</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('media/img/logo.png') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>

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
            <a href="{{ url('/contacts') }}"><i class="fas fa-envelope"></i> Contacto</a>
            <a href="{{ url('/languages') }}"><i class="fas fa-code"></i> Lenguajes</a>
            <a href="{{ url('/projects') }}"><i class="fas fa-briefcase"></i> Proyectos</a>
            <a href="{{ url('/tags') }}"><i class="fas fa-tag"></i> Tags</a>
            <a href="{{ url('/testimonials') }}"><i class="fas fa-comments"></i> Testimonials</a>
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


{{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav> --}}
