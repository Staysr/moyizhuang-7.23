<?php

namespace App\Services\Api\Task;

use Exception;

/**
 * Class AbandonService
 *
 * @package App\Services\Api\Task
 */
class AbandonService extends TaskService
{


    public function __construct($request, $task, $sms)
    {
        parent::__construct($request, $task, $sms);
    }


    /**
     * 验证
     *
     * @throws Exception
     * @author Mark
     * @date   2018/8/14 11:55
     */
    public function validator()
    {
        if (!empty( $this->getTask()->driver_id)) {
            throw new Exception("已有司机被选中");
        }
        if (time() > strtotime($this->getTask()->offer_end_time)) {
            throw new Exception("司机报价已截止，任务无法作废");
        }

    }

    /**
     * 处理
     * @throws Exception
     * @author Mark
     * @date   2018/8/14 14:35
     */
    public function handle()
    {
        $this->validator();
        $this->getTask()->driver_id = 0;
        $this->getTask()->status = 6;
        $this->getTask()->remark = $this->getRemark();
        $this->getTask()->save();
    }
}
