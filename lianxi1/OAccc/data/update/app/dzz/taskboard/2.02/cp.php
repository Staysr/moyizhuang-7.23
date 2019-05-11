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

$do=trim($_GET['do']);
$tbid=intval($_GET['tbid']);
$taskid=intval($_GET['taskid']);
if($taskid){
	$task=C::t('task')->fetch($taskid,0,1);//("select * from %t where taskid=%d ",array('task',$taskid));
	$tbid=$task['tbid'];
}
if(!$taskboard=C::t('task_board')->fetch_by_tbid($tbid,$_G['uid']) ){
	showmessage('任务板不存在或已删除',dreferer());
}

if($taskboard['perm']<2){
	showmessage('没有权限');
}

if($do=='saveLabel'){
	$taskid=intval($_GET['taskid']);
	$label=intval($_GET['label']);
	if(C::t('task')->update($taskid,array('labels'=>$label))) exit('sucess');
}elseif($do=='setLabel'){
	$taskid=intval($_GET['taskid']);
	$pow=intval($_GET['pow']);
	$isadd=intval($_GET['isadd']);
	C::t('task')->setLabel($taskid,$pow,$isadd);
	exit('sucess');	
}elseif($do=='saveuser'){
	$taskid=intval($_GET['taskid']);
	$type=trim($_GET['type']);
	$action=intval($_GET['action']);
	$uid=intval($_GET['uid']);
	if($type=='remove'){
		if(C::t('task_user')->delete_by_id_idtype_uid($taskid,'task',$action,$uid)) exit('success');
	}elseif($type=='add'){
		$arr=array('tbid'=>$tbid,
					'id'=>$taskid,
					'idtype'=>'task',
					'action'=>$action,
					'uid'=>$uid,
					'username'=>$_GET['username'],
					'dateline'=>TIMESTAMP
					);
		if(C::t('task_user')->insert($arr)){
			exit('success');	
		}
	}
}elseif($do=='saveendtime'){
	$taskid=intval($_GET['taskid']);
	$endtime=empty($_GET['endtime'])?0:trim($_GET['endtime']);
	if(C::t('task')->update_by_taskid($taskid,array('endtime'=>strtotime($endtime)))){
		exit('success');
	};
}elseif($do=='saveworktime'){
	$taskid=intval($_GET['taskid']);
	$worktime=intval($_GET['worktime']);
	if(C::t('task')->update_by_taskid($taskid,array('worktime'=>$worktime))){
		exit('success');
	};
}elseif($do=='savemoney'){
	$taskid=intval($_GET['taskid']);
	$money=intval($_GET['money']);
	if(C::t('task')->update_by_taskid($taskid,array('money'=>$money))){
		exit('success');
	};
}elseif($do=='taskdelete'){
	$taskid=intval($_GET['taskid']);
	C::t('task')->delete_by_taskid($taskid);
	exit(json_encode(array('msg'=>'success')));
}elseif($do=='taskdeletepermanent'){
	if($taskboard['perm']<3 && $_G['adminid']!=1) exit(json_encode(array('error'=>'没有权限')));
	$taskid=intval($_GET['taskid']);
	C::t('task')->delete_by_taskid($taskid,true);
	exit(json_encode(array('msg'=>'success')));
}elseif($do=='moveto'){
	$taskid=intval($_GET['taskid']);
	$catid=intval($_GET['catid']);
	if(C::t('task')->setDispByTaskid($taskid,0,$catid)){
		exit(json_encode(array('msg'=>'success')));	
	}else{
		exit(json_encode(array('error'=>'移动未成功')));	
	}
}elseif($do=='taskcomplete'){
	$taskid=intval($_GET['taskid']);
	$status=intval($_GET['status']);
	if(C::t('task')->setStatus($taskid,$status)) exit(json_encode(array('msg'=>'success')));
}elseif($do=='taskarchive'){
	$taskids=($_GET['taskids']);
	$ids=array();
	foreach($taskids as $taskid){
		if(C::t('task')->archive_by_taskid($taskid)){
			$ids[]=$taskid;
		}
	}
    exit(json_encode(array('msg'=>'success','taskids'=>$ids)));
}elseif($do=='tasksubadd'){
	$arr=array('subname'=>getstr($_GET['subname']),
			   'tbid'=>$tbid,
			   'taskid'=>intval($_GET['taskid']),
			   'uid'=>$_G['uid'],
			   'completed'=>0
			   );
	if(empty($arr['subname'])) exit(json_encode(array('error'=>'任务检查项名称不能为空')));
	if($arr['subid']=C::t('task_sub')->insert($arr)){
		$arr['msg']='success';
		exit(json_encode($arr));
	}else{
		exit(json_encode(array('error'=>'添加任务检查项失败')));
	}
}elseif($do=='tasksubedit'){
	$subid=intval($_GET['subid']);
	$subname=getstr($_GET['subname']);
	C::t('task_sub')->rename_by_subid($subid,$subname);
	exit(json_encode(array('msg'=>'success')));
}elseif($do=='tasksubdel'){
	$subid=intval($_GET['subid']);
	if(C::t('task_sub')->delete_by_subid($subid)){
		
	}
	exit(json_encode(array('msg'=>'success')));
}elseif($do=='tasksubcomplete'){
	$subid=intval($_GET['subid']);
	$completed=intval($_GET['completed']);
	if($completed) $completed=TIMESTAMP;
	if(C::t('task_sub')->setStatusBySubid($subid,$completed)){
		exit(json_encode(array('msg'=>'success')));
	}
	exit(json_encode(array('error'=>'error')));
}elseif($do=='taskedit'){
	$taskid=intval($_GET['taskid']);
	$field=array('description'=>helper_security::checkhtml($_GET['message']),
				 'name'=>getstr($_GET['taskname'])
				 );
	C::t('task_field')->update($taskid,$field);
		$field['taskid']=$taskid;
		showmessage('do_success',dreferer(),array('data'=>rawurlencode(json_encode($field))),array('showmsg'=>true));
}elseif($do=='taskattachsave'){
	$taskid=intval($_GET['taskid']);
	$setarr=array('taskid'=>$taskid,
				  'aid'=>intval($_GET['aid']),
				  'tbid'=>$tbid,
				  'filename'=>$_GET['filename'],
				  'filesize'=>intval($_GET['filesize']),
				  'filetype'=>!empty($_GET['ext'])?trim($_GET['ext']):trim($_GET['filetype']),
				  'uid'=>$_G['uid'],
				  'type'=>intval($_GET['aid'])?'attach':trim($_GET['type']),
				  'img'=>intval($_GET['aid'])?'':trim($_GET['img']),
				  'url'=>intval($_GET['aid'])?'':trim($_GET['url']),
				  'dateline'=>TIMESTAMP
				  );
	if($setarr['id']=C::t('task_attach')->insert($setarr)){
		$return=C::t('task_attach')->fetch_by_id($setarr['id']);
		$taskinfo=DB::fetch_first("select attachs,imageaid from %t where taskid=%d",array('task',$taskid));
		$return['attachs']=$taskinfo['attachs'];
		if(empty($taskinfo['imageaid'])){
			if(in_array($setarr['filetype'],array('jpg','jpeg','gif','png'))){
				$return['imageaid']=$return['id'];
				$return['dpath']=dzzencode('attach::'.$return['aid']);
			}
		}
		$return['msg']='success';
		exit(json_encode($return));
	}else{
		exit(json_encode(array('error'=>'附件保存失败')));
	}
}elseif($do=='upload'){
	include libfile('class/uploadhandler');
	$options=array(
					'upload_dir' =>$_G['setting']['attachdir'].'cache/',
					'upload_url' => $_G['setting']['attachurl'].'cache/',
					'thumbnail'=>array('max-width'=>256,'max-height'=>256)
					);
	$upload_handler = new uploadhandler($options);
	exit();
}elseif($do=='taskattachdel'){
	$attachid=intval($_GET['attachid']);
	if($ret=C::t('task_attach')->delete_by_id($attachid)){
		$ret['msg']='success';
		exit(json_encode($ret));
	}
	exit(json_encode(array('error'=>'删除失败')));
}elseif($do=='taskattachrestore'){
	$attachid=intval($_GET['id']);
	C::t('task_attach')->restore_by_id($attachid);
	exit(json_encode(array('msg'=>'success')));
}elseif($do=='taskattachdeletepermanent'){
	if($taskboard['perm']<3 && $_G['adminid']!=1) exit(json_encode(array('error'=>'没有权限')));
	$attachid=intval($_GET['id']);
	C::t('task_attach')->delete_by_id($attachid,1,1);
	exit(json_encode(array('msg'=>'success')));
}elseif($do=='catrename'){
	$catid=intval($_GET['catid']);
	$catname=getstr(trim($_GET['catname']));
	C::t('task_cat')->update_by_catid($catid,array('catname'=>$catname));
	exit(json_encode(array('msg'=>'success','catid'=>$catid,'catname'=>$catname)));
}elseif($do=='catcopy'){
	$catid=intval($_GET['catid']);
	$catname=getstr(trim($_GET['catname']));
	if($cat=C::t('task_cat')->copy_by_catid($catid,$catname)){
		if($cat['error']){
			exit(json_encode(array('error'=>$cat['error'])));
		}else{
			$cat['msg']=='success';
			exit(json_encode($cat));
		}
	}else{
		exit(json_encode(array('error'=>'拷贝失败')));
	}
}elseif($do=='catdelete'){
	$catid=intval($_GET['catid']);	
	if(C::t('task_cat')->delete_by_catid($catid)){
		
	}
	exit(json_encode(array('msg'=>'success')));
}elseif($do=='catdeletepermanent'){
	if($taskboard['perm']<3 && $_G['adminid']!=1) exit(json_encode(array('error'=>'没有权限')));
	$catid=intval($_GET['catid']);	
	if(C::t('task_cat')->delete_by_catid($catid,true)){
		
	}
	exit(json_encode(array('msg'=>'success')));
}elseif($do=='catarchive'){
	$catid=intval($_GET['catid']);	
	if(C::t('task_cat')->archive_by_catid($catid)){
		
	}
	exit(json_encode(array('msg'=>'success')));
}elseif($do=='batchmoveto'){
	$taskids=($_GET['taskids']);
	$catid=intval($_GET['catid']);
	$ids=array();
	foreach($taskids as $taskid){
		if(C::t('task')->setDispByTaskid($taskid,0,$catid,0)){
			$ids[]=$taskid;
		}
	}
    exit(json_encode(array('msg'=>'success','taskids'=>$ids)));
}elseif($do=='addCatlist'){ //创建任务分类
	$setarr=array('catname'=>getstr($_GET['catname'],80),
				  'tbid'=>$tbid,
				  'uid'=>$_G['uid'],
				  'username'=>$_G['username'],
				  'dateline'=>TIMESTAMP
				  );
	if(empty($setarr['catname'])){
		exit(json_encode(array('error'=>'任务分类名称不能为空')));
	}
	if($setarr['catid']=C::t('task_cat')->insert($setarr)){
		exit(json_encode($setarr));
	}else{
		exit(json_encode(array('error'=>'创建任务分类错误')));
	}
}elseif($do=='addtask'){ //创建任务
	$setarr=array('catid'=>intval($_GET['catid']),
				  'tbid'=>$tbid,
				  'uid'=>$_G['uid'],
				  'username'=>$_G['username'],
				  'money'=>intval($_GET['time']),
				  'labels'=>intval($_GET['labels']),
				  'endtime'=>$_GET['time']?strtotime($_GET['time']):0,
				  'dateline'=>TIMESTAMP
				  );
	$field=array('name'=>getstr($_GET['taskname']));
	if(empty($field['name'])){
		exit(json_encode(array('error'=>'任务名称不能为空')));
	}
	if($_GET['uids']) $uids=dintval($_GET['uids']);
	else $uids=array();
	$users=array();
	if($setarr['taskid']=C::t('task')->insert($setarr,$field)){
		if($uids){//插入用户
			foreach($uids as $uid){
				if($user=getuserbyuid($uid)){
					$arr=array('tbid'=>$tbid,
								'id'=>$setarr['taskid'],
								'idtype'=>'task',
								'uid'=>$uid,
								'username'=>$user['username'],
								'action'=>2,
								'dateline'=>TIMESTAMP
								);
					if($arr['tuid']=C::t('task_user')->insert($arr)){
						$users[]=$arr;
					}
				}
			}
		}
		$setarr['name']=$field['name'];
		$setarr['users_assign']=$users;
		$setarr['fendtime']=$_GET['time'];
		$setarr['labels']=getLabels($setarr['labels']);
		exit(json_encode($setarr));
	}else{
		exit(json_encode(array('error'=>'创建任务错误')));
	}
}elseif($do=='savecatlist'){
	$catlist=($_GET['catlist']);
	if($catlist){
		C::t('task_setting')->update('catlist_'.$tbid,implode(',',$catlist));
	}
	exit('success');
}elseif($do=='savemovetask'){
	$taskid=intval($_GET['taskid']);
	$btaskid=intval($_GET['prevtaskid']);
	$catid=intval($_GET['catid']);
	if($taskid && $catid){
		C::t('task')->setDispByTaskid($taskid,$btaskid,$catid);
	}
	exit('success');
}elseif($do=='savemovetasksub'){
	$taskid=intval($_GET['taskid']);
	$bsubid=intval($_GET['prevsubid']);
	$subid=intval($_GET['subid']);
	C::t('task_sub')->setDispBySubid($subid,$bsubid,$taskid);
	
	exit('success');
}elseif($do=='catfollow'){
	$catid=intval($_GET['catid']);
	$isadd=intval($_GET['isadd']);
	$setarr=array('tbid'=>$tbid,
				  'id'=>$catid,
				  'idtype'=>'task_cat',
				  'uid'=>$_G['uid'],
				  'username'=>$_G['username'],
				  'action'=>1,
				  'dateline'=>TIMESTAMP
				  );
	if($isadd){
		C::t('task_user')->insert($setarr);
	}else{
		C::t('task_user')->delete_by_id_idtype_uid($catid,'task_cat',1,$_G['uid']);
	}
	exit('success');

}elseif($do=='filterme'){
	$metype=trim($_GET['metype']);
	$taskids=array();
	if($metype=='assign'){
		foreach(DB::fetch_all("select id from %t where tbid=%d and action='2' and uid=%d and idtype='task'",array('task_user',$tbid,$_G['uid'])) as $value){
			$taskids[]=$value['id'];
		}
	}elseif($metype=='follow'){
		foreach(DB::fetch_all("select id from %t where tbid=%d and action='1' and uid=%d and idtype='task'",array('task_user',$tbid,$_G['uid'])) as $value){
			$taskids[]=$value['id'];
		}
	}elseif($metype=='create'){
		foreach(DB::fetch_all("select taskid from %t where tbid=%d and status<3  and uid=%d ",array('task',$tbid,$_G['uid'])) as $value){
			$taskids[]=$value['taskid'];
		}
	}
	exit(json_encode(array('msg'=>'success','taskids'=>$taskids)));
	
}elseif($do=='taskactive'){
	$taskid=intval($_GET['taskid']);
	$catid=intval($_GET['catid']);
	if(C::t('task')->active_by_taskid($taskid,$catid)){
		exit(json_encode(array('msg'=>'success')));
	}
	exit(json_encode(array('error'=>'失败')));
}elseif($do=='taskrestore'){
	$taskid=intval($_GET['taskid']);
	$catid=intval($_GET['catid']);
	if(C::t('task')->restore_by_taskid($taskid,$catid)){
		exit(json_encode(array('msg'=>'success')));
	}
	exit(json_encode(array('error'=>'失败')));
}elseif($do=='catactive'){
	$catid=intval($_GET['catid']);
	if(C::t('task_cat')->active_by_catid($catid)){
		exit(json_encode(array('msg'=>'success')));
	}
	exit(json_encode(array('error'=>'失败')));
}elseif($do=='catrestore'){
	$catid=intval($_GET['catid']);
	if(C::t('task_cat')->restore_by_catid($catid)){
		exit(json_encode(array('msg'=>'success')));
	}
	exit(json_encode(array('error'=>'失败')));

}elseif($do=='boardautoarchive'){//修改配置项
	$perm=C::t('task_board_user')->fetch_perm_by_uid($_G['uid'],$tbid);
	if($perm<3){
		exit(json_encode(array('error'=>'没有权限')));
	}
	$autoarchive=intval($_GET['autoarchive']);
	C::t('task_board')->update_by_tbid($tbid,array('autoarchive'=>$autoarchive));
	exit(json_encode(array('msg'=>'success')));
}elseif($do=='setCoverImage'){//设置封面图片
	$id=intval($_GET['id']);
	$taskid=intval($_GET['taskid']);
	$task=C::t('task')->fetch($taskid);
	if($task['imageaid']==$id){
		$arr=array('imageaid'=>0);
	}else{
		$arr=array('imageaid'=>$id);
	}
	C::t('task')->update($taskid,$arr);
	
	exit(json_encode($arr));
}
?>
