<?php
/*
 * 此应用的通知接口
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
if(!defined('IN_DZZ')) {
	exit('Access Denied');
}
include libfile('function/organization');
include libfile('function/news');

$appid=intval($_GET['appid']);
$uid=intval($_G['uid']);

$perm=getPermByUid($_G['uid']);

$data=array();
$data['timeout']=60*60;//一小时查询一次；
//获取应用的提醒数
$lasttime=intval(DB::result_first("select lasttime from ".DB::table('app_user')." where uid='{$uid}' and appid='{$appid}'"));

//查询
$param=array('news');
$sql="dateline>%d and status<2 and authorid!=%d";
$param[]=$lasttime;
$param[]=$_G['uid'];
$orderby="ORDER BY dateline DESC";
if($perm<2){
	if($_G['uid']<1){//游客时
		$sql=" and orgids='' and uids=''";
	}else{
		//阅读范围查询语句
		$sql.=" and (";
		$sql_gid=array("orgids=''");
		$orgarr=getDepartmentByUid($_G['uid']); //获取当前用户所在的部门数组
		foreach($orgarr as $value){
			foreach($value as $value1){
				$sql_gid[]="FIND_IN_SET(%d,orgids)";
				$param[]=$value1['orgid'];
			}
		}
		
		$sql.="(".implode(' OR ',$sql_gid).") and ( uids='' OR FIND_IN_SET(%d,uids))";
		
		$sql.=")";
		$param[]=$_G['uid'];
	}
}

$data['sum']=DB::result_first("select count(*) from %t where $sql",$param);
if($data['sum']){//获取最新信息列表；
	$list=DB::fetch_all("select newid,subject,authorid,author from %t where $sql $orderby limit 10 ",$param);
}
if($list){
	 $html=' <div class="panel panel-success" style="margin:0;width:300px;">';
	 $html.=' <div class="panel-heading" style="border-radius:0">';
	 $html.='   <h3 class="panel-title">';
	 $html.=lang('new_news');
	 $html.='     <button type="button" class="close" onclick="jQuery(\'#notice\').hide();"><span aria-hidden="true">×</span></button>';
	 $html.='   </h3>';
	 $html.=' </div>';
	 $html.=' <div class="panel-body" style="padding:0;max-height:350px;overflow-x:hidden;overflow-y:auto">';
	 $html.='  <table class="table" style="margin:0">';
	 foreach($list as $value){
	 $html.=  '<tr><td><a href="'.DZZSCRIPT.'?mod=news&op=view&newid='.$value['newid'].'" onclick="OpenApp(\''.$appid.'\',this.href);jQuery(this).closest(\'tr\').remove();return false" style="font-size:14px;line-height:30px;">'.$value['subject'].'</a><small style="color:#999"> by '.$value['author'].'</small></td></tr>';
	 }
	 $html.=' </table>';
	 $html.=' </div>';
	 $html.='</div>';
 }
 if($html){
	 $data['notice']=array('closetime'=>60,'html'=>rawurlencode($html)); //关闭时间1分钟
 }else{
	 $data['notice']='';
 }
	
echo "noticeCallback(".json_encode($data).")";

exit();
?>
