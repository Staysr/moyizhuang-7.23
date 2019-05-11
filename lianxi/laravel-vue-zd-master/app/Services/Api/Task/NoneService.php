<?php

namespace App\Services\Api\Task;

use Exception;

/**
 * Class NoneService
 *
 * @package App\Services\Api\Task
 */
class NoneService extends TaskService
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
        if (!empty($this->getTask()->driver_id)) {
            throw new Exception("已有司机被选中");
        }
        if ($this->getTask()->status != 1) {
            throw new Exception("该任务不处于选择司机中状态");
        }
        if ($this->getTask()->getOriginal('driver_status')==5) {
            throw new Exception("司机状态已无责任解约");
        }

    }

    /**
     * 处理
     *
     * @throws Exception
     * @author Mark
     * @date   2018/8/14 14:35
     */
    public function handle()
    {
        $this->validator();
        $this->getTask()->driver_id = 0;
        $this->getTask()->status = 3;
        $this->getTask()->remark = $this->getRemark();
        $this->getTask()->save();
    }
}
