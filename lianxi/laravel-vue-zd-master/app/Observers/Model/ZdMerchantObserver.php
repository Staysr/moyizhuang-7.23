<?php
/**
 * 商户模型事件观察者
 */

namespace App\Observers\Model;


use App\Model\ZdMerchant;
use Illuminate\Support\Facades\Auth;

class ZdMerchantObserver
{
    public function creating(ZdMerchant $merchant){
        $merchant->setAttribute('user_id', Auth::guard('api')->user()->id);
    }

    public function created(ZdMerchant $merchant){
        $merchant->account()->create([
            'merchant_id' => $merchant->id
        ]);
    }
}