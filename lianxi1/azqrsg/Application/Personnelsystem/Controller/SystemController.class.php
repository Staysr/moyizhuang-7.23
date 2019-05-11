<?php
namespace Personnelsystem\Controller;
use Think\Controller;
header("content-type:text/html;charset=utf-8");
class SystemController extends LoginTrueController{
    public function System(){
        $this->LoginTrue();
        $systemInfo=M("system");
        $rs_systemInfo=$systemInfo->where("sId=1")->find();
        $this->assign("rs_systemInfo",$rs_systemInfo);
        $this->display();
    }
    public function SystemAction(){
        $this->LoginTrue();
        $data["sName"]=$_POST["sName"];
        $data["sUrl"]=$_POST["sUrl"];
        $data["sCompany"]=$_POST["sCompany"];
        $data["sCompanyTel"]=$_POST["sCompanyTel"];
        $data["sCompanyIntroduce"]=$_POST["sCompanyIntroduce"];
        $data["sDepartment"]=$_POST["sDepartment"];
        if($data["sDepartment"]==""){
            $data["sDepartment"]="部门";
        }
        $data["sCheckCodeSwitch"]=$_POST["sCheckCodeSwitch"];
        $data["sErrorPwdLockNum"]=$_POST["sErrorPwdLockNum"];
        $data["sLoginTimeout"]=$_POST["sLoginTimeout"];
        $data["sCopyrightName"]=$_POST["sCopyrightName"];
        if($data["sCopyrightName"]==""){
            $data["sCopyrightName"]="云南爱之情信息科技有限公司";
        }
        $data["sCopyrightAuthor"]=$_POST["sCopyrightAuthor"];
        if($data["sCopyrightAuthor"]==""){
            $data["sCopyrightAuthor"]="阮金波";
        }
        $data["sCopyrightAuthorTel"]=$_POST["sCopyrightAuthorTel"];
        if($data["sCopyrightAuthorTel"]==""){
            $data["sCopyrightAuthorTel"]="15887835880";
        }
        $data["sCopyrightAuthorQQ"]=$_POST["sCopyrightAuthorQQ"];
        if($data["sCopyrightAuthorQQ"]==""){
            $data["sCopyrightAuthorQQ"]="309091579";
        }
        $sLogo=$_FILES["sLogo"];
		if(strlen($sLogo["name"])>0){
		    $upload = new \Think\Upload();// 实例化上传类
		    $upload->maxSize   =     3145728 ;// 设置附件上传大小
		    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		    $rootPath= $upload->rootPath  =     './'; // 设置附件上传根目录
		    $upload->savePath  =     'Uploads/Logo/'; // 设置附件上传（子）目录
		    $upload->subName=array('date','Ymd');
		    // 上传文件
		    $info   =   $upload->upload();
		    if(!$info) {// 上传错误提示错误信息
		        $this->error($upload->getError());
		    }
		    foreach($info as $file){
		        $imgsUrl= $file['savepath'].$file['savename'];
		    }
		    $data["sLogo"]=$imgsUrl;
		}
        $systemSet=M("system");
        $result=$systemSet->where("sId=1")->save($data);
        if($result){
            $this->success("更新成功");
        }else{
            $this->error("更新失败");
        }
    }
  
}