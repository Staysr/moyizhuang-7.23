<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ZdMonthBill extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "zd_month_bill";

   // protected $appends=['overdue'];

    protected $fillable
        = [
            'id',
            'merchant_id',
            'bill_no',
            'bill_time',
            'status',
            'money',
            'repayment_money',
            'last_repayment_time',
        ];

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
     * 商户
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author Mark
     * @date   2018/8/13 14:37
     */
    public function merchant()
    {
        return $this->hasOne(ZdMerchant::class, 'id', 'merchant_id');
    }

    public function driver()
    {
        return $this->hasOne(ZdDriver::class, 'id', 'driver_id');
    }


    public function getOverdueAttribute()
    {
        if ($this->attributes['money']== $this->attributes['repayment_money']
        ) {
            return 0;
        } else {
            if (time() - strtotime($this->attributes['bill_time'])
                < $this->merchant->repayment_day * 86400
            ) {
                return 1;
            } else {
                return 2;
            }
        }
    }

}
