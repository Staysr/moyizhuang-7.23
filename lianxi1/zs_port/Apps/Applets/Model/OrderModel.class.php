<?php
/**
 * Date: 2018/11/8
 * Time: 19:47
 * User: Liu
 * Email: <1938232816@qq.com>
 */
namespace Applets\Model;

use Think\Model;

class OrderModel extends Model
{
    public $AlbumModel;
    public $IntegralModel;

    public function __construct() {
        parent::__construct();
        //专辑实例模型
        $this->AlbumModel = new AlbumModel();
        $this->IntegralModel = new IntegralModel();
    }

    /**
     * 创建订单
     * @param type $userId      用户id
     * @param type $albumId  课程实例
     * @param type $source      客户端标识1微信小程序
     * @param type $payPlatform 支付平台：1微信，2支付宝
     * @param type $payType     支付类型：1微信小程序
     * @param type $addressId   收货地址id
     * @return type
     */
    public function createOrder($userId, $albumId, $source = 0, $payPlatform = 0, $payType = 1 ,$addressId = 0) {

        $time = time();
        $album = $this->AlbumModel->find($albumId);

        if (empty($album)) {
            return failed('专辑不存在', 301);
        }

        //是否上架
        if (!in_array($album['status'], array(1))) {
            return failed('专辑已下架', 302);
        }

        //校验是否已经有成功支付的同个实例，防止重复购买
        $isHas = $this->where("user_id = {$userId} and album_id = {$albumId} and `status` > 1")->select();
        if (!empty($isHas)) {
            return failed('已成功购买此专辑，请勿重复购买', 305);
        }

        //收费课需要批定支付平台
        if ($album['price'] > 0 && !$payPlatform && $source == 1) {
            return failed('需要指定订单的支付平台', 308);
        }
        $integral = 0;
        //处理付款类型
       if($album['is_free'] == 2){
           $price = $album['price'];
       }elseif($album['is_free'] == 3){
           $integral = $this->IntegralModel->user_integral($userId)['integral'];
           if(!$integral || $integral < $album['price'] * 100){
               return failed('积分不足', 700);
           }else{
               $integral = $album['price'] * 100;
               //减积分
               $this->IntegralModel->reduce($userId,$album['price'] * 100,2);
           }
           $price = 0;
       }elseif($album['is_free'] == 4){
           $integral = $this->IntegralModel->user_integral($userId)['integral'];
           if(!$integral || $integral < $album['integral_max']){
               $integral = 0;
               $price = $album['price'];
           }else{
               $price = $album['price'] - $album['integral_max'] / 100;
               $integral = $album['integral_max'];
           }
       }


        $orderId = $this->createOrderId(); //订单号
        $orderData = array(
            'order_id' => $orderId,
            'user_id' => $userId,
            'album_id' => $albumId,
            'title' => $album['title'],
            'album_type' => $album['album_type_one'],
            'price' => $price,
            'integral' => $integral,
            'add_time' => $time,
            'source' => (int) $source,
            'pay_platform' => (int) $payPlatform,
            'pay_type' => (int) $payType,
            'address_id' => (int) $addressId,
            'order_type' => $album['is_free']
        );

        //免费专辑直接设置为支付成功 分支付直接设置为成功
        if ($album['price'] == 0 || $album['is_free'] == 3) {
            $orderData['status'] = 2;
            $orderData['pay_time'] = $time;
        }

        $result = $this->add($orderData);
        if ($result) {
            if ($album['price'] == 0 || $album['is_free'] == 3) {
                $this->AlbumModel->addUp($albumId);
            }
            return success($orderData);
        } else {
            return failed('购买失败', 306);
        }
    }

    /**
     * 支付成功更新订单
     * @param type $orderId 订单id
     * @param type $userId  用户id
     * @param type $price   支付金额
     * @param type $payTime 支付时间
     * @return type
     */
    public function setPaySuccess($orderId, $userId = null, $price = null, $source = 0, $payTime = null) {

        if (empty($orderId) || !is_numeric($orderId)) {
            return failed('订单不存在', 400);
        }
        $info = $this->where("order_id = {$orderId}")->find();

        if (empty($info)) {
            return failed('订单不存在', 400);
        }

        if ($userId && $info['user_id'] != $userId) {
            return failed('订单用户错误', 401);
        }

//        if ($info['price'] != $price) {
//            return failed('订单金额错误', 404);
//        }

        if ($info['status'] == 2) {
            return failed('订单已经支付', 402);
        }

        if ($info['status'] != 1) {
            return failed('订单已经失效或结束', 403);
        }
        if($info['order_type'] == 4 && $info['integral']){
            //减积分
            $this->IntegralModel->reduce($userId,$info['integral'],2);
        }

        $param = array();
        $param['status'] = 2;
        $param['pay_time'] = $payTime && is_numeric($payTime) ? $payTime : time();
        $result = $this->where("order_id = {$orderId}")->save($param);
        if ($result) {
            //统计购买人数
            $this->AlbumModel->addUp($info['album_id']);
            return success($info);
        } else {
            return failed('更新订单失败', 405);
        }
    }

    /**
     * 创建订单号v1.0
     * 待优化
     * @return type
     */
    public function createOrderId() {
        return date("YmdHis") . mt_rand(1000, 9999);
    }
}