<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ZdRepayLog extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "zd_repay_log";
    protected $fillable=['id','merchant_id','repay_money','trade_no','payee','type','remark'];


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

    public function scopeSingleMerchant($query)
    {
        return $query->where('merchant_id', auth()->user()->merchant_id);
    }

    public function merchant()
    {
        return $this->hasOne(ZdMerchant::class, 'id', 'merchant_id');
    }

}
