<?php
//计划任务，应用安装和卸载都将同步加入和删除此计划任务
//cronname:清空讨论版今日发帖数
//week:-1
//day:-1
//hour:0
//minute:0

if(!defined('IN_DZZ')) {
	exit('Access Denied');
}
$yesterdayposts = intval(C::t('#discuss#discuss')->fetch_sum_todaypost());

C::t('#discuss#discuss')->update_oldrank_and_yesterdayposts();

$historypost = C::t('#discuss#discuss_setting')->fetch('historyposts');
$hpostarray = explode("\t", $historypost);
$historyposts = $hpostarray[1] < $yesterdayposts ? "$yesterdayposts\t$yesterdayposts" : "$yesterdayposts\t$hpostarray[1]";

C::t('#discuss#discuss_setting')->update('historyposts', $historyposts);
$date = date('Y-m-d', TIMESTAMP - 86400);

C::t('#discuss#discuss_statlog')->insert_stat_log($date);
C::t('#discuss#discuss')->clear_todayposts();
$rank = 1;
foreach(C::t('#discuss#discuss_statlog')->fetch_all_rank_by_logdate($date) as $value) {
	C::t('#discuss#discuss')->update($value['fid'], array('rank' => $rank));
	$rank++;
}
savecache('historyposts', $historyposts);

?>