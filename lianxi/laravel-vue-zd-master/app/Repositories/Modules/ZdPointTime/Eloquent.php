<?php

namespace App\Repositories\Modules\ZdPointTime;

use App\Model\ZdLine;
use App\Model\ZdLinePoint;
use App\Model\ZdPointTime;
use Illuminate\Support\Facades\DB;
use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\Types\Array_;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            foreach ($attributes as $attribute) {
                if (!empty($attribute['lists'])) {
                    /* @var $model ZdPointTime */
                    $model = $this->check($attribute);

                    foreach ($attribute['lists'] as $value) {
                        $value['location'] = isset($value['location']) ? $value['location'] : [0, 0];
                        if ($value['location'][0] == 0 && $value['location'][1] == 0) {
                            $status = 0;
                            $model->exception_count++;
                        } else {
                            $status = 1;
                        }
                        $lists[] = [
                            'name'          => $value['address'],
                            'fixed_name'    => $value['address'],
                            'area'          => $value['province'] . $value['city'] . $value['district'],
                            'contacts'      => $value['contacts'],
                            'contact_way'   => $value['contact_way'],
                            'remark'        => $value['remark'],
                            'point_time_id' => $model->id,
                            'lng'           => $value['location'][0] ?? 0,
                            'lat'           => $value['location'][1] ?? 0,
                            'status'        => $status,
                        ];
                    }
                    $model->save();
                    if (!empty($lists)) {
                        $model->point()->createMany($lists);
                    }
                }
            }

            return $model;
        });
    }

    /**
     * 查询数据库是否已存在数据
     * @param $data
     * @return mixed
     */
    private function check ($data) {
        return $this->model->firstOrCreate([
                    'warehouse_id' => $data['warehouse_id'],
                    'arrival_warehouse_day' => $data['arrival_warehouse_day'],
                    'arrival_warehouse_time' => $data['arrival_warehouse_time'],
                ], [
                    'warehouse_id' => $data['warehouse_id'],
                    'arrival_warehouse_day' => $data['arrival_warehouse_day'],
                    'arrival_warehouse_time' => $data['arrival_warehouse_time'],
                    'total_count' => 0,
                    'exception_count' => 0,
                ]);
    }


    /**
     * @param $model
     * @param $attr
     * @return mixed
     */
    public function change($model, $attr)
    {
        return DB::transaction(function () use ($model, $attr){
            /* @var $model ZdPointTime */
            $ids = $model->line()->pluck('id')->all();
            if (!empty($ids)) {
                ZdLinePoint::getModel()->whereIn('line_id', $ids)->delete();
            }
            $model->line()->delete();

            $count = 0;
            if (!empty($attr)) {
                //新增路线
                $lineNames = array_column($attr, 'line_name');
                foreach ($lineNames as $name) {
                    $lineModel = new ZdLine();
                    $lineModel->title = $name;
                    $lineModel->point_time_id = $model->id;
                    $lineModel->save();
                }

                //路线中间表
                foreach ($attr as $value) {
                    $lineId = ZdLine::getModel()->where('title', '=', $value['line_name'])->where('point_time_id', '=', $model->id)->value('id');
                    foreach ($value['data'] as $key => $data) {
                        $linePointModel = new ZdLinePoint();
                        $linePointModel->line_id = $lineId;
                        $linePointModel->point_id = $data['id'];
                        $linePointModel->sort = $key + 1;
                        $linePointModel->save();
                        $count++;
                    }
                }
            }
            $model->plan_count = $count;
            $model->save();

            return $model;
        });
    }

}
