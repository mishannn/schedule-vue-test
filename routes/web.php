<?php

Route::get('/', 'MainController@home')->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', 'AdminController@index')->name('index');
});

Route::prefix('api')->group(function () {
    Route::prefix('subjects')->group(function () {
        Route::get('/', 'SubjectsController@getAll');
        Route::get('{id}', 'SubjectsController@get')->where('id', '\d+');
        Route::post('/', 'SubjectsController@add');
        Route::put('{id}', 'SubjectsController@edit')->where('id', '\d+');
        Route::delete('{id}', 'SubjectsController@delete')->where('id', '\d+');
    });

    Route::prefix('rooms')->group(function () {
        Route::get('/', 'RoomsController@getAll');
        Route::get('{id}', 'RoomsController@get')->where('id', '\d+');
        Route::post('/', 'RoomsController@add');
        Route::put('{id}', 'RoomsController@edit')->where('id', '\d+');
        Route::delete('{id}', 'RoomsController@delete')->where('id', '\d+');
    });

    Route::prefix('teachers')->group(function () {
        Route::get('/', 'TeachersController@getAll');
        Route::get('{id}', 'TeachersController@get')->where('id', '\d+');
        Route::post('/', 'TeachersController@add');
        Route::put('{id}', 'TeachersController@edit')->where('id', '\d+');
        Route::delete('{id}', 'TeachersController@delete')->where('id', '\d+');
    });

    Route::prefix('classes')->group(function () {
        Route::get('/', 'ClassesController@getAll');
        Route::get('{id}', 'ClassesController@get')->where('id', '\d+');
        Route::post('/', 'ClassesController@add');
        Route::put('{id}', 'ClassesController@edit')->where('id', '\d+');
        Route::delete('{id}', 'ClassesController@delete')->where('id', '\d+');
    });

    Route::prefix('schedule')->group(function () {
        Route::get('/', 'ScheduleController@schedule');
    });

    Route::any('{any}', 'MainController@apiAny')->where('any', '.*');
});

Route::any('{any}', 'MainController@any')->where('any', '.*');