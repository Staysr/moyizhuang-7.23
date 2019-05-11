<?php
/* @authorcode  codestrings
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */

function getAidsByMessage($message){//获取附件aids
	$aids=array();
	if(preg_match_all("/".rawurlencode('attach::')."(\d+)/i",$message,$matches)){
		$aids=$matches[1];
	}
	if(preg_match_all("/attach::(\d+)/i",$message,$matches)){
		$aids=array_merge($aids,$matches[1]);
	}
	return array_unique($aids);
}
function getAtsByMessage($message){
	$atuids=array();
	include_once libfile('function/organization');
	if(preg_match_all('/data-id="(u.+?)"/i',$message,$matches)){
		$arr=$matches[1];
	}
	foreach($arr as $value){
		if(strpos($value,'g')!==false){
			$gid=str_replace('g','',$value);
			if(($org=C::t('organization')->fetch($gid)) && checkAtPerm($gid)){//判定用户有没有权限@此部门
				$uids=getUserByOrgid($gid,true,array(),true);
				if($uids) $at_users=array_merge($at_users,$uids);
			}
		}elseif(strpos($value,'u')!==false){
			$uid=str_replace('u','',$value);
			if($user=C::t('user')->fetch($uid)){
				$atuids[]=$user['uid'];
			}
		}
	}
	return $atuids;
}
function getAttachmentByMessage($message){//获取附件aids
	$attachment=0;
	if(preg_match("/<img.+?class=\"dzz-image\"/i",$message)){
		$attachment=2;
	}elseif(preg_match("/<span\s+class=\"dzz-attach\"/i",$message)){
		$attachment=1;
	}
	return $attachment;
}
function get_thread_by_tid($tid, $forcetableid = null) {
	global $_G,$discuss;
	$ret = array();
	if(!is_numeric($tid)) {
		return $ret;
	}
	
	$threadtableids = C::t('discuss_thread')->fetch_thread_table_ids();
	foreach($threadtableids as $tableid) {
		$tableid = $tableid > 0 ? $tableid : 0;
		$ret = C::t('discuss_thread')->fetch($tid, $tableid);
		if($ret) {
			$ret['threadtable'] = C::t('discuss_thread')->get_table_name($tableid);
			$ret['threadtableid'] = $tableid;
			$ret['posttable'] = 'discuss_post'.($ret['posttableid'] ? '_'.$ret['posttableid'] : '');
			break;
		}
	}

	if(!is_array($ret)) {
		$ret = array();
	} else{
		$ret=formatThreadData($ret);
	}
	return $ret;
}

function get_post_by_pid($pid, $fields = '*', $addcondiction = '', $forcetable = null) {
	global $_G;

	$ret = array();
	if(!is_numeric($pid)) {
		return $ret;
	}

	loadcache('posttable_info');

	$posttableids = array(0);
	if($_G['cache']['posttable_info']) {
		if(isset($forcetable)) {
			if(is_numeric($forcetable) && array_key_exists($forcetable, $_G['cache']['posttable_info'])) {
				$posttableids[] = $forcetable;
			} elseif(substr($forcetable, 0, 10) == 'discuss_post') {
				$posttableids[] = $forcetable;
			}
		} else {
			$posttableids = array_keys($_G['cache']['posttable_info']);
		}
	}

	foreach ($posttableids as $id) {
		$table = empty($id) ? 'discuss_post' : (is_numeric($id) ? 'discuss_post'.$id : $id);
		$ret = C::t('discuss_post')->fetch_by_pid_condition($id, $pid, $addcondiction, $fields);
		if($ret) {
			$ret['posttable'] = $table;
			break;
		}
	}

	if(!is_array($ret)) {
		$ret = array();
	}
	
	return $ret;
}

