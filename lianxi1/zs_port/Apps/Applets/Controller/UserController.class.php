<?php

/**
 * 用户中心
 */

namespace Applets\Controller;

use Common\Controller\AppletsController;
use Applets\Model\IntegralModel;

class UserController extends AppletsController {

    public function __construct() {
        parent::__construct();
        $tmpData = $this->getPost("data");
        $this->postData = $this->decrypt($tmpData);
        $this->IntegralModel = new IntegralModel();
        $this->userModel = M('user');
        $this->configModel = M('config');
        $this->orderModel = M('order');
        $this->albumModel = M('album');
        $this->controllerAction = CONTROLLER_NAME .'/'. ACTION_NAME .'/';
        if($this->postData['action'] != $this->controllerAction) {
            $this->arrReturn('',"非法提交","-1");
            exit();
        }
    }

    /**
     *  获取openid
     */

     public function getsessionkey(){
         $aData = $this->postData;
             $appid = $this->configModel->find(1)['appid'];
             $secret = $this->configModel->find(1)['appsecret'];

         $code = trim($aData['code']);

         if (!$code) {
             $this->arrReturn('',"非法操作","-1");
             exit();
         }

         if (!$appid || !$secret) {
             $this->arrReturn('',"配置错误","-1");
             exit();
         }

         $curl = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$appid.'&secret='.$secret.'&js_code='.$code.'&grant_type=authorization_code';
         $curl = sprintf($curl,$appid,$secret,$code);
         $info = file_get_contents($curl);//发送HTTPs请求并获取返回的数据
         $json = json_decode($info);//对json数据解码
         $arr = get_object_vars($json);
         $this->arrReturn($arr,"成功","200");
         exit();
     }
    /**
     *  授权登录
     */
       public function authlogin(){
           $aData = $this->postData;
           $openid = trim($aData['openid']);

           if (!$openid) {
               $this->arrReturn('',"授权失败","0");
               exit();
           }
           $con = array();
           $con['openid'] = $openid;

           $wxinfo = $this->userModel->where($con)->find();

           if($wxinfo){
               $err = array();
               $this->userModel->where("id = {$wxinfo['id']}")->setInc('open_num');
               $err['ID'] = intval($wxinfo['id']);
               $this->arrReturn($err,"成功","2");
           } else{                                     //新用户
               $data = array();
               $data['openid'] = $aData['openid'];
               $data['add_time'] = time();
               $data['open_num'] = 1;
               $data['update_time'] = date("Y-m-d H:i:s");
               $res = $this->userModel->add($data);
               if ($res) {
                   $err = array();
                   $err['ID'] = intval($res);
                   $this->arrReturn($err,"成功","2");
               }else{
                   $this->arrReturn('',"授权失败!","0");
                   exit();
               }
           }
       }
       /**
       更新用户信息
        */
 public function info(){
     $aData = $this->postData;
     $uid = $aData['uid'];
     $aData['userInfo']['status'] = 1;
     $result = $this->userModel->where("id = {$uid}")->save($aData['userInfo']);
     $this->arrReturn($result,"成功",200);
 }
    /**
     *  个人中心首页
     */
    public function index(){
        //积分
        $integral = $this->IntegralModel->user_integral($this->postData['uid']);
        if(date('Ymd', $integral['stime']) != date('Ymd')){
            $integral['is_sign'] = false;
        }
        $data = array();
        $data['integral'] = $integral;
        $this->arrReturn($data,"成功",200);
    }
//积分详情
    public function integral_detail(){
        $integral = $this->IntegralModel->user_integral($this->postData['uid']);
        $integral_detail = $this->IntegralModel->integral_detail($this->postData['uid']);
        $data = array();
        $data['integral'] = $integral;
        $data['integral_detail'] = $integral_detail;
        $this->arrReturn($data,"成功",200);
    }

    /**
     *  签到
     */
 public function sign(){
     $aData = $this->postData;
     $uid = $aData['uid'];
     if(!$uid)$this->arrReturn("","未登录",201);
     $type = 1;

    $sign = $this->IntegralModel->inte_detail($type,$uid);
    $this->arrReturn($sign['data'],$sign['info'],$sign['start']);
 }
 /*我的订单*/
    public function my_order(){
        $aData = $this->postData;
        $uid = $aData['uid'];
        $order = $this->orderModel->field("album_id,title,price,integral,order_type,pay_time")->where("user_id = {$uid} and status = 2")->order("pay_time desc")->limit(20)->select();
        if($order){
            foreach ($order as $key=>$item){
                $album = $this->pic_host($this->albumModel->field("pic,memo1")->where("id = {$item['album_id']}")->find(),"pic");
                $order[$key]['album_pic'] = $album['pic'];
                $order[$key]['memo1'] = $album['memo1'];
                $order[$key]['pay_time'] = date("Y-m-d H:i:s",$item['pay_time']);
            }
        }
        $this->arrReturn($order,"成功",200);
    }
}
