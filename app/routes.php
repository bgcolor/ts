<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('before' => 'signed'), function () {
    
    Route::get('/', 'ViewController@index');

    Route::post('project/create', 'ProjectController@create');
    Route::get('logout', 'UserController@logout');
    Route::post('user/create', 'UserController@create');
    Route::get('user/password/change', 'UserController@changePassword');
});

Route::get('login', 'UserController@loginView');
Route::get('login/check', 'UserController@login');
Route::get('/hello', function() {
    return View::make('hello');
});
