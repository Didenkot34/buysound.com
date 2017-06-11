<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();
//
Route::resource('groups', 'Group\GroupController');
Route::post('groups-upload-files', 'Group\GroupController@uploadFiles');

Route::resource('songs', 'Song\SongController');
Route::post('songs-upload-files', 'Song\SongController@uploadFiles');