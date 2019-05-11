<?php
include('../inc/aik.config.php'); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
	<meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>帮助中心</title>
	<link rel="stylesheet" type="text/css" href="css/font_1459473269_4751618.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="upload/ssi-uploader.css"  type="text/css"/>
   <script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="upload/ssi-uploader.js"></script>
<!--必要样式-->
<link rel="stylesheet" type="text/css" href="css/menu_elastic.css" />
<style type="text/css">
body,td,th {
	font-family: "Microsoft Yahei", "微软雅黑", Arial, "宋体", sans-serif;
}
</style>
<script src="js/snap.svg-min.js"></script>
<!--[if IE]>
<script src="js/html5.js"></script>
<![endif]-->
</head>
<body class="huibg">
<div class="divbody">
<nav class="navbar text-center">
   <button class="topleft" onclick ="javascript:history.go(-1);" onclick="window.location.href='index.php'"><span class="iconfont icon-fanhui"></span></button>
  <a class="navbar-tit center-block">帮助中心</a>
  <button class="topnav" id="open-button" onclick="window.location.href='index.php'"><span class="iconfont icon-1"></span></button>
</nav>
<div class="dingdan">
   <div class="ddlist">
     <?php echo $aik['help1']?>
   </div>
    <div class="ddlist">
     <?php echo $aik['help2']?>
   </div> 
</div>
<div class="footnav">
 <div class="footer">
 <div class="col-xs-3 text-center" style="width:50%"><a href="index.php" style="color:#FF7831"><i class="iconfont icon-yonghu"></i><p>用户中心</p></a></div>
 <div class="col-xs-3 text-center" style="width:50%"><a  onclick="window.location.href='/index.php'"><i class="iconfont icon-home"></i><p>返回首页</p></a></div>
 </div>
</div>
</div>
<script type="text/javascript">
function postcheck(){
	if (document.chxform.kami.value==""){
	    alert('亲，请输入购买的卡密号进行升级？');
		document.chxform.kami.focus();
		return false;
	}
	document.chxform.submit();
	return true;	
}
</script> 
</body>
</html>