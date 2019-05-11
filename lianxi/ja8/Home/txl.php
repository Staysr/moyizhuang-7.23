<?php
if(!defined('VER'))exit('非法访问!');
$title = "同学录";
require_once(PATH.'Home/header.php');
$p = is_numeric($_GET['p']) ? $_GET['p'] : '1';
$pp=$p+7;
$pagesize=6;
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
?>
<!-- 主页面 Start-->
<style>
	.txl li{
		display:inline;
	}
</style>
<div class="col-sm-12" style="text-align:right;">
<div class="btn-group">
<ul class="txl">
<li><a class="btn btn-info" href="?mod=txl&p=1">首页</a></li>
<li><a class="btn btn-info" href="?mod=txl&p=<?=$prev?>">&laquo;</a></li>
<?php for($i=$s;$i<=$pp;$i++){?>
<li><a class="btn btn-info <?php if($i==$p){echo'active';}?>" href="?mod=txl&p=<?=$i?>"><?=$i?></a></li>
<?php }?>
<li><a class="btn btn-info" href="?mod=txl&p=<?=$next?>">&raquo;</a></li>
<li><a class="btn btn-info" href="?mod=txl&p=<?=$pages?>">末页</a></li>
</ul>
</div>
</div>
<?php if($users){foreach($users as $user){ ?>
<div class="col-sm-6">
<section class="panel">
<aside class="profile-nav">
<div class="user-heading round">
<a href="#">
<img src="http://q1.qlogo.cn/g?b=qq&nk=<?=$user['qq']?>&s=160" alt="">
</a>
<br>
<span style="text-transform:capitalize;font-size:24px;"><?=$user['user'] ?></span>
<?php
if ($user['tj']){
echo '<span class="label label-info">'.$user['tj'].'</span>';
}
?>
<p>
<?php
if ($user['gxqm']){
	echo $user['gxqm'];
}else{
	echo '这个人很懒,什么也没留下';
}
?>
</p>
</div>
</aside>
<ul class="list-group">
<li class="list-group-item">姓名:
<?php
if ($user['name']){
	echo $user['name'];
}else{
	echo '未填写';
}
?>
</li>
<li class="list-group-item">性别:
<?php 
if($user['xb']==1){
echo '男';
}else if ($user['xb']==2){
echo '女';
}else{
echo '未填写';
}
?>
</li>
<li class="list-group-item">生日:
<?php
if ($user['sr']){
	echo $user['sr'];
}else{
	echo '未填写';
}
?>
</li>
<li class="list-group-item">年龄:
<?php
if ($user['sr']){
	if($f = explode('-', $user['sr'])){
	$age = date('Y') - $f['0'];
	echo $age;
	}
}else{
echo '未填写';
}
?>
</li>
<li class="list-group-item">学号:
<?php
if ($user['xh']){
	echo $user['xh'];
}else{
	echo '未填写';
}
?>
</li>
<li class="list-group-item">QQ:
<?php
if ($user['qq']){
	echo $user['qq'];
}else{
	echo '未填写';
}
?>
</li>
<li class="list-group-item">邮箱:
<?php
if ($user['mail']){
	echo $user['mail'];
}else{
	echo '未填写';
}
?>
</li>
<li class="list-group-item">星座:
<?php
if ($user['xz']) {
	if($user['xz']==1){
	echo '天蝎座';
	}
	if($user['xz']==2){
	echo '白羊座';
	}
	if($user['xz']==3){
	echo '水瓶座';
	}
	if($user['xz']==4){
	echo '狮子座';
	}
	if($user['xz']==5){
	echo '金牛座';
	}
	if($user['xz']==6){
	echo '摩羯座';
	}
	if($user['xz']==7){
	echo '双子座';
	}
	if($user['xz']==8){
	echo '处女座';
	}
	if($user['xz']==9){
	echo '巨蟹座';
	}
	if($user['xz']==10){
	echo '双鱼座';
	}
	if($user['xz']==11){
	echo '射手座';
	}
	if($user['xz']==12){
	echo '天秤座';
	}
}else{
echo '未填写';
}
?>
</li>
<li class="list-group-item">住址:<?php
if ($user['dz']){
	echo $user['dz'];
}else{
	echo '未填写';
}
?></li>
<li class="list-group-item">电话:
<?php
if ($user['phone']){
	echo $user['phone'];
}else{
	echo '未填写';
}
?>
</li>
<li class="list-group-item">爱好:
<?php
if ($user['ah']){
	echo $user['ah'];
}else{
	echo '未填写';
}
?></li>
<li class="list-group-item">特长:
<?php
if ($user['tc']){
	echo $user['tc'];
}else{
	echo '未填写';
}
?>
</li>
</ul>
</section>
</div>
<?php } } ?>	
<!-- 主页面 End -->
<?php
require_once(PATH.'Home/footer.php');
?>