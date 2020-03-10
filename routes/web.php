<?php
/**
 * For system. Only admin
 */
Route::group(['prefix' => 'sys', 'middleware' => 'basic-auth'], static function () {
});


/**
 * For static resources (img,style...)
 */
Route::group(['prefix' => 'static'], static function () {
    // fot test
    Route::get('test', 'TestController@index');

    Route::get('confirm/{key}', 'Api\Auth\ApiRegisterController@confirm')->name('register.confirm');
});
