<?php

namespace Index\Controller;

use Think\Controller;

class BehaviorController extends BaseController
{
    //公司状况
    public function index()
    {
        $dataname = "dynamic";
        $data = 'type = 1';

        $list = M($dataname)->where($data)
            ->select();
        $this->assign("list", $list);
        $this->display();
    }

    public function ajaxdynamic()
    {
        $dataname = "dynamic";
        $data = 'type = 1';
        $list = $this->selectdata($dataname, $data);
        $count = M('dynamic')->count();
        $msg = '成功';
        $code = 200;
        echo json_encode(['data' => $list, 'code' => $code, 'msg' => $msg, 'count' => $count]);
    }

    //查看更多
    public function addcaa()
    {
        if($_GET['type'] == 'gongsi'){
            $id = I('get.id');
            $statuss = I('get.statuss');
            $dataname = "dynamic";
            $list = M($dataname)->where("id = $id")->find();
            $this->assign("list", $list);
            $this->assign("statuss", $statuss);
            $this->display();

        }else if($_GET['type'] == 'anli'){
            $id = I('get.id');
            $dataname = "case";
            $list = M($dataname)->where("id = $id")->find();
            $this->assign("list", $list);
            $this->display();
        }else{
        $id = I('get.id');

        $dataname = "dynamic";
        $data = "id = $id";
        $list = $this->selectfinddata($dataname, $data);
        // print_r($list);
        $this->assign("list", $list);
        $this->display();
        }
    }

    //公司动态
    public function status()
    {
        $dataname = "dynamic";
        $data = "type = 2 AND is_home =2";
        $list = $this->selectdata($dataname, $data);
//        print_r($list);
        $list1 = M($dataname)->where("type = 2 AND is_home =0")->select();
        $this->assign("list1", $list1);
        $this->assign("list", $list);

        $this->display();
    }
    //
    public function staajax (){
        $dataname = "dynamic";
        $list = M($dataname)->where("type = 2 AND is_home =0")->select();
        $msg = '成功';
        $code = 200;
        echo json_encode(['data' => $list, 'code' => $code, 'msg' => $msg, 'count' => $count]);
    }

    //决绝方案
    public function fangan()
    {
        $id = I('get.id');
        $dataname = "solution";
        $data = "id = $id";
        $list = $this->selectfinddata($dataname, $data);
        $list1 = $this->selectdata($dataname, "");
        $this->assign("list", $list);
        $this->assign("list1", $list1);
        $this->display();
    }
    //分类决绝方案
    public function ajaxlist(){
        $id = I('post.id');
        $dataname = "solution";
        $data = "id = $id";
        $list = $this->selectfinddata($dataname, $data);
        $msg = '成功';
        $code = 200;
        echo json_encode(['data' => $list, 'code' => $code, 'msg' => $msg, 'count' => $count]);
    }
    //anli
  public function anli(){
        $id = I('get.id');
        $list = M('case_class')->select();//分类
      $list1 = M('case')->select();//全部

      $this->assign("list", $list);
      $this->assign("list1", $list1);
      $this->assign("id", $id);

      $this->display();
   }
   //案例
   public function ajaxanli(){
    if (I('post.id') == 9999999999){
        $list = M('case')->select();//全部
        $msg = '成功';
        $code = 200;
        echo json_encode(['data' => $list, 'code' => $code, 'msg' => $msg, 'count' => $count]);
    }else{
//        $iid = I('get.id');
//        print_r($iid);
        $id = I('post.id');
        $data = M('case_class');
        $list = $data
            ->where("tb_case_class.id = $id")
            ->join("tb_case ON tb_case_class.id = tb_case.cid")
            ->field('tb_case.*')
           ->select();
        $msg = '成功';
        $code = 200;
        echo json_encode(['data' => $list, 'code' => $code, 'msg' => $msg, 'count' => $count]);
    }
   }
   //公共的详情
   public function  pubdatalist(){

        $id = I('post.id');
       $add_time = I('post.add_time');

       if(I('post.statuss') == ""){


       if(I('post.type') == "gongsi"){

           $map['add_time']=array('lt',$add_time);//小于


           $map1['add_time']=array('GT',$add_time);//大于

           $name = M("dynamic")->where("type = 2 AND is_home = 0")->where($map)->order("add_time")->limit(1)->select();
           $name = $name[0];
           $name1 = M("dynamic")->where("type = 2 AND is_home = 0")->where($map1)->order("add_time")->limit(1)->select();
           $name1 = $name1[0];
           $msg = '成功';
           $code = 200;
           echo json_encode(['list' => $name, "list1"=>$name1 ,'code' => $code, 'msg' => $msg, 'count' => $count]);

       }else if(I('post.type') == "anli"){

               $map['add_time']=array('lt',$add_time);//小于


           $map1['add_time']=array('GT',$add_time);//大于

           $name = M("case")->where($map)->order("add_time")->limit(1)->select();
           $name = $name[0];

           $name1 = M("case")->where($map1)->order("add_time")->limit(1)->select();
           $name1 = $name1[0];
           $msg = '成功';
           $code = 200;
           echo json_encode(['list' => $name, "list1"=>$name1 ,'code' => $code, 'msg' => $msg, 'count' => $count]);

       }else{

       $map['add_time']=array('lt',$add_time);//小于


       $map1['add_time']=array('GT',$add_time);//大于

        $name = M('dynamic')->where("type = 1")->where($map)->order("add_time")->limit(1)->select();
           $name = $name[0];

       $name1 = M('dynamic')->where("type = 1")->where($map1)->order("add_time")->limit(1)->select();
           $name1 = $name1[0];
       $msg = '成功';
       $code = 200;
       echo json_encode(['list' => $name, "list1"=>$name1 ,'code' => $code, 'msg' => $msg, 'count' => $count]);
         }
       }else{

           $map['add_time']=array('lt',$add_time);//小于


           $map1['add_time']=array('GT',$add_time);//大于

           $name = M("dynamic")->where("type = 2 AND is_home = 2")->where($map)->order("add_time")->limit(1)->select();
           $name = $name[0];
           $name1 = M("dynamic")->where("type = 2 AND is_home = 2")->where($map1)->order("add_time")->limit(1)->select();
           $name1 = $name1[0];
           $msg = '成功';
           $code = 200;
           echo json_encode(['list' => $name, "list1"=>$name1 ,'code' => $code, 'msg' => $msg, 'count' => $count]);
       }
   }
   //合作单位
   public function about_coop (){
       $dataname = "cooperator";
       $data = '';
       $list = $this->selectdata($dataname,$data);
       $this->assign("list", $list);
      $this->display();
   }

   //加入我们
    public function joinus(){
       $list = M('system')->find();
        $this->assign("list", $list);
        $list1 = M('job')->select();
        $this->assign("list1", $list1);
        $this->display();
    }
    //加入我们详情
    public function listman(){
        $id = I('get.id');
        $list = M('job')->where("id = $id")->find();
        $this->assign("list", $list);
        $this->display();
    }

    //全部查询
    private function selectdata($dataname, $data)
    {
        $list = M($dataname)->where($data)->select();
        if ($list) {
            return $list;

        } else {
            return false;
        }
    }

    //$limt查询
    private function selectdatalimt($dataname, $data, $limt)
    {
        $list = M($dataname)->where($data)->limit($limt)->select();
        if ($list) {
            return $list;

        } else {
            return false;
        }
    }

    //查询一条
    private function selectfinddata($dataname, $data)
    {
        $list = M($dataname)->where($data)->find();
        if ($list) {
            return $list;

        } else {
            return false;
        }
    }
}