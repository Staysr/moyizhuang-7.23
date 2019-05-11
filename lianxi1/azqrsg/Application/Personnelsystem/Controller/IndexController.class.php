<?php
namespace Personnelsystem\Controller;
use Think\Controller;
header("content-type:text/html;charset=utf-8");
class IndexController extends CalendarsController {
    public function Index(){
        $this->LoginTrue();
        $systemName=M("system");
        $rs_systemName=$systemName->field("sName,sDepartment,sCopyrightName,sCopyrightAuthor,sVersion,sCopyrightAuthorTel,sCopyrightAuthorQQ")->where("sId=1")->find();
        $this->assign("rs_systemName",$rs_systemName);
        $aUser=session("aUser");
        $this->assign("aUser",$aUser);
        $logintime=session("loginTime");
        $this->assign("logintime",$logintime);
        $aName=session("aName");
        $this->assign("aName",$aName);
        $aPowers=session("aPowers");
        $admin_role=M("admin_role");
        if($aPowers==0){
            $powersName="系统管理员";
            $powersValue="0";
        }else{
            $rs_role=$admin_role->where("arId={$aPowers}")->field("arName,arPowers")->find();
            $powersName=$rs_role["arName"];
            $powersValue=$rs_role["arPowers"];
            $morepowersValue=$powersValue;
            $powersValue=explode("-", $powersValue);
        }
        $this->assign("powersName",$powersName);
        $this->assign("morepowersValue",$morepowersValue);
        $this->assign("powersValue",$powersValue);
        $aDid=session("aDid");
        $department=M("department");
        $this->assign("aDid",$aDid);
        $rs_department=$department->where("dId={$aDid}")->find();
        $this->assign("rs_department",$rs_department);
        //获取当前日期
        $this->NowToday();
        // 活动自定义菜单
        $hdmenu=M("hdmenu");
        $rs_hdmenu=$hdmenu->select();
        $this->assign("rs_hdmenu",$rs_hdmenu);
        $this->display();   
    }
    function random_color(){
        mt_srand((double)microtime()*1000000);
        $c = '';
        while(strlen($c)<6){
            $c .= sprintf("%02X", mt_rand(0, 200));
        }
        return $c;
    }
    public function Welcome(){
        $this->LoginTrue();
        $adminInfo=M("admin");
        $aName=session("aName");
        $aUser=session("aUser");
        $this->assign("aName",$aName);
        $aUser=session("aUser");
        $aPowers=session("aPowers");
        $rs_adminInfo=$adminInfo->field("aLoginNum")->where("aUser='{$aUser}'")->find();
        $this->assign("rs_adminInfo",$rs_adminInfo);
        
        $admin_role=M("admin_role");
        if($aPowers==0){
            $powersName="系统管理员";
            $powersValue="0";
        }else{
            $rs_role=$admin_role->where("arId={$aPowers}")->field("arName,arPowers")->find();
            $powersName=$rs_role["arName"];
            $powersValue=$rs_role["arPowers"];
            $morepowersValue=$powersValue;
            $powersValue=explode("-", $powersValue);
        }
        $this->assign("powersName",$powersName);
        $this->assign("morepowersValue",$morepowersValue);
        $this->assign("powersValue",$powersValue);
        
        // 活动自定义菜单
        $hdmenu=M("hdmenu");
        $rs_hdmenu=$hdmenu->select();
        $this->assign("rs_hdmenu",$rs_hdmenu);
        //颜色
        for($i=0;$i<30;$i++){
            $colors[$i]="#".$this->random_color();
            $color=array($colors);
        }
        $this->assign("color",$color);
        
        
        //统计数据
        $rs_admin_role=M("admin_role");
        $rs_role=$rs_admin_role->count();
        $this->assign("rs_role",$rs_role);
        $rs_admin=$adminInfo->count();
        $this->assign("rs_admin",$rs_admin);
        $rs_department=M("department");
        $rs_department=$rs_department->count();
        $this->assign("rs_department",$rs_department);
        $rs_staff=M("staff");
        $rs_staff_work=$rs_staff->where("stBlacklist=0")->count();
        $this->assign("rs_staff_work",$rs_staff_work);
        $rs_staff_working=$rs_staff->where("stJobState=1 AND stBlacklist=0")->count();
        $this->assign("rs_staff_working",$rs_staff_working);
        $rs_staff_worked=$rs_staff->where("stJobState=0 AND stBlacklist=0")->count();
        $this->assign("rs_staff_worked",$rs_staff_worked);
        $rs_staff_blacklists=$rs_staff->where("stBlacklist=1")->count();
        $this->assign("rs_staff_blacklists",$rs_staff_blacklists);
        
        //版权信息
        $systemName=M("system");
        $rs_systemName=$systemName->field("sName,sCopyrightName,sCopyrightAuthor,sCopyrightAuthorTel,sCopyrightAuthorQQ")->where("sId=1")->find();
        $this->assign("rs_systemName",$rs_systemName);
        $year=date("Y");
        $this->assign("year",$year);
        $this->display();
    }

}