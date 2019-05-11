<?php

namespace App\Model;

use App\Foundations\Util;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ZdTaskOrder extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "zd_task_order";
    protected $fillable = [
        'id',
        'order_no',
        'merchant_id',
        'task_id',
        'name',
        'warehouse_id',
        'driver_id',
        'car_type_id',
        'unit_price',
        'safe_fee',
        'merchant_safe_fee',
        'total_fee',
        'manage_fee',
        'percentage',
        'arrival_warehouse_time',
        'punch_time',
        'leaves_warehouse_time',
        'finish_time',
        'cancel_time',
        'rescind_time',
        'undo_time',
        'is_agent',
        'is_one_step_finish',
        'safe_id',
        'merchant_safe_id',
        'status',
        'remind_status',
        'is_confirm_posts',
        'cancel_count',
        'point_count',
        'exception_count',
        'is_reassigned',
        'delivery_point_remark',
        'reassignment_reason',
        'remark',
    ];

    protected $casts = [
        'total_fee' => 'float',
    ];

    protected static function boot()
    {
        parent::boot();
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
        return $query->orderBy('zd_task_order.arrival_warehouse_time', 'DESC');
    }

    public function scopeTaskType($query, $type)
    {
        return $query->join('zd_task', 'zd_task_order.task_id', '=', 'zd_task.id')->where('zd_task.type', $type);
    }


    public function scopeSingleMerchant($query)
    {
        return $query->where('merchant_id', auth()->user()->merchant_id);
    }


    public function scopeRelatedMerchant($query)
    {
        $merchants = auth('api')->user()->merchants;
        if ($merchants === true) {
            return $query;
        } else {
            return $query->whereIn('merchant_id', auth('api')->user()->merchants);
        }
    }


    public function scopeFinish($query)
    {
        return $query->where('status', 3);
    }


    public function merchant()
    {
        return $this->hasOne(ZdMerchant::class, 'id', 'merchant_id');
    }

    public function driver()
    {
        return $this->hasOne(ZdDriver::class, 'id', 'driver_id');
    }

    public function driverSub()
    {
        return $this->hasOne(ZdDriverSub::class, 'driver_id', 'driver_id');
    }

    public function driverDay()
    {
        return $this->hasMany(ZdDriverDays::class, 'driver_id', 'driver_id');
    }

    public function safe()
    {
        return $this->hasOne(ZdSafe::class, 'id', 'safe_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(ZdWarehouse::class, 'warehouse_id', 'id');
    }

    public function merchantSafe()
    {
        return $this->hasOne(ZdSafe::class, 'id', 'merchant_safe_id');

    }

    public function task()
    {
        return $this->hasOne(ZdTask::class, 'id', 'task_id');
    }


    public function carType()
    {
        return $this->hasOne(ZdCarType::class, 'id', 'car_type_id');
    }

    public function delivery()
    {
        return $this->hasMany(ZdOrderDeliveryPoint::class, 'order_id', 'id')->orderBy('sort');
    }

    public function PendingDelivery()
    {
        return $this->hasMany(ZdOrderDeliveryPoint::class, 'order_id', 'id')->where('status', 0);
    }


    public function position()
    {
        return $this->FilledHasOne(ZdPosition::class, '_id', 'driver_id');
    }

    /**
     * 司机取消的出车单
     * scopeCancelByDriver
     * @param $query
     * @param $drivers
     * @author luffyzhao@vip.126.com
     */
    public function scopeCancelByDriver(Builder $query, array $drivers)
    {
        $query->whereIn('driver_id', $drivers)->whereIn('status', [4, 5, 6]);
    }

    /**
     * 首页筛选
     *
     * @param $query
     *
     * @return mixed
     * @author Mark
     * @date   2018/9/19 17:47
     */
    public function scopeIndexFilter($query)
    {
        $post = request()->only(['task', 'driver', 'merchant']);

        return $query->whereHas(
            'task',
            function ($query) use ($post) {
                if (!empty($post['task'])) {
                    $query->where('name', 'like', '%'.$post['task'].'%');
                }
            }
        )->whereHas(
            'driver',
            function ($query) use ($post) {
                if (!empty($post['driver'])) {
                    $query->where('name', 'like', '%'.$post['driver'].'%')
                        ->orWhere('phone', 'like', '%'.$post['driver'].'%')
                        ->orWhere(
                            'car_number',
                            'like',
                            '%'.$post['driver'].'%'
                        );
                }
            }
        )->whereHas(
            'merchant',
            function ($query) use ($post) {
                if (!empty($post['merchant'])) {
                    $query->where(
                        'short_name',
                        'like',
                        '%'.$post['merchant'].'%'
                    );
                }
            }
        );
    }


    /**
     * Define a one-to-one relationship.
     *
     * @param  string $related
     * @param  string $foreignKey
     * @param  string $localKey
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function FilledHasOne($related, $foreignKey = null, $localKey = null)
    {
        $instance = $this->newRelatedInstance($related);

        $foreignKey = $foreignKey ?: $this->getForeignKey();

        $localKey = $localKey ?: $this->getKeyName();

        return $this->newHasOne($instance->newQuery(), $this, $foreignKey, $localKey);
    }

    public function bill()
    {
        return $this->hasOne(ZdMerchantBill::class, 'order_id', 'id');
    }


    public function getShortArrivalWarehouseTimeAttribute($value)
    {
        return date("H:i", strtotime($this->attributes['arrival_warehouse_time']));
    }


    /**
     * 迟到时间
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:24
     */
    public function getLateAttribute()
    {
        $attributes = $this->attributes;
        if (empty($attributes['punch_time'])) {
            $diff = time() - strtotime($attributes['arrival_warehouse_time']);
        } else {
            $diff = strtotime($attributes['punch_time']) - strtotime($attributes['arrival_warehouse_time']);
        }
        $format = Util::Sec2Time($diff);
        if ($format["seconds"] > 0) {
            $format["minutes"]++;
        }

        return $format["days"]."天".$format["hours"]."小时".$format["minutes"]."分钟";
    }


}
