<?php

Route::group(['middleware' => 'api', 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
	//Users
    Route::get('', 'UserController@index');
    Route::post('','UserController@store')->middleware(['jwt.auth', 'permission:user-store']);

    //Permission
    Route::post('/permission/create', 'PermissionController@store')->middleware(['jwt.auth']);
    Route::get('/permission', 'PermissionController@index')->middleware(['jwt.auth']);

    Route::post('/login', 'AuthenticationController@login');
    Route::get('/get_auth_user', 'AuthenticationController@getAuthenticatedUser')->middleware('jwt.auth');
    Route::post('/logout','AuthenticationController@logout')->middleware('jwt.auth');
});
