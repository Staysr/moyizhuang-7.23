<?php
namespace Personnelsystem\Controller;
use Think\Controller;
header("content-type:text/html;charset=utf-8");
class DepartmentController extends LoginTrueController {
    public function Add(){
        $this->LoginTrue();
        $systemName=M("system");
        $rs_systemName=$systemName->field("sDepartment")->where("sId=1")->find();
        $this->assign("rs_systemName",$rs_systemName);
        $this->display();
    }
    public function AddAction(){
        $this->LoginTrue();
        $data["dName"]=$_POST["dName"];
        $data["dPid"]=$_POST["dPid"];
        if($data["dPid"]==""){
            $data["dPid"]=0;
        }
        $data["dPsid"]=$_POST["dPsid"];
        if($data["dPsid"]==""){
            $data["dPsid"]=0;
        }
        $data["dDirector"]=$_POST["dDirector"];
        if($data["dDirector"]==""){
            $data["dDirector"]="暂未设定负责人";
        }
        $data["dDirectorTel"]=$_POST["dDirectorTel"];
        if($data["dDirectorTel"]==""){
            $data["dDirectorTel"]="暂无完善";
        }
        $data["dDirectorQQ"]=$_POST["dDirectorQQ"];
        if($data["dDirectorQQ"]==""){
            $data["dDirectorQQ"]="暂无完善";
        }
        $data["dDirectorEmail"]=$_POST["dDirectorEmail"];
        if($data["dDirectorEmail"]==""){
            $data["dDirectorEmail"]="暂无完善";
        }
        $data["dInfo"]=$_POST["dInfo"];
        if($data["dInfo"]==""){
            $data["dInfo"]="暂未填写";
        }
        $departmentAdd=M("department");
        $result=$departmentAdd->add($data);
        if($result){
            $this->success("添加成功",U("listsedit"));
        }else{
            $this->error("添加失败");
        }
    }

 
    
    public function ListsEdit(){
        $this->LoginTrue();
        $department=M("department");
        $rs_department=$department->select();
        $this->assign("rs_department",$rs_department);
        $this->display();
    }
    public function ListsEditUpdate(){
        $this->LoginTrue();
        $dId=$_GET["dId"];
        $department=M("department");
        $rs_department=$department->where("dId={$dId}")->find();
        $this->assign("rs_department",$rs_department);
        
        $this->display();
    }
    public function Update(){
        $this->LoginTrue();
        $dId=$_GET["dId"];
        $department=M("department");
        $rs_department=$department->where("dId={$dId}")->find();
        $this->assign("rs_department",$rs_department);
        $this->display();
    }
    public function UpdateAction(){
        $this->LoginTrue();
        $dId=$_GET["dId"];
        $data["dPid"]=$_POST["dPid"];
        if($data["dPid"]==""){
            $data["dPid"]=0;
        }
        $data["dPsid"]=$_POST["dPsid"];
        if($data["dPsid"]==""){
            $data["dPsid"]=0;
        }
        $data["dName"]=$_POST["dName"];
        $data["dDirector"]=$_POST["dDirector"];
        if($data["dDirector"]==""){
            $data["dDirector"]="暂未设定负责人";
        }
        $data["dDirectorTel"]=$_POST["dDirectorTel"];
        if($data["dDirectorTel"]==""){
            $data["dDirectorTel"]="暂无完善";
        }
        $data["dDirectorQQ"]=$_POST["dDirectorQQ"];
        if($data["dDirectorQQ"]==""){
            $data["dDirectorQQ"]="暂无完善";
        }
        $data["dDirectorEmail"]=$_POST["dDirectorEmail"];
        if($data["dDirectorEmail"]==""){
            $data["dDirectorEmail"]="暂无完善";
        }
        $data["dInfo"]=$_POST["dInfo"];
        if($data["dInfo"]==""){
            $data["dInfo"]="暂未填写";
        }
        $department=M("department");
        $result=$department->where("dId={$dId}")->save($data);
        if($result){
            $this->success("修改成功",U("listsedit"));
        }else{
            $this->error("修改失败");
        }
    }
    public function DelAction(){
        $this->LoginTrue();
        $dId=$_GET["dId"];
        $department=M("department");
        $rs=$department->where("dPid={$dId}")->count();
        if($rs>0){
            $this->error("该部门下有二级部门，请删除二级部门在删除该部门");
        }
        $rs1=$department->where("dPsid={$dId}")->count();
        if($rs1>0){
            $this->error("该部门下有三级部门，请删除三级部门在删除该部门");
        }
        $result=$department->where("dId={$dId}")->delete();
        if($result){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }
    }

}