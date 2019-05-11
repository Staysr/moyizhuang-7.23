<?php
/**
 * Created by PhpStorm.
 * User: fathoo
 * Date: 2018/7/18
 * Time: 14:50
 */

namespace App\Services\Api\Order;

use App\Model\ZdDriverDays;
use App\Model\ZdDriverSub;
use App\Notifications\Push\Api\Order;
use Exception;

/**
 * Class CancelService
 *
 * @package App\Services\Api\Order
 */
class CancelService extends OrderService
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
        if (!in_array($this->getOrder()->status, [0, 1, 3])) {
            throw new Exception("出车单需要处于未签到，已签到，或配送完成阶段");
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
        $status=$this->getOrder()->status;
        $this->getOrder()->status = 6;
        $this->getOrder()->cancel_time = $this->getCurrent();
        $this->getOrder()->remark = $this->getRemark();
        $this->getOrder()->save();
        $this->callback($status);
        if ($push == true) {
            $this->push();
        }
    }


    /**
     * 回调
     * @param $status
     *
     * @author Mark
     * @date   2018/8/6 15:24
     */
    public function callback($status)
    {
        ///临时任务且是最后一个出车单
        if ($this->getTask()->type == 2
            && $this->getTask()->temp_end_date
            == $this->getArrivalWarehouseDate()
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
        //删除账单
        if(!empty($this->getBill()) && $this->getBill()->count()==1){
            $this->getBill()->delete();
        }
        //如果之前是完成的
        if ($status == 3) {
            $DriverDay = ZdDriverDays::firstOrNew(
                [
                    'driver_id'   => $this->getOrder()->driver_id,
                    'finish_date' => $this->getToday()
                ],
                [
                    'times'=>0
                ]
            );
            $DriverDay->times--;
            $DriverDay->save();
            $DriverSub = ZdDriverSub::firstOrNew(
                ['driver_id' => $this->getOrder()->driver_id],
                [
                    'complete_count'=>0
                ]
            );
            $DriverSub->complete_count--;
            $DriverSub->save();
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
            "您有一个出车单,被运营取消了,客户：{$this->getMerchant()->short_name},线路：{$this->getTask()->name},出车单号：{$this->getOrder()->order_no},运营设置 {$this->getToday()} 取消"
        );
        $this->getDriver()->notify(new Order($this->getContent()));
        $this->getSms()->create(
            [
                'mobile'   => $this->getDriver()->phone,
                'contents' => $this->getContent(),
                'remark'   => '舟到系统运营取消',
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