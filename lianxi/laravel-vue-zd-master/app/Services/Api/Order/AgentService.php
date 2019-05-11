<?php
/**
 * Created by PhpStorm.
 * User: fathoo
 * Date: 2018/7/18
 * Time: 14:50
 */

namespace App\Services\Api\Order;

use App\Notifications\Push\Api\Order;
use Exception;

/**
 * Class AgentService
 *
 * @package App\Services\Api\Order
 */
class AgentService extends OrderService
{
    protected $content;

    public function __construct($request, $order, $sms)
    {
        parent::__construct($request, $order, $sms);
    }


    /**
     * 验证
     *
     * @throws Exception
     * @author Mark
     * @date   2018/8/3 14:53
     */
    public function validator()
    {
        if ($this->getOrder()->status != 0) {
            throw new Exception("出车单需要处于未签到阶段");
        }

    }

    /**
     * 处理
     *
     * @param bool $push 是否推送
     *
     * @throws Exception
     * @author Mark
     * @date   2018/8/3 15:01
     */
    public function handle($push = true)
    {
        $this->validator();
        $this->getOrder()->status = 1;
        $this->getOrder()->punch_time = $this->getCurrent();
        $this->getOrder()->is_agent = 1;
        $this->getOrder()->remark = $this->getRemark();
        $this->getOrder()->save();
        //更新大B状态
        $this->getDriver()->is_big_work=1;
        $this->getDriver()->save();
    }


}