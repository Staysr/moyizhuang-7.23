<?php

namespace App\Model;

use App\Events\Model\ZdWarehouse\DeletedEvent;
use App\Events\Model\ZdWarehouse\SavedEvent;
use App\Observers\Model\ZdWarehouseObserver;
use Illuminate\Database\Eloquent\Model;

class ZdWarehouse extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "zd_warehouse";
    protected $fillable = [
        'merchant_id',
        'title',
        'category_position',
        'category_zone',
        'contacts',
        'contacts_phone',
        'address',
        'description',
        'instruction',
        'longitude',
        'latitude',
        'remark',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();
        static::observe(ZdWarehouseObserver::class);
    }

    public function scopeSingleMerchant($query)
    {
        return $query->where('merchant_id', auth()->user()->merchant_id);
    }

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
     * @param $query
     * @return mixed
     * @author Mark
     * @date 2018/5/25 10:00
     */
    public function scopeOrderWith($query)
    {
        return $query->orderBy('id', 'DESC');
    }



    public function scopeEnableHouse($query)
    {
        return $query->where('status',1);
    }


    public function merchant()
    {
        return $this->belongsTo(ZdMerchant::class, 'merchant_id', 'id');
    }


    public function order()
    {
        return $this->hasMany(ZdTaskOrder::class, 'warehouse_id', 'id');
    }

    public function backupContacts()
    {
        return $this->hasMany(ZdWarehouseContacts::class, 'warehouse_id', 'id');
    }


    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }


    public function setCategoryPositionAttribute($value)
    {
        $positions = explode(' ', $this->attributes['category_zone']);
        $this->attributes['category_position'] = ZdArea::where('area_name', '=', end($positions))->value('position');
    }




}