function get_post_by_tid_pid($tid, $pid) {
	static $postlist = array();
	if(empty($postlist[$pid])) {
		$postlist[$pid] = C::t('discuss_post')->fetch('tid:'.$tid, $pid, false);
		if($postlist[$pid] && $postlist[$pid]['tid'] == $tid) {
			$user = getuserbyuid($postlist[$pid]['authorid']);
			$postlist[$pid]['adminid'] = $user['adminid'];
		} else {
			$postlist[$pid] = array();
		}
	}
	return $postlist[$pid];
}
function formatPostData($postarr){
	global $discuss,$thread;
	static $userinfo=array();
	foreach($postarr as $key=> $post){
		if($post['anonymous']==2){
			$post['authorid']=0;
			$post['author']=lang('anonymous');
		}elseif($post['anonymous']==1){
			$post['authorid']=0;
			$post['author']=lang('anonymous');
		}
		if($post['authorid'] ){
			 if(!isset($userinfo[$post['authorid']])) $userinfo[$post['authorid']]=C::t('discuss_userinfo')->fetch($post['authorid']);
				$post['member']=getuserbyuid($post['authorid']);
				$post['member']['threads']=$userinfo[$post['authorid']]['threads'];
				$post['member']['posts']=$userinfo[$post['authorid']]['posts'];
				$post['member']['hots']=$userinfo[$post['authorid']]['hots'];
		}
		
		if($post['member']['adminid']==1){
			$post['userperm']=4;
		}elseif(isset($discuss['users'][$post['authorid']])){
			$post['userperm']=$discuss['users'][$post['authorid']]['perm'];
		}elseif($post['member']['uid']>0){
			$post['userperm']=1;
		}else{
			$post['userperm']=0;
		}
		$postarr[$key]=$post;
	}
	return $postarr;
}
function formatThreadData($thread,$discuss = 0,$forumlastvisit = 0,$forward='',$extra=''){
	if(!$discuss) $discuss=C::t('discuss')->fetch_by_fid($thread['fid']);
	$thread['forumname']=$discuss['name'];
	if($thread['highlight']) {
		$highlight = json_decode($thread['highlight'], true);
		if ($highlight['highlight_style']) {
			$stylestr = sprintf('%03d', decbin($highlight['highlight_style']));
		}
		$thread['highlight'] = ' style="';
		$thread['highlight'] .= $stylestr[0] ? 'font-weight: bold;' : '';
		$thread['highlight'] .= $stylestr[1] ? 'font-style: italic;' : '';
		$thread['highlight'] .= $stylestr[2] ? 'text-decoration: underline;' : '';
		$thread['highlight'] .= $highlight['highlight_color'] ? 'color: '.$highlight['highlight_color'].';' : '';
		if($thread['bgcolor']) {
			$thread['highlight'] .= "background-color: $thread[bgcolor];";
		}
		$thread['highlight'] .= '"';
	} else {
		$thread['highlight'] = '';
	}
	//处理热贴
	if($discuss['setting']['hotlevels']){
		foreach($discuss['setting']['hotlevels'] as $k => $i) {
			if($thread['heats'] > $i) {
				$thread['hot'] = $k + 1;
			}
		}
	}
	
	//处理主题分类
	
	if($thread['typeid'] && !empty($discuss['threadtypes']['prefix']) && isset($discuss['threadtypes']['types'][$thread['typeid']])) {
		if($discuss['threadtypes']['prefix'] == 1) {
			$thread['typehtml'] = '<em>[<a href="'.DZZSCRIPT.'?mod=discuss&op=list&fid='.$discuss['fid'].'&typeid='.$thread['typeid'].($forward?'&forward='.$forward:'').($extra?'&extra='.$extra:'').'">'.$discuss['threadtypes']['types'][$thread['typeid']].'</a>]</em>';
		} elseif($discuss['threadtypes']['icons'][$thread['typeid']] && $discuss['threadtypes']['prefix'] == 2) {
			$thread['typehtml'] = '<em><a title="'.$discuss['threadtypes']['types'][$thread['typeid']].'" href="'.DZZSCRIPT.'?mod=discuss&op=list&fid='.$discuss['fid'].'&typeid='.$thread['typeid'].($forward?'&forward='.$forward:'').($extra?'&extra='.$extra:'').'">'.'<img style="vertical-align: middle;padding-right:4px;" src="'.$discuss['threadtypes']['icons'][$thread['typeid']].'" alt="'.$discuss['threadtypes']['types'][$thread['typeid']].'" /></a></em>';
		}
		$thread['typename'] = $discuss['threadtypes']['types'][$thread['typeid']];
	} else {
		$thread['typename'] = $thread['typehtml'] = '';
	}
	
	if($thread['closed'] == 1) {
		$thread['folder'] = 'lock';
	} else {
		$thread['folder'] = 'common';
	}
	if(in_array($thread['displayorder'], array(1, 2, 3))) {
		
	} else {
		if($thread['folder'] == 'common' && $thread['lastpost'] >= $forumlastvisit || !$forumlastvisit) {
			$thread['new'] = 1;
			$thread['folder'] = 'new';
			$thread['weeknew'] = TIMESTAMP - 604800 <= $thread['dateline'];
		}
	}
	if($thread['icon']>-1){
		$thread['iconurl']=$thread['iconurl']['url'];
	}
	if(($discuss['setting']['optimizeviews'] && $row = C::t('discuss_threadaddviews')->fetch($tid))) {
		$thread['addviews'] = intval($row['addviews']);
		$thread['views'] += $ret['addviews'];
	}
	//list($thread['subject'], $thread['author'], $thread['lastposter']) = daddslashes(array($thread['subject'], $thread['author'], $thread['lastposter']));
	$todaytime = strtotime(dgmdate(TIMESTAMP, 'Ymd'));
	$thread['dateline'] = $thread['dateline'] > $todaytime ? "<span class=\"xi1\">".dgmdate($thread['dateline'], 'u')."</span>" : "<span>".dgmdate($thread['dateline'], 'u')."</span>";
	
	if($thread['anonymous']){
		 $thread['authorid']=0;
		 $thread['author']=lang('anonymous');
		 $thread['lastposterusername']=lang('anonymous');
		 $thread['lastposter']=0;
	}
	$thread['lastpost'] = dgmdate($thread['lastpost'],'u');
	if($thread['lastposter'] && $user=getuserbyuid(intval($thread['lastposter']))){
		$thread['lastposterusername']=addslashes($user['username']);
	}
	
	return $thread;
}
function viewthread_updateviews() {
	global $discuss,$thread;
	$tableid=0;
	if($discuss['setting']['preventrefresh'] || $_G['cookie']['viewid'] != 'tid_'.$thread['tid']) {
		if(!$tableid && $discuss['setting']['optimizeviews']) {
			if($thread['addviews']) {
				if($thread['addviews'] < 100) {
					C::t('discuss_threadaddviews')->update_by_tid($thread['tid']);
				} else {
					if(!discuz_process::islocked('update_thread_view')) {
						$row = C::t('discuss_threadaddviews')->fetch($thread['tid']);
						C::t('discuss_threadaddviews')->update($thread['tid'], array('addviews' => 0));
						C::t('discuss_thread')->increase($thread['tid'], array('views' => $row['addviews']+1), true);
						discuz_process::unlock('update_thread_view');
					}
				}
			} else {
				C::t('discuss_threadaddviews')->insert(array('tid' => $thread['tid'], 'addviews' => 1), false, true);
			}
		} else {
			C::t('discuss_thread')->increase($thread['tid'], array('views' => 1), true, $tableid);
		}
	}
	dsetcookie('viewid', 'tid_'.$thread['tid']);
}
function insertpost($data) {//
	if(isset($data['tid'])) {
		$thread = C::t('discuss_thread')->fetch($data['tid']);
		$tableid = $thread['posttableid'];
	} else {
		$tableid = $data['tid'] = 0;
	}
	$pid = C::t('discuss_post_tableid')->insert(array('pid' => null), true);


	$data = array_merge($data, array('pid' => $pid));

	C::t('discuss_post')->insert($tableid, $data);
	if($pid % 1024 == 0) {
		C::t('disucss_post_tableid')->delete_by_lesspid($pid);
	}
	savecache('max_post_id', $pid);
	return $pid;
}
function updateforumcount($fid) {

	extract(C::t('discuss_thread')->count_posts_by_fid($fid));

	$thread = C::t('discuss_thread')->fetch_by_fid_displayorder($fid, 0, '=');

	$thread['subject'] = addslashes($thread['subject']);
	$thread['lastposter'] = $thread['author'] ? addslashes($thread['lastposter']) : lang('anonymous');
	$tid =$thread['tid'];
	$setarr = array('posts' => $posts, 'threads' => $threads, 'lastpost' => "$tid\t$thread[subject]\t$thread[lastpost]\t$thread[lastposter]");
	C::t('discuss')->update($fid, $setarr);
}

