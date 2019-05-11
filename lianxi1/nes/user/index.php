<?php
include('../inc/aik.config.php'); 
?>
<?php
require dirname(__FILE__) . "/dzsck.php";
$cm->query("SELECT * FROM d_adminuser where admin_id='" . $_SESSION["adminid"] . "' order by admin_id desc");
$row = $cm->fetch_array($rs);
$cm->query("SELECT * FROM d_ddcenter where dd_adminid='" . $_SESSION["adminid"] . "' and dd_type=0 order by dd_id desc");
$mum = $cm->db_num_rows();
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
	<title>用户中心</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" type="text/css" href="css/font_1459473269_4751618.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
   <script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
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
<body>
<div class="divbody">
<div class="vipcenter">
  <div class="vipheader">

    <div class="touxiang"><?php echo $aik['logo_tx'];?></div>
    <?php if  (empty($_SESSION["adminid"]) || ($_SESSION["userkey"] != "ktkey2016")) {?>
      <div class="name"><a style="color:#FFF">点击登录</a></div>
    <?php }else{ ?>
      <div class="name"><a style="color:#FFF"><?=$_SESSION["adminname"]?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="login.php?type=loginout" style="color:#FFF">退出登录</a></div>
    <?php } ?>
  </div>
  <ul class="vipul">
   <li>
      <a href="edituser.php">
       <div class="icc"><i class="iconfont icon-yonghux"></i></div>
       <div class="lzz">个人信息</div>
       <div class="rizi"><i class="iconfont icon-jiantouri"></i></div>
      </a>
    </li>
    <li>
      <a href="payvip.php">
       <div class="icc"><i class="iconfont icon-vip"></i></div>
       <div class="lzz">开通VIP会员</div>
       <div class="rizi lvzi">
	   <?php if($row['admin_endtime']<time()||$row['admin_endtime']==""){ echo"已过期!";}else{ echo $grade[$row['admin_level']]."&nbsp;&nbsp;&nbsp;到期时间：".date("Y-m-d H:i:s",$row['admin_endtime']);} ?>&nbsp;<i class="iconfont icon-jiantouri"></i></div>
      </a>
    </li>
	<li>
      <a href="ddcenter.php">
       <div class="icc"><i class="iconfont icon-wenjian1"></i></div>
       <div class="lzz">订单中心</div>
       <div class="rizi"><?php if($mum>0){?><font style="color:#F00"><?php echo$mum ?>条待审核&nbsp;</font><?php } ?><i class="iconfont icon-jiantouri"></i></div>
      </a>
    </li>
    <li>
      <a href="jiameng.php">
       <div class="icc"><i class="iconfont icon-jifenx"></i></div>
       <div class="lzz">加盟代理</div>
       <div class="rizi"><i class="iconfont icon-jiantouri"></i></div>
      </a>
	      <li>
      <a href="../agent/">
       <div class="icc"><i class="iconfont icon-jifenx"></i></div>
       <div class="lzz">代理管理</div>
       <div class="rizi"><i class="iconfont icon-jiantouri"></i></div>
      </a>
  </ul>
  <ul class="vipul" style="margin-top:10px;">
   <li>
      <a href="help.php">
       <div class="icc"><i class="iconfont icon-fenxiang"></i></div>
       <div class="lzz">帮助中心</div>
       <div class="rizi"><i class="iconfont icon-jiantouri"></i></div>
      </a>
    </li>
    <li>
      <a href="about.php">
       <div class="icc"><i class="iconfont icon-weixinx"></i></div>
       <div class="lzz">联系客服</div>
       <div class="rizi"><i class="iconfont icon-jiantouri"></i></div>
      </a>
    </li>
  </ul>
</div>
<div class="footnav">
 <div class="footer">
 <div class="col-xs-3 text-center" style="width:50%"><a href="index.php" style="color:#FF7831"><i class="iconfont icon-yonghu"></i><p>用户中心</p></a></div>
 <div class="col-xs-3 text-center" style="width:50%"><a  onclick="window.location.href='/index.php'"><i class="iconfont icon-home"></i><p>返回首页</p></a></div>
 </div>
</div>
<script src="js/classie.js"></script>
<script src="js/main3.js"></script>
</div>
</body>
</html>