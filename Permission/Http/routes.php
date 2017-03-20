<?php

Route::group(['middleware' => 'web', 'prefix' => 'permission', 'namespace' => 'Modules\Permission\Http\Controllers'], function()
{
    Route::get('/', 'PermissionController@index');
    Route::get('/create','PermissionController@create');
    Route::post('/store','PermissionController@store');
    Route::get('/edit/{id}','PermissionController@edit');
    Route::post('/update/{id}','PermissionController@update');
    Route::get('/delete/{id}','PermissionController@destroy');
});
