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
define('IMGDIR','dzz/discuss/images');
require_once libfile('function/discuss');

$cachelife_time = 300;		
$cachelife_text = 300;
$_G['tpp']=20;
$navtitle = lang('search').' - '.lang('appname');
$forward=urlencode($_SERVER['QUERY_STRING']);
$adv=empty($_GET['adv'])?0:1;
$searchid=intval($_GET['searchid']);
$srchtxt = trim($_GET['srchtxt']);
$srchuid = intval($_GET['srchuid']);
$srchuname = isset($_GET['srchuname']) ? trim(str_replace('|', '', $_GET['srchuname'])) : '';;
$srchfrom = $_GET['srchfrom'];
$before = intval($_GET['before']);
$srchfid = $_GET['srchfid'];
$srhfid = intval($_GET['srhfid']);

$keyword = isset($srchtxt) ? dhtmlspecialchars(trim($srchtxt)) : '';

$uid = $_G['uid'];
if(!submitcheck('searchsubmit', 1)) {
	dheader("location: ".outputurl($_G['siteurl'].MOD_URL));
} else {
	
	$orderby = in_array($_GET['orderby'], array('dateline', 'replies', 'views')) ? $_GET['orderby'] : 'lastpost';
	$ascdesc = isset($_GET['ascdesc']) && $_GET['ascdesc'] == 'asc' ? 'asc' : 'desc';
	$_G['tpp']=10;
	
	if(!empty($searchid)) {
		$page = max(1, intval($_GET['page']));
		$start_limit = ($page - 1) * $_G['tpp'];
		$index = C::t('discuss_searchindex')->fetch_by_searchid($searchid);
		if(!$index) {
			showmessage(lang('search_id_no_exist'));
		}

		$keyword = dhtmlspecialchars($index['keywords']);
		$keyword = $keyword != '' ? str_replace('+', ' ', $keyword) : '';

		$index['keywords'] = rawurlencode($index['keywords']);
		$searchstring = explode('|', $index['searchstring']);
		$index['searchtype'] = $searchstring[0];//preg_replace("/^([a-z]+)\|.*/", "\\1", $index['searchstring']);
		$searchstring[2] = base64_decode($searchstring[2]);
		$modfid = 0;
		if($keyword) {
			$modkeyword = str_replace(' ', ',', $keyword);
			$fids = explode(',', str_replace('\'', '', $searchstring[5]));
			
		}
		
		$threadlist = $posttables = array();
		foreach(C::t('discuss_thread')->fetch_all_by_tid_fid_displayorder(0, explode(',',$index['ids']), null, 0, $orderby, $start_limit, $_G['tpp'], '>=', $ascdesc) as $thread) {
			// var_dump($thread);exit;
			$thread['subject'] = bat_highlight($thread['subject'], $keyword);
			//$thread['realtid'] = $thread['isgroup'] == 1 ? $thread['closed'] : $thread['tid'];
			$threadlist[$thread['tid']] = formatThreadData($thread,null,TIMESTAMP,$forward);
			
			$posttables[$thread['posttableid']][] = $thread['tid'];
		}
		if($threadlist) {
			foreach($posttables as $tableid => $tids) {
				foreach(C::t('discuss_post')->fetch_all_by_tid($tableid, $tids, true, '', 0, 0, 1) as $post) {
					$threadlist[$post['tid']]['message'] = bat_highlight(getstr(strip_tags($post['message']), 200), $keyword);
				}
			}

		}
		$theurl = DZZSCRIPT."?mod=discuss&op=search&searchid=$searchid&orderby=$orderby&ascdesc=$ascdesc&searchsubmit=yes";
		$multipage = multi($index['num'], $_G['tpp'], $page, $theurl);
		$url_forward = $_SERVER['QUERY_STRING'];
		$srchfilter = $searchstring[8];
		$fids = explode(',', str_replace(array('\'', '\\'), '', $searchstring[5]));
		$srchfid = 'all';
		if (count($fids) == 1) {
			$srchfid = $fids[0];
		}
		$srchuname = $searchstring[4];
		$srchfrom = $searchstring[6];
		if ($srchfrom == 'assign_time') {
			$starttime = $searchstring[9];
			$endtime = $searchstring[10];
		}
		$ismobile=helper_browser::ismobile();
		// var_dump($threadlist);exit;
		if ($ismobile) {
			$list = &$threadlist;
			if($page*$_G['tpp']<$index['num']){
				$nextpage=$page+1;
			}
			if ($_GET['ajax']) {
				include template('mobile/thread_list');
			} else {
				include template('mobile/search');
			}
		} else {
			include template('search/result');
		}

	} else {

		$srchtype = 'title';

		$forumsarray = array();
		if(!empty($srchfid)) {
			foreach((is_array($srchfid) ? $srchfid : explode('_', $srchfid)) as $forum) {
				if($forum = intval(trim($forum))) {
					$forumsarray[] = $forum;
				}
			}
		}

		$fids = $comma = '';
		foreach(C::t('discuss')->getMyDiscuss($uid, '', 0, 'lastpost', 'all') as $fid => $forum) {
			if(!$forumsarray || in_array($fid, $forumsarray)) {
				$fids .= "$comma'$fid'";
				$comma = ',';
			}
		}
		$srchfilter = in_array($_GET['srchfilter'], array('all', 'digest', 'top')) ? $_GET['srchfilter'] : 'all';


		$searchstring = 'forum|'.$srchtype.'|'.base64_encode($srchtxt).'|'.intval($srchuid).'|'.$srchuname.'|'.addslashes($fids).'|'.$srchfrom.'|'.intval($before).'|'.$srchfilter.'|'.$_GET['starttime'].'|'.$_GET['endtime'];
		$searchindex = array('id' => 0, 'dateline' => '0');

		foreach(C::t('discuss_searchindex')->fetch_all_search($_G['timestamp'], $searchstring) as $index) {
			if($index['indexvalid'] && $index['dateline'] > $searchindex['dateline']) {
				$searchindex = array('id' => $index['searchid'], 'dateline' => $index['dateline']);
				break;
			} 
		}

		if($searchindex['id']) {

			$searchid = $searchindex['id'];

		} else {
	
			if(isset($srchfid) && !empty($srchfid) && $srchfid != 'all' && !(is_array($srchfid) && in_array('all', $srchfid)) && empty($forumsarray)) {
				showmessage(lang('search_dis_error'), MOD_URL);
			} elseif(!$fids) {
				$fids = 0;
				// showmessage('没有权限', NULL, array(), array('login' => 1));
			}
			$digestltd = $srchfilter == 'digest' ? "(t.digest>'0' AND t.startdigest < ".TIMESTAMP.") AND" : '';
			$topltd = $srchfilter == 'top' ? "AND (t.displayorder>'0' AND t.startstick < ".TIMESTAMP.')' : "AND t.displayorder>='0'";

			$sqlsrch = "FROM ".DB::table('discuss_thread')." t left join ".DB::table('discuss')." d ON t.fid = d.fid WHERE $digestltd t.fid IN ($fids) $topltd";
			if($srchuname) {
				$srchuid = array_keys(C::t('user')->fetch_all_by_like_username($srchuname, 0, 50));
				
				if(!$srchuid) {
					$sqlsrch .= ' AND 0';
				}
			}

			if($srchtxt) {
				$srcharr = searchkey($keyword,"t.subject LIKE '%{text}%'", true);
				$srchtxt = $srcharr[0];
				$sqlsrch .= $srcharr[1];
			}

			if($srchuid) {
				$sqlsrch .= ' AND t.authorid IN ('.dimplode((array)$srchuid).')';
			}
			if(!empty($srchfrom)) {
				switch ($srchfrom) {
					case 'today'://今天
						$sqlsrch .= ' AND t.lastpost >= '.(strtotime(date('Ymd', TIMESTAMP)));
						break;
					case 'ytoday'://昨天
						$sqlsrch .= ' AND t.lastpost < '.(strtotime(date('Ymd', TIMESTAMP)).' AND t.lastpost >= '.strtotime(date('Ymd', TIMESTAMP)) - (3600*24));
						break;
					case '7_days_ago':
						$sqlsrch .= ' AND t.lastpost > '.(strtotime(date('Ymd', TIMESTAMP)) - (3600*24*7));
						break;
					case '30_days_ago':
						$sqlsrch .= ' AND t.lastpost > '.(strtotime(date('Ymd', TIMESTAMP)) - (3600*24*30));
						break;
					case '90_days_ago':
						$sqlsrch .= ' AND t.lastpost > '.(strtotime(date('Ymd', TIMESTAMP)) - (3600*24*90));
						break;
					case 'assign_time':
						$sqlsrch .= ' AND t.lastpost > '.strtotime($_GET['starttime']).' AND t.lastpost < '.strtotime($_GET['endtime']);
						break;
					default:
						break;
				}
			}
			$keywords = str_replace('%', '+', $srchtxt);
			$expiration = TIMESTAMP + $cachelife_text;
			$sqlsrch .= ' AND t.isdelete = 0 AND d.isdelete = 0';
			$num = $ids = 0;
			$maxsearchresults = 500;
			$query = DB::query("SELECT  t.tid, t.closed, t.author, t.authorid $sqlsrch ORDER BY tid DESC LIMIT ".$maxsearchresults);
			while($thread = DB::fetch($query)) {
				$ids .= ','.$thread['tid'];
				$num++;
			}
			DB::free_result($query);
		

			$searchid = C::t('discuss_searchindex')->insert(array(
				'keywords' => $keywords,
				'searchstring' => $searchstring,
				'useip' => $_G['clientip'],
				'uid' => $_G['uid'],
				'dateline' => $_G['timestamp'],
				'expiration' => $expiration,
				'num' => $num,
				'ids' => $ids
			), true);

		}

		dheader("location: ".outputurl($_G['siteurl'].MOD_URL."&op=search&searchid=$searchid&orderby=$orderby&ascdesc=$ascdesc&searchsubmit=yes&kw=".urlencode($keyword)));

	}

}


?>

