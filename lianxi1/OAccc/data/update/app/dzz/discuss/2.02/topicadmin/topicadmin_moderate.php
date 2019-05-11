<?php
/*
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
if(!defined('IN_DZZ')) {
	exit('Access Denied');
}
if(!empty($_G['tid'])) {
	$_GET['moderate'] = array($_G['tid']);
}
$allow_operation = array('delete', 'highlight', 'stick', 'digest', 'movetype', 'removeopt', 'recycle');

$operations = empty($_GET['operations']) ? array() : $_GET['operations'];
if($operations && $operations != array_intersect($operations, $allow_operation)) {
	exit(json_encode(array('code' => 400, 'message' => lang('admin_moderate_invalid'))));
}

$threadlist = $loglist = $posttablearr = $authors = array();

$recommend_group_count = 0;
$operation = getgpc('operation');
loadcache('threadtableids');
$threadtableids = !empty($_G['cache']['threadtableids']) ? $_G['cache']['threadtableids'] : array();
if(!in_array(0, $threadtableids)) {
	$threadtableids = array_merge(array(0), $threadtableids);
}

if($_GET['moderate']) {
	
	foreach($threadtableids as $tableid) {
		foreach(C::t('discuss_thread')->fetch_all_by_tid_fid_displayorder(0, $_GET['moderate'], $discuss['fid'], null, '', 0, 100, '', '', $tableid) as $thread) {
			if ($thread['fid'] != $fid || $thread['inarchive'] || $thread['isdelete']) continue;
			$thread['lastposterenc'] = rawurlencode($thread['lastposter']);
			$thread['dblastpost'] = $thread['lastpost'];
			$thread['lastpost'] = dgmdate($thread['lastpost'], 'u');
			$posttablearr[$thread['posttableid'] ? $thread['posttableid'] : 0][] = $thread['tid'];
			$authors[$thread['authorid']] = 1;
			$threadlist[$thread['tid']] = $thread;
			$_G['tid'] = empty($_G['tid']) ? $thread['tid'] : $_G['tid'];
		}
		if(!empty($threadlist)) {
			break;
		}
	}
}
if(empty($threadlist)) {
	exit(json_encode(array('code' => 400, 'message' => '操作失败')));
}

$authorcount = count(array_keys($authors));
$modpostsnum = count($threadlist);
$single = $modpostsnum == 1 ? TRUE : FALSE;
$frommodcp = getgpc('frommodcp');
switch($frommodcp) {
	case '1':
		$_G['referer'] = "forum.php?mod=modcp&action=thread&fid=$_G[fid]&op=thread&do=list";
		break;
	case '2':
		$_G['referer'] = "forum.php?mod=modcp&action=forum&op=recommend".(getgpc('show') ? "&show=getgpc('show')" : '')."&fid=$_G[fid]";
		break;
	default:
		if(in_array('delete', $operations) || in_array('move', $operations) && !strpos($_SERVER['HTTP_REFERER'], 'search.php?mod=forum')) {
			$_G['referer'] = DZZSCRIPT.'?mod=discuss&op=list&fid='.$fid.(!empty($_GET['listextra']) ? '&'.rawurldecode($_GET['listextra']) : '');
		} else {
			$_G['referer'] = $_GET['redirect'];
		}
		break;
}

$optgroup = $_GET['optgroup'] = isset($_GET['optgroup']) ? intval($_GET['optgroup']) : 0;

$defaultcheck = array();
foreach ($allow_operation as $v) {
	$defaultcheck[$v] = '';
}
$defaultcheck[$operation] = 'checked="checked"';

if(!submitcheck('modsubmit')) {
	exit(json_encode(array('code' => 400, 'message' => '提交方式有误')));
} else {
	$tidsarr = array_keys($threadlist);
	$moderatetids = dimplode($tidsarr);
	$reason = $_GET['reason'];
	$stampaction = 'SPA';
	if(empty($operations)) {
		exit(json_encode(array('code' => 400, 'message' => '请选择操作')));
	} else {
		$images = array();
		foreach($operations as $operation) {

			$updatemodlog = TRUE;
			if($operation == 'stick') {//置顶
				$optitle = lang('stick');
				$sticklevel = intval($_GET['sticklevel']);
				if($sticklevel < 0 || $sticklevel > 3 ) {
					exit(json_encode(array('code' => 400, 'message' => '置顶权限错误')));
				}
				switch ($_GET['effective']) {
					case 'day':
						$starttime = TIMESTAMP;
						$expiration = $starttime + (24*3600);
						break;
					case 'week':
						$starttime = TIMESTAMP;
						$expiration = $starttime + (24*3600*7);
						break;
					case 'month':
						$starttime = TIMESTAMP;
						$expiration = $starttime + (24*3600*30);
						break;
					case 'diy':
						$starttime = strtotime($_GET['starttime']);
						$expiration = strtotime($_GET['endtime']);
						break;
					default:
						$starttime = 0;
						$expiration = 0;
						break;
				}
				checkexpiration($starttime, $endtime);
				$expirationstick = $sticklevel ? $expiration : 0;

				$updatearr= array('displayorder'=>$sticklevel, 'moderated'=>1);
				C::t('discuss_thread')->update($tidsarr, $updatearr, true);
				
				
				$modaction = $sticklevel ? ($expiration ? 'EST' : 'STK') : 'UST';
				C::t('discuss_threadmod')->update_by_tid_action($tidsarr, array('STK', 'UST', 'EST', 'UES'), array('status' => 0));

				if(!$sticklevel) {
					$stampaction = 'SPD';
				}


			} elseif($operation == 'highlight') {
				$optitle = lang('highlight');
				$highlight_style = $_GET['highlight_style'];
				$highlight_color = $_GET['highlight_color'];
				$highlight_bgcolor = $_GET['highlight_bgcolor'];
				switch ($_GET['effective']) {
					case 'day':
						$starttime = TIMESTAMP;
						$expiration = $starttime + (24*3600);
						break;
					case 'week':
						$starttime = TIMESTAMP;
						$expiration = $starttime + (24*3600*7);
						break;
					case 'month':
						$starttime = TIMESTAMP;
						$expiration = $starttime + (24*3600*30);
						break;
					case 'diy':
						$starttime = strtotime($_GET['starttime']);
						$expiration = strtotime($_GET['endtime']);
						break;
					default:
						$starttime = 0;
						$expiration = 0;
						break;
				}
				checkexpiration($starttime, $endtime);
				$stylebin = '';
				for($i = 0; $i <= 2; $i++) {
					$stylebin .= empty($highlight_style[$i]) ? '0' : '1';
				}

				$highlight_style = bindec($stylebin);
				if($highlight_style < 0 || $highlight_style > 7) {
					exit(json_encode(array('code' => 400, 'message' => '参数错误')));
				}
				$bgcolor = dhtmlspecialchars(preg_replace("/[^\[A-Za-z0-9#]/", '', $_GET['highlight_bgcolor']));
				$modaction = $expiration ? 'EHL' : 'HLT';
				C::t('discuss_thread')->update($tidsarr, array('highlight'=>json_encode(array('highlight_style' => $highlight_style, 'highlight_color' => $highlight_color, 'highlight_effective' => $_GET['effective'], 'modaction' => $modaction)), 'moderated'=>1, 'bgcolor' => $bgcolor), true);

				
				C::t('discuss_threadmod')->update_by_tid_action($tidsarr, array('HLT', 'UHL', 'EHL', 'UEH'), array('status' => 0));

			} elseif($operation == 'digest') {
				$optitle = lang('digest');
				$digestlevel = intval($_GET['digestlevel']);
				if($digestlevel < 0 || $digestlevel > 3 ) {
					exit(json_encode(array('code' => 400, 'message' => '精华设置错误')));
				}
				switch ($_GET['effective']) {
					case 'day':
						$starttime = TIMESTAMP;
						$expiration = $starttime + (24*3600);
						break;
					case 'week':
						$starttime = TIMESTAMP;
						$expiration = $starttime + (24*3600*7);
						break;
					case 'month':
						$starttime = TIMESTAMP;
						$expiration = $starttime + (24*3600*30);
						break;
					case 'diy':
						$starttime = strtotime($_GET['starttime']);
						$expiration = strtotime($_GET['endtime']);
						break;
					default:
						$starttime = 0;
						$expiration = 0;
						break;
				}
				checkexpiration($starttime, $endtime);
				$expirationdigest = $digestlevel ? $expirationdigest : 0;

				$updatearr= array('digest'=>$digestlevel, 'moderated'=>1);
				C::t('discuss_thread')->update($tidsarr, $updatearr, true);
				foreach($threadlist as $thread) {
					if($thread['digest'] != $digestlevel) {
						if($digestlevel == $thread['digest']) continue;
						$extsql = array();
						if($digestlevel > 0 && $thread['digest'] == 0) {
							$extsql = array('digestposts' => 1);
						}
						if($digestlevel == 0 && $thread['digest'] > 0) {
							$extsql = array('digestposts' => -1);
						}
						if($digestlevel == 0) {
							$stampaction = 'SPD';
						}
					}
				}

				$modaction = $digestlevel ? ($expiration ? 'EDI' : 'DIG') : 'UDG';
				C::t('discuss_threadmod')->update_by_tid_action($tidsarr, array('DIG', 'UDI', 'EDI', 'UED'), array('status' => 0));

			} elseif ($operation == 'recycle') {//讨论版下的多主题删除进回收站
				foreach ($threadlist as $thread) {
					$setarr = array(
								'fid'	=>	intval($thread['fid']),
								'type'	=>	'thread',
								'id'	=>	$thread['tid'],
								'authorid'	=>	$thread['authorid'],
								'deleteuid'	=>	$_G['uid'],
								'deletetime'	=>	TIMESTAMP,	
							);	
					if (C::t('discuss_recycle')->insert($setarr)) {
						C::t('discuss_thread')->update($thread['tid'], array('isdelete' => 1, 'deleteuid' => $_G['uid'], 'deletetime' => TIMESTAMP));
						//给版主发送通知
						$uids= C::t('discuss_user')->fetch_uids_by_fid($thread['fid'],3);
						$appid=C::t('app_market')->fetch_appid_by_mod('discuss',0);
						foreach($uids as $uid){
							if($uid!=getglobal('uid')){
								//发送通知
								$notevars=array(
												'from_id'=>$appid,
												'from_idtype'=>'app',
												'url'=>DZZSCRIPT.'?mod=discuss&op=recyclebin',
												'author'=>getglobal('username'),
												'authorid'=>getglobal('uid'),
												'dataline'=>dgmdate(TIMESTAMP),
												'threadname'=>getstr($thread['subject'],30),
												
												);
								
									$action='discuss_delete_thread';
									$type='discuss_delete_thread_'.$fid;
								
								dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/discuss');
							}
						}

					}
				}
				updateforumcount($_GET['fid']);

				$modaction = 'DEL';
				updatemodlog($moderatetids, $modaction, $expiration, 0, $reason, 0);
				exit(json_encode(array('code' => 200, 'message' => '删除成功')));
				
			} elseif ($operation == 'removeopt') {//移除置顶，高亮，精华
				$opt = trim($_GET['opt']) ? trim($_GET['opt']) : '';
				if (!in_array($opt, array('highlight', 'stick', 'digest'))) {
					exit(json_encode(array('code' => 400, 'message' => '提交参数错误')));
				}
				C::t('discuss_threadmod')->remove_action_by_tid($tidsarr, $opt);
				$updatemodlog = false;
				$modaction = 'CNL_'.strtoupper($opt);
				switch ($opt) {
					case 'highlight':
						$optitle = lang('highlight');
						break;
					case 'stick':
						$optitle = lang('stick');
						break;
					case 'digest':
						$optitle = lang('digest');
						break;
					default:
						break;
				}
			}  elseif($operation == 'movetype') {
				
				if(!isset($_G['forum']['threadtypes']['types'][$_GET['typeid']]) && ($_GET['typeid'] != 0 || $_G['forum']['threadtypes']['required'])) {
					exit(json_encode(array('code' => 400, 'message' => '主题分类设置错误')));
				}
				C::t('discuss_thread')->update($tidsarr, array('typeid'=>$_GET['typeid'], 'moderated'=>1), true);
				$modaction = 'TYP';
			} 

			if($updatemodlog) {
				if($operation != 'delete') {
					updatemodlog($moderatetids, $modaction, $expiration, 0, $reason, 0);
					if ($starttime && in_array($operation, array('stick', 'highlight', 'digest'))) {
						C::t('discuss_thread')->update($tidsarr, array('start'.$operation => $starttime));
					}
				}
			}
			$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=discuss',0);
			foreach($threadlist as $thread) {
				//通知原作者
				
				if($thread['authorid']!=getglobal('uid')){
					//发送通知
					$notevars=array(
									'from_id'=>$appid,
									'from_idtype'=>'app',
									'url'=>DZZSCRIPT.'?mod=discuss&op=viewthread&tid='.$thread['tid'].'&fid='.$thread['fid'],
									'author'=>getglobal('username'),
									'authorid'=>getglobal('uid'),
									'dataline'=>dgmdate(TIMESTAMP),
									'subject'=>getstr($thread['subject'],30),
									'optitle'=>$optitle,
									);
					
						$action='discuss_thread_moderate';
						$type='discuss_thread_moderate_'.$thread['tid'];
					
					dzz_notification::notification_add($thread['authorid'], $type, $action, $notevars, 0,'dzz/discuss');
				}
			}
			
		}
		exit(json_encode(array('code' => 200, 'message' => '操作成功', 'status' => $starttime > TIMESTAMP ? 0 : 1)));
	}
}

function checkexpiration($starttime, $endtime) {
	if ($endtime) {
		if ($starttime && $starttime > $endtime) {
			exit(json_encode(array('code' => 400, 'message' => '结束时间应大于开始时间')));
		}
	}
}

function get_expiration($tid, $action) {
	$tid = intval($tid);
	if(empty($tid) || empty($action)) {
		return '';
	}
	$row = C::t('discuss_threadmod')->fetch_by_tid_action_status($tid, $action);
	return $row['expiration'] ? date('Y-m-d H:i', $row['expiration']) : '';
}
?>
