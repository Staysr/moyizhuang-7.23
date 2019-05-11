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
class InfoService extends OrderService
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
            throw new \Exception("出车单只有在未签到状态才能通知司机");
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
        if ($push == true) {
            $this->push();
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
            "您有一个出车单配送点有变更，请您按变更后的配送点送货,客户：{$this->getMerchant()->short_name},线路：{$this->getTask()->name},出车单号{$this->getOrder()->order_no},到仓时间 {$this->getOrder()->arrival_warehouse_time}"
        );
        $this->getDriver()->notify(new Order($this->getContent()));
        $this->getSms()->create(
            [
                'mobile'   => $this->getDriver()->phone,
                'contents' => $this->getContent(),
                'remark'   => '舟到系统改变配送点',
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