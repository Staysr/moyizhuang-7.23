<?php
/**
 * Created by PhpStorm.
 * User: fathoo
 * Date: 2018/7/18
 * Time: 14:50
 */

namespace App\Services\Api\Order;

use App\Notifications\Push\Api\Order;
use App\Services\Api\Task\TaskConflictService;
use Exception;

/**
 * Class DispatchService
 *
 * @package App\Services\Api\Order
 */
class DispatchService extends OrderService
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
        if ($this->getOrder()->status != 4) {
            throw new \Exception("出车单需要处于不配送状态");
        }
        //任务冲突
        $Conflict = new TaskConflictService($this->getTask());
        if ($Conflict->taskConflict() === false) {
            throw new Exception(
                "司机在您设置不配送后，已指派其他该时段的任务，您将不能再设置配送！如需帮助，请联系岗控经理"
            );
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
        $this->getOrder()->status = 0;
        $this->getOrder()->save();
        if ($push == true) {
            $this->push();
        }
    }

    /**
     * 回调
     *
     * @author Mark
     * @date   2018/8/7 10:51
     */
    public function push()
    {
        $this->setContent(
            "您有一个出车单状态有变更，由不配送变更为配送,客户：{$this->getMerchant()->short_name}，线路：{$this->getTask()->name}，出车单号：{$this->getOrder()->order_no}，到仓时间 {$this->getArrivalWarehouseDate()}"
        );
        $this->getDriver()->notify(new Order($this->getContent()));
        $this->getSms()->create(
            [
                'mobile'   => $this->getDriver()->phone,
                'contents' => $this->getContent(),
                'remark'   => '舟到系统修改到仓时间',
            ]
        );

    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }


}