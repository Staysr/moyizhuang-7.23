<?php

namespace App\Model;

use App\Observers\Model\ZdDriverRewardObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class ZdDriverReward extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;
    protected $table = "zd_driver_reward";

    protected $fillable
        = [
            'id',
            'reward_no',
            'driver_id',
            'merchant_id',
            'order_id',
            'type',
            'fee',
            'reason',
            'user_id',
        ];


    protected static function boot()
    {
        parent::boot();
        static::observe(ZdDriverRewardObserver::class);
    }

    /**
     * 排序
     *
     * @param $query
     *
     * @return mixed
     * @author Mark
     * @date   2018/5/25 10:00
     */
    public function scopeOrderWith($query)
    {
        return $query->orderBy('id', 'DESC');
    }


    public function merchant()
    {
        return $this->hasOne(ZdMerchant::class, 'id', 'merchant_id');
    }

    public function driver()
    {
        return $this->hasOne(ZdDriver::class, 'id', 'driver_id');
    }

    public function order()
    {
        return $this->hasOne(ZdTaskOrder::class, 'id', 'order_id');
    }

    public function user()
    {
        return $this->hasOne(ZdSysUser::class, 'id', 'user_id');
    }



    /**
     * 创建奖惩号
     *
     * @return string
     * @author Mark
     * @date   2018/8/23 14:35
     */
    public function createAwardNo()
    {
        $key = 'zhoudao:awardNo:'.date("Ym");
        $inc = Redis::incr($key);
        if ($inc == 1) {
            Redis::expire($key, 2600600);
        }

        return date("Ym").str_pad($inc, 2, "0", STR_PAD_LEFT);
    }


}
