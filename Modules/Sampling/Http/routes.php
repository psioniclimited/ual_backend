<?php

Route::group(['middleware' => 'api', 'prefix' => '', 'namespace' => 'Modules\Sampling\Http\Controllers'], function()
{
    Route::post('/artwork', 'ArtworkController@store');
    Route::post('/artwork/{artwork}/artwork_image', 'ArtworkImageController@store');
});
