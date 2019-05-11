<?php
/* @authorcode  codestrings
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
if(!defined('IN_DZZ')) {
	exit('Access Denied');
}
Hook::listen('adminlogin');
$ismobile=helper_browser::ismobile();
include libfile('function/cache');
$navs=array('basic'=>'基本设置',
			'wxapp'=>'微信设置',
			'manage'=>'任务板管理',
			);
$do=empty($_GET['do'])?'basic':trim($_GET['do']);
$navtitle=$navs[$do].' - 任务板';
$navlast=$navs[$do];
$operation=trim($_GET['operation']);
$muids=array();

//判断用户是否有管理员权限
if($_G['adminid']!=1 ){
	showmessage('没有权限',dreferer());
}

if($do=='basic'){
	$type=intval($_GET['type']);
	if($type==1) $key='neworg_users';
	elseif($type==2) $key='newboard_users';
	else  $key='moderators';
	if($operation=='selectuser'){
		$uids=$_GET['uids'];
		$uids=explode(',',$uids);
		if($uids){
			if(C::t('task_setting')->update($key,implode(',',$uids))){
				updatecache('taskboard:setting');
			}
		}
		$users = C::t('user')->fetch_all($uids);
		foreach ($users as $key => $value) {
			$users[$key]['avatar'] = avatar_block($value['uid']);
		}
		include template('user_select_list');
		exit();
	
	}elseif($operation=='deleteuser'){
		
		$uid=intval($_GET['uid']);
		if($m=C::t('task_setting')->fetch($key)){
			$muids=explode(',',$m);
		}
		foreach($muids as $key1=>$value){
			if($value==$uid) unset($muids[$key1]);
		}
		if(C::t('task_setting')->update($key,implode(',',$muids))){
			updatecache('taskboard:setting');
		}
		$users = C::t('user')->fetch_all($muids);
		foreach ($users as $key1 => $value) {
			$users[$key1]['avatar'] = avatar_block($value['uid']);
		}
		include template('user_select_list');
		exit();
		
	}else{
		if(submitcheck('settingsubmit')){
			$setarr=$_GET['settingnew'];
			$setarr['maxboard']=intval($setarr['maxboard']);
			$setarr['allowneworg']=intval($setarr['allowneworg']);
			$setarr['allownewboard']=intval($setarr['allownewboard']);
			$setarr['maxorganization']=intval($setarr['maxorganization']);
			$setarr['neworganization']=intval($setarr['neworganization']);
			if($setarr['allownewboard']){
				$moderators=$_GET['moderators'];
				if($moderators) $setarr['moderators']=implode(',',$moderators);
				savecache('taskboard_moderators',$moderators);
			}
			C::t('task_setting')->update_batch($setarr);
			if($ismobile){
				include template('mobile/setting');
			}else{
				showmessage('do_success',DZZSCRIPT.'?mod=taskboard&op=setting&do=basic');
			}
			showmessage('do_success',DZZSCRIPT.'?mod=taskboard&op=setting&do=basic');
		}else{
			$setting=C::t('task_setting')->fetch_all(array('moderators','neworg_users','newboard_users','allownewboard','maxboard','neworganization','maxorganization','allowneworg'));
			$setting['allownewboard']=intval($setting['allownewboard']);
			$setting['maxboard']=intval($setting['maxboard']);
			
			$moderators=$neworg_users=$newboard_users=array();
			if($setting['neworg_users'] && ($neworg_users=explode(',',$setting['neworg_users']))){
				$neworg_users=C::t('user')->fetch_all($neworg_users);
			}
			if($setting['newboard_users'] && ($newboard_users=explode(',',$setting['newboard_users']))){
				$newboard_users=C::t('user')->fetch_all($newboard_users);
			}
			if($setting['moderators'] && ($moderators=explode(',',$setting['moderators']))){
				$moderators=C::t('user')->fetch_all($moderators);
			}
		}
	}

}elseif($do=='manage'){//任务板管理
	if(submitcheck('settingsubmit')){
		foreach($_GET['del'] as $tbid){
			C::t('task_board')->delete_permanent_by_tbid($tbid);
		}
		showmessage('任务板删除成功',$_GET['refer']);
	}elseif($operation=='archive'){
		$tbid=intval($_GET['tbid']);
		if(C::t('task_board')->archive_by_tbid($tbid)){
			showmessage('任务板归档成功',$_GET['refer']);
		}else{
			showmessage('任务板归档失败',$_GET['refer']);
		}
	}elseif($operation=='restore'){
		$tbid=intval($_GET['tbid']);
		if(C::t('taskboard')->restore_by_tbid($tbid)){
			showmessage('任务板恢复成功',$_GET['refer']);
		}else{
			showmessage('任务板恢复失败',$_GET['refer']);
		}
	}elseif($operation=='active'){
		$tbid=intval($_GET['tbid']);
		if(C::t('task_board')->restore_by_tbid($tbid)){
			showmessage('任务板激活成功',$_GET['refer']);
		}else{
			showmessage('任务板激活失败',$_GET['refer']);
		}		
	}elseif($operation=='delete'){
		$tbid=intval($_GET['tbid']);
		if(C::t('taskboard')->delete_permanent_by_tbid($tbid)){
			showmessage('任务板删除成功',$_GET['refer']);
		}else{
			showmessage('任务板删除失败',$_GET['refer']);
		}
	}elseif($operation=='forceindex'){
		$tbid=intval($_GET['tbid']);
		$data=C::t('task_board')->fetch($tbid);
		if($data['viewperm']>0 && $data['forceindex']<1){
			exit(json_encode(array('error'=>'私有的任务板无法设置')));
		}
		if(C::t('task_board')->update($tbid,array('forceindex'=>$data['forceindex']?0:1))){
			exit(json_encode(array('msg'=>'设置成功！','tbid'=>$tbid,'forceindex'=>!$data['forceindex'])));
		}else{
			exit(json_encode(array('error'=>'设置失败！')));
		}
	}else{
		
		$page = empty($_GET['page'])?1:intval($_GET['page']);
		$perpage=10;
		$keyword=trim($_GET['keyword']);
		$status=intval($_GET['status']);
		$forceindex=intval($_GET['forceindex']);
		$gets = array(
				'mod'=>'taskboard',
				'keyword'=>$keyword,
				'op' =>'setting',
				'do'=>'manage',
				'archive'=>$archive,
				'status'=>$status,
				'forceindex'=>$forceindex,
				
			);
		$theurl = BASESCRIPT."?".url_implode($gets);
		$refer=urlencode($theurl.'&page='.$page);
		$limit=($page-1)*$perpage.'-'.$perpage;
		$temp=$list=array();
		if($count=C::t('task_board')->fetch_all_for_manage($limit,$keyword,$status,$forceindex,true)){
			$temp=C::t('task_board')->fetch_all_for_manage($limit,$keyword,$status,$forceindex);
		}
		foreach($temp as $value){
			if($value['statusuid']){
				 $user=getuserbyuid($value['statusuid']);
				 $value['statususername']=$user['username'];
			}
			
			$list[]=$value;
		}
		$multi=multi($count, $perpage, $page, $theurl,'pull-right');
	}

}

include template('taskboard_setting');
?>
 
