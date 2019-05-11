<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(
    ['middleware' => 'sign:api'],
    function ($router) {
        Route::get('token/version', 'TokenController@version')->name('token.version');
        Route::post('token/login', 'TokenController@login')->name('token.create');
        Route::post('user/sms', 'UserController@sms')->name('user.sms');
        Route::put('user/forget', 'UserController@forget')->name('user.forget');
        Route::group(
            [
                'middleware' => ['auth:merchant'],
            ],
            function ($router) {
                // 需要验证登录的接口写在这里
                Route::get('token/logout', 'TokenController@logout')->name('token.logout');
                Route::get('token/refresh', 'TokenController@refresh')->name('token.refresh');
                Route::get('token/me', 'TokenController@me')->name('token.me');
                Route::get('user/profile', 'UserController@profile')->name('user.profile');
                Route::get('task/index', 'TaskController@index')->name('task.index');
                Route::get('task/search', 'TaskController@search')->name('task.search');
                Route::get('task/offer/{id}', 'TaskController@offer')->name('task.offer');
                Route::get('task/driver/{id}', 'TaskController@driver')->name('task.driver');
                Route::get('task/detail/{id}', 'TaskController@detail')->name('task.detail');
                Route::post('task/create', 'TaskController@create')->name('task.create');
                Route::get('task/count', 'TaskController@count')->name('task.count');
                Route::get('order/index', 'OrderController@index')->name('order.index');
                Route::get('order/delivery/{id}', 'OrderController@delivery')->name('order.delivery');
                Route::resource('warehouse', 'WarehouseController', ['only' => ['show', 'index', 'store', 'update','destroy']]);
                Route::get('bill/month', 'BillController@month')->name('bill.month');
                Route::get('bill/day', 'BillController@day')->name('bill.day');
                Route::get('bill/log', 'BillController@log')->name('bill.log');
                Route::get('bill/me', 'BillController@center')->name('bill.center');
                Route::get('cartype/index', 'CarTypeController@index')->name('cartype.index');
                Route::get('area/index', 'AreaController@index')->name('area.index');
                Route::get('user/detail', 'UserController@detail')->name('merchant.detail');
                Route::get('user/info', 'UserController@info')->name('merchant.info');
                Route::post('user/feedback', 'UserController@feedback')->name('user.feedback');

            }
        );

    }
);

Route::get('h5/{title}','AboutController@index')->name('about.index');






