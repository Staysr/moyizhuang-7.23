<?php

namespace App\Repositories\Modules\ZdSysUser;

use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function findWhere($attributes, array $columns = ['*'])
    {
        return $this->model->where($attributes)->first($columns);
    }
}
