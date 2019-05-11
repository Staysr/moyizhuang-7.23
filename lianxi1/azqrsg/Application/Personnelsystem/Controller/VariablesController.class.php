<?php
namespace Personnelsystem\Controller;
use Think\Controller;
header("content-type:text/html;charset=utf-8");
class VariablesController extends LoginTrueController {
    
    public function lists(){
        $this->LoginTrue();
        $variables=M("variables");
        $rs_variables=$variables->select();
        $this->assign("rs_variables",$rs_variables);
        $this->display();
    }
    public function update(){
        $vId=$_GET["vId"];
        $variables=M("variables");
        $rs_variables=$variables->where("vId={$vId}")->find();
        $this->assign("rs_variables",$rs_variables);
        $this->display();
    }
    public function UpdateAction(){
        $vId=$_GET["vId"];
        $variables=M("variables");
        $data["vNum"]=$_POST["vNum"];
        $data["vVariablesExplain"]=$_POST["vVariablesExplain"];
        $data["vVariables"]=$_POST["vVariables"];
        $data["vVariablesVal"]=$_POST["vVariablesVal"];
        $result=$variables->where("vId={$vId}")->save($data);
        if($result){
            $this->success("更新成功");
        }else{
            $this->error("更新失败");
        }
    }
    
}