<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

// Own imports
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {
        $identificador = $request->input('identificador');
        $password = $request->input('password');

        $usuario = User::where('username', $identificador)
                            ->orWhere('email', $identificador)
                            ->first();

        if ($usuario != null && Hash::check($password, $usuario->password)) {
            Auth::login($usuario);
            return redirect('/');
        } else {
            return redirect('/login')->withInput();
        }
    }

    public function logout() {
        Auth::logout();

        return redirect('/');
    }
}
