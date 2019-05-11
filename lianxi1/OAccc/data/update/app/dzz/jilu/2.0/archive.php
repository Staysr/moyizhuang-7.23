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
if(!$_G['uid']){
	showmessage(lang('to_login'));
	exit();
}
$navtitle=lang('navtitle_archived_list').' - '.lang('record_book');
require_once 'conf.php';
$ismobile=helper_browser::ismobile();
include_once libfile('function/common');
$perm=getPermByUid($_G['uid']); 
if($_GET['do'] == 'loadmore') {
	$navtitle=lang('navtitle_archived');
	$navlast=lang('navtitle_archived');
	$pageSize=10;
	$param=array('jilu', 'jilu_user');
	$sql = 'j.inarchive > 0';
	//筛选过滤
	//日期筛选
	if(isset($_GET['after']) && $_GET['after']){
	    $afterdate = strtotime($_GET['after']);
	    $sql .= " and j.archivetime >= %d";
	    $param[] = $afterdate;
	}
	if(isset($_GET['before']) && $_GET['before']){
	    $beforedate = strtotime($_GET['before']);
	    $sql .= " and j.archivetime <= %d";
	    $param[] = $beforedate;
	}
	if($_GET['keyword']){
		$sql .= ' and j.title LIKE %s';
		$param[] = '%'.$_GET['keyword'].'%';
	}

	if($_GET['uids']){//过滤用户
		$_GET['uids'] = is_array($_GET['uids']) ? $_GET['uids'] : explode(',',$_GET['uids']);
		$uids=array();
		foreach($_GET['uids'] as  $uid){
			if(intval($uid)){
				$uids[]=intval($uid);
			}
		}
		if($uids){
			$sql .= " and u.uid IN(%n)";
			$param[]=$uids;
		}
	}

	if ($_GET['mytype']) {//我创建，我关注，我协作过滤
		$sql .= ' and (';
		$_GET['mytype'] = is_array($_GET['mytype']) ? $_GET['mytype'] : explode(',', $_GET['mytype']);
		foreach ($_GET['mytype'] as $v) {
			switch ($v) {
				case 'mycreate':
					$param[] = $_G['uid'];
					$my_type[] = 'j.authorid = %d';
					break;
				case 'myfllow':
					$param[] = $_G['uid'];
					$my_type[] = '(u.perm = 1 and u.uid = %d)';
					break;
				case 'mycooper':
					$my_type[] = '(u.perm = 2 and u.uid = %d)';
					$param[] = $_G['uid'];
					break;
				default:
					break;
			}
		}
		$sql .= implode(' or ', $my_type);
		$sql .= ')';
	}
	//end筛选过滤
	$gets = array(
				'mod' 			=> 		$_GET['mod'],
				'do'			=>		'loadmore',
				'op'			=>		'archive',
				'keyword'		=>		$_GET['keyword'],
				'after'			=>		$_GET['after'],
				'before'		=>		$_GET['before'],
				'uids'			=>		$uids?implode(',',$uids):'',
				'mytype'		=>		$_GET['mytype'] ? implode(',', $_GET['mytype']) : '',
				
			);
	$theurl = BASESCRIPT."?".url_implode($gets);
	if($perm < 2){
		$sql.=" and u.uid = %d";
		$param[] = $_G['uid'];
	}
	$sql .= ' group by j.jid';
	$orderby = 'order by archivetime DESC';
	$count = count(DB::fetch_all("SELECT COUNT(*) FROM %t j left join %t u on j.jid = u.jid WHERE $sql",$param));
	$start = intval($_GET['nextStart']) ? intval($_GET['nextStart']) : 0;
	if($start + $pageSize < $count) $nextStart = $start + $pageSize;
	$limit = ' limit '.$start.','.$pageSize;
	$list=array();
	if($count){
		foreach(DB::fetch_all("SELECT j.*,u.perm FROM %t j left join %t u on j.jid = u.jid WHERE $sql $orderby $limit",$param) as $value){
			if($value['dateline']) $value['fdateline']=dgmdate($value['dateline'],'u');
			$value['cover_uids']=C::t('jilu_user')->fetch_cover_uids_by_jid($value['jid']);
			$list[$value['jid']]=$value;
		}
	}
}
if ($_GET['do'] == 'loadmore') {
	include template('archive_item');
} else {
	include template('archive');
}

?>
