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
include_once libfile('function/taskboard');
$ismobile=helper_browser::ismobile();
if($_GET['do']=='updateview'){
	$tbid=intval($_GET['tbid']);
	DB::query("update %t set viewnum=viewnum+1 where tbid=%d ",array('task_board',$tbid));
}elseif($_GET['do']=='team'){
	$orgid=intval($_GET['orgid']);
	$orgs=array();
	foreach(C::t('task_organization')->fetch_all_by_uid($_G['uid'],array(2,3)) as $value){
		if($value['mperm_c']>0 ){
			$orgs[$value['orgid']]=$value;
		}
	}
	include template('mobile/mobile_taskboard_new_team');
	dexit();


}elseif($_GET['do']=='search'){
	if($_GET['submit']){
		//搜索任务板
		$wheresql = '';
		$keyword=trim($_GET['keyword']);
		$param1 = array('task_board_user','task_board',$_G['uid']);
		$param2 = array('task_board','task_board_user',$_G['uid']);
		if($keyword){
			$wheresql.=" and (c.name LIKE %s)";
			$param1[]='%'.$keyword.'%';
			
			$param2[]='%'.$keyword.'%';
			
		}
		$my=array();
		$list=array('board'=>array(),'task'=>array());		//获取我的任务板
		foreach(DB::fetch_all("select c.*,u.perm,u.lastvisit as uperm from %t u LEFT JOIN %t c ON u.tbid=c.tbid where u.uid=%d and c.status='0'  $wheresql order by c.dateline DESC" ,$param1) as $value){
			$list['board'][$value['tbid']]=$value;
		}
		
		//搜索任务
		$param=array('task','task_user','task_field','task_board');
		$sql="t.deletetime<1 and ((t.uid=%d) OR (u.uid=%d and u.action>1 and u.idtype='task'))";
		$param[]=$_G['uid'];
		$param[]=$_G['uid'];
		
		if($keyword){
			$sql.=" and f.name like %s";
			$param[]='%'.$keyword.'%';
		}

		$tasks=array();

		if($count=DB::result_first("select COUNT(*) from %t t 
								LEFT JOIN %t u ON t.taskid=u.id
								LEFT JOIN %t f ON t.taskid=f.taskid 
								LEFT JOIN %t b ON t.tbid=b.tbid 
								where  $sql",$param)){
				foreach(DB::fetch_all("select t.*,u.action,f.name,b.name as bname,b.aid as cover from %t t
										LEFT JOIN %t u ON t.taskid=u.id
										LEFT JOIN %t f ON t.taskid=f.taskid 
										LEFT JOIN %t b ON t.tbid=b.tbid 
										where  $sql  limit 100",$param) as $value){
					$tasks[$value['taskid']]=$value;
				}
		}
		$list['task']=$tasks;
		include template('mobile/taskboard_search_result');
	}else{
		include template('mobile/taskboard_search');
	}
	


}
elseif($_GET['do']=='setStar'){
	$cids=dintval($_GET['tbids'],true);
	if($cids) $tbids=implode(',',$cids);
	else $tbids='';
	C::t('user_setting')->update_by_skey('taskboard_paixu_stared',$tbids);
}elseif($_GET['do']=='addStar'){
	$action=$_GET['action'];
	$tbid=intval($_GET['tbid']);
	$paixu_stared=array();
	if($cache=C::t('user_setting')->fetch_by_skey('taskboard_paixu_stared')){
		$paixu_stared=explode(',',$cache);
	}
	if($action=='add'){
		$paixu_stared[]=$tbid;
	}else{
		$paixu_stared=array_diff($paixu_stared,array($tbid));
	}
	
	if($tbids=array_unique($paixu_stared)){
		$tbids=implode(',',$tbids);
	}else $tbids='';
	C::t('user_setting')->update_by_skey('taskboard_paixu_stared',$tbids);
	exit($tbids);
}elseif($_GET['do']=='create'){
	//检测创建权限
	$orgid=intval($_GET['orgid']);
	$newarr=createBoardPerm($orgid);
	if($newarr['errmsg']){
		showmessage($newarr['errmsg']);
	}
	 $perm=0;//默认隐私
	 if($org=DB::fetch_first("select o.*,u.perm from %t o LEFT JOIN %t u ON o.orgid=u.orgid and u.uid=%d where o.orgid=%d",array('task_organization','task_organization_user',$_G['uid'],$orgid))){
		 $perm=1;
		 if($org['mperm_c'] & 2){//团队内可见
			$perm=1;
		 }elseif($org['mperm_c'] & 1){//团队内隐私
			$perm=0;
		 }elseif($org['mperm_c'] & 4){//公开
			$perm=2;
		 }
	 }
	if(submitcheck('createsubmit')){
		
		$setarr=array('name'=>str_replace('...','',getstr($_GET['name'],80)),
					  'viewperm'=>intval($_GET['viewperm']),
					  'aid'=>intval($_GET['aid']),
					  'layout'=>intval($_GET['layout']),
					  'orgid'=>$orgid
					  );
		
			$setarr['dateline']=TIMESTAMP;
			$setarr['uid']=$_G['uid'];
			$setarr['username']=$_G['username'];
			if($setarr['tbid']=C::t('task_board')->insert_by_tbid($setarr)){
				exit(json_encode($setarr));
			}else{
				exit(json_encode(array($setarr)));
			}
	}else{
		$refer=dreferer();
		$taskboard=array();
		$navtitle='创建任务板 - 任务板';
		$navlast=' 创建任务板';
		$taskboard['aid']=1;
		
		if ($ismobile) {
			$refer=dreferer();
			include template('mobile/taskboard_new');
		} else {
			include template('taskboard_create');
		}
		dexit();
	}
	
}elseif($_GET['do']=='imageupload'){
	include libfile('class/uploadhandler');
		$options=array( 'accept_file_types' => '/\.(gif|jpe?g|jpg|png)$/i',
						'upload_dir' =>$_G['setting']['attachdir'].'cache/',
						'upload_url' => $_G['setting']['attachurl'].'cache/',
						'thumbnail'=>array('max-width'=>512,'max-height'=>512)
						);
		$upload_handler = new uploadhandler($options);
		exit();
}elseif($_GET['do']=='importupload_book'){
	 include_once libfile('class/uploadhandler');
		$options=array( 'accept_file_types' => '/\.(epub|txt)$/i',
						'upload_dir' =>$_G['setting']['attachdir'].'cache/',
						'upload_url' => $_G['setting']['attachurl'].'cache/',
						//'tospace'=>false
						);
		$upload_handler = new uploadhandler($options);
		exit();
}elseif($_GET['do']=='importupload'){
	include_once libfile('class/uploadhandler');
		$options=array( 'accept_file_types' => '/\.(CHM|MOBI|EPUB|PDF|DOCX|MD|INI|DZZDOC|HTM|HTML|SHTM|SHTML|HTA|HTC|XHTML|STM|SSI|JS|JSON|AS|ASC|ASR|XML|XSL|XSD|DTD|XSLT|RSS|RDF|LBI|DWT|ASP|ASA|ASPX|ASCX|ASMX|CONFIG|CS|CSS|CFM|CFML|CFC|TLD|TXT|PHP|JSP|WML|TPL|LASSO|JSF|VB|VBS|VTM|VTML|INC|SQL|JAVA|EDML|MASTER|INFO|INSTALL|THEME|CONFIG|MODULE|PROFILE|ENGINE)$/i',
						'upload_dir' =>$_G['setting']['attachdir'].'cache/',
						'upload_url' => $_G['setting']['attachurl'].'cache/',
						//'tospace'=>false
						);
		$upload_handler = new uploadhandler($options);
		exit();
}elseif($_GET['do']=='setSave'){

	include_once libfile('function/taskboard');
	$orgid=intval($_GET['orgid']);
	$perm=C::t('task_organization_user')->fetch_perm_by_uid($_G['uid'],$orgid);
	if($perm<3){
		exit(lang('have_no_right'));
	}
	$setarr=array();
	$setarr[trim($_GET['name'])]=$_GET['val'];
	switch($_GET['name']){
		case 'name':
			if(empty($_GET['val'])) exit(lang('name_cannot_be_empty'));
			$setarr['name']=getstr($_GET['val'],255);
			break;
		case 'desc':
			$setarr['desc']=getstr($_GET['val']);
			break;
		case 'color':
			if(preg_match("/#\w{6}/i",$_GET['val'])){
				$setarr['color']=$_GET['val'];
			}else{
				$setarr['color']='';
			}
		
			break;
			
		case 'privacy':
			$setarr[trim($_GET['name'])]=intval($_GET['val']);
			break;
		case 'cover':
			$org=C::t('task_organization')->fetch($orgid);
			if($org['cover'] && $org['cover']!=intval($_GET['val'])) C::t('attachment')->delete_by_aid($org['cover']);
			if(C::t('task_organization')->update($orgid,array('cover'=>intval($_GET['val'])))){
				C::t('attachment')->addcopy_by_aid(intval($_GET['val']));
				exit('success');
			}
			exit('error');
			break;
		case 'logo':
			$org=C::t('task_organization')->fetch($orgid);
			if($org['logo'] && $org['logo']!=intval($_GET['val'])) C::t('attachment')->delete_by_aid($org['logo']);
			if(C::t('task_organization')->update($orgid,array('logo'=>intval($_GET['val'])))){
				C::t('attachment')->addcopy_by_aid(intval($_GET['val']));
				exit('success');
			}
			exit('error');
			break;
			
	}
	C::t('task_organization')->update($orgid,$setarr);
	exit('success');
}elseif($_GET['do']=='org_member_add'){
	$orgid=intval($_GET['orgid']);
	$uid=intval($_GET['uid']);
	//判断权限
	$perm=C::t('task_organization_user')->fetch_perm_by_uid($_G['uid'],$orgid);
	if($perm<3){
		exit(json_encode(array('error'=>lang('have_no_right'))));
	}
	if(!getuserbyuid($uid)){//激活此用户
		exit(json_encode(array('error'=>lang('fail_to_add_retry_after'))));		
	}
	if(C::t('task_organization_user')->insert($orgid,$uid,2)){
		exit(json_encode(array('msg'=>'success')));
	}else{
		exit(json_encode(array('error'=>lang('fail_to_add'))));
	}
}elseif($_GET['do']=='org_member_set'){
	$orgid=intval($_GET['orgid']);
	
	if(is_array($_GET['ids'])){
		$ids=$_GET['ids'];
	}else{
		$ids=explode(',',$_GET['ids']);
	}
	
	//判断权限
	$perm=C::t('task_organization_user')->fetch_perm_by_uid($_G['uid'],$orgid);
	if($perm<3){
		exit(json_encode(array('error'=>lang('have_no_right'))));
	}
	//print_r($ids);exit('ddd=='.$orgid);
	if(C::t('task_organization_user')->insert_uids_by_orgid($orgid,$ids,2,true)){
		exit(json_encode(array('success'=>true)));
	}else{
		exit(json_encode(array('error'=>lang('fail_to_add'))));
	}	
}elseif($_GET['do']=='member_invite'){
	$email=trim($_GET['email']);
	$username=trim($_GET['username']);
	$orgid=intval($_GET['orgid']);
	$cid=intval($_GET['cid']);
	$password=random(32);
	loaducenter();
	$uid = uc_user_register(addslashes($username), $password, $email, '', '', '');
	if($uid <= 0) {
		if($uid == -1) {
			exit(json_encode(array('error'=>lang('message','profile_username_illegal'))));
		} elseif($uid == -2) {
			exit(json_encode(array('error'=>lang('message','profile_username_protect'))));
		} elseif($uid == -3) {
			exit(json_encode(array('error'=>lang('message','profile_username_duplicate'))));
		} elseif($uid == -4) {
			exit(json_encode(array('error'=>lang('message','profile_email_illegal'))));
		} elseif($uid == -5) {
			exit(json_encode(array('error'=>lang('message','profile_email_domain_illegal'))));
		} elseif($uid == -6) {
			exit(json_encode(array('error'=>lang('message','profile_email_duplicate'))));
		} elseif($uid == -7) {
			exit(json_encode(array('error'=>lang('message','profile_username_illegal'))));
		} else {
			exit(json_encode(array('error'=>lang('message','undefined_action'))));
		}
	}
	$salt=substr(uniqid(rand()), -6);
	$groupid = $_G['setting']['regverify'] ? 8 : $_G['setting']['newusergroupid'];
	$setarr=array(  'uid'=>$uid,
					'salt'=>$salt,
					'password'=>md5(md5($password).$salt),
					'username'=>$username,
					'secques'=>'',
					'email'=>$email,
					'regdate'=>TIMESTAMP,
					'groupid'=>$groupid
					);
	if(DB::insert('user',$setarr,1)){
		$status = array(
						'uid' => $uid,
						'regip' => '',
						'lastip' => '',
						'lastvisit' => 0,
						'lastactivity' => 0,
						'lastsendmail' => 0
					);
		C::t('user_status')->insert($status, false, true);
		if($cid){
			C::t('task_user')->insert_uids_by_cid($cid,array($uid),2);
		}else{
			//添加到组织
			C::t('task_organization_user')->insert($orgid,$uid,2);
		}
		//发送邀请邮件
		$idstring = random(6);
		C::t('user')->update($uid, array('authstr' => "$_G[timestamp]\t3\t$idstring"));
		require_once libfile('function/mail');
		$invite_passwd_subject = lang('email', 'invite_passwd_subject');
		$invite_passwd_message = lang(
			'email',
			'invite_passwd_message',
			array(
				'username' => $username,
				'author' => $_G['username'],
				'sitename' => $_G['setting']['sitename'],
				'siteurl' => $_G['siteurl'],
				'uid' => $uid,
				'idstring' => $idstring,
				'clientip' => $_G['clientip'],
			)
		);
		if(!sendmail("$username <$email>", $invite_passwd_subject, $invite_passwd_message)) {
			runlog('sendmail', "$email sendmail failed.");
			exit(json_encode(array('error'=>$email.lang('sending_failed_check_if_the_mailbox_is_correct'))));
		}
		exit(json_encode(array('msg'=>'success')));
	}
}elseif($_GET['do']=='org_member_invite_sendmail'){
		$uid=intval($_GET['uid']);
		$user=getuserbyuid($uid);
		list($dateline, $operation, $idstring) = explode("\t", $user['authstr']);
		if(empty($idstring)) $idstring = random(6);
		C::t('user')->update($uid, array('authstr' => "$_G[timestamp]\t3\t$idstring"));
	    require_once libfile('function/mail');
		$invite_passwd_subject = lang('email', 'invite_passwd_subject');
		$invite_passwd_message = lang(
			'email',
			'invite_passwd_message',
			array(
				'username' => $user['username'],
				'author' => $_G['username'],
				'sitename' => $_G['setting']['sitename'],
				'siteurl' => $_G['siteurl'],
				'uid' =>$uid,
				'idstring' => $idstring,
				'clientip' => $_G['clientip'],
			)
		);
		if(!sendmail("$user[username] <$user[email]>", $invite_passwd_subject, $invite_passwd_message)) {
			runlog('sendmail', "$user[email] sendmail failed.");
			exit(json_encode(array('error'=>$user['email'].lang('sending_failed_check_if_the_mailbox_is_correct'))));
		}
		exit(json_encode(array('msg'=>'success')));

}elseif($_GET['do']=='search_user_list'){
	$orgid=intval($_GET['orgid']);
	$cid=intval($_GET['cid']);
	$term=getstr($_GET['term']);
	//检查email
	if(strlen($term)<2){
		exit(json_encode(array('isemail'=>0,'num'=>0,'term'=>$term)));
	}
	$sqladd = $sqlsearch ='where 1';
	if($isemail=isemail($term)){
		
		$sqladd.=" and email = '{$term}'";
		$sqlsearch .=" and u.email = %s";
		$param = $term;
	}else{
		$sqladd.=" and username like '%".$term."%'";
		$sqlsearch .=" and u.username like %s";
		$param = "%".$term."%";
	}
	$list=array();
	foreach(DB::fetch_all("select u.uid,u.username,u.email,u.avatarstatus,us.lastactivity,ou.uid as joined from %t u 
									LEFT JOIN %t us ON u.uid=us.uid
									LEFT JOIN %t ou ON ou.uid=u.uid and ou.orgid=%d 
									$sqlsearch" ,array('user','user_status','task_organization_user',$orgid,$param)) as $value){
		$value['avatar_block']=avatar_block($value['uid'],null,'iconFirstWord');
		$list[]=$value;
	}
	if($isemail){
		list($username,$temp)=explode('@',$term);
		include libfile("function/user",'','user');
		if(preg_match("/_(\d+)$/i",$username,$matches)){
			$pnum=intval($matches[1]);
		}else{
			$pnum=1;
		}
		
		$username=$username.$padding.$pnum;	
	}
	exit(json_encode(array('isemail'=>$isemail,'username'=>$username,'num'=>count($list),'term'=>$term,'list'=>$list)));

}elseif($_GET['do']=='getuser'){
	
	$term=trim($_GET['term']);
	$page=empty($_GET['page'])?1:intval($_GET['page']);
	$perpage=30;
	$start=($page-1)*$perpage;
	$not_uids=$_GET['notuids']?explode(',',$_GET['notuids']):array();
	
	$param_user=array('user','user_status');
	$sql_user="where u.status<1 ";
	if($not_uids) {
		$sql_user.=" and u.uid NOT IN(%n)";
		$param_user[]=$not_uids;
	}
	if($term){
	   $sql_user.=" and (u.username LIKE %s OR u.email LIKE %s)";
	   $param_user[]='%'.$term.'%';
	   $param_user[]='%'.$term.'%';
	}
	$data=array();
	
	if($count=DB::result_first("select COUNT(*) from %t u  LEFT JOIN %t s on u.uid=s.uid  $sql_user",$param_user)){
	  foreach(DB::fetch_all("select DISTINCT u.uid,u.username  from %t u LEFT JOIN %t s on u.uid=s.uid  $sql_user order by s.lastactivity DESC limit $start,$perpage",$param_user) as $value){
			
			 $data[]=array('uid'=>$value['uid'],
						   'username'=>$value['username']
						);
			
	  }
	}

  exit(json_encode(array('total_count'=>$count,'items'=>$data)));
}

?>
