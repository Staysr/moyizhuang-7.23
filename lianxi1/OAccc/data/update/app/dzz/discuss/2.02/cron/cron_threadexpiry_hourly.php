<?php
//计划任务，应用安装和卸载都将同步加入和删除此计划任务
//cronname:限时操作清理
//week:-1
//day:-1
//hour:-1
//minute:0

if(!defined('IN_DZZ')) {
	exit('Access Denied');
}

$actionarray = array();
foreach(C::t('#discuss#discuss_threadmod')->fetch_all_by_expiration_status($_G['timestamp']) as $expiry) {
	switch($expiry['action']) {
		case 'EST':	$actionarray['UES'][] = $expiry['tid']; break;
		case 'EHL':	$actionarray['UEH'][] = $expiry['tid'];	break;
		case 'ECL':	$actionarray['UEC'][] = $expiry['tid'];	break;
		case 'EOP':	$actionarray['UEO'][] = $expiry['tid'];	break;
		case 'EDI':	$actionarray['UED'][] = $expiry['tid'];	break;
		case 'TOK':	$actionarray['UES'][] = $expiry['tid']; break;
		case 'CCK':	$actionarray['UEH'][] = $expiry['tid'];	break;
		case 'CLK':	$actionarray['UEC'][] = $expiry['tid']; break;
		case 'SPA':	$actionarray['SPD'][] = $expiry['tid']; break;
	}
}

if($actionarray) {

	foreach($actionarray as $action => $tids) {

		switch($action) {

			case 'UES':
				C::t('#discuss#discuss_thread')->update($actionarray[$action], array('displayorder'=>0), true);
				C::t('#discuss#discuss_threadmod')->update_by_tid_action($tids, array('EST', 'TOK'), array('status'=>0));
				break;

			case 'UEH':
				C::t('#discuss#discuss_thread')->update($actionarray[$action], array('highlight'=>0), true);
				C::t('#discuss#discuss_threadmod')->update_by_tid_action($tids, array('EHL', 'CCK'), array('status'=>0));
				break;

			case 'UEC':
			case 'UEO':
				$closed = $action == 'UEO' ? 1 : 0;
				C::t('#discuss#discuss_thread')->update($actionarray[$action], array('closed'=>$closed), true);
				C::t('#discuss#discuss_threadmod')->update_by_tid_action($tids, array('EOP', 'ECL', 'CLK'), array('status'=>0));
				break;

			case 'UED':
				C::t('#discuss#discuss_threadmod')->update_by_tid_action($tids, array('EDI'), array('status'=>0));
				$digestarray = $authoridarry = array();
				foreach(C::t('#discuss#discuss_thread')->fetch_all_by_tid($actionarray[$action]) as $digest) {
					$authoridarry[] = $digest['authorid'];
					$digestarray[$digest['digest']][] = $digest['authorid'];
				}
				
				C::t('#discuss#discuss_thread')->update($actionarray[$action], array('digest'=>0), true);
				break;

			case 'SPD':
				C::t('#discuss#discuss_threadmod')->update_by_tid_action($tids, array('SPA'), array('status'=>0));
				break;

		}
	}

	require_once libfile('function/discuss','discuss');
	foreach($actionarray as $action => $tids) {
		updatemodlog(implode(',', $tids), $action, 0, 1);
	}

}

?>