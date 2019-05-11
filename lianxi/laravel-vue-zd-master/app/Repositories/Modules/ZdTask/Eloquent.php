<?php

namespace App\Repositories\Modules\ZdTask;

use App\Model\ZdTaskDeliveryPoint;
use App\Model\ZdTaskSetting;
use App\Model\ZdMerchant;
use App\Model\ZdTaskChoose;

use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * 复制一个任务
     * replicate
     * @param Model $model
     * @author luffyzhao@vip.126.com
     * @return Model
     */
    public function replicate(Model $model){
        $model->load(['setting', 'delivery']);

        $new = $model->replicate(['id']);
        $new->offer_count = 1;
        $new->save();

        foreach (['setting', 'delivery'] as $relation) {
            $new->{$relation}->each(
                function (Model $item) use ($new) {
                    $value = $item->replicate(['id', 'task_id']);
                    $value->task_id = $new->id;
                    $value->save();
                }
            );
        }

        return $new;
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

    /**
     *
     * @param $post
     * @param $id
     * @return bool
     * @author Mark
     * @date 2018/6/8 17:05
     */
    public function fixedPoint($post, $id)
    {
        $deliveryPoint=new ZdTaskDeliveryPoint();
        if ($post['is_fixed_point'] == 0) {
            return true;
        }
        $delivery = $post['delivery_point'];
        $point = [];
        $dateTime = date('Y-m-d H:i:s');

        foreach ($delivery as $key => $value) {
            if (isset($value['lng'], $value['lat'])) {
                $lng = $value['lng'];
                $lat = $value['lat'];
            }
            else {
                list($lng, $lat) = explode(',', $value['location']);
            }
            $point[$key] = [
                'task_id' => $id,
                'name' => $value['name'],
                'lng' => $lng,
                'lat' => $lat,
                'contacts' => $value['contacts'],
                'contact_way' => $value['contact_way'],
                'sort' => $key + 1,
                'create_time' => $dateTime,
                'modify_time' => $dateTime,
            ];
        }
        $deliveryPoint->addAll($point);
    }

    /**
     * 添加任务选择列表
     * @param $post
     * @param $id
     * @author Mark
     * @date 2018/6/8 17:46
     */
    public function taskChoose($post, $id)
    {
        $arr = [];
        $data['driver_id'] = 0;
        $data['task_id'] = $id;
        if ($post['type'] == 1) {
            $data['start_date'] = $post['arrival_date'];
            $data['end_date'] = null;
        }
        if ($post['type'] == 2) {
            $data['start_date'] = $post['temp_start_date'];
            $data['end_date'] = $post['temp_end_date'];
        }
        if (isset($post['send_time'])&& !empty($post['send_time'])) {
            $endTimeArr =  $post['send_time'];
            foreach ($endTimeArr as $index => $week) {
                $arr[] = (int)$week;
            }
            $data['week'] = implode(",", $arr);
        } else {
            $data['week'] = null;
        }

        $data['start_time'] = strtotime(  date('Y-m-d')." ".$post['arrival_warehouse_time'] )-strtotime( date('Y-m-d') );
        $data['end_time'] = strtotime(  date('Y-m-d')." ".$post['estimate_time'] )-strtotime( date('Y-m-d') );

        if ($data['start_time'] > $data['end_time']) {
            $data['end_time'] = $data['end_time'] + 86400; //跨天多一个天
        }

        $data['arrival_warehouse_time'] = $post['arrival_warehouse_time'];
        $data['estimate_time'] = $post['estimate_time'];

        (new ZdTaskChoose())->create($data);
    }

    /**
     * 商户任务数目
     * @param $post
     * @author Mark
     * @date 2018/6/8 17:46
     */
    public function merchantTaskCount($post, $merchant_id)
    {
        $merchant               = new ZdMerchant();
        $ZdMerchant             = $merchant->find($merchant_id);
        $ZdMerchant->task_count = $ZdMerchant->task_count + 1;
        $ZdMerchant->save();
    }

    /**
     * 任务配置
     * @param $post
     * @param $id
     * @param ZdTaskSetting $taskSetting
     * @author Mark
     * @date 2018/6/8 17:04
     */
    public function taskSetting($post, $id)
    {
        $setting = [];
        // 搬运
        if ($post['carry_type'] != 0) {
            $setting = $this->setting($id, $post['carry'], 'carry', $setting);
        }
        // 回单
        if (isset($post['back_bill']) &&$post['back_bill'] == 1) {
            $setting = $this->setting($id, $post['receipt'], 'receipt', $setting);
        }
        // 配送
        if (isset($post['is_delivery'])  && $post['is_delivery'] == 1) {
            $setting = $this->setting($id, $post['dispatching'], 'dispatching', $setting);
        }
        // 其他上岗要求
        if (isset($post['supply'])) {
            $setting = $this->setting($id, $post['supply'], 'supply', $setting);
        }
        // 司机福利补贴奖励
        if (isset($post['welfare'])) {
            $setting = $this->setting($id, $post['welfare'], 'welfare', $setting);
        }
        // 司机福利补贴奖励
        if (isset($post['other'])) {
            $setting = $this->setting($id, $post['other'], 'other', $setting);
        }
        // 批量添加
        (new ZdTaskSetting())->addAll($setting);
    }

    /**
     * 配置格式化
     * @param $id
     * @param $data
     * @param string $key
     * @param $setting
     * @return array
     * @author Mark
     * @date 2018/6/8 17:04
     */
    protected function setting($id, $data, $key = '', $setting)
    {
        $dateTime = date('Y-m-d H:i:s');
        foreach ($data as $k => $value) {
            $setting[] = [
                'task_id' => $id,
                'type' => $key,
                'key' => $k,
                'value' => $value,
                'create_time' => $dateTime,
                'modify_time' => $dateTime,
            ];
        }

        return $setting;
    }

}
