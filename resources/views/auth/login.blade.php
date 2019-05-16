<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>LOGIN - AdriaMayne</title>

        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('media/img/logo.png') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container h-100">
            <div class="row align-items-center h-100">
                <div class="col-md-6 mx-auto">
                    <div class="card bg-transparent border-light">
                        <img class="mb-4 mx-auto" src="{{ asset('media/img/logo.png')}}" alt="AdriaMayne Logo">
                        <h2 class="text-center mb-0">LOGIN</h2>
                        <div class="card-body">
                            <form method="POST" action="{{ action('Auth\LoginController@login') }}">
                                @csrf
                                <div class="form-group col-lg-11 mx-auto">
                                    <label for="email" class="col-form-label">{{ __('Username') }}</label>
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="identificador" value="{{ old('email') }}" placeholder="{{ __('Username or email') }}" autocomplete="email" autofocus required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-11 mx-auto">
                                    <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" autocomplete="current-password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group row mb-0">
                                    <button type="submit" class="btn col-10 col-lg-8 mx-auto">
                                        {{ __('Login') }}
                                    </button>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
