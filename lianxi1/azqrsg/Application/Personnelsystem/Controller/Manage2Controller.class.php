<?php
namespace Personnelsystem\Controller;
use Think\Controller;
header("content-type:text/html;charset=utf-8");
class ManageController extends LoginTrueController {
    public function Role(){
        $this->LoginTrue();
        $admin_role=M("admin_role");
        $rs_role=$admin_role->select();
        $this->assign("rs_role",$rs_role);
        $this->display();
    }
    public function RoleAdd(){
        $this->LoginTrue();
        $this->display();
    }
    public function RoleAddAction(){
        $this->LoginTrue();
        $data["arName"]=$_POST["arName"];
        $data["arInfo"]=$_POST["arInfo"];
        
 $systems=$_POST["systems"];
        if($systems==""){
            $systems=0;
        }
        $adminGroup=$_POST["adminGroup"];
        if($adminGroup==""){
            $adminGroup=0;
        }
        $staffGroup=$_POST["staffGroup"];
        if($staffGroup==""){
            $staffGroup=0;
        }
        $deptGroup=$_POST["deptGroup"];
        if($deptGroup==""){
            $deptGroup=0;
        }
        $department=$_POST["department"];
        if($department==""){
            $department=0;
        }
        $arPowers=$systems."-".$adminGroup."-".$staffGroup."-".$deptGroup."-".$department;
        if($arPowers=="0-0-0-0-0"){
            $this->error("请至少选择一个权限");
        }elseif($adminGroup=="A1" || $staffGroup=="A2" || $deptGroup=="A3"){
            if($systems=="0" && $department=="0"){
                $this->error("选择子类一定要选择父类");
            } 
        }
        if($adminGroup=="0" && $staffGroup=="0" && $deptGroup=="0"){
            if($systems!="0"){
                $this->error("选择父类至少得选择一个子类");
            }
        }

        $data["arPowers"]=$arPowers;
        $admin_role=M("admin_role");
        $result=$admin_role->add($data);
        if($result){
            $this->success("添加角色成功",U("role"));
        }else{
            $this->error("添加角色失败");
        }
    }
    public function RoleUpdate(){
        $this->LoginTrue();
        $arId=$_GET["arId"];
        $admin_role=M("admin_role");
        $rs_role=$admin_role->where("arId={$arId}")->find();
        $this->assign("rs_role",$rs_role);
        $this->display();
    }
    public function RoleUpdateAction(){
        $this->LoginTrue();
        $arId=$_GET["arId"];
        $data["arName"]=$_POST["arName"];
        $data["arInfo"]=$_POST["arInfo"];
        
        $systems=$_POST["systems"];
        if($systems==""){
            $systems=0;
        }
        $adminGroup=$_POST["adminGroup"];
        if($adminGroup==""){
            $adminGroup=0;
        }
        $staffGroup=$_POST["staffGroup"];
        if($staffGroup==""){
            $staffGroup=0;
        }
        $deptGroup=$_POST["deptGroup"];
        if($deptGroup==""){
            $deptGroup=0;
        }
        $department=$_POST["department"];
        if($department==""){
            $department=0;
        }
        $arPowers=$systems."-".$adminGroup."-".$staffGroup."-".$deptGroup."-".$department;
        if($arPowers=="0-0-0-0-0"){
            $this->error("请至少选择一个权限");
        }elseif($adminGroup=="A1" || $staffGroup=="A2" || $deptGroup=="A3"){
            if($systems=="0" && $department=="0"){
                $this->error("选择子类一定要选择父类");
            } 
        }
        if($adminGroup=="0" && $staffGroup=="0" && $deptGroup=="0"){
            if($systems!="0"){
                $this->error("选择父类至少得选择一个子类");
            }
        }
        $data["arPowers"]=$arPowers;
        $admin_role=M("admin_role");
        $result=$admin_role->where("arId={$arId}")->save($data);
        if($result){
            $this->success("修改角色成功",U("role"));
        }else{
            $this->error("修改角色失败");
        }
    }
public function RoleDel(){
        $this->LoginTrue();
        $arId=$_GET["arId"];
        $admin_role=M("admin_role");
        $rs_role=$admin_role->where("arId={$arId}")->find();
        $admin=M("admin");
        $rs_admin=$admin->field("aId,aDid")->select();
        foreach($rs_admin as $val_admin){
            if($val_admin["aDid"]==$rs_role["arId"]){
                $static=1;
            }
        }
        $this->assign("static",$static); 
        $this->assign("rs_role",$rs_role);
        $this->display();
    }
    public function RoleDelAction(){
        $this->LoginTrue();
        $arId=$_GET["arId"];
        $admin_role=M("admin_role");
        $result=$admin_role->where("arId={$arId}")->delete();
        if($result){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }
    }

