<?php

Route::group(['middleware' => 'api', 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
    Route::post('/login', 'AuthenticationController@login');
    Route::get('/get_auth_user', 'AuthenticationController@getAuthenticatedUser')->middleware('jwt.auth');
    Route::post('/logout','AuthenticationController@logout')->middleware('jwt.auth');
});
