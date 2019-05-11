<?php

namespace App\Services;
use App\Model\ZdPoint as ZdPointModel;
use App\Model\ZdPointTime as ZdPointTimeModel;
use App\Plugins\Amap\Amap;
use Illuminate\Support\Facades\DB;

class PointService
{
    protected $allow = [

    ];
    /**
     * 导入
     * @method   import
     * @DateTime 2017-12-15T16:44:32+0800
     * @param    [type]                   $data [description]
     * @return   [type]                         [description]
     */
    public function import($data)
    {
        $data = Amap::getGeoLocation($data, ['addressKey' => 'address']);
        return $this->_group($data);

    }

    /**
     * 分组
     * @method   _group
     * @DateTime 2017-12-15T17:56:59+0800
     * @param    [type]                   $data [description]
     * @return array [type]               [description]
     */
    private function _group($data)
    {
        $group = [];

        foreach ($data as $value) {
            $key = $value['merchant_id'] . '-' . $value['warehouse_id'] . '-' . date('Y-m-d', intval(strtotime($value['date']))) . date('H:i:s', intval(strtotime($value['date'])));
            if (!isset($group[$key])) {
                $group[$key] = [
                    'warehouse_id' => $value['warehouse_id'],
                    'arrival_warehouse_day' => date('Y-m-d', intval(strtotime($value['date']))),
                    'arrival_warehouse_time' => date('H:i:s', intval(strtotime($value['date']))),
                ];
            }
            $group[$key]['lists'][] = $value;
        }

        return $group;
    }

}
