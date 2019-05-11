<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redis;

class ZdTaskOffer extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "zd_task_offer";
    protected $fillable = [
        'id',
        'task_id',
        'driver_id',
        'unit_price',
        'percentage',
        'manage_fee',
        'driver_income_fee',
        'remark',
        'status',
        'rescind_reason',
        'cancel_reason',
        'create_time',
        'modify_time'
    ];

    public function task()
    {
        return $this->hasOne(ZdTask::class, 'id', 'task_id');
    }

    public function driver()
    {
        return $this->hasOne(ZdDriver::class, 'id', 'driver_id');
    }

    public function driverSub()
    {
        return $this->hasOne(ZdDriverSub::class, 'driver_id', 'driver_id');
    }

    /**
     * 设置单套报价
     * setUnitPriceAttribute
     * @param $value
     * @author luffyzhao@vip.126.com
     */
    public  function setUnitPriceAttribute($value){
        $percentage = (int) $this->getConfig()['percentage'];

        $this->attributes['percentage'] = $percentage;
        $this->attributes['manage_fee'] = $value * ($percentage / 100);
        $this->attributes['driver_income_fee'] = $value - ($value * ($percentage / 100));
    }

    /**
     * 获取配置
     * getConfig
     * @return array
     * @author luffyzhao@vip.126.com
     */
    protected function getConfig(){
        $key = Config::get('zd.config_key');
        return (array) json_decode(Redis::get($key), true);
    }
}
