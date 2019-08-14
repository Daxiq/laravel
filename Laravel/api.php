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

/*
|--------------------------------------------------------------------------
| Postman Routes
|--------------------------------------------------------------------------
*/
// Events
Route::get('/events', 'EventController@index');
Route::get('/event/{id}', 'EventController@show');
Route::post('/event', 'EventController@store');
Route::put('/event/{id}', 'EventController@update');
Route::delete('/event/{id}', 'EventController@destroy');

// Session
Route::get('/sessions/{id}', 'SessionController@index');
Route::get('/session/{id}', 'SessionController@show');
Route::post('/session', 'SessionController@store');
Route::put('/session/{id}', 'SessionController@update');
Route::delete('/session/{id}', 'SessionController@destroy');

// Registrations
Route::get('/registrations/{id}', 'RegistrationController@index');
Route::get('/registration/{id}', 'RegistrationController@show');
Route::post('/registration', 'RegistrationController@store');
Route::put('/registration/{id}', 'RegistrationController@update');
Route::delete('/registration/{id}', 'RegistrationController@destroy');

// Events
Route::get('/events', 'EventController@index');
Route::get('/event/{id}', 'EventController@show');
Route::post('/event', 'EventController@store');
Route::put('/event/{id}', 'EventController@update');
Route::delete('/event/{id}', 'EventController@destroy');