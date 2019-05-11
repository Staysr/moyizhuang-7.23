<?php

namespace App\Repositories\Modules\ZdOrderDeliveryPoint;

use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function whereIn($key, $values)
    {
        return $this->model->whereIn($key, $values);
    }


}
