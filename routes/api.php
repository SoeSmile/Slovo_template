<?php
declare(strict_types=1);

Route::group(['namespace' => 'Api'], static function () {

    Route::apiResource('lang', 'ApiLangController')->only('index');

    Route::post('login', 'Auth\ApiAuthController@login')->name('auth.login');
    Route::post('register', 'Auth\ApiRegisterController@register')->name('auth.register');

    /**
     * Admin routers
     */
    Route::group(['middleware' => ['auth', 'is-admin']], static function () {
        // Journals
        Route::apiResource('journals', 'ApiJournalController')->only('index');

        // Roles
        Route::apiResource('roles', 'ApiRoleController')->only('index');

        // Users
        Route::post('users/approve', 'ApiUsersController@approve')->name('users.approve');

        // Subjects
        Route::apiResource('subjects', 'ApiSubjectController')->except('index', 'show');
    });

    /**
     * Auth Routers
     */
    Route::group(['middleware' => 'auth'], static function () {

        // Auth Route
        Route::post('logout', 'Auth\ApiAuthController@logout')->name('auth.logout');
        Route::post('refresh', 'Auth\ApiAuthController@refresh')->name('auth.refresh');
        Route::post('me', 'Auth\ApiAuthController@me')->name('auth.me');

        // Projects
        Route::apiResource('projects', 'ApiProjectController')->except('show');

        // Users
        Route::apiResource('users', 'ApiUsersController')->except('destroy');

        // Subjects
        Route::get('subjects', 'ApiSubjectController@index')->name('subjects.index');

        // Orders
        Route::get('orders', 'ApiOrderController@getTypeAndExecution')->name('orders.getTypeAndExecution');
    });
});
