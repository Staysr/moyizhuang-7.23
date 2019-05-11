<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/9
 * Time: 3:27
 */
namespace Applets\Model;

use Think\Model;

class PayModel extends Model
{
    /* 支付平台 */

    const WEIXIN_PAY_CODE = 1; //微信支付
    const ALIPAY_PAY_CODE = 2; //支付宝支付

    /* 支付方式 */
    const PAY_APP_CODE = 1; //小程序
    /* 订单相关 */

    private $orderInfo = array(); //订单信息

    public function __construct($orderInfo = array()) {
        $this->orderInfo = $orderInfo;
    }
    /**
     * 执行支付
     * @return type
     */
    public function pay() {
        if (empty($this->orderInfo) || !is_array($this->orderInfo)) {
            return failed('没有要支付的订单数据', 519);
        }

        //微信支付
        if ($this->orderInfo['pay_platform'] == self::WEIXIN_PAY_CODE) {
            $param = array();
            $param['out_trade_no'] = $this->orderInfo['order_id'];
            $param['body'] = $this->orderInfo['title'];
            $param['total_fee'] = $this->orderInfo['price'] * 100;
            if ($this->orderInfo['source'] == 1) { //微信小程序支付
                $platformModel = new WeixinModel(C('WXCX'));
                $param['openid'] = $this->orderInfo['openid'];
            }

            return $platformModel->unifiedOrder($param);
        }

        //支付宝支付
        if ($this->orderInfo['pay_platform'] == self::ALIPAY_PAY_CODE) {

        }


        //不需要支付的情况
        return failed('未知的支付方式', 521);
    }
}