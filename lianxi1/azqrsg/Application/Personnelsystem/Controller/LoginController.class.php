<?php
namespace Personnelsystem\Controller;
use Think\Controller;
header("content-type:text/html;charset=utf-8");
class LoginController extends Controller {
    public function Index(){
       if(strlen(session("aUser"))>0){
          $this->success("你已登陆，正在跳转",U("Index"));
       }else{
           $systemName=M("system");
           $rs_systemName=$systemName->field("sLogo,sName,sCopyrightName,sCopyrightAuthor,sCheckCodeSwitch,sVersion,sCopyrightAuthorTel,sCopyrightAuthorQQ")->where("sId=1")->find();
           $this->assign("rs_systemName",$rs_systemName);
            $year=date("Y");
            $this->assign("year",$year);
            $this->display();
       }
    }
    public function CheckLogin(){
            $system=M("system");
            $rs_system=$system->field("sCheckCodeSwitch,sErrorPwdLockNum,sLoginTimeout")->where("sId=1")->find();
            if($rs_system["sCheckCodeSwitch"]==1){
                $Verify = new \Think\Verify;
                if(!$Verify->check($_POST['code'])){
                    $this->error("验证码错误！");
                    return;
                }
             }
            $admin=M("admin");
            $aUser=$_POST["aUser"];
            $aPwd=md5($_POST["aPwd"]);
            $rs=$admin->where("aUser='{$aUser}' OR aTel='{$aUser}'")->find();
            if(count($rs)>0){

                if($rs["aErrorPwdNum"]>=$rs_system["sErrorPwdLockNum"]){
                    $this->error("该账号输入密码错误已达到".$rs_system['sErrorPwdLockNum']."次，被系统锁定","",6);
                }elseif($aPwd==$rs["aPwd"]){
                    if($rs["aStatic"]==0){
                        $this->error("对不起，该账户已被系统管理员停用！","",5); 
                        exit;
                    }else{
                    $aLoginNum=$rs["aLoginNum"]+1;
					$data["aLoginNum"]=$aLoginNum;
					$data["aErrorPwdNum"]=0;
					$admin->where("aUser='{$aUser}' OR aTel='{$aUser}'")->save($data);
                    session("aId",$rs["aId"]);
					session("aUser",$rs["aUser"]);
                    session("aPowers",$rs["aPowers"]);
                    session("aName",$rs["aName"]);
                    session("aDid",$rs["aDid"]);
                    session("aLN",$aLoginNum);
                    session("time",time());
                    $_SESSION['expiretime'] = time() + (($rs_system["sLoginTimeout"])*60);
                    $loginTime=date("Y-m-d H:i:s");
                    session("loginTime",$loginTime);
                    $this->success("登陆成功",U('/Index/'));
                    }
                }else{
                    if($rs["aId"]==1){
                       $this->error("密码不正确"); 
                    }else{
                    $errPwdNum=$data["aErrorPwdNum"]=($rs["aErrorPwdNum"])+1;
                    $admin->where("aUser='{$aUser}' OR aTel='{$aUser}'")->save($data);
                    $this->error("密码不正确，已输入错误".$errPwdNum."次，连续输入错误达到 ".$rs_system["sErrorPwdLockNum"]."次自动锁定","",6);
                    exit;
                    }
                }
            }else{
                if(strlen($aUser)==11 &&  is_numeric($aUser) ==true){
                    $this->error("手机号码不存在");
                    exit;
                }else{
                    $this->error("用户名不存在");
                    exit;
                }
            }
      }     
}
