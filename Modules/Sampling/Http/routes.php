<?php

Route::group(['middleware' => 'api', 'prefix' => '', 'namespace' => 'Modules\Sampling\Http\Controllers'], function()
{
    Route::post('/artwork', 'ArtworkController@store');
});
