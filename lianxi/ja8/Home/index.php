<?php
if(!defined('VER'))exit('非法访问!');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=<?=$config['scale']?>, maximum-scale=<?=$config['scale']?>, user-scalable=no">
<title><?=$config['Webtitle']?></title>
<link href="Assets/Index/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="Assets/Index/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="Assets/Index/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
<link href="Assets/Index/css/creative.min.css" rel="stylesheet">
<link rel="stylesheet" href="/Assets/Player/style.css" type="text/css"/>
<!-- 屏蔽播放器广告 -->
<style>
	#BadApplePlayer_Ad{
		display:none;
	}
</style>
</head>
<body id="page-top">
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			 Menu <i class="fa fa-bars"></i>
			</button>
			<a class="navbar-brand page-scroll" href="#page-top"><?=$config['Webname'];?></a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a class="page-scroll" href="index.php?mod=login">登录</a>
				</li>
				<li>
					<a class="page-scroll" href="index.php?mod=reg">注册</a>
				</li>
				<li>
					<a class="page-scroll" href="#about">网站介绍</a>
				</li>
				<li>
					<a class="page-scroll" href="#services">网站功能</a>
				</li>
				<li>
					<a class="page-scroll" href="#contact">联系我们</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<header style="background-image: url('<?php
if ($config['Index_bgapi'] == 1){
		echo 'http://api.lxlby.cn/api/randbg.php?do=SN';
	}else if($config['Index_bgapi'] == 2){
		echo 'http://img.badapple.top/api/randbg.php';
	}else if($config['Index_bgapi'] == 3){
		echo 'http://api.idceo.cn/api/randbg.php?do=LQ';
	}else{
		echo '../Assets/Index/img/bg.jpg';
	}
 ?>');background-color:#464646;">
	<div class="header-content">
		<div class="header-content-inner">
			<br><br><br><br>
			<h1 id="homeHeading" style="font-size:48px"><?=$config['Webname'];?></h1>
			<hr>
			<p style="font-size:28px;color:#FFFFFF"><?=$config['Index_miaoshu'];?></p>
			<a href="index.php?mod=main" class="btn btn-primary btn-xl page-scroll">进入中心</a>
		</div>
	</div>
</header>
<section class="bg-primary" id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 text-center">
				<h2 class="section-heading">网站介绍</h2>
				<hr class="light">
				<p class="text-faded"><?=$config['Index_jianjie'];?></p>
				<a href="#services" class="page-scroll btn btn-default btn-xl sr-button">立即注册</a>
			</div>
		</div>
	</div>
</section>

<section id="services">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2 class="section-heading">网站功能</h2>
				<hr class="primary">
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-6 text-center">
				<div class="service-box">
					<i class="fa fa-4x fa-cloud text-primary sr-icons"></i>
					<h3>云端储存</h3>
					<p class="text-muted">网站可以把同学们的信息储存在云端，可以在网站随时查看</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 text-center">
				<div class="service-box">
					<i class="fa fa-4x fa-image text-primary sr-icons"></i>
					<h3>相册功能</h3>
					<p class="text-muted">登录网站后可以在网站里面上传图片，上传后的图片同学们都可以看到</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 text-center">
				<div class="service-box">
					<i class="fa fa-4x fa-smile-o text-primary sr-icons"></i>
					<h3>留言板</h3>
					<p class="text-muted">你可以在留言板页面，把你想说的一些话，想说的事发表在留言板里面</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 text-center">
				<div class="service-box">
					<i class="fa fa-4x fa-codepen text-primary sr-icons"></i>
					<h3>信息保护</h3>
					<p class="text-muted">网站采用PHP+Mysql操作，用户的密码加密储存的方式来保护您的信息安全</p>
				</div>
			</div>
		</div>
	</div>
</section>

<aside class="bg-dark">
	<div class="container text-center">
		<div class="call-to-action">
			<center>
			 不仅是一个同学录网站，而是那段时光的美好回忆
			</center>
		</div>
	</div>
</aside>

<section id="contact">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 text-center">
				<h2 class="section-heading">联系方式</h2>
				<hr class="primary">
				<p>如果你在使用本网站中遇到什么问题，请以下面的联系方式联系网站管理员</p>
			</div>
			<div class="col-lg-4 col-lg-offset-2 text-center">
				<i class="fa fa-qq fa-3x sr-contact"></i>
				<p><?=$config['Webqq'];?></p>
			</div>
			<div class="col-lg-4 text-center">
				<i class="fa fa-envelope-o fa-3x sr-contact"></i>
				<p><?=$config['Webemail'];?></p>
			</div>
		</div>
	</div>
</section>
<div style="text-align:center;background:#000000;color:#FFFFFF;">
	<br>
	© <?=$config['Index_foot'];?>
	<br><br>
</div>
<script src="/Assets/jQuery/jquery.js"></script>
<?php
if($config['player'] != 0){
	require_once('music.php');
}
	?>
<script src="Assets/Index/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="Assets/Index/js/jquery.easing.min.js"></script>
<script src="Assets/Index/vendor/scrollreveal/scrollreveal.min.js"></script>
<script src="Assets/Index/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="Assets/Index/js/creative.min.js"></script>
</body>
</html>