    public function ManageLists(){
        $this->LoginTrue();
        $admin=M("admin");
        $rs_admin=$admin->select();
        $this->assign("rs_admin",$rs_admin);
        $sessionPowers=session("aPowers");
        $this->assign("sessionPowers",$sessionPowers);
        $sessionaId=session("aId");
        $this->assign("sessionaId",$sessionaId);
        $system=M("system");
        $rs_system=$system->field("sErrorPwdLockNum")->where("sId=1")->find();
        $sEPLN=$rs_system["sErrorPwdLockNum"];
        $this->assign("systemEPLN",$sEPLN);
        $this->display();
    }
    public function ManageAdd(){
        $this->LoginTrue();
        $admin_role=M("admin_role");
        $rs_role=$admin_role->field("arId,arName")->select();
        $this->assign("rs_role",$rs_role);
        $this->display();
    }
    public function ManageAddAction(){
        $this->LoginTrue();
        $admin=M("admin");
        $rs_admin=$admin->select();
        $data["aUser"]=$_POST["aUser"];
        
        $data["aName"]=$_POST["aName"];
        $data["aPwd"]=md5($_POST["aPwd"]);
        $data["aSex"]=$_POST["aSex"];
        $data["aPowers"]=$_POST["aPowers"];
        $data["aTel"]=$_POST["aTel"];
        $data["aEmail"]=$_POST["aEmail"];
        if($data["aEmail"]==""){
            $data["aEmail"]==null;
        }
        foreach($rs_admin as $val_admin){
            if($data["aUser"]==$val_admin["aUser"]){
                $this->error("登陆账号已存在，不得重复");
            }elseif($data["aTel"]==$val_admin["aTel"]){
                $this->error("手机号码已经存在，不得重复");
            }elseif($data["aEmail"]!=""){
                if($data["aEmail"]==$val_admin["aEmail"]){
                    $this->error("邮箱已存在，不得重复");
                }
            }
        }  
        $result=$admin->add($data);
        if($result){
            $this->success("添加管理员成功",U("managelists"));
        }else{
            $this->error("添加管理员失败");
        }
    }
    public function ManageUpdate(){
        $this->LoginTrue();
        $aId=$_GET["aId"];
        $admin=M("admin");
        $rs_admin=$admin->where("aId={$aId}")->find();
        $this->assign("rs_admin",$rs_admin);
        $sessionPowers=session("aPowers");
        $this->assign("sessionPowers",$sessionPowers);
        $admin_role=M("admin_role");
        $rs_role=$admin_role->field("arId,arName")->select();
        $this->assign("rs_role",$rs_role);
        $this->display();
    }
    public function ManageUpdateAction(){
        $this->LoginTrue();
        $aId=$_GET["aId"];
        $sessionPowers=session("Powers");
        $admin=M("admin");
        $data["aName"]=$_POST["aName"];
        $data["aSex"]=$_POST["aSex"];
        $data["aTel"]=$_POST["aTel"];
        $data["aEmail"]=$_POST["aEmail"];
        if($data["aEmail"]==""){
            $data["aEmail"]=null;
        }
        $rs_admin=$admin->where("aId!={$aId}")->select();
        foreach($rs_admin as $val_admin){
           if($data["aTel"]==$val_admin["aTel"]){
                $this->error("手机号码已经存在，不得重复");
            }elseif($data["aEmail"]!=""){
                if($data["aEmail"]==$val_admin["aEmail"]){
                    $this->error("邮箱已存在，不得重复");
                }
            }
        }
        $data["aPowers"]=$_POST["aPowers"];
        if($data["aPowers"]==""){
            $data["aPowers"]=0;
        }
        $aOldPwd=$_POST["aOldPwd"];
        $aNewPwd=$_POST["aNewPwd"];
        $aNewPwd2=$_POST["aNewPwd2"];
        
        if($sessionPowers==0){
            if($aNewPwd!="" && $aOldPwd==""){
                    $data["aPwd"]=md5($_POST["aNewPwd"]);
            }
        }else{
            if($aOldPwd!="" && $aNewPwd!=""){
                $rs_pwd=$admin->where("aId={$aId}")->field("aPwd")->find();
                if($rs_pwd["aPwd"]!=md5($aOldPwd)){
                    $this->error("原密码错误");
                }else{
                        $data["aPwd"]=md5($_POST["aNewPwd"]);
                }
            }elseif($aOldPwd!="" && $aNewPwd==""){
                $this->error("如果不需要修改密码，请不要填写原密码");
            }elseif($aOldPwd=="" && $aNewPwd!=""){
                $this->error("如果需要修改密码，请验证原密码");
            }   
        }
        $result=$admin->where("aId={$aId}")->save($data);
        if($result){
            $this->success("恭喜修改成功",U("managelists"));
        }else{
            $this->error("修改失败");
        }
    }
    public function ManageUpdateStatic(){
        $this->LoginTrue();
        $data["aStatic"]=$_GET["ast"];
        $aId=$_GET["aId"];
        $admin=M("admin");
        $result=$admin->where("aId={$aId}")->save($data);
        if($result){
            $this->success("更新状态成功");
        }else{
            $this->error("更新失败");
        }
    }
    public function ManageUpdateLock(){
        $this->LoginTrue();
        $data["aErrorPwdNum"]=$_GET["lock"];
        $aId=$_GET["aId"];
        $admin=M("admin");
        $result=$admin->where("aId={$aId}")->save($data);
        if($result){
            $this->success("设置成功");
        }else{
            $this->error("设置失败");
        }
    }
    
    
    public function ManageUpdateDepartment(){
        $this->LoginTrue();
        $aId=$_GET["aId"];
        $department=M("department");
        $rs_department=$department->field("dId,dPid,dPsid,dName")->select();
        $this->assign("rs_department",$rs_department);
        $admin=M("admin");
        $rs_admin=$admin->where("aId={$aId}")->find();
        $this->assign("rs_admin",$rs_admin);
        $this->display();
    }
    public function ManageUpdateDepartmentAction(){
        $this->LoginTrue();
        $aId=$_GET["aId"];
        $admin=M("admin");
        $data["aDid"]=$_POST["aDid"];
        $result=$admin->where("aId={$aId}")->save($data);
        if($result){
           $this->success("分配成功",U("managelists")); 
        }else{
            $this->error("分配失败");
        }
    }
    public function ManageDel(){
        $this->LoginTrue();
        $aId=$_GET["aId"];
        $this->assign("aId",$aId);
        $this->display();
    }
    public function ManageDelAction(){
        $this->LoginTrue();
        $aId=$_GET["aId"];
        $admin=M("admin");
        $result=$admin->where("aId={$aId}")->delete();
        if($result){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }
    }
    public function ShutDown(){
        $this->LoginTrue();
        $this->display();
    }
}