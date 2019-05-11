<?php

namespace App\Repositories\Modules\ZdSysRole;

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
    public function withCount($count)
    {
        $this->newQuery()->withCount($count);
        return $this;
    }
    
    /**
     * 创建模型
     *
     * @param array $attributes
     * @return Model
     * @throws \Exception
     *
     * @author aofei
     */
    public function create(array $attributes = [])
    {
        DB::beginTransaction();
        try {
            $model = parent::create($attributes);
            if (isset($attributes['categorys'])) {
                $model->roleCategorys()->attach($attributes['categorys']);
            }
            $model->roleCategorys;
            
            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }
    
    /**
     * 更新模型
     *
     * @param Model $model
     * @param array $values
     * @param array $attributes
     * @return Model
     * @throws \Exception
     *
     * @author aofei
     */
    public function update(Model $model, array $values, array $attributes = [])
    {
        DB::beginTransaction();
        try {
            $model = parent::update($model, $values, $attributes);
            if (isset($values['categorys'])) {
                $model->roleCategorys()->sync($values['categorys']);
            }
            $model->roleCategorys;
            
            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }
    
    /**
     * 删除模型
     *
     * @param Model $model
     * @return bool|Model|mixed
     * @throws \Exception
     *
     * @author aofei
     */
    public function delete(Model $model)
    {
        DB::beginTransaction();
        try {
            if (parent::delete($model)) {
                $model = $model->roleCategorys()->detach();
            }
            
            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }
}
