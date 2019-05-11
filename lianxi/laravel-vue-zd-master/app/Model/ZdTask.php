<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;
use App\Model\ZdCarType as ZdCarTypeModel;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Cache;

class ZdTask extends Model
{

    use SoftDeletes;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    const DELETED_AT = 'delete_time';
    protected $dates = ['delete_time'];
    public $timestamps = true;

    protected $table = "zd_task";


    protected $fillable = [
        'id',
        'type',
        'name',
        'merchant_id',
        'car_type_ids',
        'warehouse_id',
        'driver_id',
        'is_fixed_point',
        'unfixed_json',
        'delivery_point_remark',
        'is_back',
        'distance_json',
        'arrival_date',
        'send_time',
        'temp_start_date',
        'temp_end_date',
        'arrival_warehouse_time',
        'estimate_time',
        'total_time',
        'safe_id',
        'merchant_safe_id',
        'goods_remark',
        'goods_volume',
        'goods_weight',
        'goods_num',
        'back_bill',
        'unit_price',
        'price_remark',
        'is_delivery',
        'offer_end_time',
        'choose_driver_end_time',
        'choose_driver_time',
        'carry_type',
        'status',
        'driver_status',
        'work_time',
        'merchant_status',
        'assign_status',
        'browse_count',
        'offer_count',
        'generated',
        'create_er',
        'rescind_id',
        'rescind_time',
        'delete_time',
        'is_show',
        'remark',
    ];

    protected $attributes
        = [

            'goods_remark' => '-',
            'goods_volume' => '{"min":1,"max":2}',
            'goods_weight' => '{"min":1,"max":2}',
            'goods_num' => '{"min":1,"max":2}',
            'unit_price' => '{"min":1,"max":2}',
            'is_show' => 0,
            'driver_id' => 0,
        ];


    protected static function boot()
    {
        parent::boot();
    }


    /**
     * 商户
     * @param $query
     * @return mixed
     * @author Mark
     * @date 2018/5/25 10:13
     */
    public function scopeSingleMerchant($query)
    {
        return $query->where('merchant_id', auth()->user()->merchant_id);
    }


    /**
     * 关联商户
     * @param $query
     *
     * @return mixed
     * @author Mark
     * @date   2018/9/19 17:47
     */
    public function scopeRelatedMerchant($query)
    {
        $merchants=auth('api')->user()->merchants;
        if($merchants===true){
            return $query;
        }else{
            return $query->whereIn('merchant_id', auth('api')->user()->merchants);
        }
    }



    /**
     * 未删除的
     * @param $query
     * @return mixed
     * @author Mark
     * @date 2018/5/25 10:13
     */
    public function scopeIsDelete($query)
    {
        return $query->whereNull('delete_time');
    }


    /**
     * 未删除的
     * @param $query
     * @return mixed
     * @author Mark
     * @date 2018/5/25 10:13
     */
    public function scopeIsChoose($query)
    {
        return $query->where('rescind_id', 0);
    }


    /**
     * 在跑任务
     * @param $query
     * @return mixed
     * @author Mark
     * @date 2018/5/25 10:13
     */
    public function scopeRunning($query)
    {
        return $query->where(['status' => 2, 'driver_status' => 2, 'rescind_id' => 0]);
    }

    /**
     * 有效（司机在跑）
     * @param $query
     * @return mixed
     */
    public function scopeValid($query, $driverIds)
    {
        return $query->whereIn('status', [0, 1, 2])
            ->whereIn('driver_status', [1, 2])
            ->whereIn('driver_id', $driverIds);
    }

    /**
     * 完成
     * @param $query
     * @return mixed
     * @author Mark
     * @date 2018/5/25 10:13
     */
    public function scopeFinish($query)
    {
        return $query->where(['status' => 3]);
    }


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
     * 商户用户
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author Mark
     * @date 2018/5/25 14:11
     */
    public function user()
    {
        return $this->hasOne(ZdMerchantUser::class, 'id', 'merchant_id');
    }

    public function merchant()
    {
        return $this->hasOne(ZdMerchant::class, 'id', 'merchant_id');
    }

    public function driver()
    {
        return $this->hasOne(ZdDriver::class, 'id', 'driver_id');
    }

    public function rescind()
    {
        return $this->hasOne(ZdDriver::class, 'id', 'rescind_id');
    }


    public function warehouse()
    {
        return $this->hasOne(ZdWarehouse::class, 'id', 'warehouse_id');
    }

    public function carType()
    {
        return $this->hasOne(ZdCarType::class, 'id', 'car_type_id');
    }

    public function offer()
    {
        return $this->hasMany(ZdTaskOffer::class, 'task_id', 'id');
    }

    public function offerEnable()
    {
        return $this->hasMany(ZdTaskOffer::class, 'task_id', 'id')->where('status', 1);
    }

    public function delivery()
    {
        return $this->hasMany(ZdTaskDeliveryPoint::class, 'task_id', 'id');
    }


    public function setting()
    {
        return $this->hasMany(ZdTaskSetting::class, 'task_id', 'id');
    }

    public function driverSub()
    {
        return $this->hasOne(ZdDriverSub::class, 'driver_id', 'driver_id');
    }

    public function rescindSub()
    {
        return $this->hasOne(ZdDriverSub::class, 'driver_id', 'rescind_id');
    }

    public function order()
    {
        return $this->hasMany(ZdTaskOrder::class, 'task_id', 'id');
    }

    public function merchantSafe(){
        return $this->hasOne(ZdSafe::class, 'id', 'merchant_safe_id');

    }

    public function getDriverStatusAttribute($value)
    {
        if ($this->attributes['rescind_id'] != 0) {
            return 5;
        } else {
            return $value;
        }
    }


