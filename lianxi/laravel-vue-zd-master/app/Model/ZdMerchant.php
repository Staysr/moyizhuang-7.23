<?php

namespace App\Model;

use App\Observers\Model\ZdMerchantObserver;
use Illuminate\Database\Eloquent\Model;

class ZdMerchant extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "zd_merchant";


    protected $casts
        = [
            'content' => 'json',
        ];


    protected $fillable
        = [
            'quality_id',
            'advice_id',
            'running_id',
            'user_id',
            'title',
            'short_name',
            'city',
            'trade',
            'bank',
            'bank_no',
            'telephone',
            'agreement_start_time',
            'agreement_end_time',
            'invoice',
            'repayment',
            'repayment_day',
            'sop',
            'content',
            'task_count',
            'unless_task_count',
            'warehouse_count',
            'contract_count'
        ];


    protected static function boot()
    {
        parent::boot();
        static::observe(ZdMerchantObserver::class);
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
            return $query->whereIn('id', auth('api')->user()->merchants);
        }
    }


    public function getContentAttribute($value)
    {
        return json_decode($value);
    }

    /**
     * 品质经理
     * @method quality
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author luffyzhao@vip.126.com
     */
    public function quality()
    {
        return $this->belongsTo(ZdSysUser::class, 'quality_id', 'id')
            ->where('authority_level', '=', 4)
            ->where('status', '=', 1)
            ->select(['name', 'phone']);
    }

    /**
     * 客户顾问
     * @method advice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author luffyzhao@vip.126.com
     */
    public function advice()
    {
        return $this->belongsTo(ZdSysUser::class, 'advice_id', 'id')
            ->where('authority_level', '=', 1)
            ->where('status', '=', 1)
            ->select(['name', 'phone']);
    }

    /**
     * 运作经理
     * @method running
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author luffyzhao@vip.126.com
     */
    public function running()
    {
        return $this->belongsTo(ZdSysUser::class, 'running_id', 'id')
            ->where('authority_level', '=', 2)
            ->where('status', '=', 1)
            ->select(['name', 'phone']);
    }


    /**
     * 创建者
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author Mark
     * @date   2018/8/8 12:16
     */
    public function creator()
    {
        return $this->hasOne(ZdSysUser::class, 'id', 'user_id');
    }


    /**
     * 商户用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author Mark
     * @date   2018/8/1 17:39
     */
    public function user()
    {
        return $this->belongsTo(ZdMerchantUser::class, 'id', 'merchant_id');
    }


    /**
     * 商户账户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author Mark
     * @date   2018/8/8 12:16
     */
    public function account()
    {
        return $this->belongsTo(ZdMerchantAccount::class, 'id', 'merchant_id');
    }


    /**
     * 等待还款账单
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author Mark
     * @date   2018/8/9 16:19
     */
    public function checkedWaitBill()
    {
        return $this->hasMany(ZdMonthBill::class, 'merchant_id', 'id')->whereIn(
            'status',
            [0, 1]
        )->orderBy('zd_month_bill.create_time');
    }

    /**
     * 还款记录
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author Mark
     * @date   2018/8/9 16:19
     */
    public function repayLog()
    {
        return $this->hasMany(ZdRepayLog::class, 'merchant_id', 'id');
    }


    /**
     * 商户合同
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author Mark
     * @date   2018/9/6 10:15
     */
    public function contract()
    {
        return $this->hasMany(ZdMerchantContract::class, 'merchant_id', 'id');
    }


}
