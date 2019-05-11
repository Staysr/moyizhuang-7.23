<?php
/**
 * User: Liu zn
 * Date: 2018/11/27 21:40
 */
namespace Applets\Controller;

use Common\Controller\AppletsController;

class LotterController extends AppletsController
{
    public function __construct()
    {
        parent::__construct();
        $tmpData = $this->getPost("data");
        $this->postData = $this->decrypt($tmpData);
        $this->lotteryModel = M('lottery');
		$this->IntegralModel = D('integral');
		$this->ints = 3; //需要积分
    }
    public function index(){
        $list = $this->lotteryModel->where("status = 1")->select();
		$arr = array();
		$arr['list'] = $list;
		$arr['ints'] = $this->ints;
        $this->arrReturn($arr, "成功", 200);
    }
    public function rotate(){
        if(!isset($this->postData['uid'])){
            $this->arrReturn('', "参数错误", 201);
        }
		$uid = $this->postData['uid'];
		//判断积分是否足够
		$integral = $this->IntegralModel->user_integral($uid)['integral'];
        if(!$integral || $integral < $this->ints){
            $this->arrReturn('', "积分不足", 201);
        }

  //减积分
		 $this->IntegralModel->reduce($uid,$this->ints,3);

        $list = $this->lotteryModel->where("status = 1")->order("id desc")->select();
        //如果中奖数据是放在数据库里，这里就需要进行判断中奖数量
//在中1、2、3等奖的，如果达到最大数量的则unset相应的奖项，避免重复中大奖
//code here eg:unset($prize_arr['0'])
        foreach ($list as $key => $val) {
            $arr[$val['id']] = $val['prob'];
        }

        $rid = $this->get_rand($arr); //根据概率获取奖项id

        $res = $list[$rid-1]; //中奖项
//将中奖项从数组中剔除，剩下未中奖项，如果是数据库验证，这里可以省掉
        unset($list[$rid-1]);
        shuffle($list); //打乱数组顺序
        for($i=0;$i<count($list);$i++){
            $pr[] = $list[$i]['title'];
        }
        //$res['no'] = $pr;
        //print_r($res);
		//增加积分
		if($res['int_num'] > 0){
			$this->IntegralModel->plus($uid,$res['int_num'],3);	
		}
		
		
		$this->arrReturn($res, "成功", 200);
    }

    /**
     * 概率算法
     * @param $proArr
     * @return int|string
     */
    function get_rand($proArr) {
        $result = '';

        //概率数组的总概率精度
        $proSum = array_sum($proArr);

        //概率数组循环
        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        unset ($proArr);

        return $result;
    }
}