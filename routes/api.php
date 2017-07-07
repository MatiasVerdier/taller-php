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

Route::get('/resources', 'ResourceController@index');
Route::post('/resources', 'ResourceController@store');
Route::get('/resources/{resource}', 'ResourceController@show');
Route::put('/resources/{resource}', 'ResourceController@update');
Route::delete('/resources/{resource}', 'ResourceController@destroy');

Route::put('/resources/metadata/{resource}', 'ResourceController@updateMetadata');

/*
Notes endpoints
*/

Route::get('/resources/{resource}/notes', 'NoteController@index');
Route::post('/resources/{resource}/notes', 'NoteController@store');
Route::get('/resources/{resource}/notes/{note}', 'NoteController@show');
Route::put('/resources/{resource}/notes/{note}', 'NoteController@update');
Route::delete('/resources/{resource}/notes/{note}', 'NoteController@destroy');

/*
Authentication endpoints
*/

Route::post('/register', 'JWTController@register');
Route::post('/login', 'JWTController@login');
Route::post('/logout', 'JWTController@logout');
Route::get('/me', 'JWTController@getUser');

/*
Users endpoints
*/

Route::get('/profile', 'UserController@profile');
Route::get('/users/{user}/resources', 'UserController@resources');
Route::get('/users/{user}/info', 'UserController@userInfo');


/*
Followers endpoints
*/


// Follow user
Route::post('/following/add', 'UserController@follow');

// Unfollow user
Route::post('/following/remove', 'UserController@unfollow');
