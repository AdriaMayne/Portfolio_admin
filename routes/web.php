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

// ------------------------- PRUEBAS -------------------------

// ------------------------- PRUEBAS -------------------------



// ------------------------- PÚBLICO -------------------------
// LOGIN
Route::get('login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', 'Auth\LoginController@login');

// Vídeo
Route::get('/video', function () {
    return view('video');
});



// ------------------------- PRIVADO -------------------------
Route::group(['middleware' => ['auth']], function () {
    // LANDING -- Prueba
    Route::get('/', function () {
        return view('landing');
    });

    // LOGOUT
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

    // CRUDS -- Prueba
    Route::resource('/contacts', 'ContactController');
    Route::resource('/languages', 'LanguageController');
    Route::resource('/projects', 'ProjectController');
    Route::resource('/tags', 'TagController');
    Route::resource('/testimonials', 'TestimonialController');
});
