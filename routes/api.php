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

Route::get('/news', 'Api\NewsController@getAll');
Route::get('/news/detail/{slug}', 'Api\NewsController@getBySlug');
Route::get('/news/category/{category}', 'Api\NewsController@getByCategory');

Route::get('/events', 'Api\EventController@getAll');
Route::get('/events/detail/{slug}', 'Api\EventController@getBySlug');
Route::get('/events/category/{category}', 'Api\EventController@getByCategory');

Route::post('register', 'Api\Auth\PassportController@register');
Route::post('login', 'Api\Auth\PassportController@login');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/events/join/{event}/{class}', 'Api\EventController@joinEvent');
});