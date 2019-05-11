<?php
/**
 * Date: 2018/11/2
 * Time: 16:06
 * User: Liu
 * Email: <1938232816@qq.com>
 */
namespace Applets\Model;

use Think\Model;

class IntegralModel extends Model {

    /**
     * 积分
     * @param $type 1、签到
     */
    public function inte_detail($type,$uid){

        if ($type == 1){
            $sign = $this->where("uid = {$uid}")->find();
            $data = array();
            $data['stime'] = time();
            $data['is_sign'] = 1;
            $data['uid'] = $uid;
            //判断是否存在
            if($sign){
                if($sign['is_sign'] == 1 && date('Ymd', $sign['stime']) == date('Ymd')){
                    return array("data"=>"","info"=>"今日已签到","start"=>201);
                }
                if($this->yesterdaySign($sign['stime'])){ //昨天签到
                    $data['days'] = $sign['days'] + 1;
                }else{
                    $data['days'] = 1;
                }
                $Increase_number = $this->getTodayScores($data['days']);//要增加的积分
                $data['integral'] = $sign['integral'] + $Increase_number;
                $this->where("uid = {$uid}")->save($data);
            }else{
                $Increase_number = $this->getTodayScores(1);//要增加的积分
                $data['add_time'] = time();
                $data['days'] = 1;
                $data['integral'] = $sign['integral'] + $Increase_number;
                $this->add($data);
            }
            $current = $sign['integral'] + $Increase_number;
            M("integral_detail")->add(array("uid"=>$uid,"type"=>$type,"add_time"=>time(),"detail"=>"+{$Increase_number}","current"=>$current));
            return array("data"=>$data,"info"=>"签到成功","start"=>200);
        }
    }

    /**
     * @param $uid
     * @return array|false|\PDOStatement|string|Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */

    public function user_integral($uid){
        return $this->where("uid = {$uid}")->find();
    }

    public function integral_detail($uid){
        return M('integral_detail')->field("from_unixtime(add_time,'%Y-%m-%d %H:%i:%s') as date,type,detail")->where("uid = {$uid}")->order('id desc')->select();
    }

    /**
     * @param $uid
     * @param $num 积分数
     * @param $type 类型 2、专辑购买,3、抽奖
     */
    public function reduce($uid,$num,$type=2){
        //减去积分
        $this->where("uid = {$uid}")->setDec('integral',$num);
        //增加详情
        $data = array();
        $data['current'] = $this->user_integral($uid)['integral'];
        $data['type'] = $type;
        $data['uid'] = $uid;
        $data['add_time'] = time();
        $data['detail'] = "-{$num}";
        M('integral_detail')->add($data);
    }

	   /**
     * @param $uid
     * @param $num 积分数
     * @param $type 类型 ,3、抽奖
     */
    public function plus($uid,$num,$type=2){
        //增加积分
        $this->where("uid = {$uid}")->setInc('integral',$num);
        //增加详情
        $data = array();
        $data['current'] = $this->user_integral($uid)['integral'];
        $data['type'] = $type;
        $data['uid'] = $uid;
        $data['add_time'] = time();
        $data['detail'] = "+{$num}";
        M('integral_detail')->add($data);
    }
	
    /**
     * @param $time
     * @return bool
     */
    public function yesterdaySign($time){
        //判断昨天是否签到
        //获取今天凌晨的时间戳
        $day = strtotime(date('Y-m-d',time()));
        //获取昨天凌晨的时间戳
        $pday = strtotime(date('Y-m-d',strtotime('-1 day')));
        if($time<$day && $time>$pday) { //昨天签到
            return true;
        }else{
            return false;
        }
    }
    /**
     * 积分规则，返回连续签到的天数对应的积分
     *
     * @param int $days 当天应该得的分数
     * @return int 积分
     */
    protected function getTodayScores($days){
        if($days == 1){
            return 5;
        }else if($days == 2){
            return 10;
        }else if($days == 3){
            return 15;
        }else if($days > 3){
            return 20;
        }
    }

}