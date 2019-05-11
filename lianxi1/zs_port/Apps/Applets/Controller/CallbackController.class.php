<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/9
 * Time: 4:18
 */
namespace Applets\Controller;

use Common\Controller\AppletsController;
use Applets\Model\OrderModel;
use Applets\Model\WeixinModel;

class CallbackController extends AppletsController
{
    /**
     * 构造方法
     */
    public function __construct() {
        parent::__construct();
        $this->orderModel = new OrderModel();
    }

    /**
     * 微信小程序支付异步同知接口v1.0
     * 需要改进的问题
     * 1, 把解析xml的数据保存到数据库
     * (小程序断返回支付成功后更新订单 暂不使用回调)
     */
    public function wxcx() {
        $xml = file_get_contents("php://input"); //接收post数据
        return true;
        //实例化微信处理类
        $weixinModel = new WeixinModel(C('WXCX'));
        //校验数据
        $result = $weixinModel->notify($xml);
        //判断处理结果
        if ($result['status'] == 200) {
            $orderInfo = $result['data'];
            $this->orderModel->setPaySuccess($orderInfo['out_trade_no'], null, $orderInfo['total_fee'] / 100, 1);
            //正常回复
            $weixinModel->replyNotify(true);
        } else {
            //异常回复
            $weixinModel->replyNotify(false, $result['msg']);
        }
    }

    /**
     * 支付宝异步通知接口v1.0
     */
    public function alipay() {

    }
}