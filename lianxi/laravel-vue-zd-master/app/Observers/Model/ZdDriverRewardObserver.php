<?php
/**
 * 司机奖惩观察模型类
 */

namespace App\Observers\Model;


use App\Model\ZdDriverReward;

class ZdDriverRewardObserver
{


    /**
     * 创建
     * @param ZdDriverReward $result
     *
     * @author Mark
     * @date   2018/8/23 14:37
     */
    public function creating(ZdDriverReward $result){
        $result->setAttribute('driver_id', $result->order->driver_id);
        $result->setAttribute('reward_no', $result->createAwardNo());
        $result->setAttribute('user_id', auth('api')->user()->id);
    }


    /**
     * 保存
     * @param ZdDriverReward $result
     *
     * @author Mark
     * @date   2018/8/23 14:55
     */
    public function saving(ZdDriverReward $result){
        $result->user_id=auth('api')->user()->id;
    }

}