function updatethreadcount($tid) {
	$replycount = C::t('discuss_post')->count_visiblepost_by_tid($tid) - 1;
	$lastpost = C::t('discuss_post')->fetch_visiblepost_by_tid('tid:'.$tid, $tid, 0, 1);

	$lastpost['author'] = $lastpost['anonymous'] ? lang('anonymous') : addslashes($lastpost['author']);
	$lastpost['dateline'] = !empty($lastpost['dateline']) ? $lastpost['dateline'] : TIMESTAMP;

	$data = array('replies'=>$replycount, 'lastposter'=>$lastpost['author'], 'lastpost'=>$lastpost['dateline']);
	
	C::t('discuss_thread')->update($tid, $data);
}

function deletethread($tids) {
		global $_G;
		
		if(!$tids) {
			return 0;
		}
		$count = count($tids);
		$arrtids = $tids;
		$tids = dimplode($tids);
	
		loadcache(array('threadtableids', 'posttableids'));
		$threadtableids = !empty($_G['cache']['threadtableids']) ? $_G['cache']['threadtableids'] : array();
		$posttableids = !empty($_G['cache']['posttableids']) ? $_G['cache']['posttableids'] : array('0');
		if(!in_array(0, $threadtableids)) {
			$threadtableids = array_merge(array(0), $threadtableids);
		}
		$cachefids = $atids = $fids = $postids = $threadtables = array();
		foreach($threadtableids as $tableid) {
			foreach(C::t('discuss_thread')->fetch_all_by_tid($arrtids, 0, 0, $tableid) as $row) {
				$atids[] = $row['tid'];
				$row['posttableid'] = !empty($row['posttableid']) && in_array($row['posttableid'], $posttableids) ? $row['posttableid'] : '0';
				$postids[$row['posttableid']][$row['tid']] = $row['tid'];
				if($tableid) {
					$fids[$row['fid']][] = $tableid;
				}
				$cachefids[$row['fid']] = $row['fid'];
			}
			if(!$tableid && !$ponly) {
				$threadtables[] = $tableid;
			}
		}
		if($cachefids) {
			C::t('discuss_thread')->clear_cache($cachefids, 'forumdisplay_');
			
		}
				
		foreach($threadtables as $tableid) {
			C::t('discuss_thread')->delete_by_tid($arrtids, false, $tableid);
		}
		foreach($cachefids as $fid) {
			updateforumcount($fid);
		}
		if($atids) {
			foreach($postids as $posttableid=>$oneposttids) {
				deletepost($oneposttids, 'tid', false, $posttableid);
			}
		}
		C::t('discuss_threadmod')->delete_by_tid($arrtids);
		return $count;
}
function deletepost($ids, $idtype = 'pid', $jreplies = false, $posttableid = false, $recycle = false) {
	global $_G;
	$recycle = $recycle && $idtype == 'pid' ? true : false;
	
	if(!$ids || !in_array($idtype, array('authorid', 'tid', 'pid'))) {
		return 0;
	}
	loadcache('posttableids');
	$posttableids = !empty($_G['cache']['posttableids']) ? ($posttableid !== false && in_array($posttableid, $_G['cache']['posttableids']) ? array($posttableid) : $_G['cache']['posttableids']): array('0');

	$count = count($ids);
	$idsstr = dimplode($ids);
	$tids=array();
	if($jreplies) {
		foreach($posttableids as $id) {
			$postlist = array();
			if($idtype == 'pid') {
				$postlist = C::t('discuss_post')->fetch_all($id, $ids, false);
			} elseif($idtype == 'tid') {
				$postlist = C::t('discuss_post')->fetch_all_by_tid($id, $ids, false);
			} elseif($idtype == 'authorid') {
				$postlist = C::t('discuss_post')->fetch_all_by_authorid($id, $ids, false);
			}
			foreach($postlist as $post) {
				$tids[$post['tid']]=$post['tid'];
			}
			unset($postlist);
		}
	}
	foreach($posttableids as $id) {
		if($recycle) {
			C::t('discuss_post')->update($id, $ids, array('invisible' => -5));
		} else {
			if($idtype == 'pid') {
				if(C::t('discuss_post')->delete($id, $ids)){
					C::t('discuss_post_attach')->delete_by_pid($ids);
					C::t('discuss_post_at')->delete_by_pid($ids);
				}
			} elseif($idtype == 'tid') {
				if(C::t('discuss_post')->delete_by_tid($id, $ids)){
					C::t('discuss_post_attach')->delete_by_tid($ids);
					C::t('discuss_post_at')->delete_by_tid($ids);
				}
			} elseif($idtype == 'authorid') {
				if(C::t('discuss_post')->delete_by_authorid($id, $ids)){
					C::t('discuss_post_attach')->delete_by_uid($ids);
				}
			}
		}
	}
	if($tids){//更新主题replies
		foreach($tids as $tid=>$num){
				updatethreadcount($tid);
		}
		C::t('discuss_thread')->clear_cache($tids);
	}
	return $count;
}
function modreasonselect($isadmincp = 0, $reasionkey = 'modreasons' ,$target='modreason') {
		global $_G;
		if(!isset($_G['cache'][$reasionkey]) || !is_array($_G['cache'][$reasionkey])) {
			loadcache($reasionkey);
		}
		if(!$_G['cache'][$reasionkey]){
		   if($data = C::t('discuss_setting')->fetch('modreasons')){
				$data = str_replace(array("\r\n", "\r"), array("\n", "\n"), $data);
				$data = explode("\n", trim($data));
				savecache($reasionkey, $data);
				$_G['cache'][$reasionkey]=$data;
		   }
		}
		$select = '';
		if(!empty($_G['cache'][$reasionkey])) {
			foreach($_G['cache'][$reasionkey] as $reason) {
				$select .= !$isadmincp ? ($reason ? '<li><a role="menuitem" tabindex="-1" href="javascript:;" onclick="$(\''.$target.'\').value=this.innerHTML">'.$reason.'</a></li>' : '<li role="presentation" class="divider"></li>') : ($reason ? '<option value="'.dhtmlspecialchars($reason).'">'.$reason.'</option>' : '<option></option>');
			}
		}
		if($select) {
			return $select;
		} else {
			return false;
		}
	
	}
