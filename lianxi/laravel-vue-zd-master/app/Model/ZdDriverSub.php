<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ZdDriverSub extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "zd_driver_sub";
    protected $fillable
        = [
            'id',
            'driver_id',
            'offer_count',
            'checked_count',
            'complete_count',
            'complaint_count',
            'b_assess_count',
            'b_score_sum',
            'work_count',
        ];

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

    /**
     * 关联司机
     *
     * @param $query
     *
     * @return mixed
     * @author Mark
     * @date   2018/9/19 17:47
     */
    public function scopeRelatedDriver($query)
    {
        $role = auth('api')->user()->cachedRole();
        return $query->whereHas('driver',function ($query) use ($role){
            $query->whereIn('category_id', $role->roleCategorys->pluck('id')->toArray());
        });
    }

    public function driver()
    {
        return $this->hasOne(ZdDriver::class, 'id', 'driver_id');
    }


    /**
     * 订单总和
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author Mark
     * @date   2018/8/10 17:52
     */
    public function order()
    {
        return $this->hasMany(ZdTaskOrder::class, 'driver_id', 'driver_id');

    }
}
