<!DOCTYPE html>
<html lang="{{ Config::get('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="Description" content="{{ __('master.web_description') }}">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        @yield('scripts_head')

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- FontAwesome -->
        <script src="{{ asset('libs/FontAwesome/all.js') }}"></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @if (Session::get('theme-dark'))
        <link rel="stylesheet" href="{{ asset('css/root-dark.css') }}">
        @else
            <link rel="stylesheet" href="{{ asset('css/root.css') }}">
        @endif
        @yield('own_css')
    </head>
    <body>
        <div id="app">
            @include('layouts.navbar')

            <main class="py-4">
                @yield('content')
            </main>
        </div>
        @yield('scripts_body')
    </body>
</html>
