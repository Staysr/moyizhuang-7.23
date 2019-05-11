<?php

namespace App\Repositories\Modules\ZdDriver;

use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * 使实体的一个新实例查询
     * @method make
     *
     * @param array $with
     *
     * @return $this
     *
     * @author luffyzhao@vip.126.com
     */
    public function withCount(array $with = array())
    {
        $this->newQuery()->withCount($with);

        return $this;
    }
}