    public function getArrivalWarehouseTimeAttribute($value)
    {
        return date("H:i", strtotime($value));
    }


    public function getEstimateTimeAttribute($value)
    {
        return date("H:i", strtotime($value));
    }


    public function getTaskWorkTimeAttribute($value)
    {
        if ($this->attributes['type'] == 1) {
            return $this->attributes['arrival_date']." ".$this->attributes['arrival_warehouse_time'];
        } else {
            return $this->attributes['temp_start_date']." ".$this->attributes['arrival_warehouse_time'];
        }
    }


    public function getDriverStatusTextAttribute()
    {
        $attributes = $this->attributes;
        switch ($attributes['status']) {
            case 0:
            case 1:
            case 2:
                if ($attributes['driver_id'] != 0 && $attributes['driver_status'] == 2) {
                    return '司机已确认上岗，按时为你配送';
                }
                $offer = (new ZdTaskOffer())->where(
                    ["driver_id" => $attributes['rescind_id'], "task_id" => $attributes['id']]
                )->first();
                if (!empty($offer) && $offer['status'] == 2) {
                    return "司机被无责任解约，原因：".$offer['rescind_reason']."\n 最后配送日期：".date(
                            'Y-m-d',
                            strtotime($attributes['rescind_time'])
                        );
                }

                return null;
            case 3:
                return null;
            case 4:
                $offer = (new ZdTaskOffer())->where(
                    ["driver_id" => $attributes['rescind_id'], "task_id" => $attributes['id']]
                )->first();
                if (!empty($offer) && $offer['status'] == 2) {
                    return "司机被无责任解约，原因：".$offer['rescind_reason']."\n 最后配送日期：".date(
                            'Y-m-d',
                            strtotime($attributes['rescind_time'])
                        );
                } else {
                    return null;
                }
            case 5:
                return null;
            case 6:
                return null;
        }
    }

    public function getSendTimeAttribute(
        $value
    ) {
        if (!empty($value)) {
            return json_decode($value);
        } else {
            return null;
        }
    }


    public function getCarTypeNameAttribute($value)
    {
        return Cache::rememberForever(
            'zhoudao:app:carType:'.$this->attributes['car_type_ids'],
            function () {
                $carTypeIds = explode(',', $this->attributes['car_type_ids']);

                return ZdCarTypeModel::whereIn('id', $carTypeIds)->pluck('name');
            }
        );
    }


    public function getUnfixedJsonAttribute(
        $value
    ) {
        return json_decode($value);
    }

    public function getDistanceJsonAttribute(
        $value
    ) {
        return json_decode($value);
    }

    public function getUnitPriceAttribute(
        $value
    ) {
        return json_decode($value);
    }


    public function getGoodsVolumeAttribute(
        $value
    ) {
        return json_decode($value);
    }


    public function getGoodsWeightAttribute(
        $value
    ) {
        return json_decode($value);
    }



    public function getGoodsNumAttribute(
        $value
    ) {
        return json_decode($value);
    }



    public function setUnfixedJsonAttribute(
        $value
    ) {
        $this->attributes['unfixed_json'] = json_encode($value);
    }

    public function setDistanceJsonAttribute(
        $value
    ) {
        $this->attributes['distance_json'] = json_encode($value);
    }

    public function setSendTimeAttribute(
        $value
    ) {
        $new = [];
        foreach ($value as $index => $item) {
            $new[] = (int)$item;
        }
        $this->attributes['send_time'] = (string)json_encode($new);
    }

    public function setCarTypeIdsAttribute(
        $value
    ) {
        $this->attributes['car_type_ids'] = implode(',', $value);
    }

    protected function setGoodsVolumeAttribute($value)
    {
        if (isset($value['min'], $value['max'])) {
            $this->attributes['goods_volume'] = json_encode($value);
        }
    }

    protected function setGoodsWeightAttribute($value)
    {
        if (isset($value['min'], $value['max'])) {
            $this->attributes['goods_weight'] = json_encode($value);
        }
    }

    protected function setGoodsNumAttribute($value)
    {
        $this->attributes['goods_num'] = isset($value['min'], $value['max']) ? json_encode($value) : '';
    }

    protected function setUnitPriceAttribute($value)
    {
        if (isset($value['min'], $value['max'])) {
            $this->attributes['unit_price'] = json_encode($value);
        }
    }


    public function getArrivalWarehouseTimeBeforeAttribute()
    {
        $config = json_decode(Redis::get("zhoudao:sysconfig"), true);

        return date(
            "H:i",
            strtotime($this->attributes['arrival_warehouse_time']) - 3600
            * $config['task_conflict_time']
        );
    }

    public function getEstimateTimeAfterAttribute()
    {
        $config = json_decode(Redis::get("zhoudao:sysconfig"), true);

        return date(
            "H:i",
            strtotime($this->attributes['estimate_time']) + 3600
            * $config['task_conflict_time']
        );
    }


    public function getBeforeCrossDayAttribute()
    {
        $config = json_decode(Redis::get("zhoudao:sysconfig"), true);
        $result = date(
            " H:i",
            strtotime($this->attributes['arrival_warehouse_time']) - 3600
            * $config['task_conflict_time']
        );
        if (strtotime(date("Y-m-d")) > strtotime($result)) {
            return true;
        } else {
            return false;
        }


    }

    public function getAfterCrossDayAttribute()
    {
        $config = json_decode(Redis::get("zhoudao:sysconfig"), true);

        $result = date(
            "H:i",
            strtotime($this->attributes['estimate_time']) + 3600
            * $config['task_conflict_time']
        );
        if (strtotime($result) > strtotime(date("Y-m-d")) + 86400) {
            return true;
        } else {
            return false;
        }
    }


}