function typeselect($curtypeid = 0) {
	global $_G;
	if($threadtypes = $_G['forum']['threadtypes']) {
		$html = '<select name="typeid" id="typeid"><option value="0">&nbsp;</option>';
		foreach($threadtypes['types'] as $typeid => $name) {
			$html .= '<option value="'.$typeid.'" '.($curtypeid == $typeid ? 'selected' : '').'>'.strip_tags($name).'</option>';
		}
		$html .= '</select>';
		return $html;
	} else {
		return '';
	}
}
function updatemodlog($tids, $action, $expiration = 0, $iscron = 0, $reason = '', $stamp = 0) {
	global $_G;

	$uid = empty($iscron) ? $_G['uid'] : 0;
	$username = empty($iscron) ? $_G['member']['username'] : 0;
	$expiration = empty($expiration) ? 0 : intval($expiration);

	$data = $comma = '';
	foreach(explode(',', str_replace(array('\'', ' '), array('', ''), $tids)) as $tid) {
		if($tid) {

			$data = array(
					'tid' => $tid,
					'uid' => $uid,
					'username' => $username,
					'dateline' => $_G['timestamp'],
					'action' => $action,
					'expiration' => $expiration,
					'status' => 1,
					'reason' => $reason
				);
			C::t('discuss_threadmod')->insert($data);
		}
	}
}
function searchkey($keyword, $field, $returnsrchtxt = 0) {
	$srchtxt = '';
	if($field && $keyword) {
		if(preg_match("(AND|\+|&|\s)", $keyword) && !preg_match("(OR|\|)", $keyword)) {
			$andor = ' AND ';
			$keywordsrch = '1';
			$keyword = preg_replace("/( AND |&| )/is", "+", $keyword);
		} else {
			$andor = ' OR ';
			$keywordsrch = '0';
			$keyword = preg_replace("/( OR |\|)/is", "+", $keyword);
		}
		$keyword = str_replace('*', '%', addcslashes($keyword, '%_'));
		$srchtxt = $returnsrchtxt ? $keyword : '';
		foreach(explode('+', $keyword) as $text) {
			$text = trim(daddslashes($text));
			if($text) {
				$keywordsrch .= $andor;
				$keywordsrch .= str_replace('{text}', $text, $field);
			}
		}
		$keyword = " AND ($keywordsrch)";
	}
	return $returnsrchtxt ? array($srchtxt, $keyword) : $keyword;
}

