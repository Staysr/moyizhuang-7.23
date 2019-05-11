<?php

namespace App\Repositories\Modules\ZdMonthBill;

use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * 统计字段的和
     * @param $column
     * @return mixed
     * @author Mark
     * @date 2018/5/7 17:29
     */
    public function sum($column)
    {
        return $this->model->sum($column);
    }

    /**
     * 统计自定义字段的和
     * @param $column
     * @return mixed
     * @author Mark
     * @date 2018/5/7 17:29
     */
    public function getField($alias, $column)
    {
        return $this->model->select( DB::raw("SUM({$alias}) AS {$column}"))->get();
    }
}
