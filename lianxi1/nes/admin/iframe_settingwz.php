<?php
require dirname(__FILE__) . "/dzsck.php";

?>
<!DOCTYPE html><html lang="cn">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>团啊VIP电影系统后台管理</title>
<link href="../Public/Plugin/style/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../Public/Plugin/style/css/ace.min.css" />
<link rel="stylesheet" href="../Public/Plugin/style/css/font-awesome.min.css" />
<script type="text/javascript">window.jQuery || document.write("<script src='../Public/Plugin/style/js/jquery-2.0.3.min.js'>"+"<"+"/script>");</script>
<script src="../Public/Plugin/style/js/bootstrap.min.js"></script>
<style>
body {overflow-x : hidden;  overflow-y : hidden;}
</style>
</head>
<body>
  <div class="navbar navbar-default" id="navbar">
   <div class="navbar-container" id="navbar-container">
    <div class="navbar-header pull-left">
	 <a href="iframe_config.php" class="navbar-brand"><small>管理设置</small></a> 
	 <a href="iframe_settingwz.php" class="navbar-brand" "target="_blank"><small>网站设置</small></a>
	 <a href="iframe_settingads.php" class="navbar-brand" "target="_blank"><small>广告设置</small></a>
	 <a href="iframe_adminuser.php" class="navbar-brand" "target="_blank"><small>会员管理</small></a>
	 <a href="iframe_dingdan.php" class="navbar-brand" "target="_blank"><small>订单管理</small></a>
	 <a href="iframe_kami.php" class="navbar-brand" "target="_blank"><small>卡密管理</small></a>
	 <a href="/tu/" class="navbar-brand" "target="_blank"><small>图片上传</small></a>
	 <a href="http://www.tuana.cn/product/search_j263v_k266v.html" class="navbar-brand" "target="_blank"><small>卡密商城</small></a>
     </div>
	 <div class="navbar-header pull-right" role="navigation">
	 <ul class="nav ace-nav">
	 <li class="light-blue">
	   <a data-toggle="dropdown" href="#" class="dropdown-toggle">
	   <span class="user-info"><?=$_SESSION["adminnamekt123"]?></span><i class="icon-caret-down"></i></a>
	    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
		 <li><a href="login.php?type=loginout"><i class="icon-off"></i>注销</a></li>
		</ul>
	  </li>
	  </ul>
	 </div>
	</div>
   </div>
  <div class="main-container" id="main-container">
   <div class="main-container-inner">        
	  <script type="text/javascript" language="javascript"> function iframeResize(iframe) {iframe.height = $(window).height()-90; }</script>
   <div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
	  <ul class="breadcrumb">
	    <li><i class="icon-home home-icon"></i> <a href="index.php">后台首页</a></li>
		<li class="active">网站设置</li>
	  </ul>
	</div>
	<div id="content_main">
	    <iframe src="settingwz.php" id="main_iframe" name="main_iframe"style="width: 100%;" frameborder="0" onload="iframeResize(this);" scrolling="yes">
        </iframe>
	 </div>
	 </div>
	 </div>
	 </div>
	</body>
 </html>