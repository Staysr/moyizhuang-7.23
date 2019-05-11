<?php
namespace Personnelsystem\Controller;
use Think\Controller;
header("content-type:text/html;charset=utf-8");
class TargetsController extends LoginTrueController {
    public function Models(){
        $this->LoginTrue();
        $month=date("m");
        $this->assign("month",$month);
        $year=date("Y");
        $this->assign("year",$year);
        $aName=session("aName");
        $this->assign("aName",$aName);
        $datetime=date("Y-m-d H:i:s");
        $this->assign("datetime",$datetime);
        $mmodels=M("mmodels");
        $rs_models=$mmodels->where("mMid=1")->find();
        $this->assign("rs_models",$rs_models);
        $this->display();
    }
    public function SetModelsAction(){
        $this->LoginTrue();
        $data["mModel"]=$_POST["mModel"];
        $mmodels=M("mmodels");
        $result=$mmodels->where("mMid=1")->save($data);
        if($result){
            $this->success("保存成功");
        }else{
            $this->error("配置失败");
        }
    }
    public function MonthAdd(){
        $this->LoginTrue();
        $month=date("m");
        $this->assign("month",$month);
        $year=date("Y");
        $this->assign("year",$year);
        $aName=session("aName");
        $this->assign("aName",$aName);
        $datetime=date("Y-m-d H:i:s");
        $this->assign("datetime",$datetime);
        $mmodels=M("mmodels");
        $rs_models=$mmodels->where("mMid=1")->find();
        $this->assign("rs_models",$rs_models);
        $this->display();
    }
    public function MonthAddAction(){
        $this->LoginTrue();
        $mttitle=$data["mtTitle"]=$_POST["mtTitle"];
        $data["mtAname"]=$_POST["mtAname"];
        $data["mtTime"]=$_POST["mtTime"];
        $data["mtContent"]=$_POST["mtContent"];
        $mtablesinfo=M("mtablesinfo");
        $rs_mtablesinfo=$mtablesinfo->where("mtTitle='{$mttitle}'")->count();
        if($rs_mtablesinfo>0){
            $this->error("你已经填写过该月份的信息啦");
        }
        $result=$mtablesinfo->add($data);
        if($result){
            $this->success("添加成功",U("monthlists"));
        }else{
            $this->error("添加失败");
        }
    }
    public function MonthLists(){
        $this->LoginTrue();
        $mtablesinfo=M("mtablesinfo");
        $rs_mtablesinfo=$mtablesinfo->order("mtId desc")->select();
        $this->assign("rs_mtablesinfo",$rs_mtablesinfo);
        $this->display();
    }
    public function MonthOneInfo(){
        $this->LoginTrue();
        $mtId=$_GET["mtId"];
        $mtablesinfo=M("mtablesinfo");
        $rs_mtablesinfo=$mtablesinfo->where("mtId={$mtId}")->find();
        $this->assign("rs_mtablesinfo",$rs_mtablesinfo);
        $this->display();
    }
    public function MonthUpdate(){
        $this->LoginTrue();
        $mtId=$_GET["mtId"];
        $mtablesinfo=M("mtablesinfo");
        $rs_mtablesinfo=$mtablesinfo->where("mtId={$mtId}")->find();
        $this->assign("rs_mtablesinfo",$rs_mtablesinfo);
        $this->display();
    }
    public function MonthUpdateAction(){
        $this->LoginTrue();
        $mtId=$_GET["mtId"];
        $mtablesinfo=M("mtablesinfo");
        $data["mtTitle"]=$_POST["mtTitle"];
        $data["mtAname"]=$_POST["mtAname"];
        $data["mtTime"]=$_POST["mtTime"];
        $data["mtContent"]=$_POST["mtContent"];
        $result=$mtablesinfo->where("mtId={$mtId}")->save($data);
        if($result){
            $this->success("修改成功",U("monthlists"));
        }else{
            $this->error("修改失败");
        }
    }
    public function MonthDel(){
        $this->LoginTrue();
        $mtId=$_GET["mtId"];
        $mtablesinfo=M("mtablesinfo");
        $result=$mtablesinfo->where("mtId={$mtId}")->delete();
        if($result){
            $this->success("删除信息成功",U("monthlists"));
        }else{
            $this->error("删除信息失败");
        }
    }
}