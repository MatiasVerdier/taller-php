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

Route::post('/register', 'JWTController@register');
Route::post('/login', 'JWTController@login');
Route::post('/logout', 'JWTController@logout');

Route::get('/me', 'JWTController@getUser');
Route::get('/profile', 'UserController@profile');

Route::get('/user/{user}/resources', 'UserController@resources');


/*
Followers endpoints
*/


// Follow user
Route::post('/following/add', 'UserController@follow');

// Unfollow user
Route::post('/following/remove', 'UserController@unfollow');
