<?php
namespace Personnelsystem\Controller;
use Think\Controller;
header("content-type:text/html;charset=utf-8");
class HdmenuController extends LoginTrueController {
    public function Add(){
        $this->LoginTrue();
        $this->display();
    }
    public function AddAction(){
        $this->LoginTrue();
        $data["hdName"]=$_POST["hdName"];
        $hdIco=$_FILES["hdIco"];
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg', 'doc', 'docx', 'xls', 'xlsx', 'rar', 'zip', '7z');// 设置附件上传类型
        $rootPath= $upload->rootPath  =     './'; // 设置附件上传根目录
        $upload->savePath  =     'Uploads/hdmico/'; // 设置附件上传（子）目录
        $upload->subName=array('date','Ymd');
        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }
        foreach($info as $file){
            $icoUrl= $file['savepath'].$file['savename'];
        }
        $data["hdIco"]=$icoUrl;
        $hdmenu=M("hdmenu");
        $result=$hdmenu->add($data);
        if($result){
            $this->success("添加活动菜单成功",U("lists"));
        }else{
            $this->error("添加活动菜单失败");
        }
    }
    public function Lists(){
        $this->LoginTrue();
        $hdmenu=M("hdmenu");
        $rs_hdmenu=$hdmenu->select();
        $this->assign("rs_hdmenu",$rs_hdmenu);
        $this->display();
    }
    public function Update(){
        $this->LoginTrue();
        $hdId=$_GET["hdId"];
        $hdmenu=M("hdmenu");
        $rs_hdmenu=$hdmenu->where("hdId={$hdId}")->find();
        $this->assign("rs_hdmenu",$rs_hdmenu);
        $this->display();
    }
    public function UpdateAction(){
        $this->LoginTrue();
        $hdId=$_GET["hdId"];
        $hdmenu=M("hdmenu");
        $data["hdName"]=$_POST["hdName"];
        $hdIco=$_FILES["hdIco"];
        if(strlen($hdIco["name"])>0){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg', 'doc', 'docx', 'xls', 'xlsx', 'rar', 'zip', '7z');// 设置附件上传类型
            $rootPath= $upload->rootPath  =     './'; // 设置附件上传根目录
            $upload->savePath  =     'Uploads/hdmico/'; // 设置附件上传（子）目录
            $upload->subName=array('date','Ymd');
            // 上传文件
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }
            foreach($info as $file){
                $icoUrl= $file['savepath'].$file['savename'];
            }
            $data["hdIco"]=$icoUrl;
        }
        $result=$hdmenu->where("hdId={$hdId}")->save($data);
        if($result){
            $this->success("修改活动菜单成功",U("lists"));
        }else{
            $this->error("修改活动菜单失败");
        }
    }
    public function DelAction(){
        $this->LoginTrue();
        $hdId=$_GET["hdId"];
        $hdmenu=M("hdmenu");
        $result=$hdmenu->where("hdId={$hdId}")->delete();
        if($result){
            $this->success("删除菜单成功");
        }else{
            $this->error("删除菜单失败");
        }
    }
}