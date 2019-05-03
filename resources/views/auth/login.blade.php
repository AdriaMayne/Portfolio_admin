<!DOCTYPE html>
<html lang="{{ Config::get('app.locale') }}">
    <head>
        <title>Admin Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/png" href="{{ asset('img/favicon.ico') }}"/>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- FontAwesome -->
        <script src="{{ asset('libs/FontAwesome/all.js') }}"></script>

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/login/main.css') }}">

        {{-- <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css"> --}}
        {{-- <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css"> --}}

        {{-- <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
        <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
        <link rel="stylesheet" type="text/css" href="css/util.css">--}}
    <!--===============================================================================================-->
    </head>
    <body class="w-100 my-0 mx-auto">
        <div class="container-login w-100 d-flex flex-wrap justify-content-center position-relative align-items-center" style="background-image: url('{{ asset('img/login-background.jpg') }}');">
            <div class="wrap-login overflow-hidden">
                <form class="w-100 validate-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <span class="login-form-logo bg-white my-0 mx-auto rounded-circle d-flex align-items-center">
                        <i class="fas fa-crown"></i>
                    </span>
                    <span class="login-form-title d-block text-center text-white text-uppercase my-4">{{ __('login.title') }}</span>
                    <div class="wrap-input">
                        <input id="username" type="text" class="input text-white d-block w-100 bg-transparent" name="identificador" value="{{ old('email') }}" placeholder="{{ __('login.username') }}" autocomplete="username" autofocus required>
                        <span class="focus-input d-block w-100 h-100 position-absolute"></span>
                    </div>
                    <div class="wrap-input">
                        <input id="password" type="password" class="input text-white d-block w-100 bg-transparent" name="password" placeholder="{{ __('login.password') }}" required>
                        <span class="focus-input d-block w-100 h-100 position-absolute"></span>
                    </div>
                    <div class="form-checkbox">
                        <input class="input-checkbox d-none" id="remember-checkbox" type="checkbox" name="remember-me">
                        <label class="label-checkbox" for="remember-checkbox">
                            {{ __('login.remember') }}
                        </label>
                    </div>
                    <div class="container-login-form-btn w-100 d-flex flex-wrap justify-content-center">
                        <button class="login-form-btn">{{ __('login.login_btn') }}</button>
                    </div>
                    {{-- <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div> --}}
                </form>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        {{-- <script src="vendor/select2/select2.min.js"></script> --}}
        <script src="{{ asset('libs/tilt/tilt.jquery.min.js') }}"></script>
        <script>
            $('.js-tilt').tilt({
                scale: 1.1
            })
        </script>
        <script src="{{ asset('js/events/login.js') }}"></script>
    </body>
</html>
