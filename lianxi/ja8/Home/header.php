<?php
if(!defined('VER'))exit('非法访问!');
require_once(PATH.'Home/common.php');
if (!$isinfo) {
	if (!$userrow['qq'] or !$userrow['mail'] or !$userrow['phone'] or !$userrow['name'] or !$userrow['xb'] or !$userrow['xz'] or !$userrow['sr']) {
		msg('请先完善资料后再继续查看本页','index.php?mod=info');
	}
}
?>
<!DOCTYPE html>
<html lang="zh">
  <head>
    <meta charset="utf-8">
    <title><?=$title?>-<?=$config['Webtitle']?></title>  
    <meta name="viewport" content="width=device-width, initial-scale=<?=$config['scale']?>, maximum-scale=<?=$config['scale']?>, user-scalable=no">
    <!-- CSS文件引用 -->
    <link href="Assets/Home/css/bootstrap.min.css" rel="stylesheet">
    <link href="Assets/Home/css/bootstrap-reset.css" rel="stylesheet">
    <link href="Assets/Home/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="Assets/Home/css/style.css" rel="stylesheet">
    <link href="Assets/Home/css/style-responsive.css" rel="stylesheet" />
    <link href="Assets/Xc/blueimp-gallery.min.css" rel="stylesheet">
    <script src="Assets/Home/js/clock.js" type="text/javascript"></script>
	<!-- 屏蔽播放器广告 -->
	<style>
		#BadApplePlayer_Ad{
			display:none;
		}
	</style>
  </head>
<style>
.spinner {
  margin: 50% auto;
  width: 50px;
  height: 60px;
  text-align: center;
  font-size: 10px;
}
 
.spinner > div {
  background-color: <?=$config['pjax_loadanimation']?>;
  height: 100%;
  width: 6px;
  display: inline-block;
   
  -webkit-animation: stretchdelay 1.2s infinite ease-in-out;
  animation: stretchdelay 1.2s infinite ease-in-out;
}
 
.spinner .rect2 {
  -webkit-animation-delay: -1.1s;
  animation-delay: -1.1s;
}
 
.spinner .rect3 {
  -webkit-animation-delay: -1.0s;
  animation-delay: -1.0s;
}
 
.spinner .rect4 {
  -webkit-animation-delay: -0.9s;
  animation-delay: -0.9s;
}
 
.spinner .rect5 {
  -webkit-animation-delay: -0.8s;
  animation-delay: -0.8s;
}
 
@-webkit-keyframes stretchdelay {
  0%, 40%, 100% { -webkit-transform: scaleY(0.4) } 
  20% { -webkit-transform: scaleY(1.0) }
}
 
@keyframes stretchdelay {
  0%, 40%, 100% {
    transform: scaleY(0.4);
    -webkit-transform: scaleY(0.4);
  }  20% {
    transform: scaleY(1.0);
    -webkit-transform: scaleY(1.0);
  }
}
</style>
  <body>
	<div id="Loading" style="display:none;">
		<div class="spinner">
 		 <div class="rect1"></div>
  		<div class="rect2"></div>
  		<div class="rect3"></div>
		  <div class="rect4"></div>
		  <div class="rect5"></div>
		</div>
	</div>
  <section id="head" class="">
      <!--header start-->
      <header class="header white-bg">
          <div class="sidebar-toggle-box">
              <div data-original-title="展开或关闭导航栏" data-placement="right" class="icon-reorder tooltips"></div>
          </div>
          <!--logo start-->
          <a href="#" class="logo"><span><?=$config['Webname']?></span></a>
          <!--logo end-->
          <div class="top-nav ">
              <ul class="nav pull-right top-menu">
                  <li>
                      <input type="text" class="form-control search" placeholder="Search">
                  </li>
                  <!-- user login dropdown start-->
                  <li class="dropdown">
                      <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                          <img alt="" src="http://q1.qlogo.cn/g?b=qq&nk=<?php echo $userrow['qq']?>&s=160" width="32" height="32">
                          <span class="username" style="text-transform:capitalize;"><?=$userrow['user']?></span>
                      </a>
                  </li>
                  <!-- user login dropdown end -->
              </ul>
          </div>
      </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">
                  <li>
                      <a href="index.php?mod=main">
                          <i class="icon-home"></i>
                          <span>班级中心</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a>
                          <i class="icon-cogs"></i>
                          <span>个人设置</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li><a href="index.php?mod=info">修改资料</a></li>
                          <li><a href="index.php?mod=pwd">修改密码</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="index.php?mod=txl">
                          <i class="icon-github"></i>
                          <span>同学录</span>
                      </a>
                  </li>
                   <li>
                      <a href="index.php?mod=lts">
                          <i class="icon-cloud"></i>
                          <span>聊天室</span>
                      </a>
                  </li>
				  <li>
                      <a href="index.php?mod=xc">
                          <i class="icon-picture"></i>
                          <span>班级相册</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a>
                          <i class="icon-instagram"></i>
                          <span>相册管理</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li><a href="index.php?mod=upphoto">上传图片</a></li>
                          <li><a href="index.php?mod=photo">管理图片</a></li>
                      </ul>
                  </li>
                  <?php
                  if ($userrow['active'] == 9){
                     echo <<<HTML
                     <li>
                      <a href="index.php?mod=admin-index" pjax="no">
                          <i class="icon-bar-chart"></i>
                          <span>后台管理</span>
                      </a>
                  </li>
HTML;
                    }else if ($userrow['active'] == 8){
						echo <<<HTML
                     <li>
                      <a href="index.php?mod=admin-users" pjax="no">
                          <i class="icon-bar-chart"></i>
                          <span>后台管理</span>
                      </a>
                  </li>
HTML;
					}
                    ?>
                  <li>
                      <a href="/logout.php">
                          <i class="icon-power-off"></i>
                          <span>退出登陆</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      	</section>
          <section id="main-content">
          <section class="wrapper">