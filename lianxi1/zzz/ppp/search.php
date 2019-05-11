<?php
@set_time_limit(0);
require_once 'global.php';

initvar('action');
if(!$action)
{
	$_class_opt = create_class_option(array('auth'=>array('allowvisit')));
	$_nation_opt = create_nation_option();
}
elseif($action == 'search')
{
	initvar(array('cid','nid','lines','page'), 'GP', 2);
	initvar(array('field','keyword','orderway','asc','submit'),'GP',0);

	if(	!in_array($field, array('subject','playactor','director','author','tag','year','memo')) ||
		!in_array($orderway, array('postdate','lastdate','hits','reply')) ||
		!in_array($asc, array('ASC','DESC'))
	) showmsg('undefined_action', '', 'search.php');
	
	$tagstr = '';

	if(isset($submit))
		$keyword = trim($keyword);
	else
		$keyword = addslashes(urldecode($keyword));
	
	$keyword = str_replace(array('%','_','|'), array('\%','\_','PHPVOD-TAG-SEPARATOR'), $keyword);
	
	if($keyword != '')
	{
		if($field == 'author' || $field == 'year')			
			$tagstr = "sqlwhere={$field}='$keyword'";
		else
			$tagstr = "sqlwhere={$field} LIKE '%$keyword%'";
	}

	if($cid > 0)
	{
		$tagstr .= empty($tagstr) ? "cid=$cid" : "|cid=$cid";
		$tagstr_left = "cid=$cid|showsub=1";
	}
	else
	{
		$tagstr_left = "cid=-1";
	}

	if($nid > 0)
	{
		$tagstr .= empty($tagstr) ? "nid=$nid" : "|nid=$nid";
	}

	(!is_numeric($page) || $page < 1) && $page = 1; //页码
	(!is_numeric($lines) || $lines < 1) && $lines = $db_perpage;

	$keyword_encode = urlencode(stripslashes($keyword));
	$url = 'search.php?action=search&field=' . $field;
	$keyword != '' && $url .= '&keyword=' . $keyword_encode;
	$cid != '' && $url .= '&cid=' . $cid;
	$nid != '' && $url .= '&nid=' . $nid;
	$orderway != '' && $url .= '&orderway=' . $orderway;
	$asc != '' && $url .= '&asc=' . $asc;
	$lines != '' && $url .= '&lines=' . $lines;
	$url .= '&';

	//$url = "search.php?action=search&field=$field&keyword=$keyword&cid=$cid&nid=$nid&orderway=$orderway&asc=$asc&lines=$lines&"; //numofpage url

}

require_once PHPVOD_ROOT . 'require/header.php';
require_once gettpl('search');
footer();
?>