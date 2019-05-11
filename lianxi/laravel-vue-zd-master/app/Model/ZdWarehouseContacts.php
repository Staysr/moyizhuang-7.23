<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ZdWarehouseContacts extends Model
{
    public $timestamps = false;

    protected $table = "zd_warehouse_contacts";
    protected $fillable = [
        'id',
        'warehouse_id',
        'name',
        'phone'
    ];


    public function warehouse()
    {
        return $this->hasOne(ZdWarehouse::class, 'id', 'warehouse_id');
    }

    /**
     * 更新备用联系人
     * @param array $data
     * @param $warehouseId
     * @return mixed
     * @author Mark
     * @date 2018/6/29 11:33
     */
    public function addAllContact($data,$warehouseId){
        DB::table($this->getTable())->where('warehouse_id',$warehouseId)->delete();
        if(!empty($data)){
            foreach ($data as $j => $item) {
                $data[$j]['warehouse_id']=$warehouseId;
            }
            return  DB::table($this->getTable())->insert($data);
        }
    }


}
