<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class ZdPointTime
 * @package App\Model
 *
 * @property integer $id
 * @property integer $total_count
 * @property integer $exception_count
 */

class ZdPointTime extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "zd_point_time";

    protected $fillable = ['warehouse_id', 'arrival_warehouse_day', 'arrival_warehouse_time', 'total_count', 'exception_count', 'plan_count'];

    public function warehouse()
    {
        return $this->belongsTo(ZdWarehouse::class, 'warehouse_id', 'id');
    }

    public function scopeOrderWith($query)
    {
        return $query->orderBy(DB::raw("CONCAT(arrival_warehouse_day,' ',arrival_warehouse_time)"), 'DESC');
    }

    public function point()
    {
        return $this->hasMany(ZdPoint::class, 'point_time_id', 'id');
    }

    public function line()
    {
        return $this->hasMany(ZdLine::class, 'point_time_id', 'id');
    }
    
    public function scopeLine($query)
    {
        return $query->rightJoin('zd_line', 'zd_line.point_time_id', '=', 'zd_point_time.id');
    }

    /**
     * 关联仓库
     * @param $query
     *
     * @return mixed
     * @author Mark
     * @date   2018/9/19 17:47
     */
    public function scopeRelatedWarehouse($query)
    {
        $merchants=auth('api')->user()->merchants;
        if($merchants===true){
            return $query;
        }else{
            $warehouseModel = new ZdWarehouse();
            $ids = $warehouseModel->whereIn('merchant_id', auth('api')->user()->merchants)->pluck('id');
            return $query->whereIn('warehouse_id', $ids);
        }
    }

}
