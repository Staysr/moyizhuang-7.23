<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ZdMerchantBill extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "zd_merchant_bill";

    protected $fillable = [
        'driver_id',
        'order_id',
        'merchant_id',
        'charge_type',
        'task_type',
        'merchant_money',
        'money',
        'arrival_warehouse_time',
    ];


    /**
     * 排序
     * @param $query
     * @return mixed
     * @author Mark
     * @date 2018/5/25 10:00
     */
    public function scopeOrderWith($query)
    {
        return $query->orderBy('id', 'DESC');
    }


    /**
     * 按完成时间排序
     * @param $query
     *
     * @return mixed
     * @author Mark
     * @date   2018/8/8 16:42
     */
    public function scopeOrderWithDesc($query)
    {
        return $query->orderBy('create_time', 'DESC');
    }


    public function scopeSingleMerchant($query)
    {
        return $query->where('merchant_id', auth()->user()->merchant_id);
    }


    /**
     * 关联订单
     *
     * @param $query
     *
     * @return mixed
     * @author Mark
     * @date   2018/9/19 17:47
     */
    public function scopeFilterOrder($query)
    {
        $finishTime = request()->input('finish_time');
        return $query->whereHas(
            'order',
            function ($query) use ($finishTime) {
                if (!empty($finishTime)) {
                    $query->where('finish_time', '>=', $finishTime[0])->where(
                        'finish_time',
                        '<',
                        $finishTime[1]
                    );
                }
            }
        );
    }


    public function merchant()
    {
        return $this->hasOne(ZdMerchant::class, 'id', 'merchant_id');
    }

    public function driver()
    {
        return $this->hasOne(ZdDriver::class, 'id', 'driver_id');
    }
    public function driverSub()
    {
        return $this->hasOne(ZdDriverSub::class, 'driver_id', 'driver_id');
    }

    public function order()
    {
        return $this->hasOne(ZdTaskOrder::class, 'id', 'order_id');
    }





}
