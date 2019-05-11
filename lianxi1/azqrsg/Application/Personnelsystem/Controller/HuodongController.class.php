<?php
namespace Personnelsystem\Controller;
use Think\Controller;
header("content-type:text/html;charset=utf-8");
class HuodongController extends LoginTrueController {
    public function Add(){
        $this->LoginTrue();
        $hdPid=$_GET["hdPid"];
        $this->assign("hdPid",$hdPid);
        $hdmenu=M("hdmenu");
        $rs_hdmenu=$hdmenu->where("hdId={$hdPid}")->find();
        $this->assign("rs_hdmenu",$rs_hdmenu);
        $this->display();
    }
    public function AddAction(){
        $this->LoginTrue();
        $data["hdPid"]=$_POST["hdPid"];
        $data["huodongTitle"]=$_POST["huodongTitle"];
        $data["huodongTime"]=$_POST["huodongTime"];
        $data["huodongContent"]=$_POST["huodongContent"];
        $huodong=M("huodonginfo");
        $result=$huodong->add($data);
        if($result){
            $this->success("添加活动成功");
        }else{
            $this->error("添加活动失败");
        }
    }
    public function Lists(){
        $this->LoginTrue();
        $hdPid=$_GET["hdPid"];
        $huodong=M("huodonginfo");
        $rs_huodong=$huodong->where("hdPid={$hdPid}")->select();
        $this->assign("rs_huodong",$rs_huodong);
        $this->assign("hdPid",$hdPid);
        $hdmenu=M("hdmenu");
        $rs_hdmenu=$hdmenu->where("hdId={$hdPid}")->find();
        $this->assign("rs_hdmenu",$rs_hdmenu);
        $this->display();
    }
    public function Update(){
        $this->LoginTrue();
        $hdPid=$_GET["hdPid"];
        $this->assign("hdPid",$hdPid);
        $huodongId=$_GET["hdId"];
        $hdmenu=M("hdmenu");
        $rs_hdmenu=$hdmenu->where("hdId={$hdPid}")->find();
        $this->assign("rs_hdmenu",$rs_hdmenu);
        $huodong=M("huodonginfo");
        $rs_huodong=$huodong->where("huodongId={$huodongId}")->find();
        $this->assign("rs_huodong",$rs_huodong);
        $this->display();
    }
    public function UpdateAction(){
        $this->LoginTrue();
        $huodongId=$_GET["huodongId"];
        $huodong=M("huodonginfo");
        $data["hdPid"]=$_POST["hdPid"];
        $data["huodongTitle"]=$_POST["huodongTitle"];
        $data["huodongTime"]=$_POST["huodongTime"];
        $data["huodongContent"]=$_POST["huodongContent"];
        $result=$huodong->where("huodongId={$huodongId}")->save($data);
        if($result){
            $this->success("修改成功");
        }else{
            $this->error("修改失败");
        }
    }
    public function DelAction(){
        $this->LoginTrue();
        $huodongId=$_GET["hdId"];
        $huodong=M("huodonginfo");
        $result=$huodong->where("huodongId={$huodongId}")->delete();
        if($result){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }
    }
    public function Show(){
        $this->LoginTrue();
        $hdId=$_GET["hdId"];
        $huodong=M("huodonginfo");
        $rs_huodong=$huodong->where("huodongId={$hdId}")->find();
        $this->assign("rs_huodong",$rs_huodong);
        $hdmenu=M("hdmenu");
        $hdPid=$rs_huodong["hdPid"];
        $this->assign("hdPid",$hdPid);
        $rs_hdmenu=$hdmenu->where("hdId={$hdPid}")->find();
        $this->assign("rs_hdmenu",$rs_hdmenu);
        $this->display();
    }
}