<?php

namespace App\Repositories\Modules\ZdWarehouse;

use Illuminate\Support\Facades\DB;
use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * 统计关联结果数目
     * @method withCount
     * @param $relations
     *
     * @return $this
     *
     * @author luffyzhao@vip.126.com
     */
    public function withCount($relations)
    {
        $this->newQuery()->withCount($relations);
        return $this;
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes = []){
        if(!isset($attributes['category_position'])) {
            $attributes['category_position'] = '';
        }
        return DB::transaction(function () use ($attributes){
            $model = parent::create($attributes);
            if(isset($attributes['backup_contacts'])){
                $model->backupContacts()->createMany($attributes['backup_contacts']);
            }
            return $model;
        });
    }

    /**
     * @param Model $model
     * @param array $values
     * @param array $attributes
     * @return Model
     */
    public function update(Model $model, array $values, array $attributes = [])
    {
        return DB::transaction(function () use ($model, $values, $attributes){
            parent::update($model, $values, $attributes);
            $model->backupContacts()->delete();
            if(isset($values['backup_contacts'])){
                $model->backupContacts()->createMany($values['backup_contacts']);
            }
            return $model;
        });
    }
}
