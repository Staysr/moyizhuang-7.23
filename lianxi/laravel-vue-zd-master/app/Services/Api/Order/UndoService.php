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
 * Class UndoService
 *
 * @package App\Services\Api\Order
 */
class UndoService extends OrderService
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
        if ($this->getOrder()->status == 4) {
            throw new \Exception("该出车单已设置为不配送");
        }

        $dispatch = $this->getConfig()[$this->getTaskType()
        .'_driver_not_dispatch_before_warehouse'];

        if (strtotime($this->getOrder()->arrival_warehouse_time)
            - $this->getTime() < $dispatch
            * 3600
        ) {
            throw new \Exception("设置不配送需要在到仓时间前".$dispatch."小时");
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
        $this->getOrder()->status = 4;
        $this->getOrder()->cancel_count++;
        $this->getOrder()->undo_time = $this->getCurrent();
        $this->getOrder()->remark = $this->getRemark();
        $this->getOrder()->save();
        $this->callback();
        if ($push == true) {
            $this->push();
        }
    }


    /**
     * 回调
     *
     * @author Mark
     * @date   2018/8/3 15:34
     */
    public function callback()
    {
        ///临时任务且是最后一个出车单
        if ($this->getTask()->type == 2
            && $this->getTask()->temp_end_date == $this->getArrivalWarehouseDate()
        ) {
            $i = 0;
            $orderAll = $this->getOrderAll()->pluck(['status'])->toArray();
            foreach ($orderAll as $index => $item) {
                if ($item == 4 || $item == 6) {
                    $i++;
                }
            }
            if ($i == count($orderAll)) {
                $this->getTask()->fill(['driver_status' => 4])->save();
            }
        }
    }

    /**
     * 推送
     *
     * @author Mark
     * @date   2018/8/3 15:35
     */
    public function push()
    {
        $this->setContent(
            "您有一个出车单,设置为不配送,客户：{$this->getMerchant()->short_name},线路：{$this->getTask()->name},出车单号{$this->getOrder()->order_no},客户设置 {$this->getToday()}不配送"
        );
        $this->getDriver()->notify(new Order($this->getContent()));
        $this->getSms()->create(
            [
                'mobile'   => $this->getDriver()->phone,
                'contents' => $this->getContent(),
                'remark'   => '舟到系统设置不配送',
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