<?php

namespace App\Services\Api\Task;

use Exception;


/**
 * Class DeleteService
 *
 * @package App\Services\Api\Task
 */
class DeleteService extends TaskService
{


    public function __construct($request, $task, $sms)
    {
        parent::__construct($request, $task, $sms);
    }


    /**
     * 验证
     * @throws Exception
     * @author Mark
     * @date   2018/8/14 11:55
     */
    public function validator()
    {
        if (!in_array($this->getTask()->status, [3, 4, 5, 6])) {
            throw new Exception("任务状态必须为无司机报价、客户不选司机、过期不选司机、任务作废之一");
        }

    }


    /**
     * 处理
     * @throws Exception
     * @author Mark
     * @date   2018/8/14 14:35
     */
    public function handle(){
        $this->validator();
        $this->getTask()->delete();
    }
}
