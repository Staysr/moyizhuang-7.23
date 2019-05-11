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
Hook::listen('check_login');//检查是否登录，未登录跳转到登录界面
$navtitle='回收站';
$do=trim($_GET['do']);
if(empty($do)){
	if(submitcheck('recyclesubmit')){
		foreach($_GET['del'] as $tbid){
			C::t('task_board')->delete_permanent_by_tbid($tbid);
		}
		showmessage('任务板删除成功',$_GET['refer']);
		
	}else{
		$list=array();
		$page = empty($_GET['page'])?1:intval($_GET['page']);
		$perpage=20;
		$start=($page-1)*$perpage;
		$keyword=trim($_GET['keyword']);
		$starttime=strtotime($_GET['starttime']);
		$endtime=strtotime($_GET['endtime']);
		$gets = array(
				'mod'=>MOD_NAME,
				'op' =>'recycle',
				'keyword'=>$keyword,
				'starttime'=>$starttime,
				'endtime'=>$endtime
			);
		$theurl = BASESCRIPT."?".url_implode($gets);
		$refer=$theurl.'&page='.$page;
		$param=array('task_board','task_board_user',$_G['uid'],'task_organization','user');


		$sql1="select COUNT(*) from %t b 
					LEFT JOIN %t bu ON b.tbid=bu.tbid and bu.uid=%d
					LEFT JOIN %t o  ON b.orgid=o.orgid
					LEFT JOIN %t u  ON b.statusuid=u.uid";

		$sql="select b.* ,u.username,u.uid,o.name as orgname,bu.perm as buperm 
						 from %t b 
					LEFT JOIN %t bu ON b.tbid=bu.tbid and bu.uid=%d
					LEFT JOIN %t o  ON b.orgid=o.orgid
					LEFT JOIN %t u  ON b.statusuid=u.uid";
		$where=' where b.status>1 and bu.perm>2';
		if($keyword){
			$where.=" and b.name LIKE %s";
			$param[]='%'.$keyword.'%';
		}
		if($starttime){
			$where.=" and b.statustime > %d";
			$param[]=$starttime;
		}
		if($endtime){
			$where.=" and b.statustime < %d";
			$param[]=$endtime;
		}
		//print_r($param);
		//exit("select COUNT(*) from %t u LEFT JOIN %t c ON u.cid=c.cid where $sql");
		if($count=DB::result_first($sql1.$where,$param)){
			foreach(DB::fetch_all($sql.$where."  ORDER BY b.statustime DESC limit $start,$perpage" ,$param) as $value){
				$list[$value['tbid']]=$value;
			}
			$multi = multi($count, $perpage, $page, $theurl, 'pull-right');
		}

		include template('taskboard_recycle');
		exit();
	}
}elseif($do=='restore'){
    $tbid=intval($_GET['tbid']);
	if(!$taskboard=C::t('task_board')->fetch_by_tbid($tbid,$_G['uid']) ){
		exit(json_encode(array('error'=>'任务板不存在或已删除!')));
	}
	if($taskboard['perm']<3){
		exit(json_encode(array('error'=>'没有权限!')));
	}
	if(C::t('task_board')->restore_by_tbid($tbid)){
		exit(json_encode(array('success'=>1)));
	}else{
		exit(json_encode(array('error'=>'恢复失败!')));
	}
}elseif($do=='delete'){
    $tbid=intval($_GET['tbid']);
	if(!$taskboard=C::t('task_board')->fetch_by_tbid($tbid,$_G['uid']) ){
		exit(json_encode(array('error'=>'任务板不存在或已删除!')));
	}
	if($taskboard['perm']<3){
		exit(json_encode(array('error'=>'没有权限!')));
	}
	if(C::t('task_board')->delete_permanent_by_tbid($tbid)){
		exit(json_encode(array('success'=>1)));
	}else{
		exit(json_encode(array('error'=>'删除失败!')));
	}
}

