<?php

namespace App\Repositories\Modules\ZdTaskOrder;

use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * 数量
     * @param $attributes
     * @return mixed
     * @author Mark
     * @date 2018/5/7 17:29
     */
    public function count($attributes)
    {
        return $this->model->where($attributes)->count();
    }


    public function whereIn($key, $values)
    {
        return $this->model->whereIn($key, $values);
    }


}
