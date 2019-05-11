<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class ZdDriver
 *
 * @package App\Model
 */
class ZdDriver extends Authenticatable implements JWTSubject
{
    use Notifiable;

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "base_driver_info";
    protected $fillable
        = [
            'id',
            'company_id',
            'phone',
            'extend_id',
            'password',
            'name',
            'is_service_star',
            'account_price',
            'withdrawal_amount',
            'device_token',
            'os_type',
            'app_version',
            'device_id',
            'head_img_url',
            'sex',
            'idcard',
            'type',
            'deposit_status',
            'deposit_fee',
            'last_deposit_id',
            'is_plat_service_fee',
            'plat_fee_start_date',
            'plat_fee_end_date',
            'supervisor_id',
            'supervisors',
            'native_place',
            'address',
            'job_number',
            'job_date',
            'drive_level',
            'issue_date',
            'car_type_id',
            'car_number',
            'category_id',
            'category_code',
            'is_work',
            'work_date',
            'total_work_time',
            'order_count',
            'count_assess',
            'sum_score',
            'assess_score',
            'status',
            'work_status',
            'app_status',
            'is_frozen_out_car',
            'is_frozen_task',
            'my_invite_code',
            'last_end_work',
            'driver_type',
            'spec',
            'review_reason',
            'toggle_reason',
            'driver_tag',
            'entry_time',
            'identity_type',
            'is_booking_type',
            'book_start_time',
            'book_end_time',
            'create_time',
            'modify_time',
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
     * 地区关联司机
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
        if($role['is_admin']){
            return $query;
        }else{
            return $query->whereIn('category_id', $role->roleCategorys->pluck('id')->toArray());
        }
    }

    /**
     * 自营司机
     *
     * @param $query
     *
     * @return mixed
     * @author Mark
     * @date   2018/5/25 10:00
     */
    public function scopeSelf($query)
    {
        return $query->where('status', 1)->where('driver_type', 0);
    }


    /**
     * 合作司机
     *
     * @param $query
     *
     * @return mixed
     * @author Mark
     * @date   2018/5/25 10:00
     */
    public function scopeWork($query)
    {
        return $query->where('status', 1)->where('driver_type', 1);
    }

    /**
     * 社会司机
     *
     * @param $query
     *
     * @return mixed
     * @author Mark
     * @date   2018/5/25 10:00
     */
    public function scopeSocial($query)
    {
        return $query->where('status', 1)->where('driver_type', 2);
    }

    /**
     * 已审核
     *
     * @param $query
     *
     * @return mixed
     * @author Mark
     * @date   2018/5/25 10:00
     */
    public function scopeFinish($query)
    {
        return $query->where('status', 1);
    }

    /**
     * 在职
     * @method scopeOnTheJob
     *
     * @param $query
     *
     * @return mixed
     * @author luffyzhao@vip.126.com
     */
    public function scopeOnTheJob($query)
    {
        return $query->where('app_status', 1)->where('status', 1);
    }

    /**
     * 司机车辆
     * @method car
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author luffyzhao@vip.126.com
     */
    public function car()
    {
        return $this->belongsTo(ZdCar::class, 'id', 'driver_id');
    }

    /**
     *
     * @method driverSub
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author luffyzhao@vip.126.com
     */
    public function driverSub()
    {
        return $this->hasOne(ZdDriverSub::class, 'driver_id', 'id');
    }

    /**
     * 车型
     * @method carType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author luffyzhao@vip.126.com
     */
    public function carType()
    {
        return $this->hasOne(ZdCarType::class, 'id', 'car_type_id');
    }

    /**
     * 位置
     * @method position
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author luffyzhao@vip.126.com
     */
    public function position()
    {
        return $this->FilledHasOne(ZdPosition::class, '_id', 'id');
    }

    /**
     * 地区
     * @method category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author luffyzhao@vip.126.com
     */
    public function category()
    {
        return $this->hasOne(ZdCategory::class, 'id', 'category_id');
    }

    /**
     * 关联公司
     * @method company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author luffyzhao@vip.126.com
     */
    public function company()
    {
        return $this->hasOne(ZdCompany::class, 'id', 'company_id');
    }

    /**
     * 关联上级
     * @method supervisor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author luffyzhao@vip.126.com
     */
    public function supervisor()
    {
        return $this->hasOne(ZdDriver::class, 'id', 'supervisor_id');
    }

    /**
     * 关联审核记录
     * @method review
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author luffyzhao@vip.126.com
     */
    public function review()
    {
        return $this->hasMany(ZdDriverReview::class, 'driver_id', 'id');
    }

    /**
     * 关联订单
     * @method order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author luffyzhao@vip.126.com
     */
    public function orders()
    {
        return $this->hasMany(ZdOrder::class, 'driver_id', 'id');
    }

    /**
     * 关联出车单
     * @method taskOrders
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author luffyzhao@vip.126.com
     */
    public function taskOrders()
    {
        return $this->hasMany(ZdTaskOrder::class, 'driver_id', 'id');
    }


    /**
     * 司机配送完成次数
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author Mark
     * @date   2018/8/6 10:40
     */
    public function day()
    {
        return $this->hasMany(ZdDriverDays::class, 'driver_id', 'id');
    }


    public function setCategoryCodeAttribute($value)
    {
        $code = ZdCategory::get($this->attributes['category_id']);
        $this->attributes['category_code'] = $code ? $code : '';

    }


    public function getAssessScoreAttribute($value)
    {
        if (empty($value)) {
            return number_format(5, 2, ".", "");
        } else {
            return number_format($value, 2, ".", "");
        }
    }


    /**
     * Define a one-to-one relationship.
     *
     * @param  string $related
     * @param  string $foreignKey
     * @param  string $localKey
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function FilledHasOne($related, $foreignKey = null, $localKey = null)
    {
        $instance = $this->newRelatedInstance($related);

        $foreignKey = $foreignKey ?: $this->getForeignKey();

        $localKey = $localKey ?: $this->getKeyName();

        return $this->newHasOne(
            $instance->newQuery(),
            $this,
            $foreignKey,
            $localKey
        );
    }


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
