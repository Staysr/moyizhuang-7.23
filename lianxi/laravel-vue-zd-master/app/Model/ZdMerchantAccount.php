<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ZdMerchantAccount extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "zd_merchant_account";
    protected $fillable
        = [
            'id',
            'merchant_id',
            'account',
            'latest_repayment_time',
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

    public function merchant()
    {
        return $this->hasOne(ZdMerchant::class, 'id', 'merchant_id');
    }

    public function merchantUser()
    {
        return $this->hasOne(ZdMerchantUser::class, 'merchant_id', 'merchant_id');
    }


    public function orderFinish()
    {
        return $this->hasMany(ZdTaskOrder::class, 'merchant_id', 'merchant_id')
            ->whereYear('arrival_warehouse_time', '=', date('Y'))
            ->whereMonth('arrival_warehouse_time', '=', date('m'));
    }


    public function month(){
        return $this->hasMany(ZdMonthBill::class, 'merchant_id', 'merchant_id');
    }


}
