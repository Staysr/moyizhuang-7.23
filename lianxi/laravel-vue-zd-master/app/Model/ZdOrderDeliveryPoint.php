<?php

namespace App\Model;


use App\Observers\Model\ZdOrderDeliveryPointObserver;
use Illuminate\Database\Eloquent\Model;

class ZdOrderDeliveryPoint extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "zd_order_delivery_point";
    protected $fillable
        = [
            'id',
            'task_id',
            'order_id',
            'name',
            'lng',
            'lat',
            'contacts',
            'contact_way',
            'sort',
            'is_fixed_point',
            'status',
            'put_address',
            'put_lng',
            'put_lat',
            'reason',
            'img_one',
            'img_two',
            'img_three',
            'finish_time',
        ];


    protected static function boot()
    {
        parent::boot();
        static::observe(ZdOrderDeliveryPointObserver::class);
    }


    public function order()
    {
        return $this->BelongsTo(ZdTaskOrder::class, 'order_id', 'id');
    }


}