function highlight($text, $words, $prepend) {
	$text = str_replace('\"', '"', $text);
	foreach($words AS $key => $replaceword) {
		$text = str_replace($replaceword, '<highlight>'.$replaceword.'</highlight>', $text);
	}
	return "$prepend$text";
}

function bat_highlight($message, $words, $color = '#ff0000') {
	if(!empty($words)) {
		$highlightarray = explode(' ', $words);
		$sppos = strrpos($message, chr(0).chr(0).chr(0));
		if($sppos !== FALSE) {
			$specialextra = substr($message, $sppos + 3);
			$message = substr($message, 0, $sppos);
		}
		$message = preg_replace_callback("/(^|>)([^<]+)(?=<|$)/sU", function($matcher)use($highlightarray){
			return highlight($matcher[2], $highlightarray, $matcher[1]);
		}, $message);
		$message = preg_replace("/<highlight>(.*)<\/highlight>/siU", "<strong><font color=\"$color\">\\1</font></strong>", $message);
		if($sppos !== FALSE) {
			$message = $message.chr(0).chr(0).chr(0).$specialextra;
		}
	}
	return $message;
}

function atreplacement($matches){
	global $at_users;
	include_once libfile('function/code');
	$uid=str_replace('u','',$matches[2]);
	if(($user=C::t('user')->fetch($uid)) && $user['uid']!=$_G['uid']){
		$at_users[]=$user['uid'];
		return '[uid='.$user['uid'].']@'.$user['username'].'[/uid]';
	}else{
		return $matches[0];
	}
}

