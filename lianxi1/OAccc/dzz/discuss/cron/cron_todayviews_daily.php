<?php
//计划任务，应用安装和卸载都将同步加入和删除此计划任务
//cronname:更新讨论版每日查看数
//week:-1
//day:-1
//hour:0
//minute:0

if(!defined('IN_DZZ')) {
	exit('Access Denied');
}

$updateviews = array();
$deltids = array();
foreach(C::t('#discuss#discuss_threadaddviews')->fetch_all_order_by_tid(500) as $tid => $addview) {
	$deltids[$tid] = $updateviews[$addview['addviews']][] = $tid;
}
if($deltids) {
	C::t('#discuss#discuss_threadaddviews')->delete($deltids);
}
foreach($updateviews as $views => $tids) {
	C::t('#discuss#discuss_thread')->increase($tids, array('views' => $views,'heats'=>$views), true);
}

?>