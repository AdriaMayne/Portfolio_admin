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

Route::get('projects', 'ProjectController@indexApi')->name('projects.index');
Route::get('languages', 'LanguageController@indexApi')->name('languages.index');
Route::get('testimonials', 'TestimonialController@indexApi')->name('testimonials.index');
// Route::apiResource('project', 'ProjectController');
