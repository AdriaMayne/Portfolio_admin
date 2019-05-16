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


Route::get('/user-new', 'UserController@store');
// LOGIN
Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/login', 'Auth\LoginController@login');

Route::group(['middleware' => ['auth']], function () {
    // LANDING
    Route::get('/', function () {
        return view('landing');
    });

    // LOGOUT
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
});
