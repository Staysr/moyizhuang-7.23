<?php
if(!defined('VER'))exit('非法访问!');
$title = "班级中心";
// print_r(PATH);
// die();
require_once(PATH.'Home/header.php');

$users=$db->rs("SELECT * FROM ".$Mysql['prefix']."users ORDER BY `uid` DESC LIMIT 7");
?>
<!-- 主页面 Start-->

<!-- 网站公告 Start -->
<div class="col-sm-12">
	<section class="panel">
		<div class="revenue-head" style="background-color:#A9A9F5;">
			<span style="background-color:#A9A9F5;">
			<i class="icon-bullhorn"></i>
			</span>
			<h3>系统公告</h3>
		</div>
		<div class="panel-body">
			<?=$config['Gonggao']?>
		</div>
	</section>
</div>
<!-- 网站公告 End -->

<!-- 数据板 Start -->
<div class="state-overview">
	<div class="col-sm-3">
		<section class="panel">
			<div class="symbol terques">
	        	<i class="icon-calendar"></i>
	        </div>
	        <div class="value">
	        	<h1><?=date("m-d")?></h1>
	        	<p>当前日期</p>
        	</div>
        </section>
    </div>
        <div class="col-sm-3">
        <section class="panel">
		<div class="symbol red">
        <i class="icon-time"></i>
        </div>
        <div class="value">
        <h1><SPAN id=clock></SPAN>
		<SCRIPT type=text/javascript>
		var clock = new Clock();
		clock.display(document.getElementById("clock"));
		</SCRIPT></h1>
        <p>当前时间</p>
        </div>
        </section>
        </div>
        <div class="col-sm-3">
        <section class="panel">
		<div class="symbol yellow">
        <i class="icon-user"></i>
        </div>
        <div class="value">
        <h1><?=$db->count('SELECT count(*) FROM '.$Mysql['prefix'].'users')?></h1>
        <p>注册同学人数</p>
        </div>
        </section>
        </div>
        <div class="col-sm-3">
        <section class="panel">
		<div class="symbol blue">
        <i class="icon-picture"></i>
        </div>
        <div class="value">
        <h1><?=$db->count('SELECT count(*) FROM '.$Mysql['prefix'].'photo')?></h1>
        <p>相册图片数量</p>
        </div>
        </section>
        </div>
		</div>
<!-- 数据板 End -->

<!-- 新用户 Start -->
<div class="col-sm-6">
	<section class="panel">
		<div class="revenue-head" style="background-color:#A9A9F5;">
			<span style="background-color:#A9A9F5;">
			<i class="icon-user"></i>
			</span>
			<h3>新加入的同学</h3>
		</div>
		<div class="panel-body profile-nav">
			<ul class="nav nav-pills nav-stacked">
			<?php if ($users){foreach($users as $user){ ?>
				<li><a><img style="border-radius:100%;" src="http://q1.qlogo.cn/g?b=qq&nk=<?=$user['qq']?>&s=160" width="32" height="32"><span style="float:right"><?=$user['user']?></span></a></li>
			<?php } } ?>
			</ul>
		</div>
	</section>
</div>
<!-- 新用户 End -->

<!-- 用户信息 Start -->
<aside class="profile-nav col-sm-6">
<section class="panel">
<div class="user-heading round">
	<a href="#">
	<img src="http://q1.qlogo.cn/g?b=qq&nk=<?=$userrow['qq']?>&s=160" alt="">
	</a>
	<h1>
	<?php
	if ($userrow['name']){
		echo $userrow['name'];
	}else{
		echo '未填写';
	}
	?>
	</h1>
	<p>
	<?php
	if ($userrow['gxqm']){
		echo $userrow['gxqm'];
	}else{
		echo '这个人很懒,什么也没留下';
	}
	?>
	</p>
</div>
<ul class="nav nav-pills nav-stacked">
	<li><a><i class="icon-user"></i> 用户名: <?=$userrow['user']?>
	</a></li>
	<li><a><i class="icon-shield"></i> 权限: 
	<?php
		if ($userrow['active'] == 9){
			echo '管理员';
		}else if ($userrow['active'] == 8){
			echo '副管理';
		}else{
			echo '小同学';
		}
	?>
	</a></li>
	<li><a><i class="icon-linux"></i> QQ: <?=$userrow['qq']?>
	</a></li>
	<li><a><i class="icon-envelope"></i> 邮箱: <?=$userrow['mail']?>
	</a></li>
</ul>
</section>
</aside>
<!-- 用户信息 End -->
	
<!-- 主页面 End -->

<?php
require_once(PATH.'Home/footer.php');
?>