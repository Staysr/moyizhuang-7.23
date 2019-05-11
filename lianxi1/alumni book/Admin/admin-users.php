<?php
if(!defined('VER'))exit('非法访问!');
$title = "用户管理";
require_once(PATH.'Admin/header.php');
$p = is_numeric($_GET['p']) ? $_GET['p'] : '1';
$pp=$p+7;
$pagesize=10;
$start=($p-1)*$pagesize;
$users=$db->rs("SELECT * FROM ".$Mysql['prefix']."users ORDER BY uid LIMIT $start,$pagesize");
$pages=ceil($db->count('SELECT count(*) FROM '.$Mysql['prefix'].'users')/$pagesize);
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
	if ($id == $userrow['uid']){
		msg('不能删除自己','index.php?mod=admin-users');
	}
	if ($id == 1){
		msg('管理员不能删除','index.php?mod=admin-users');
	}else{
		$sql = 'DELETE FROM '.$Mysql['prefix']."users WHERE uid = '{$id}'";
		if ($db->query($sql)){
			msg('删除成功','index.php?mod=admin-users');
		}else{
			msg('删除失败','index.php?mod=admin-users');
		}
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
<h3>用户管理</h3>
</div>
<div class="inbox-body">
<div class="col-sm-12" style="text-align:right;">
<div class="btn-group">
<ul class="txl">
<li><a class="btn btn-info" href="?mod=admin-users&p=1">首页</a></li>
<li><a class="btn btn-info" href="?mod=admin-users&p=<?=$prev?>">&laquo;</a></li>
<?php for($i=$s;$i<=$pp;$i++){?>
<li><a class="btn btn-info <?php if($i==$p){echo'active';}?>" href="?mod=admin-users&p=<?=$i?>"><?=$i?></a></li>
<?php }?>
<li><a class="btn btn-info" href="?mod=admin-users&p=<?=$next?>">&raquo;</a></li>
<li><a class="btn btn-info" href="?mod=admin-users&p=<?=$pages?>">末页</a></li>
</ul>
</div>
</div>
<div class="col-sm-12">
<section class="panel">
<table class="table">
<thead>
<tr>
 <th>id</th>
<th>用户名</th>
<th>姓名</th>
<th>权限</th>
<th>操作</th>
</tr>
</thead>
<tbody>
<?php if ($users){foreach($users as $user){ ?>
<tr>
<td><?=$user['uid']?></td>
<td><?=$user['user']?></td>
<td><?=$user['name']?></td>
<td>
<?php 
if ($user['active'] == 9){
	echo '<span class="label label-danger">管理员</span>';
}else if ($user['active'] == 8){
	echo '<span class="label label-info">副管理</span>';
}else{
	echo '<span class="label label-primary">普通同学</span>';
}
?>
</td>
<td>
<a class="btn btn-primary" href="index.php?mod=admin-info&id=<?=$user['uid']?>">编辑</a>
<a class="btn btn-danger" href="index.php?mod=admin-users&del=<?=$user['uid']?>">删除</a>
</td>
</tr>
<?php } } ?>
</tbody>
</table>
</section>
</div>
</div>
</aside>
<?php
require_once(PATH.'Admin/footer.php');
?>