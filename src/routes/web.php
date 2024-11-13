<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Sudip\LangMaker\Http\Controllers'], function () {

    $middlewareArr = is_array(config('lang-maker.middleware')) ? config('lang-maker.middleware') : [];
    $middlewares = array_merge(['web'], $middlewareArr);

    Route::group(['middleware' => $middlewares], function () {
        Route::get(config('lang-maker.route_prefix').'/{lang?}', 'LanguageController@index')->name(config('lang-maker.route_name'));
        Route::post(config('lang-maker.route_prefix').'/store', 'LanguageController@store')->name(config('lang-maker.route_name').'.store');
        Route::post(config('lang-maker.route_prefix').'/update/{lang}', 'LanguageController@update')->name(config('lang-maker.route_name').'.update');
    });
});
