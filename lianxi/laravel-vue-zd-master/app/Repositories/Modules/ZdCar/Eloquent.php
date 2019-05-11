<?php

namespace App\Repositories\Modules\ZdCar;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;


class Eloquent extends RepositoriesAbstract implements Interfaces
{

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


}
