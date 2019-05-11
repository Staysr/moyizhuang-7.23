<?php
namespace Personnelsystem\Controller;
use Think\Controller;
use Think\Upload;
ob_end_clean();
header("content-type:text/html;charset=utf-8");
class StaffController extends LoginTrueController {
    public function Add(){
        $this->LoginTrue();
        $depId=$_GET["depId"];
        $staffNum=M("staff");
        $rs_staffNum=$staffNum->count();
        $number=$rs_staffNum+1;
        $this->assign("number",$number);
        //部门的处理
        $department=M("department");
        if($depId!=0){
         $rs_department=$department->field("dId,dPid,dPsid,dName")->where("dId={$depId}")->find();
        }else{
        $rs_department=$department->field("dId,dPid,dPsid,dName")->select();
        }
        $this->assign("depId",$depId);
        $this->assign("rs_department",$rs_department);
        //下面对自定义变量的处理
        $variables=M("variables");
        $rs_xueli=$variables->where("vId=1")->find();
        $xueli=explode("|",$rs_xueli["vVariablesVal"]);
        $this->assign("xueli",$xueli);
        
        $rs_zhicheng=$variables->where("vId=2")->find();
        $zhicheng=explode("|",$rs_zhicheng["vVariablesVal"]);
        $this->assign("zhicheng",$zhicheng);
        
        $rs_zhiwu=$variables->where("vId=3")->find();
        $zhiwu=explode("|",$rs_zhiwu["vVariablesVal"]);
        $this->assign("zhiwu",$zhiwu);
        
        $rs_hunyin=$variables->where("vId=4")->find();
        $hunyin=explode("|",$rs_hunyin["vVariablesVal"]);
        $this->assign("hunyin",$hunyin);
        
        $rs_minzu = $variables->where("vId=5")->find();
        $minzu = explode("|", $rs_minzu["vVariablesVal"]);
        $this->assign("minzu", $minzu);
        
        
        
        
        $this->display();
    }
    public function up(){
        $config = array(
            'rootPath'      =>  './Uploads/', //保存根路径
            'savePath'      =>  'Staff/photo/', //保存路径
            'subName' =>array('date','Ymd'),
        );
        $up=new \Think\Upload($config);
        $rup=$up->upload($_FILES);
        $a="";
        foreach($rup as $v){
            $name='./Uploads/'.$v['savepath'].$v['savename'];
            $url='Uploads/'.$v['savepath'].$v['savename'];
            list($width, $height, $type, $attr) = getimagesize($name);
            if($width > 0){
                echo json_encode(array("error"=>"0","pic"=>$url));
            }else{
                echo json_encode(array("error"=>"上传有误，清检查服务器配置！"));
            }
        }
    }
    public function AddAction(){
        $this->LoginTrue();
        $staffAdd=M("staff");
        $yinsu=$_POST["yinsu"];
        $string=implode(",",$yinsu);
        $data["stYinsuyuan"]=$string;
        $data["stNum"]=$_POST["stNum"];
        $data["stName"]=$_POST["stName"];
        $data["stSex"]=$_POST["stSex"];
        $data["stBirthdate"]=$_POST["stBirthdate"];
        $data["stBirthdateType"]=$_POST["stBirthdateType"];
        $data["stTel"]=$_POST["stTel"];
        $data["stDegrees"]=$_POST["stDegrees"];
        $data["stEntryDate"]=$_POST["stEntryDate"];
        $data["stMarital"] = $_POST["stMarital"];
        $data["stDid"]=$_POST["stDid"];
        $data["stPositionalTitles"]=$_POST["stPositionalTitles"];
        if($data["stPositionalTitles"]==""){
            $data["stPositionalTitles"]="普通员工";
        }
        $data["stDuties"]=$_POST["stDuties"];
        if($data["stDuties"]==""){
            $data["stDuties"]="暂未录入";
        }
        $data["stHeight"]=$_POST["stHeight"];
        if($data["stHeight"]==""){
            $data["stHeight"]="0";
        }
        $data["stWeight"]=$_POST["stWeight"];
        if($data["stWeight"]==""){
            $data["stWeight"]="0";
        }
        $data["stMultiracial"]=$_POST["stMultiracial"];
        if($data["stMultiracial"]==""){
            $data["stMultiracial"]="汉族";
        }
        $data["stNativePlace"]=$_POST["stNativePlace"];
        if($data["stNativePlace"]==""){
            $data["stNativePlace"]="未录入";
        }
        $data["stCity"]=$_POST["stCity"];
        if($data["stCity"]==""){
            $data["stCity"]="未录入";
        }
        $data["stPhoto"]=$_POST["stPhoto"];
        if($data["stPhoto"]==""){
            $data["stPhoto"]="0";
        }
        $data["stPoliticalIandscape"]=$_POST["stPoliticalIandscape"];
        if($data["stPoliticalIandscape"]==""){
            $data["stPoliticalIandscape"]="普通公民";
        }
        $data["stIDCard"]=$_POST["stIDCard"];
        if($data["stIDCard"]==""){
            $data["stIDCard"]="";
        }else{
            $rs_stID=$staffAdd->select();
            foreach($rs_stID as $val_stID){
                if($data["stIDCard"]==$val_stID["stIDCard"]){
                    if($data["stIDCard"]!=""){
                    $this->error("此身份证号码已经存在");
                    }
                }
            }
        }
        $data["stQQ"]=$_POST["stQQ"];
        if($data["stQQ"]==""){
            $data["stQQ"]="未填写";
        }
        $data["stEmail"]=$_POST["stEmail"];
        if($data["stEmail"]==""){
            $data["stEmail"]="未填写";
        }
        $stEnclosure=$_FILES["stEnclosure"];
        if(strlen($stEnclosure["name"])>0){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg', 'doc', 'docx', 'xls', 'xlsx', 'rar', 'zip', '7z');// 设置附件上传类型
            $rootPath= $upload->rootPath  =     './'; // 设置附件上传根目录
            $upload->savePath  =     'Uploads/Staff/fujian/'; // 设置附件上传（子）目录
            $upload->subName=array('date','Ymd');
            // 上传文件
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }
            foreach($info as $file){
                $fujianUrl= $file['savepath'].$file['savename'];
            }
            $data["stEnclosure"]=$fujianUrl;
        }else{
            $data["stEnclosure"]=0;
        }
        $data["stJingyuan"]=$_POST["stJingyuan"];
        if($data["stJingyuan"]==""){
            $data["stJingyuan"]="未填写";
        }
        $data["stJineng"]=$_POST["stJineng"];
        if($data["stJineng"]==""){
            $data["stJineng"]="未填写";
        }
        $data["stInputDate"]=date("Y-m-d");
        $result=$staffAdd->add($data);
        if($result){
            $this->success("录入员工信息成功",U("lists"));
        }else{
            $this->error("录入员工信息失败");
        } 
    }
    public function Lists(){
        $this->LoginTrue();
        $staffLists=M("staff");
        $depId=$_GET["depId"];
        if($depId!=0){
            $rs_staffLists=$staffLists->where("stBlacklist=0 AND stDid={$depId}")->select();
        }else{
            $rs_staffLists=$staffLists->where("stBlacklist=0")->select();
        }
        $this->assign("rs_staffLists",$rs_staffLists);
        $year=date("Y");
        $this->assign("year",$year);
        $this->assign("depId",$depId);
        $this->display();
    }
    public function JobLists(){
        $this->LoginTrue();
        $staffLists=M("staff");
        $depId=$_GET["depId"];
        if($depId!=0){
            $rs_staffLists=$staffLists->where("stBlacklist=0 AND stJobState=1 AND stDid={$depId}")->select();
        }else{
            $rs_staffLists=$staffLists->where("stBlacklist=0 AND stJobState=1")->select();
        }
        $this->assign("rs_staffLists",$rs_staffLists);
        $this->assign("depId",$depId);
        $year=date("Y");
        $this->assign("year",$year);
        $this->display();
    }
    public function NoJobLists(){
        $this->LoginTrue();
        $staffLists=M("staff");
        $depId=$_GET["depId"];
        if($depId!=0){
            $rs_staffLists=$staffLists->where("stBlacklist=0  AND stJobState!=1  AND stDid={$depId}")->select();
        }else{
            $rs_staffLists=$staffLists->where("stBlacklist=0  AND stJobState!=1")->select();
        }
        $this->assign("rs_staffLists",$rs_staffLists);
        $this->assign("depId",$depId);
        $year=date("Y");
        $this->assign("year",$year);
        $this->display();
    }
    public function BackLists(){
        $this->LoginTrue();
        $staffLists=M("staff");
        $depId=$_GET["depId"];
        if($depId!=0){
            $rs_staffLists=$staffLists->where("stBlacklist=1 AND stDid={$depId}")->select();
        }else{
            $rs_staffLists=$staffLists->where("stBlacklist=1")->select();
        }
        $this->assign("rs_staffLists",$rs_staffLists);
        $this->assign("depId",$depId);
        $year=date("Y");
        $this->assign("year",$year);
        $this->display();
    }
    public function Show(){
        $this->LoginTrue();
        $stId=$_GET["stId"];
        $staffShow=M("staff");
        $rs_staffShow=$staffShow->where("stId={$stId}")->find();
        $this->assign("rs_staffShow",$rs_staffShow);
        //算年龄
        $nowTime=time();
        $year=date("Y");
        $staffShow_stBirthdate=strtotime($rs_staffShow["stBirthdate"]);
        $nowAge=floor(((($nowTime-$staffShow_stBirthdate)/86400)/365));
        $this->assign("nowAge",$nowAge);
        //算工龄
        $workingYear=strtotime($rs_staffShow["stEntryDate"]);
        $quiteYear=strtotime($rs_staffShow["stDepartureDate"]);
        if($quiteYear!=0){
            $nowWorkingYear=round(((($quiteYear-$workingYear)/86400)/365),1);
        }else{
            $nowWorkingYear=round(((($nowTime-$workingYear)/86400)/365),1);
        }
        $this->assign("nowWorkingYear",$nowWorkingYear);
        
        $department=M("department");
        $rs_department=$department->field("dId,dName")->where("dId={$rs_staffShow["stDid"]}")->find();
        $this->assign("rs_department",$rs_department);
        //算黑名单间隔天数
        if($rs_staffShow["stBlacklistEndDate"]!=0){
        $startTime=strtotime($rs_staffShow["stBlacklistNowDate"]);
        $endTime=strtotime($rs_staffShow["stBlacklistEndDate"]);
        $days=ceil((abs($endTime-$startTime))/86400);
        $newTime=$days*86400;
        $days=date("Y-m-d",$newTime);
        $days=explode("-",$days);
        $days=($days[0]-1970)." 年 零 ".($days[1]-1)." 个月 零 ".($days[2]-1)." 天 ";
        }else{
            $days="永久禁封";
        }
        $this->assign("days",$days);
        
        //洗黑还剩天数
        if($rs_staffShow["stBlacklistEndDate"]!=0){
            $nBacklistTime=floor(($endTime-$nowTime)/86400);
            if($nBacklistTime<=0){
                $nBacklistTime="已洗白";
            }else{
                $nBacklistTime=$nBacklistTime." 天 ";
            }
        }else{
            $nBacklistTime="永久黑名单";
        }
        $this->assign("nBacklistTime",$nBacklistTime);
        $this->display();
    }
    
    public function ShowImages(){
        $this->LoginTrue();
        $stId=$_GET["stId"];
        $staffShow=M("staff");
        $rs_staffShow=$staffShow->where("stId={$stId}")->find();
        $this->assign("rs_staffShow",$rs_staffShow);
        
        //算年龄
        $nowTime=time();
        $year=date("Y");
        $staffShow_stBirthdate=strtotime($rs_staffShow["stBirthdate"]);
        $nowAge=floor(((($nowTime-$staffShow_stBirthdate)/86400)/365));
        $this->assign("nowAge",$nowAge);
       
        $this->display();
    }
    
    public function ShowFujian(){
        $this->LoginTrue();
        $stId=$_GET["stId"];
        $staffShow=M("staff");
        $rs_staffShow=$staffShow->where("stId={$stId}")->find();
        $this->assign("rs_staffShow",$rs_staffShow);
    
        //算年龄
        $nowTime=time();
        $year=date("Y");
        $staffShow_stBirthdate=strtotime($rs_staffShow["stBirthdate"]);
        $nowAge=floor(((($nowTime-$staffShow_stBirthdate)/86400)/365));
        $this->assign("nowAge",$nowAge);
         
        $this->display();
    }
    
    public function QuitAdd(){
        $this->LoginTrue();
        $stId=$_GET["stId"];
        $staffShow=M("staff");
        $rs_staffShow=$staffShow->where("stId={$stId}")->find();
        $this->assign("rs_staffShow",$rs_staffShow);
        
        $nowTime=time();
        $workingYear=strtotime($rs_staffShow["stEntryDate"]);
        $quiteYear=strtotime($rs_staffShow["stDepartureDate"]);
        if($quiteYear!=0){
            $nowWorkingYear=round(((($quiteYear-$workingYear)/86400)/365),1);
        }else{
            $nowWorkingYear=round(((($nowTime-$workingYear)/86400)/365),1);
        }
        $this->assign("nowWorkingYear",$nowWorkingYear);
        
        $nowDate=date("Y-m-d");
        $this->assign("nowDate",$nowDate);
        
        $department=M("department");
        $rs_department=$department->field("dId,dName")->where("dId={$rs_staffShow["stDid"]}")->find();
        $this->assign("rs_department",$rs_department);
        $this->display();
    }
    public function QuitAddAction(){
        $this->LoginTrue();
        $stId=$_GET["stId"];
        $data["stDepartureDate"]=$_POST["stDepartureDate"];
        $data["stDepartureSo"]=$_POST["stDepartureSo"];
        if($data["stDepartureSo"]==""){
            $data["stDepartureSo"]="未注明原因";
        }
        $data["stJobState"]=0;
        $stBlacklist=$_POST["stBlacklist"];
        $staffSet=M("staff");
        $result=$staffSet->where("stId={$stId}")->save($data);
        if($result){
            if($stBlacklist!=0){
            $this->success("成功离职",U("lists"));
            }else{
            $this->success("成功离职",U("lists"));
            }
        }else{
            $this->error("离职失败");
        }
    }
    public function BackListsAdd(){
        $this->LoginTrue();
        $stId=$_GET["stId"];
        $staffShow=M("staff");
        $rs_staffShow=$staffShow->where("stId={$stId}")->find();
        $this->assign("rs_staffShow",$rs_staffShow);
        $nowTime=time();
        $workingYear=strtotime($rs_staffShow["stEntryDate"]);
        $quiteYear=strtotime($rs_staffShow["stDepartureDate"]);
        if($quiteYear!=0){
            $nowWorkingYear=round(((($quiteYear-$workingYear)/86400)/365),1);
        }else{
            $nowWorkingYear=round(((($nowTime-$workingYear)/86400)/365),1);
        }
        $this->assign("nowWorkingYear",$nowWorkingYear);
    
        $nowDate=date("Y-m-d");
        $this->assign("nowDate",$nowDate);
        
        $department=M("department");
        $rs_department=$department->field("dId,dName")->where("dId={$rs_staffShow["stDid"]}")->find();
        $this->assign("rs_department",$rs_department);
        $this->display();
    }
    public function BackListsAddAction(){
        $this->LoginTrue();
        $stId=$_GET["stId"];
        $data["stBlacklist"]=1;
        $data["stBlacklistNowDate"]=$_POST["stBlacklistNowDate"];
        $data["stBlacklistEndDate"]=$_POST["stBlacklistEndDate"];
        if($data["stBlacklistEndDate"]==""){
            $data["stBlacklistEndDate"]=0;
        }
        $data["stBlacklistSo"]=$_POST["stBlacklistSo"];
        if($data["stBlacklistSo"]==""){
            $data["stBlacklistSo"]="未注明原因";
        }
        $staffSet=M("staff");
        $result=$staffSet->where("stId={$stId}")->save($data);
        if($result){
        $this->success("成功加入黑名单",U("lists"));
        }else{
            $this->error("加入黑名单失败",U("lists"));
        }
    }
    public function Del(){
        $this->LoginTrue();
        $stId=$_GET["stId"];
        $staffShow=M("staff");
        $rs_staffShow=$staffShow->where("stId={$stId}")->find();
        $this->assign("rs_staffShow",$rs_staffShow);
        $this->display();
    }
    public function DelAction(){
        $this->LoginTrue();
        $stId=$_GET["stId"];
        $staffShow=M("staff");
        $result=$staffShow->where("stId={$stId}")->delete();
        if($result){
            $this->success("删除成功",U("lists"));
        }else{
            $this->error("删除失败");
        }
    }
    public function DelAll(){
        $this->LoginTrue();
        $stId=$_POST["node"];
        $staff=M("staff");
        foreach($stId as $val){
            $result=$staff->where("stId={$val}")->delete();
        }
        $this->success("删除成功",U("lists"));
    }
    public function Update(){
        $this->LoginTrue();
        $stId=$_GET["stId"];
        $depId=$_GET["depId"];
        $staffShow=M("staff");
        $rs_staffInfo=$staffShow->where("stId={$stId}")->find();
        $this->assign("rs_staffInfo",$rs_staffInfo);
        $department=M("department");
        if($depId!=0){
            $rs_department=$department->field("dId,dPid,dPsid,dName")->where("dId={$depId}")->find();
        }else{
            $rs_department=$department->field("dId,dPid,dPsid,dName")->select();
        }
        $this->assign("depId",$depId);
        //学历的处理
        $variables=M("variables");
        $rs_xueli=$variables->where("vId=1")->find();
        $xueli=explode("|",$rs_xueli["vVariablesVal"]);
        $this->assign("xueli",$xueli);
        
        $rs_zhicheng=$variables->where("vId=2")->find();
        $zhicheng=explode("|",$rs_zhicheng["vVariablesVal"]);
        $this->assign("zhicheng",$zhicheng);
        
        $rs_zhiwu=$variables->where("vId=3")->find();
        $zhiwu=explode("|",$rs_zhiwu["vVariablesVal"]);
        $this->assign("zhiwu",$zhiwu);
        
        $rs_hunyin=$variables->where("vId=4")->find();
        $hunyin=explode("|",$rs_hunyin["vVariablesVal"]);
        $this->assign("hunyin",$hunyin);
        
        $rs_minzu = $variables->where("vId=5")->find();
        $minzu = explode("|", $rs_minzu["vVariablesVal"]);
        $this->assign("minzu", $minzu);
        
        $this->assign("rs_department",$rs_department);
        $this->display();
    }
    public function UpdateAction(){
        $this->LoginTrue();
        $stId=$_GET["stId"];
        $staffAdd=M("staff");
        $yinsu=$_POST["yinsu"];
        $yinsuyuan=array_unique($yinsu);
        $string=implode(",",$yinsuyuan);
        $data["stYinsuyuan"]=$string;
        $data["stNum"]=$_POST["stNum"];
        $data["stName"]=$_POST["stName"];
        $data["stSex"]=$_POST["stSex"];
        $data["stBirthdate"]=$_POST["stBirthdate"];
        $data["stBirthdateType"]=$_POST["stBirthdateType"];
        $data["stTel"]=$_POST["stTel"];
        $data["stDegrees"]=$_POST["stDegrees"];
        $data["stMarital"] = $_POST["stMarital"];
        $data["stEntryDate"]=$_POST["stEntryDate"];
        $data["stDid"]=$_POST["stDid"];
        $data["stPositionalTitles"]=$_POST["stPositionalTitles"];
        if($data["stPositionalTitles"]==""){
            $data["stPositionalTitles"]="普通员工";
        }
        $data["stDuties"]=$_POST["stDuties"];
        if($data["stDuties"]==""){
            $data["stDuties"]="暂未录入";
        }
        $data["stHeight"]=$_POST["stHeight"];
        if($data["stHeight"]==""){
            $data["stHeight"]="0";
        }
        $data["stWeight"]=$_POST["stWeight"];
        if($data["stWeight"]==""){
            $data["stWeight"]="0";
        }
        $data["stMultiracial"]=$_POST["stMultiracial"];
        if($data["stMultiracial"]==""){
            $data["stMultiracial"]="汉族";
        }
        $data["stNativePlace"]=$_POST["stNativePlace"];
        if($data["stNativePlace"]==""){
            $data["stNativePlace"]="未录入";
        }
        $data["stCity"]=$_POST["stCity"];
        if($data["stCity"]==""){
            $data["stCity"]="未录入";
        }
        $data["stPhoto"]=$_POST["stPhoto"];
        if($data["stPhoto"]==""){
            $data["stPhoto"]="0";
        }
        $data["stPoliticalIandscape"]=$_POST["stPoliticalIandscape"];
        if($data["stPoliticalIandscape"]==""){
            $data["stPoliticalIandscape"]="普通公民";
        }
        $IdCard=$data["stIDCard"]=$_POST["stIDCard"];
        if($data["stIDCard"]==""){
            $data["stIDCard"]="未填写";
        }else{
            $rs_stID=$staffAdd->where("stIDCard!='{$IdCard}'")->select();
            foreach($rs_stID as $val_stID){
                if($data["stIDCard"]==$val_stID["stIDCard"]){
                    $this->error("此身份证号码已经存在");
                }
            }
        }
        $data["stQQ"]=$_POST["stQQ"];
        if($data["stQQ"]==""){
            $data["stQQ"]="未填写";
        }
        $data["stEmail"]=$_POST["stEmail"];
        if($data["stEmail"]==""){
            $data["stEmail"]="未填写";
        }
        $stEnclosure=$_FILES["stEnclosure"];
        if(strlen($stEnclosure["name"])>0){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg', 'doc', 'docx', 'xls', 'xlsx', 'rar', 'zip', '7z');// 设置附件上传类型
            $rootPath= $upload->rootPath  =     './'; // 设置附件上传根目录
            $upload->savePath  =     'Uploads/Staff/fujian/'; // 设置附件上传（子）目录
            $upload->subName=array('date','Ymd');
            // 上传文件
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }
            foreach($info as $file){
                $fujianUrl= $file['savepath'].$file['savename'];
            }
            $data["stEnclosure"]=$fujianUrl;
        }else{
            $data["stEnclosure"]=$_POST["stEnclosure"];
        }
        $data["stJingyuan"]=$_POST["stJingyuan"];
        if($data["stJingyuan"]==""){
            $data["stJingyuan"]="未填写";
        }
        $data["stJineng"]=$_POST["stJineng"];
        if($data["stJineng"]==""){
            $data["stJineng"]="未填写";
        }
        $result=$staffAdd->where("stId={$stId}")->save($data);
        if($result){
            $this->success("修改员工信息成功",U("lists"));
        }else{
            $this->error("修改员工信息失败");
        }
    }
    public function UpdateQuit(){
        $this->LoginTrue();
        $stId=$_GET["stId"];
        $depId=$_GET["depId"];
        $staffShow=M("staff");
        $rs_staffInfo=$staffShow->where("stId={$stId}")->find();
        $this->assign("rs_staffInfo",$rs_staffInfo);
        $department=M("department");
        if($depId!=0){
            $rs_department=$department->field("dId,dName")->where("dId={$depId}")->find();
        }else{
            $rs_department=$department->field("dId,dName")->select();
        }
        $this->assign("depId",$depId);
        $this->assign("rs_department",$rs_department);
        $this->display();
    }
    public function UpdateQuitAction(){
        $this->LoginTrue();
        $stId=$_GET["stId"];
        $staffShow=M("staff");
        $data["stNum"]=$_POST["stNum"];
        $data["stDepartureDate"]=$_POST["stDepartureDate"];
        if($data["stDepartureDate"]==""){
            $data["stDepartureDate"]="0";
        }
        $data["stDepartureSo"]=$_POST["stDepartureSo"];
        if($data["stDepartureSo"]==""){
            $data["stDepartureSo"]="还未填写";
        }
        $data["stJobState"]=$_POST["stJobState"];
        $result=$staffShow->where("stId={$stId}")->save($data);
        if($result){
            $this->success("修改离职员工信息成功",U("lists"));
        }else{
            $this->error("修改离职员工信息失败");
        }    
    }
}