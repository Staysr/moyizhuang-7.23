<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ZdCategory extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;

    protected $table = "sys_category";


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

    /**
     * 城市
     * @method scopeCity
     * @param $query
     * @return mixed
     * @author luffyzhao@vip.126.com
     */
    public function scopeCity($query){
        return $query->where('level', '=', 3);
    }
}
