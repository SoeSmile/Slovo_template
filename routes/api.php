<?php

// todo remove only for test
Route::get('test','TestController@index');

Route::group(['namespace' => 'Api'], static function () {

    Route::apiResource('lang', 'ApiLangController')->only('index');

    Route::post('login', 'Auth\ApiAuthController@login')->name('api.auth.login');
    Route::post('register', 'Auth\ApiRegisterController@register')->name('api.auth.register');

    /**
     * Auth Routers
     */
    Route::group(['middleware' => 'auth'], static function () {

        // Auth Route
        Route::post('logout', 'Auth\ApiAuthController@logout')->name('api.auth.logout');
        Route::post('refresh', 'Auth\ApiAuthController@refresh')->name('api.auth.refresh');
        Route::post('me', 'Auth\ApiAuthController@me')->name('api.auth.me');

        // Projects
        Route::apiResource('projects', 'ApiProjectController')->only('index');
    });

});
