<?php

Route::group(['middleware' => 'api', 'prefix' => '', 'namespace' => 'Modules\Sampling\Http\Controllers'], function()
{
    Route::get('/artwork', 'ArtworkController@index');
    Route::get('/artwork/{id}', 'ArtworkController@show');
    Route::post('/artwork', 'ArtworkController@store');
    Route::put('/artwork/{id}', 'ArtworkController@update');

    Route::post('/artwork/{artwork}/artwork_image', 'ArtworkImageController@store');
    Route::get('/artwork_image/{id}', 'ArtworkImageController@show');
});
