<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ZdArea extends Model
{
    public $timestamps = false;

    protected $table = "sys_area";

    /**
     * 排序
     * @param $query
     * @return mixed
     * @author Mark
     * @date 2018/5/25 10:00
     */
    public function scopeOrderWith($query)
    {
        return $query->orderBy('id', 'asc');
    }

}
