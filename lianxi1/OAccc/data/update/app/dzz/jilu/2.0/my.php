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
require_once 'conf.php';
$ismobile=helper_browser::ismobile();
if(!$_G['uid']){
	@header("Location: $_G[siteurl]");
	exit();
}
$navtitle=APP_LIST_NAME.' - '.lang('record_book');
include_once libfile('function/code');
include_once libfile('function/common');
$perm=getPermByUid($_G['uid']);
if($_GET['do'] == 'loadmore'){
	$navtitle=APP_LIST_NAME;
	$navlast=APP_LIST_NAME;
	$publish_type=array('text'=>lang('text'),'image'=>lang('image'),'attach'=>lang('attach'),'link'=>lang('link'),'list'=>lang('list'),'video'=>lang('video'),'voice'=>lang('voice'));
	$pageSize = 10;
	$param = array('jilu_user', 'jilu');
	$sql = 'inarchive < 1 and deletetime <= 0';
	//筛选过滤
	//日期筛选
	if(isset($_GET['after']) && $_GET['after']){
	    $afterdate = strtotime($_GET['after']);
	    $sql .= " and (j.updatetime >= %d or j.dateline >= %d)";
	    $param[] = $afterdate;
	    $param[] = $afterdate;
	}
	if(isset($_GET['before']) && $_GET['before']){
	    $beforedate = strtotime($_GET['before']);
	    $sql .= " and (j.updatetime <= %d or j.dateline <= %d)";
	    $param[] = $beforedate;
	    $param[] = $beforedate;
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

	if($_GET['keyword']){
		$sql .= " and j.title LIKE %s";
		$param[] = '%'.$_GET['keyword'].'%';
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
	if ($perm < 2) { 
		$myjids = array_keys(DB::fetch_all('select jid from %t where uid = %d', array('jilu_user', $_G['uid']), 'jid'));
		$sql .= ' and u.jid in(%n)';
		if (empty($myjids)) $myjids = array(0);
		$param[] = $myjids;
	}
	$sql .= ' group by j.jid';
	$count = count(DB::fetch_all('select count(*) from %t u left join %t j on u.jid = j.jid where '.$sql, $param));
	$start = intval($_GET['nextStart']) ? intval($_GET['nextStart']) : 0;
	if($start + $pageSize < $count) $nextStart = $start + $pageSize;
	$limit = ' limit '.$start.','.$pageSize;
	$gets = array(
				'mod' 			=> 		$_GET['mod'],
				'do'			=>		'loadmore',
				'after'			=>		$_GET['after'],
				'before'		=>		$_GET['before'],
				'uids'			=>		$uids?implode(',',$uids):'',
				'mytype'		=>		$_GET['mytype'] ? implode(',', $_GET['mytype']) : '',
				
			);
	$theurl = BASESCRIPT."?".url_implode($gets);
	array_splice($param, 2, 0, array('jilu_pin', $_G['uid']));
	$orderby = $perm > 1 ? 'order by p.pin_type DESC,p.dateline DESC,j.updatetime DESC' : 'order by p.pin_type DESC,p.dateline DESC,j.updatetime DESC';
	$list=array();
	$data = DB::fetch_all("select j.*,p.pin_type from %t u left join %t j on u.jid = j.jid left join %t p on u.jid = p.data_id and (p.pin_type = 2 or (p.uid = %d and p.pin_type = 1)) where $sql $orderby $limit", $param);
	$jids = array();
	foreach($data as $value){
		$jids[] = $value['jid'];
		//取得最后一条
		$lastactive = DB::fetch_first('select i.authorid,i.author,i.content,i.type from %t i left join %t p on i.rid = p.data_id and (p.pin_type = 2 or (p.pin_type = 1 and p.uid = %d)) where i.jid = %s and i.deletetime <= 0 order by p.pin_type DESC,p.dateline desc,i.dateline desc limit 1', array('jilu_item', 'jilu_pin', $_G['uid'], $value['jid']));
		unset($value['lastactive']);
		if($lastactive){
			 $value['lastactive']['username'] = $lastactive['author'];
			 $value['lastactive']['uid'] = $lastactive['authorid'];
			 $value['lastactive']['type'] = $lastactive['type'];
			 $value['lastactive']['content'] = stripsAT($lastactive['content']);
		}
		if($value['dateline']) $value['fdateline']=dgmdate($value['dateline'],'u');
		$value['cover_uids']=C::t('jilu_user')->fetch_cover_uids_by_jid($value['jid']);
		$list[$value['jid']]=$value;
	}
	if(!empty($jids)){
		foreach (DB::fetch_all('select jid,lastvisit from %t where uid = %d and jid IN ('.dimplode($jids).')', array('jilu_user', $_G['uid'])) as $v){			
			$list[$v['jid']]['lastvisit'] = intval($v['lastvisit']);
		}
	}
}
$alllabels=getLabelsByjid($jilu['jid']);
if($_GET['do'] == 'loadmore'){
	include template('my_item');
} else {
	include template('my');
}
?>
