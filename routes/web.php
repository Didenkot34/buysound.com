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
    return view('app');
});

Auth::routes();
//
Route::get('/api/groups', 'Group\GroupController@getAll');
Route::post('/api/groups', 'Group\GroupController@save');
Route::delete('/api/groups/{id}', 'Group\GroupController@deleteGroups');
Route::post('/api/upload-group-img', 'Group\GroupController@uploadImg');
