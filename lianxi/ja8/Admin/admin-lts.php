<?php
if(!defined('VER'))exit('非法访问!');
$title = "聊天室管理";
require_once(PATH.'Admin/header.php');
$p = is_numeric($_GET['p']) ? $_GET['p'] : '1';
$pp=$p+7;
$pagesize=10;
$start=($p-1)*$pagesize;
$chats=$db->rs("SELECT * FROM ".$Mysql['prefix']."chat ORDER BY cid LIMIT $start,$pagesize");
$pages=ceil($db->count('SELECT count(*) FROM '.$Mysql['prefix'].'chat')/$pagesize);
if($pp>$pages){
$s = 1;
$pp=$pages;
if($pages > 8){
$s = $pages - $p;
$s = 7 - $s;
$s = $p - $s;
}
}else{
$s = $p;
}
if($p==1){
	$prev=1;
}else{
	$prev=$p-1;
}
if($p==$pages){
	$next=$p;
}else{
	$next=$p+1;
}
if ($_GET['del']){
	$id = isnull('del','get');
	if (!$db->get_row('SELECT * FROM '.$Mysql['prefix']."chat WHERE cid = '{$id}' LIMIT 1")){
		msg('此ID不存在!');
	}
	$sql = 'DELETE FROM '.$Mysql['prefix']."chat WHERE cid = '{$id}'";
	if ($db->query($sql)){
		msg('删除成功','index.php?mod=admin-lts');
	}else{
		msg('删除失败','index.php?mod=admin-lts');
	}
}
?>
<style>
	.txl li{
		display:inline;
	}
</style>
<aside class="lg-side">
<div class="inbox-head">
<h3>聊天室管理</h3>
</div>
<div class="inbox-body">
<div class="col-sm-12" style="text-align:right;">
<div class="btn-group">
<ul class="txl">
<li><a class="btn btn-info" href="?mod=admin-lts&p=1">首页</a></li>
<li><a class="btn btn-info" href="?mod=admin-lts&p=<?=$prev?>">&laquo;</a></li>
<?php for($i=$s;$i<=$pp;$i++){?>
<li><a class="btn btn-info <?php if($i==$p){echo'active';}?>" href="?mod=admin-lts&p=<?=$i?>"><?=$i?></a></li>
<?php }?>
<li><a class="btn btn-info" href="?mod=admin-lts&p=<?=$next?>">&raquo;</a></li>
<li><a class="btn btn-info" href="?mod=admin-lts&p=<?=$pages?>">末页</a></li>
</ul>
</div>
</div>
<div class="col-sm-12">
<section class="panel">
<table class="table">
<thead>
<tr>
<th>id</th>
<th>发言用户ID</th>
<th>消息内容</th>
<th>发送时间</th>
<th>操作</th>
</tr>
</thead>
<tbody>
<?php if ($chats){foreach($chats as $chat){ ?>
<tr>
<td><?=$chat['cid']?></td>
<td><?=$chat['uid']?></td>
<td><?=$chat['value']?></td>
<td><?=$chat['date']?></td>
<td>
<a class="btn btn-danger" href="index.php?mod=admin-lts&del=<?=$chat['cid']?>">删除</a>
</td>
</tr>
<?php } }else{ ?>
<div class="inbox-head" style="text-align:center">
<i class="icon-stackexchange" style="font-size:80px"></i><br>
<h3>目前暂无消息</h3>
</div>
<?php } ?>
</tbody>
</table>
</section>
</div>
</div>
</aside>
<?php
require_once(PATH.'Admin/footer.php');
?>