<?php

use App\Http\Controllers\Api\PointController;
use Illuminate\Http\Request;
use luffyzhao\laravelTools\Sign\SignManager;
use Illuminate\Support\Facades\Log as Log;
use Illuminate\Support\Facades\Route;


Route::get('merchants/select', 'MerchantController@select');
Route::get('category/checkbox', 'CategoryController@checkbox');
Route::get('company/select', 'CompanyController@select');
Route::get('cartype/select', 'CarTypeController@select');
Route::get('admin/select', 'AdminController@select');
Route::get('driver/select', 'DriverController@select');
Route::get('task/select', 'TaskController@select');
Route::get('role/select', 'RoleController@select');
Route::get('warehouse/select', 'WarehouseController@select');
Route::get('safe/select', 'SafeController@select');
Route::get('order/select', 'OrderController@select');

Route::get('driver/lists', 'DriverController@lists');

Route::group(
    [
        'middleware' => ['auth:api'],
    ],
    function ($router) {
        // 当前用户的权限
        Route::get('token/permission', 'TokenController@permission')->name(
            'token.permission'
        );
        // 权限管理
        Route::apiResource('permission', 'PermissionController');
        // 角色管理
        Route::get('role/{id}/category', 'RoleController@category')->name(
            'role.category'
        );
        Route::get('role/{id}/permission', 'RoleController@permission')->name(
            'role.permission'
        );
        Route::post(
            'role/{id}/assignpermissions',
            'RoleController@assignPermissions'
        )->name('role.assignpermissions');
        Route::apiResource('role', 'RoleController');
        // 用户管理
        Route::apiResource('admin', 'AdminController');
        // 系统配置
        Route::get('config/index', 'ConfigController@index')->name(
            'config.index'
        );
        Route::put('config/update', 'ConfigController@update')->name(
            'config.update'
        );
        // 保险设置
        Route::get('safe/index', 'SafeController@index')->name('safe.index');
        Route::get('safe/{id}', 'SafeController@show')->name('safe.show');
        Route::post('safe/store', 'SafeController@store')->name('safe.store');
        Route::put('safe/{id}/status', 'SafeController@cutoverStatus')->name(
            'safe.status'
        );
        // 仓库
        Route::get('warehouse/export', 'WarehouseController@export');
        Route::resource(
            'warehouse',
            'WarehouseController',
            ['only' => ['show', 'index', 'store', 'update', 'destroy']]
        );
        Route::put('warehouse/toggle/{id}', 'WarehouseController@toggle');
        // 司机
        Route::get('driver/index', 'DriverController@index')->name(
            'driver.index'
        );
        Route::get('driver/work', 'DriverController@work')->name('driver.work');
        Route::get('driver/social', 'DriverController@social')->name(
            'driver.social'
        );
        Route::get('driver/index/{id}', 'DriverController@show')->name(
            'driver.index.show'
        );
        Route::get('driver/work/{id}', 'DriverController@show')->name(
            'driver.work.show'
        );
        Route::get('driver/social/{id}', 'DriverController@show')->name(
            'driver.social.show'
        );
        Route::get('driver/export/{type}', 'DriverController@export');
        //车辆
        Route::get('car/index', 'CarController@index');
        Route::get('car/export', 'CarController@export');
        //商户
        Route::get('merchants/export', 'MerchantController@export');
        
        Route::resource(
            'merchants',
            'MerchantController',
            ['only' => ['show', 'index', 'store', 'update', 'destroy']]
        );
        Route::put('merchants/toggle/{id}', 'MerchantController@toggle');
        //出车单
        Route::get('order/export', 'OrderController@export');
        Route::resource(
            'order',
            'OrderController',
            ['only' => ['show', 'index', 'store', 'update', 'destroy']]
        );
        Route::get('order/search', 'OrderController@search');
        Route::put('order/undo/{id}', 'OrderController@undo');
        Route::put('order/sent/{id}', 'OrderController@sent');
        Route::put('order/cancel/{id}', 'OrderController@cancel');
        Route::put('order/agent/{id}', 'OrderController@agent');
        Route::put('order/finish/{id}', 'OrderController@finish');
        Route::put('order/change/{id}', 'OrderController@change');
        //商户账单
        Route::get('bill/month', 'BillController@month')->name('bill.month');
        Route::get('bill/day', 'BillController@day')->name('bill.day');
        Route::get('bill/log', 'BillController@log')->name('bill.log');
        Route::put('bill/repay/{id}', 'BillController@repay')->name('bill.repay');
        Route::get('bill/total/{id}', 'BillController@total')->name('bill.total');
        Route::get('bill/export', 'BillController@export')->name('bill.export');
        Route::get('bill/download', 'BillController@download')->name('bill.download');
        Route::get('bill/statistics', 'BillController@statistics')->name('bill.statistics');
        Route::get('bill/analysis', 'BillController@analysis')->name('bill.analysis');


        //司机帐号
        Route::get('account/driver', 'DriverAccountController@driver')->name('account.driver');
        Route::get('account/driver/{id}', 'DriverAccountController@single')->name('account.driver.single');
        Route::get('account/driver/statistics/{id}', 'DriverAccountController@statistics')->name('account.driver.statistics');
        Route::get('account/export', 'DriverAccountController@export')->name('account.driver.export');
        Route::get('account/export/{id}', 'DriverAccountController@download')->name('account.driver.download');
        //商户帐号
        Route::get('account/merchant', 'MerchantAccountController@merchant')->name('account.merchant');
        Route::get('account/merchant/{id}', 'MerchantAccountController@single')->name('account.merchant.single');
        Route::get('account/merchant/statistics/{id}', 'MerchantAccountController@statistics')->name('account.merchant.statistics');
        Route::get('account/download', 'MerchantAccountController@export')->name('account.merchant.export');
        Route::get('account/download/{id}', 'MerchantAccountController@download')->name('account.merchant.download');
        //任务
        Route::get('task', 'TaskController@index')->name('task.index');
        Route::get('task/{id}', 'TaskController@show')->name('task.show');
        Route::get('task/copy/{id}', 'TaskController@copy')->name('task.copy');
        Route::put('task/delete/{id}', 'TaskController@delete')->name('task.delete');
        Route::put('task/abandon/{id}', 'TaskController@abandon')->name('task.abandon');
        Route::put('task/none/{id}', 'TaskController@none')->name('task.none');
        Route::put('task/choose/{id}', 'TaskController@choose')->name('task.choose');
        Route::put('task/safe/{id}', 'TaskController@safe')->name('task.safe');
        Route::put('task/rescind/{id}', 'TaskController@rescind')->name('task.rescind');
        Route::put('task/assigned/{id}', 'TaskController@assigned')->name('task.assigned');
        Route::post('task/create', 'TaskController@create')->name('task.create');
        Route::put('task/change/{id}', 'TaskController@change')->name('task.change');
        Route::put('task/toggle/{id}', 'TaskController@toggle')->name('task.toggle');
        Route::get('task/offer/{id}', 'TaskController@offer')->name('task.offer');
        Route::get('task/driver/{id}', 'TaskController@driver')->name('task.driver');
        Route::get('index/index', 'IndexController@index')->name('index.index');

        //配送点列表
        Route::get('time', 'TimeController@index')->name('time.index');
        Route::post('time/import', 'TimeController@import')->name('time.import');
        Route::post('time/change/{id}', 'TimeController@change')->name('time.change');
        Route::get('time/template', 'TimeController@template')->name('time.template');

        //配送点路线
        Route::get('point/{id}', 'PointController@index')->name('point.index');
        Route::get('point/show/{id}', 'PointController@show')->name('point.show');
        Route::delete('point/{id}', 'PointController@delete')->name('point.delete');
        Route::put('point/{id}', 'PointController@update')->name('point.update');
        Route::get('point/line/{id}', 'PointController@line')->name('point.line');
        Route::get('point/taskline/{id}', 'PointController@taskline')->name('point.taskline');
        Route::get('point/tasklinepoint/{id}', 'PointController@tasklinepoint')->name('point.tasklinepoint');
        Route::get('point/export/{id}', 'PointController@export')->name('point.export');
        Route::get('point/download/{id}', 'PointController@download')->name('point.download');

        Route::get('line/{id}', 'LineController@index')->name('line.index');

        //配送点
        Route::post('order/point/{id}', 'OrderController@point');
        Route::delete('order/point/{id}', 'OrderController@delete');
        Route::post('order/notify/{id}', 'OrderController@notify');

        //合同
        Route::get('contract/{id}', 'ContractController@show')->name('contract.show');
        Route::post('contract/upload', 'ContractController@upload')->name('contract.upload');
        Route::put('contract/{id}', 'ContractController@update')->name('contract.update');

        //司机奖惩
        Route::get('award/export', 'AwardController@export')->name('award.export');
        Route::resource(
            'award',
            'AwardController',
            ['only' => ['show','index', 'store', 'update', 'destroy']]
        );

    }
);

// 忘记密码
Route::post('token/sms', 'TokenController@sms');
Route::put('token/forget', 'TokenController@forget');
Route::apiResource('token', 'TokenController');
