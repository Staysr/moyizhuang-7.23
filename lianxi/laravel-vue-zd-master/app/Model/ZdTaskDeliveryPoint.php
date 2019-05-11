<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ZdTaskDeliveryPoint extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "zd_task_delivery_point";
    protected $fillable = ['id', 'task_id', 'name', 'lng', 'lat', 'contacts', 'contact_way', 'sort'];

    public function addAll(Array $data)
    {
        $rs = DB::table($this->getTable())->insert($data);

        return $rs;
    }
}
