<?php
/* @authorcode  f12c4e54920727fc04d615f7ab97416a
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
if(!defined('IN_DZZ')) {
	exit('Access Denied');
}
require_once libfile('function/taskboard');
$ismobile=helper_browser::ismobile();
$do=trim($_GET['do']);

/*if(!$taskboard=C::t('task_board')->fetch_by_tbid($tbid,$_G['uid']) ){
	showmessage('任务板不存在或已删除',dreferer());
}
if($taskboard['deletetime']>0 && $taskboard['perm']<3){
	showmessage('任务板不存在或已删除',dreferer());
}
if($taskboard['perm']<1 && $taskboard['viewperm']>0){ //私有的文件只有成员才能查看
	showmessage('此任务板为私有，你不是任务板成员，无法查看',dreferer());
}

$navtitle=$task['name'];
*/
if($do=='taskmenu'){
	$step=intval($_GET['step']);

	$taskid=intval($_GET['taskid']);
	$task=C::t('task')->fetch_by_taskid($taskid,1);
	if($task['archive']>0){
		$task['disable']=1;
	}elseif($task['status']==4){
		$task['disable']=2;
	}else{
		$task['disable']=0;
	}
	$taskid=$task['taskid'];
	$tbid=$task['tbid'];
	$taskboard=C::t('task_board')->fetch_by_tbid($tbid,$_G['uid']);
	if(!$step){
		
	}elseif($step==1 ||$step==3){	//分配
		foreach(C::t('task_user')->fetch_all_by_id_idtype($taskid,'task',0) as $value){
			if($value['action']==2){
				 $task['user_assign'][$value['uid']]=$value;
			}elseif($value['action']==1){
				 $task['user_follow'][$value['uid']]=$value;
			}
		}
		$task['assign_uids']=array_keys($task['user_assign']);
		$task['follow_uids']=array_keys($task['user_follow']);
		//将选中的用户提前显示
		$temp=array();
		if($step==1){
			foreach($taskboard['users'] as $key => $value){
				if(in_array($value['uid'],$task['assign_uids'])) {
					$temp[$value['uid']]=$value;
					unset($taskboard['users'][$key]);
				}
			}
		}else{
			foreach($taskboard['users'] as $key => $value){
				if(in_array($value['uid'],$task['follow_uids'])) {
					$temp[$value['uid']]=$value;
					unset($taskboard['users'][$key]);
				}
			}
		}
		foreach($taskboard['users'] as $key => $value){
			$temp[$key]=$value;
		}
		$taskboard['users']=$temp;unset($temp);
	}elseif($step==2){
		$alllabels=getLabelsBybtid($tbid);
		if($task['labels']>0) $task['labels']=getLabels($task['labels'],$task['tbid']);
	}elseif($step==4){
		if($task['endtime']) $task['fendtime']=dgmdate($task['endtime'],'Y-m-d');
		else $task['fendtime']=gmdate(TIMESTAMP,'Y-m-d');
	}elseif($step==5){
	
	}elseif($step==6){
		
	}elseif($step==7){
		$catlist=C::t('task_cat')->fetch_all_by_tbid($task['tbid']);
	}elseif($step==8){//任务拷贝
	   if(!submitcheck('copysubmit')){
			foreach(C::t('task_user')->fetch_all_by_id_idtype($taskid,'task',0) as $value){
				if($value['action']==2){
					 $task['user_assign'][$value['uid']]=$value;
				}elseif($value['action']==1){
					 $task['user_follow'][$value['uid']]=$value;
				}
			}
			$task['assign_num']=count($task['user_assign']);
			$task['follow_num']=count($task['user_follow']);
			
			if($task['labels']>0) {
				$task['labels']=getLabels($task['labels'],$task['tbid']);
				$task['labels_num']=count($task['labels']);
			}else{
				$task['labels_num']=0;
			}
	   }else{
		 	$options=$_GET['options'];
			$taskname=getstr($_GET['taskname']);
			 if($return=C::t('task')->copy_by_taskid($taskid,0,$taskname,1,$options)){
				 foreach(C::t('task_user')->fetch_all_by_id_idtype($taskid,'task',2) as $value){
					$return['user_assign'][$value['uid']]=$value;
				}
				$return['fendtime']=dgmdate($return['endtime'],'m-d');
				$return['labels']=getLabels($return['labels'],$return['tbid']);
				
				if($imageaidarr=getCoverImage($return['taskid'])){
					$return['imageaid']=$imageaidarr['imageaid'];
					$return['dpath']=$imageaidarr['dpath'];
					$return['aid']=$imageaidarr['aid'];
				}
				 showmessage('do_success',dreferer(),array('data'=>rawurlencode(json_encode($return))),array('showmsg'=>true));
			 }else{
				 showmessage('拷贝失败,请稍后重试');
			 }
	   }
	}elseif($step==13){ //激活任务到
		$catlist=C::t('task_cat')->fetch_all_by_tbid($task['tbid']);
		$a=trim($_GET['a']);
	}elseif($step==15){ //移除用户
		$uid=intval($_GET['uid']);
		$user=getuserbyuid($uid);
	}elseif($step==16){
		$boardlist=DB::fetch_all("select * from %t where status<1",array('task_board'));
	}elseif($step==17){
		$tbid=intval($_GET['tbid']);
		$catlist=C::t('task_cat')->fetch_all_by_tbid($tbid);
	}
	/*$task['subarr']=C::t('task_sub')->fetch_all_by_taskid($task['taskid']);
	$task['worktimearr']=C::t('task_worktime')->fetch_all_by_taskid($task['taskid']);
	
	if($task['endtime']){
		 $task['fendtime']=dgmdate($task['endtime'],'y-m-d');
		 if($task['endtime']<TIMESTAMP) $task['expire']=1;
	}*/
}elseif($do=='labelmenu'){
	$tbid=intval($_GET['tbid']);
	if(!submitcheck('labelsetting')){
		$labels_all=getAllLabels();
		$labels=C::t('task_setting')->fetch('labels_'.$tbid,true);
		$labelarr=array();
		foreach($labels_all as $key =>$value){
			if(isset($labels[$value['pow']])) $value['title']=$labels[$value['pow']];
			else $value['title']='';
			$labelarr[]=$value;
		}
	}else{
		$labels=array();
		foreach($_GET['labelname'] as $pow =>$title){
			if(!empty($title)) $labels[$pow]=getstr($title);
		}
		C::t('task_setting')->update('labels_'.$tbid,$labels);
		showmessage('do_success',dreferer(),array(),array('showmsg'=>true));
	}
}elseif($do=='catmenu'){
	$catid=intval($_GET['catid']);
	$step=intval($_GET['step']);
	$cat=C::t('task_cat')->fetch($catid);
	$taskboard=C::t('task_board')->fetch_by_tbid($cat['tbid'],$_G['uid']);
	
	if(!$step){ //主菜单
		$cat['followed']=C::t('task_user')->fetch_followed_by_id_idtype_uid($catid,'task_cat',1,$_G['uid']);
	}elseif($step==1){//新建任务
		
	}elseif($step==2){//批量操作任务
		
	}elseif($step==3){//归档完成任务
		
	}elseif($step==4){//重命名
	
	/*}elseif($step==5){//关注*/
		
	}elseif($step==6){//更多操作
	}elseif($step==7){//拷贝
	}elseif($step==8){//归档
	}elseif($step==9){//删除
	}elseif($step==10){//批量移动
		$catlist=C::t('task_cat')->fetch_all_by_tbid($cat['tbid']);
		
	}elseif($step==11){//批量分配任务
		$taskids=C::t('task')->fetch_taskids_by_catid($catid);
		$assign_all=array();
		foreach(C::t('task_user')->fetch_all_by_id_idtype($taskids,'task',2) as $value){
			$assign_all[$value['uid']]+=1;
		}
		//将选中的用户提前显示
		$temp=array();
		foreach($taskboard['users'] as $key => $value){
			if($assign_all[$value['uid']]==count($taskids)) {
				$temp[$value['uid']]=$value;
				unset($taskboard['users'][$key]);
			}
		}
		foreach($taskboard['users'] as $key => $value){
			$temp[$key]=$value;
		}
		$taskboard['users']=$temp;unset($temp);
		
	}elseif($step==12){//批量设置标签
		$alllabels=getLabelsBybtid($cat['tbid']);
	}elseif($step==13){//批量设置截止时间
		
	}
}elseif($do=='boardmenu'){
	$step=intval($_GET['step']);
	$tbid=intval($_GET['tbid']);
	$taskboard=C::t('task_board')->fetch_by_tbid($tbid,$_G['uid']);
	if($step==2){
		if($taskboard['perm']<3 && $_G['adminid']!=1){
			showmessage('no_privilege',dreferer(),$setarr,array('showmsg'=>true));
		}
		if($taskboard['orgid']) $org=DB::fetch_first("select o.*,u.perm from %t o LEFT JOIN %t u ON o.orgid=u.orgid and u.uid=%d where o.orgid=%d",array('task_organization','task_organization_user',$_G['uid'],$taskboard['orgid']));
	}
}elseif($do=='filtermenu'){
	$step=$_GET['step'];
	$tbid=intval($_GET['tbid']);
	$taskboard=C::t('task_board')->fetch_by_tbid($tbid,$_G['uid']);
	$alllabels=getLabelsBybtid($tbid);

}elseif($do=='addorg'){
	 $newperm=createOrgPerm($_G['uid']);
	 if(submitcheck('addorgsubmit')){
		 if(!$newperm['new']){
			showmessage('no_privilege',dreferer(),$setarr,array('showmsg'=>true));
		 }
		 $setarr=array('name'=>getstr($_GET['name'],255),
		 			   'desc'=>getstr($_GET['desc']),
					   'uid'=>$_G['uid'],
					   'username'=>$_G['username'],
					   'dateline'=>TIMESTAMP,
					   'privacy'=>0,
					   'mperm_c'=>3,
					   'inviteperm'=>0,
					   'removeperm'=>0
					   );
					   
		 if($setarr['orgid']=C::t('task_organization')->insert($setarr)){
		 	if($mobile){
		 		showmessage('do_success',MOD_URL);	
		 	}else{
		 		showmessage('do_success',dreferer(),$setarr,array('showmsg'=>true)); 
		 	}
			 
		 }else{
		 	if($mobile){
		 		showmessage(lang('fail_to_add'),'{MOD_URL}');	
		 	}else{
		 		showmessage(lang('fail_to_add'),dreferer(),array(),array('showmsg'=>true));
		 	}
			 
		 }
	 }else{
		 if(!$newperm['new']){
			$errmsg=lang('noperm_create_org_tips',$newperm);
		}
		 if($mobile){
			include template('mobile/cleate_group');
			dexit();	
		}
	 }
}elseif($do=='settings'){
	$orgid=intval($_GET['orgid']);
	$org=C::t('task_organization')->fetch($orgid);
	if($_GET['action']=='basic'){
		 $colors= array('#DB4550','#EB563E','#FAB943','#88C251','#36BC9B','#3BAEDA','#967BDC','#D870AD','#656D78','#434A54');
	}
}elseif($do=='org_member_role'){
	$permtitle=array('1'=>lang('observer'),'2'=>lang('members_of_the_collaboration'),'3'=>lang('manager'));
	$uid=intval($_GET['uid']);
	$orgid=intval($_GET['orgid']);
	$returntype=$_GET['returntype'];
	$perm=C::t('task_organization_user')->fetch_perm_by_uid($_G['uid'],$orgid);
	if($perm<3){
		if($returntype=='json'){
			exit(json_encode(array('error'=>lang('have_no_right'))));
		}
		exit('<div class="popbox-body">'.lang('have_no_right').'</div>');
	}
	
	if(!submitcheck('org_u_rolesubmit')){
		$org=C::t('task_organization')->fetch($orgid);
		if(!$org['perm']=DB::result_first("select `perm` from %t where orgid=%d and uid=%d",array('task_organization_user',$orgid,$uid))){
			exit('<div class="popbox-body">'.lang('this_user_is_not_a_team_member').'</div>');
		}
		if($org['perm']>2){
			$org['adminsum']=DB::result_first("select COUNT(*) from %t where orgid=%d and perm>2",array('task_organization_user',$orgid));
		}
	}else{
		$perm=intval($_GET['perm']);
		$ret=C::t('task_organization_user')->change_perm_by_uid($orgid,$uid,$perm);
		if($ret===true){
			if($returntype=='json'){
				exit(json_encode(array('uid'=>$uid,'perm'=>$perm,'permtitle'=>$permtitle[$perm])));
			}else{
				showmessage('do_success',dreferer(),array('uid'=>$uid,'perm'=>$perm,'permtitle'=>$permtitle[$perm]),array('showmsg'=>true));	
			}
				
		}else{
			if($returntype=='json'){
				exit(json_encode($ret));
			}
			showmessage($ret['error'],dreferer(),array(),array('showmsg'=>true));
		}
	}
}elseif($do=='org_member_role_confirm'){
	$uid=intval($_G['uid']);
	$tperm=intval($_GET['perm']);
	$orgid=intval($_GET['orgid']);
	$returntype=$_GET['returntype'];
	$perm=C::t('task_organization_user')->fetch_perm_by_uid($_G['uid'],$orgid);
	if($perm<3){
		if($returntype=='json'){
			exit(json_encode(array('error'=>lang('have_no_right'))));
		}
		exit('<div class="popbox-body">'.lang('have_no_right').'</div>');
	}
	
	if(!submitcheck('org_role_lost_confirmsubmit')){
		$org=C::t('task_organization')->fetch($orgid);
		$org['perm']=$perm;
	}else{
		$ret=C::t('task_organization_user')->change_perm_by_uid($orgid,$uid,$tperm);
		if($ret===true){
			if($returntype=='json'){
				exit(json_encode(array('msg'=>'success','uid'=>$uid,'perm'=>$tperm,'permtitle'=>$permtitle[$tperm])));
			}else{
				showmessage('do_success',dreferer(),array('uid'=>$uid,'perm'=>$tperm,'permtitle'=>$permtitle[$tperm]),array('showmsg'=>true));
			}
		}else{
			if($returntype=='json'){
				exit(json_encode($ret));
			}else{
				showmessage($ret['error'],dreferer(),array(),array('showmsg'=>true));
			}
			
		}
	}
}elseif($do=='org_member_remove'){
	$uid=intval($_GET['uid']);
	$orgid=intval($_GET['orgid']);
	$perm=C::t('task_organization_user')->fetch_perm_by_uid($_G['uid'],$orgid);
	if($_G['uid']!=$uid && $perm<3){
		exit('<div class="popbox-body">'.lang('have_no_right').'</div>');
	}
	
	if(submitcheck('org_member_removesubmit')){
		if($ret=C::t('task_organization_user')->remove_uid_by_orgid($orgid,$uid)){
			if($_GET['returntype']=='json'){
				$ret['uid']=$uid;
				exit(json_encode($ret));
			}else{
				if($ret['error']){
					showmessage($ret['error'],dreferer(),array(),array('showmsg'=>true));
				}else{
					showmessage('do_success',dreferer(),array('uid'=>$uid),array('showmsg'=>true));
				}
			}
		}
	}
}elseif($do=='org_member_add'){
	$orgid=intval($_GET['orgid']);
	
	$perm=C::t('task_organization_user')->fetch_perm_by_uid($_G['uid'],$orgid);
	if($perm<3){
		exit('<div class="popbox-body">'.lang('have_no_right').'</div>');
	}
}elseif($do=='member_add'){
	$tbid=intval($_GET['tbid']);
	$taskboard=C::t('task_board')->fetch_by_tbid($tbidid,$_G['uid']);
	if($_G['adminid']!=1 && $taskboard['perm']<3){
		exit('<div class="popbox-body">'.lang('have_no_right').'</div>');
	}
	$orgmembers=array();
	if($taskboard['orgid']>0){
		if(!$paicu_uids=C::t('task_user')->fetch_uids_by_cid($cid)){
			$paicu_uids=array();
		}
		$org=C::t('task_organization')->fetch($taskboard['orgid']);
		foreach(DB::fetch_all("select ou.*,u.username,u.email,u.avatarstatus,us.lastactivity from %t ou 
								LEFT JOIN %t u ON u.uid=ou.uid
								LEFT JOIN %t us ON us.uid=ou.uid
								where ou.orgid=%d and ou.uid NOT IN (%n) order by ou.dateline DESC" ,array('task_organization_user','user','user_status',$taskboard['orgid'],$paicu_uids)) as $value){
			$orgmembers[$value['uid']]=$value;		
		}
	}
	
}elseif($do=='member_role'){
	$uid=intval($_GET['uid']);
	$cid=intval($_GET['cid']);
	//$perm=C::t('task_user')->fetch_perm_by_uid($_G['uid'],$cid);
	if($_G['adminid']!=1 && C::t('task_user')->fetch_perm_by_uid($_G['uid'],$cid)<3){
		exit('<div class="popbox-body">'.lang('have_no_right').'</div>');
	}
	
	if(!submitcheck('u_rolesubmit')){
		$perm=C::t('task_user')->fetch_perm_by_uid($uid,$cid);
		if($perm>2){
			$adminsum=DB::result_first("select COUNT(*) from %t where cid=%d and perm>2",array('task_user',$cid));
		}
	}else{
		$perm=intval($_GET['perm']);
		$ret=C::t('task_user')->change_perm_by_uid($cid,$uid,$perm);
		if($ret===true){
			showmessage('do_success',dreferer(),array('uid'=>$uid,'perm'=>$perm,'permtitle'=>$permtitle[$perm]),array('showmsg'=>true));
		}else{
			showmessage($ret['error'],dreferer(),array(),array('showmsg'=>true));
		}
	}
}elseif($do=='member_role_confirm'){
	$uid=intval($_G['uid']);
	$tperm=intval($_GET['perm']);
	$cid=intval($_GET['cid']);
	$perm=C::t('task_user')->fetch_perm_by_uid($_G['uid'],$cid);
	if($_G['adminid']!=1 && $perm<3){
		exit('<div class="popbox-body">'.lang('have_no_right').'</div>');
	}
	
	if(!submitcheck('role_lost_confirmsubmit')){
		//$org=C::t('task_organization')->fetch($orgid);
		//$org['perm']=$perm;
	}else{
		
		$ret=C::t('task_user')->change_perm_by_uid($cid,$uid,$tperm);
		if($ret===true){
			showmessage('do_success',dreferer(),array('uid'=>$uid,'perm'=>$tperm,'permtitle'=>$permtitle[$tperm]),array('showmsg'=>true));
		}else{
			showmessage($ret['error'],dreferer(),array(),array('showmsg'=>true));
		}
	}
}elseif($do=='member_remove'){
	$uid=intval($_GET['uid']);
	$cid=intval($_GET['cid']);
	$perm=C::t('task_user')->fetch_perm_by_uid($_G['uid'],$cid);
	if($_G['adminid']!=1 && $_G['uid']!=$uid && $perm<3){
		exit('<div class="popbox-body">.'.lang('have_no_right').'</div>');
	}
	if(submitcheck('member_removesubmit')){
		if($ret=C::t('task_user')->remove_uid_by_cid($cid,$uid)){
			if($ret['error']){
				showmessage($ret['error'],dreferer(),array(),array('showmsg'=>true));
			}else{
				showmessage('do_success',dreferer(),array('uid'=>$uid),array('showmsg'=>true));
			}
		}
	}
}elseif($do=='org_delete'){
	$orgid=intval($_GET['orgid']);
	$perm=C::t('task_organization_user')->fetch_perm_by_uid($_G['uid'],$orgid);
	if($_G['adminid']!=1 && $perm<3){
		exit('<div class="popbox-body">'.lang('have_no_right').'</div>');
	}
	if(submitcheck('org_deletesubmit')){
		if($ret=C::t('task_organization')->delete_by_orgid($orgid)){
			showmessage('do_success',dreferer(),array('uid'=>$uid),array('showmsg'=>true));
		}else{
			showmessage(lang('delete_unsuccessful'),dreferer(),array(),array('showmsg'=>true));
		}
	}
}elseif($do=='org_share' || $do=='org_shareurl' || $do=='org_sharetowechat'){
		$orgid=intval($_GET['orgid']);
		$org=C::t('task_organization')->fetch($orgid);
		$shareurl=$_G['siteurl'].MOD_URL.'&op=org&orgid='.$orgid;
		$t = sprintf("%09d", $orgid);
		$dir1 = substr($t, 0, 3);
		$dir2 = substr($t, 3, 2);
		$dir3 = substr($t, 5, 2);
		$target='qrcode/'.$dir1.'/'.$dir2.'/'.$dir3.'/org_'.$orgid.'.png';
		if(is_file($_G['setting']['attachdir'].$target)) $qrcode=$_G['setting']['attachurl'].$target;
		else{
			$targetpath = dirname($_G['setting']['attachdir'].$target);
			dmkdir($targetpath);
			QRcode::png($shareurl,getglobal('setting/attachdir').$target,'M',4,2);
			if(is_file($_G['setting']['attachdir'].$target)) $qrcode=$_G['setting']['attachurl'].$target;
		}
}elseif($do=='taskheader'){
	$tbid=intval($_GET['tbid']);
}elseif($do=='board_user_perm'){
	$tbid=intval($_GET['tbid']);
	$uid=intval($_GET['uid']);
	$user=getuserbyuid($uid);
	$permarr=DB::fetch_first("select `perm` from %t where tbid=%d and uid=%d",array('task_board_user',$tbid,$uid));
	$perm=$permarr['perm'];
	$admin_sum=DB::result_first("select COUNT(*) from %t where tbid=%d and perm>2",array('task_board_user',$tbid));
	$mperm=C::t('task_board_user')->fetch_perm_by_uid($_G['uid'],$tbid);
	
}elseif($do=='board_user_perm_set'){
	$tbid=intval($_GET['tbid']);
	$user=getuserbyuid(intval($_GET['uid']));
	$perm=C::t('task_board_user')->fetch_perm_by_uid($_G['uid'],$tbid);	
	
}
if($ismobile){
		include template('mobile/menu');
	}else{
		include template('list/menu');
	}	





?>
