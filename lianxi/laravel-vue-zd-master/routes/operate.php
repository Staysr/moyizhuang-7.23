<?php
/**
 * zdapp
 * operate.php.
 * @author luffyzhao@vip.126.com
 */


Route::post('token', 'TokenController@store');

Route::group([
    'middleware' => 'auth:api'
], function (){
    Route::get('driver/big', 'DriverController@big');
    Route::get('token', 'TokenController@show');
});

Route::group([], function (){
    Route::get('statistics', 'StatisticsController@index');
    Route::get('driver/small/{id}', 'DriverController@small');
    Route::get('driver', 'DriverController@index');

    Route::apiResource('map', 'MapController');

    Route::get('situation', 'SituationController@index');
    Route::get('situation/task', 'SituationController@task');

    Route::get('merchant', 'MerchantController@index');

    Route::get('task/{id}', 'TaskOrderController@show');
});