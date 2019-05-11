<?php
if(!defined('VER'))exit('非法访问!');
$title = "相册管理";
require_once(PATH.'Admin/header.php');
$p = is_numeric($_GET['p']) ? $_GET['p'] : '1';
$pp=$p+7;
$pagesize=10;
$start=($p-1)*$pagesize;
$photos=$db->rs("SELECT * FROM ".$Mysql['prefix']."photo ORDER BY pid LIMIT $start,$pagesize");
$pages=ceil($db->count('SELECT count(*) FROM '.$Mysql['prefix'].'photo')/$pagesize);
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
	if (!$db->get_row('SELECT * FROM '.$Mysql['prefix']."photo WHERE pid = '{$id}' LIMIT 1")){
		msg('此ID不存在!');
	}
	$sql = 'DELETE FROM '.$Mysql['prefix']."photo WHERE pid = '{$id}'";
	if ($db->query($sql)){
		msg('删除成功','index.php?mod=admin-xc');
	}else{
		msg('删除失败','index.php?mod=admin-xc');
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
<h3>相册管理</h3>
</div>
<div class="inbox-body">
<div class="col-sm-12" style="text-align:right;">
<div class="btn-group">
<ul class="txl">
<li><a class="btn btn-info" href="?mod=admin-xc&p=1">首页</a></li>
<li><a class="btn btn-info" href="?mod=admin-xc&p=<?=$prev?>">&laquo;</a></li>
<?php for($i=$s;$i<=$pp;$i++){?>
<li><a class="btn btn-info <?php if($i==$p){echo'active';}?>" href="?mod=admin-xc&p=<?=$i?>"><?=$i?></a></li>
<?php }?>
<li><a class="btn btn-info" href="?mod=admin-xc&p=<?=$next?>">&raquo;</a></li>
<li><a class="btn btn-info" href="?mod=admin-xc&p=<?=$pages?>">末页</a></li>
</ul>
</div>
</div>
<div class="col-sm-12">
<section class="panel">
<table class="table">
<thead>
<tr>
<th>id</th>
<th>上传用户id</th>
<th>标题</th>
<th>地址</th>
<th>上传时间</th>
<th>操作</th>
</tr>
</thead>
<tbody>
<?php if ($photos){foreach($photos as $photo){ ?>
<tr>
<td><?=$photo['pid']?></td>
<td><?=$photo['uid']?></td>
<td><?=$photo['title']?></td>
<td><?=$photo['src']?></td>
<td><?=$photo['date']?></td>
<td>
<a class="btn btn-danger" href="index.php?mod=admin-xc&del=<?=$photo['pid']?>">删除</a>
</td>
</tr>
<?php } }else{ ?>
<div class="inbox-head" style="text-align:center">
<i class="icon-stackexchange" style="font-size:80px"></i><br>
<h3>目前暂无图片</h3>
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