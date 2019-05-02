<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

// Logout
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

// Language change
Route::get('language/{locale}', function ($locale) {
    if (in_array($locale, \Config::get('app.locales'))) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
});

// Theme change
Route::get('toggler/{theme}', function ($theme) {
    if ($theme == "dark") {
        Session::put('theme-dark', true);
    } else {
        Session::put('theme-dark', false);
    }
    return redirect()->back();
});


// ------------------------------------ AUTOMATIC URLs ------------------------------------

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
