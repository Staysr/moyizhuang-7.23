<?php
if(!defined('VER'))exit('非法访问!');
require_once(PATH.'Admin/common.php');
?>
<!DOCTYPE html>
<html lang="zh">
  <head>
    <meta charset="utf-8">
    <title><?=$title?>-<?=$config['Webtitle']?></title>  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS文件引用 -->
    <link href="/Assets/Home/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Assets/Home/css/bootstrap-reset.css" rel="stylesheet">
    <link href="/Assets/Home/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="/Assets/Home/css/style.css" rel="stylesheet">
    <link href="/Assets/Home/css/style-responsive.css" rel="stylesheet" />
    <script src="/Assets/Home/js/clock.js" type="text/javascript"></script>
  </head>
<section class="wrapper">
<div class="mail-box">
<aside class="sm-side">
<div class="user-head">
<a href="javascript:;" class="inbox-avatar">
<img src="http://q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $userrow['qq'] ?>&spec=100" style="width: 64px; height: 60px;">
</a>
<div class="user-name">
<h5><a href="#"><?=$userrow['user']?></a></h5>
<span><a href="#"><?php
	if ($userrow['active'] == 9){
		echo '超级管理员';
	}else{
		echo '副管理';
	}
?></a></span>
</div>
</div>
<div class="inbox-body">
<a class="btn btn-compose" data-toggle="modal" href="index.php?mod=main">
用户中心
</a>
</div>
<ul class="inbox-nav inbox-divider">
<?php if ($userrow['active'] == 9) { ?>
<li>
<a href="index.php?mod=admin-index"><i class="icon-gears"></i>系统设置</a>
</li>
<?php } ?>
<li>
<a href="index.php?mod=admin-users"><i class="icon-group"></i>用户管理</a>
</li>
<li>
<a href="index.php?mod=admin-xc"><i class="icon-picture"></i>相册管理</a>
</li>
<li>
<a href="index.php?mod=admin-lts"><i class="icon-cloud"></i>聊天室管理</a>
</li>
<?php if ($userrow['active'] == 9) { ?>
<li>
<a href="index.php?mod=admin-ver"><i class="icon-external-link"></i>版本信息<span class="label label-info pull-right">V<?=VER?></span></a>
</li>
<?php } ?>
</ul>
</aside>