function stripsAT($message,$all=0){ //$all>0 时去除包裹的内容
	if($all) {
		$message= preg_replace("/\[uid=(\d+)\](.+?)\[\/uid\]/i", '', $message);
		$message= preg_replace("/\[org=(\d+)\](.+?)\[\/org\]/i", '', $message);
	}else {
		$message= preg_replace("/\[uid=(\d+)\]/i", '', $message);
		$message= preg_replace("/\[\/uid\]/i", '', $message);
		$message= preg_replace("/\[org=(\d+)\]/i", '', $message);
		$message= preg_replace("/\[\/org\]/i", '', $message);
	}
	return $message;
}

function _array_column(array $array, $column_key, $index_key=null){//兼容5.5以下版本array_column函数
    $result = array();
    foreach($array as $arr) {
        if(!is_array($arr)) continue;

        if(is_null($column_key)){
            $value = $arr;
        }else{
            $value = $arr[$column_key];
        }

        if(!is_null($index_key)){
            $key = $arr[$index_key];
            $result[$key] = $value;
        }else{
            $result[] = $value;
        }
    }
    return $result; 
}

function emoji_encode($str){
	if(!is_string($str))return $str;
    if(!$str || $str=='undefined')return '';
	$text = json_encode($str); //暴露出unicode
    $text = preg_replace_callback("/(\\\u[ed][0-9a-f]{3})/i",function($str){
        return addslashes($str[0]);
    },$text);
	return json_decode($text);
}

function emoji_decode($str){
	$text = json_encode($str); //暴露出unicode
    $text = preg_replace_callback('/\\\\\\\\/i',function($str){
        return '\\';
    },$text); //将两条斜杠变成一条，其他不动
    return json_decode($text);
}



?>