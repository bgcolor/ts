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
    Route::get('download', 'ViewController@download');
    Route::get('upload', 'ViewController@upload');

    Route::post('project/create', 'ProjectController@create');
    Route::get('logout', 'UserController@logout');
    Route::post('user/create', 'UserController@create');
    Route::post('user/update', 'UserController@update');
   
    Route::post('upload/only', 'UploadController@upload_only');
    Route::post('upload/process', 'UploadController@upload_and_process');
    
    Route::get('download/only', 'DownloadController@download_only');
    Route::get('download/process', 'DownloadController@download_and_process');

    Route::post('file/delete', 'UploadController@delete');
    
    Route::get('user/password/change', 'UserController@changePassword');
});

Route::get('login', 'UserController@loginView');
Route::get('login/check', 'UserController@login');
Route::get('statusinfo/get','StatusInfoController@get');
Route::get('constant/get','ConstantController@get');
Route::get('/hello', function() {
    return View::make('hello');
});
