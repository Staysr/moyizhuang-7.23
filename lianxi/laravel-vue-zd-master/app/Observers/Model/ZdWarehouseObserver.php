<?php
/**
 * 仓库观察模型类
 */

namespace App\Observers\Model;


use App\Model\ZdWarehouse;

class ZdWarehouseObserver
{
    /**
     * 创建事件
     * @param ZdWarehouse $warehouse
     */
    public function created(ZdWarehouse $warehouse){
        $warehouse->merchant->warehouse_count++;
        $warehouse->merchant->save();
    }

    /**
     * 删除事件
     * @param ZdWarehouse $warehouse
     */
    public function deleted(ZdWarehouse $warehouse){
        $warehouse->merchant->warehouse_count--;
        $warehouse->merchant->save();
    }
}