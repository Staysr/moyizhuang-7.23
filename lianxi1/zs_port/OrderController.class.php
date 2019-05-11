<?php
/**
 * Date: 2018/11/8
 * Time: 19:27
 * User: Liu
 * Email: <1938232816@qq.com>
 */
namespace Applets\Controller;

use Common\Controller\AppletsController;
use Applets\Model\OrderModel;
use Applets\Model\UserModel;
use Applets\Model\PayModel;

class OrderController extends AppletsController
{
    /**
     * 构造方法，自动解析post请求数据
     */
    public function __construct()
    {
        parent::__construct();
        $tmpData = $this->getPost("data");
        $this->postData = $this->decrypt($tmpData);
       //订单模型
        $this->orderModel = new OrderModel();
        //用户模型
        $this->userModel = new UserModel();
    }

    /**
     * 下订单接口
     * @param type $token 用户信息
     * @param type $id 课程实例
     * @param type $source 客户端 1、微信小程序
     * @param type $pay_platform 支付平台 1、微信小程序
     * @param type $pay_type 支付方式，默认1:微信小程序
     */
    public function createOrder()
    {
        $token = isset($this->postData['token']) ? $this->postData['token'] : null;
        //专辑id
        $album_id = isset($this->postData['id']) ? (int)$this->postData['id'] : null;
        //客户端
        $source = isset($this->postData['source']) ? (int)$this->postData['source'] : null;
        //支付渠道
        $payPlatform = isset($this->postData['pay_platform']) ? (int)$this->postData['pay_platform'] : null;
        //支付类型默认1(微信小程序支付)
        $payType = isset($this->postData['pay_type']) ? (int)$this->postData['pay_type'] : 1;
        //收货地址
        $addressId = isset($this->postData['address_id']) ? (int)$this->postData['address_id'] : 0;
        //openid
        $openid = isset($this->postData['openid']) ? $this->postData['openid'] : null;

        if (empty($token)) {
            $this->arrReturn("","用户不存在",100);
        }
        if (empty($album_id)) {
            $this->arrReturn("","专辑不存在",301);
        }
        if (empty($source)) {
            $this->arrReturn("","需要标识客户端",307);
        }

        $userResult = $this->userModel->getUser($token, 1 , $openid);
        if ($userResult['status'] != 200) {
            $this->arrReturn("", $userResult['msg'], $userResult['status']);
        }
        //用户信息
        $userInfo = $userResult['data'];
        //执行创建订单
        $orderResult = $this->orderModel->createOrder($userInfo['id'], $album_id, $source, $payPlatform, $payType, $addressId);
        if ($orderResult['status'] != 200) {
            $this->arrReturn("", $orderResult['msg'], $orderResult['status']);
        }
        $orderInfo = $orderResult['data'];
        $orderInfo['openid'] = $openid;
        //免费不需要支付。直接返回
        if ($orderInfo['price'] == 0) {
            $this->arrReturn(array('order_info' => $orderInfo), $orderResult['msg'], 200);
        }
        //积分支付直接反回
        if ($orderInfo['price'] == 3) {
            $this->arrReturn(array('order_info' => $orderInfo), $orderResult['msg'], 200);
        }
        //支付
        $payModel = new PayModel($orderInfo);
        $payResult = $payModel->pay();
        $returnData = array(
            'order_info' => $orderInfo,
            'pay_info' => $payResult['data']
        );
        $this->arrReturn($returnData, $payResult['msg'], $payResult['status']);
    }

    /**
     * 更新订单
     */
    public function setPay(){

      $PaySuccess = $this->orderModel->setPaySuccess($this->postData['orderId'], $this->postData['uid'], $this->postData['price'], 1);
        $this->arrReturn($PaySuccess['data'],$PaySuccess['msg'],$PaySuccess['status']);

    }

}