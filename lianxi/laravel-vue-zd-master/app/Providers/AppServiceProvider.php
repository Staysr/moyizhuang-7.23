<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Validator as BaseValidator;
use App\Validation\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        BaseValidator::resolver(function($translator, $data, $rules, $messages,$customAttributes)
        {
            return new Validator($translator, $data, $rules, $messages,$customAttributes);
        });
        Log::info("\n\n\n\n");
        Log::info((string)request());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('App\Repositories\Modules\ZdArea\Provider');
        $this->app->register('App\Repositories\Modules\ZdCar\Provider');
        $this->app->register('App\Repositories\Modules\ZdCarType\Provider');
        $this->app->register('App\Repositories\Modules\ZdCategory\Provider');
        $this->app->register('App\Repositories\Modules\ZdDriver\Provider');
        $this->app->register('App\Repositories\Modules\ZdDriverDays\Provider');
        $this->app->register('App\Repositories\Modules\ZdDriverSub\Provider');
        $this->app->register('App\Repositories\Modules\ZdFeedBack\Provider');
        $this->app->register('App\Repositories\Modules\ZdLine\Provider');
        $this->app->register('App\Repositories\Modules\ZdLinePoint\Provider');
        $this->app->register('App\Repositories\Modules\ZdMerchant\Provider');
        $this->app->register('App\Repositories\Modules\ZdMerchantAccount\Provider');
        $this->app->register('App\Repositories\Modules\ZdMerchantAssess\Provider');
        $this->app->register('App\Repositories\Modules\ZdMerchantBill\Provider');
        $this->app->register('App\Repositories\Modules\ZdMerchantComplaint\Provider');
        $this->app->register('App\Repositories\Modules\ZdMerchantUser\Provider');
        $this->app->register('App\Repositories\Modules\ZdMonthBill\Provider');
        $this->app->register('App\Repositories\Modules\ZdOrderDeliveryPoint\Provider');
        $this->app->register('App\Repositories\Modules\ZdPoint\Provider');
        $this->app->register('App\Repositories\Modules\ZdPointTime\Provider');
        $this->app->register('App\Repositories\Modules\ZdRepayLog\Provider');
        $this->app->register('App\Repositories\Modules\ZdSafe\Provider');
        $this->app->register('App\Repositories\Modules\ZdSysRole\Provider');
        $this->app->register('App\Repositories\Modules\ZdSysRoleRule\Provider');
        $this->app->register('App\Repositories\Modules\ZdSysRule\Provider');
        $this->app->register('App\Repositories\Modules\ZdSms\Provider');
        $this->app->register('App\Repositories\Modules\ZdSysUser\Provider');
        $this->app->register('App\Repositories\Modules\ZdSysUserDriver\Provider');
        $this->app->register('App\Repositories\Modules\ZdTag\Provider');
        $this->app->register('App\Repositories\Modules\ZdTask\Provider');
        $this->app->register('App\Repositories\Modules\ZdTaskBrowse\Provider');
        $this->app->register('App\Repositories\Modules\ZdTaskChoose\Provider');
        $this->app->register('App\Repositories\Modules\ZdTaskDeliveryPoint\Provider');
        $this->app->register('App\Repositories\Modules\ZdTaskDriverChoose\Provider');
        $this->app->register('App\Repositories\Modules\ZdTaskOffer\Provider');
        $this->app->register('App\Repositories\Modules\ZdTaskOfferHis\Provider');
        $this->app->register('App\Repositories\Modules\ZdTaskOrder\Provider');
        $this->app->register('App\Repositories\Modules\ZdTaskSetting\Provider');
        $this->app->register('App\Repositories\Modules\ZdTaskSub\Provider');
        $this->app->register('App\Repositories\Modules\ZdUserRule\Provider');
        $this->app->register('App\Repositories\Modules\ZdVersion\Provider');
        $this->app->register('App\Repositories\Modules\ZdWarehouse\Provider');
        $this->app->register('App\Repositories\Modules\ZdWarehouseContacts\Provider');
        $this->app->register('App\Repositories\Modules\ZdCompany\Provider');
        $this->app->register('App\Repositories\Modules\ZdDriverReview\Provider');
        $this->app->register('App\Repositories\Modules\ZdBackendLog\Provider');
        $this->app->register('App\Repositories\Modules\StatisticsDriver\Provider');
        $this->app->register('App\Repositories\Modules\ZdDriverReward\Provider');
        $this->app->register('App\Repositories\Modules\ZdMerchantContract\Provider');
		$this->app->register('App\Repositories\Modules\ZdPointTime\Provider');


    }
}
