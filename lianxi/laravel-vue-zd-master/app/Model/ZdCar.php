<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class ZdCar extends Model
{
    public $timestamps = true;

    protected $table = "sys_car";
    protected $fillable
        = [
            'id',
            'number',
            'carframe',
            'engine',
            'archives',
            'charging_clip',
            'mileage',
            'collect_date',
            'parts',
            'identify_type',
            'operate_type',
            'company_id',
            'driver_id',
            'car_style_id',
            'car_type_id',
            'maintain_id',
            'unscientific_id',
            'commercial_id',
            'carship_id',
            'maintain_status',
            'repair_status',
            'operate_status',
            'operate_property',
            'operated_at',
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
        return $query->orderBy('sys_car.id', 'DESC');
    }

    /**
     * 外包公司
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author Mark
     * @date   2018/7/31 14:56
     */
    public function company()
    {
        return $this->hasOne(ZdCompany::class, 'id', 'company_id');
    }


    /**
     * 车辆型号
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author Mark
     * @date   2018/7/31 14:57
     */
    public function carType()
    {
        return $this->hasOne(ZdCarType::class, 'id', 'car_type_id');
    }



    /**
     * 绑定司机
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author Mark
     * @date   2018/7/31 14:58
     */
    public function driver()
    {
        return $this->hasOne(ZdDriver::class, 'id', 'driver_id');
    }


}
