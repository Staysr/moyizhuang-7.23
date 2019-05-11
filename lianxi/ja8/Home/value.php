<?php
if(!defined('VER'))exit('非法访问!');
if($_GET['do'] != 'cx' )exit('非法访问!');
require_once(PATH.'Home/common.php');
$uid = $userrow['uid'];
$date = date("Y-m-d H:i:s");
if ($_GET['fs'] == 'fs'){
	$value = isnull('txt','get');
	$sql = "INSERT INTO ". $Mysql['prefix'] ."chat(`uid`,`value`, `date`) VALUES ('{$uid}','{$value}','{$date}')";
	$db->query($sql);
}
$rows = $db->rs('SELECT * FROM ' .$Mysql['prefix']. 'chat ORDER BY `cid` DESC');
if($rows){foreach($rows as $row){
$uinfo = $db->get_row('SELECT * FROM '.$Mysql['prefix']."users WHERE uid = '{$row['uid']}' LIMIT 1");
?>
<div class="activity<?php if($userrow['uid'] == $row['uid'])echo ' alt' ?>">
<span style="background-color:#FFFFFF">
<img src="http://q1.qlogo.cn/g?b=qq&nk=<?=$uinfo['qq']?>&s=160" width="45" height="45" style="border-radius:50%">
</span>			
<div class="activity-desk">
<div class="panel">
<div class="panel-body">
<div class="arrow<?php if($userrow['uid'] == $row['uid'])echo '-alt' ?>"></div>
<h4><?=$uinfo['name']?></h4>
<p style="margin-bottom:10px"><?=$row['value']?></p>
<i class="icon-time"></i><p><?=$row['date']?><p>
</div>
</div>
</div>
</div>
<?php
}
}else{
?>
<div class="activity terques">
<span>
<i class="icon-user"></i>
</span>
<div class="activity-desk">
<div class="panel">
<div class="panel-body">
<div class="arrow"></div>
<h4>系统提示</h4>
<p style="margin-bottom:10px">目前暂时还没有同学发言,快来发表一条信息吧!</p>
</div>
</div>
</div>
</div>
<?php } ?>