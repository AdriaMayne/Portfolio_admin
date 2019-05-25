<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// --- OLD ---
// Route::get('project', 'ProjectController@indexApi')->name('project.index');
// Route::get('language', 'LanguageController@indexApi')->name('language.index');
// Route::get('testimonial', 'TestimonialController@indexApi')->name('testimonial.index');
// Route::post('contact', 'ContactController@storeApi')->name('contact.store');

Route::middleware('cors')->get('project', 'ProjectController@indexApi')->name('project.index');
Route::middleware('cors')->get('language', 'LanguageController@indexApi')->name('language.index');
Route::middleware('cors')->get('testimonial', 'TestimonialController@indexApi')->name('testimonial.index');
Route::middleware('cors')->post('contact', 'ContactController@storeApi')->name('contact.store');
