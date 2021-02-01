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

// Authentication Routes
Auth::routes();

// Site Routes
Route::group(['middleware' => 'web', 'as' => 'site.'], function() {

    Route::get('/', 'PageController@pageHome')->name('home');
    Route::get('adhd', 'PageController@pageADHD')->name('adhd');
    Route::get('test', 'PageController@pageTest')->name('test');
    Route::get('about', 'PageController@pageAbout')->name('about');

    Route::get('news', 'PageController@pageNews')->name('news');
    Route::get('news/detail/{slug}', 'PageController@pageNewsDetail')->name('news_detail');
    Route::get('news/category/{category}', 'PageController@pageNewsCategory')->name('news_category');

    Route::get('events', 'PageController@pageEvents')->name('event');
    Route::get('events/detail/{slug}', 'PageController@pageEventDetail')->name('event_detail');
    Route::get('events/category/{category}', 'PageController@pageEventCategory')->name('event_category');
    Route::post('events/join/{event}/{class}', 'EventController@joinEvent')->name('event_join');

});

// Backend Routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'backend', 'as' => 'backend.'], function() {

    Route::get('/', 'PageController@pageBackend')->name('dashboard');
    Route::resource('users', 'UserController');

    Route::resource('news', 'NewsController');
    Route::resource('news_categories', 'NewsCategoryController');

    Route::resource('events', 'EventController');
    Route::resource('event_classes', 'EventClassController');
    Route::resource('event_categories', 'EventCategoryController');

});
