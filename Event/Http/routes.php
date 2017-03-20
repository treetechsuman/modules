<?php

Route::group(['middleware' => 'web', 'prefix' => 'event', 'namespace' => 'Modules\Event\Http\Controllers'], function()
{
    Route::get('/view', 'EventController@index');
    Route::get('/create', 'EventController@create');
    Route::post('/store', 'EventController@store');
    Route::get('/edit/{id}', 'EventController@edit');
    Route::post('/update/{id}', 'EventController@update');
    Route::get('/delete/{id}', 'EventController@delete');
    Route::get('/single-view/{id}', 'EventController@single_view');


    Route::get('/add_participent/{event_id}/{client_id}', 'EventController@add_participent');
    Route::get('/delete_participent/{id}/{event_id}/{client_id}', 'EventController@delete_participent');
    Route::post('/store_participent', 'EventController@store_participent');
    
    Route::get('/add_form/{event_id}/{client_id}', 'EventController@add_form');
    Route::post('/assign_form', 'EventController@assign_form');
    Route::get('/delete_form/{id}', 'EventController@delete_form');
    Route::post('/change_status_of_assigned_form', 'EventController@change_status_of_assigned_form');

    Route::get('/add_image/{event_id}/{client_id}', 'EventController@add_image');
    Route::post('/store_image', 'EventController@store_image');
    Route::get('/delete_image/{id}/{event_id}/{client_id}', 'EventController@delete_image');
    Route::post('/change_status_of_image/{event_id}/{client_id}', 'EventController@change_status_of_image');


});
Route::group(['middleware' => 'web', 'prefix' => 'api/event', 'namespace' => 'Modules\Event\Http\Controllers'], function()
{
    Route::get('/{client_id}','ApiEventController@index');

});