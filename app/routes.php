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
    Route::get('changepass', 'ViewController@changePassword');
    Route::get('createproject', 'ViewController@createProject');
    Route::get('createuser', 'ViewController@createUser');
    Route::get('user', 'ViewController@someone');
    Route::get('userlist', 'ViewController@userList');
    Route::get('evaluate', 'ViewController@evaluate');

    Route::post('evaluate/create', 'EvaluationController@create');
    Route::post('project/create', 'ProjectController@create');
    Route::get('logout', 'UserController@logout');
    Route::post('user/create', 'UserController@create');
    Route::post('user/update', 'UserController@update');
   
    Route::post('upload/only', 'UploadController@upload_only');
    Route::post('upload/process', 'UploadController@upload_and_process');
    
    Route::get('download/only', 'DownloadController@download_only');
    Route::get('download/process', 'DownloadController@download_and_process');

    Route::post('file/delete', 'UploadController@delete');
    Route::post('user/delete', 'UserController@delete');
    
    Route::post('user/password/change', 'UserController@changePassword');
    Route::post('user/password/reset', 'UserController@resetPassword');
});

Route::get('login', 'UserController@loginView');
Route::get('login/check', 'UserController@login');
Route::get('statusinfo/get','StatusInfoController@get');
Route::get('constant/get','ConstantController@get');
Route::get('/hello', function() {
    return View::make('hello');
});
