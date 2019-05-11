<?php
require dirname(__FILE__) . "/dzsck.php";
$cm->query("SELECT * FROM d_ddcenter where dd_adminid='" . $_SESSION["adminid"] . "' order by dd_id desc");
$tgimgnum = $cm->db_num_rows();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>订单中心</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" type="text/css" href="css/font_1459473269_4751618.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
   <script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
<!--必要样式-->
<link rel="stylesheet" type="text/css" href="css/menu_elastic.css" />
<script src="js/snap.svg-min.js"></script>
<!--[if IE]>
<script src="js/html5.js"></script>
<![endif]-->
</head>
<body class="huibg">
<div class="divbody">
<nav class="navbar text-center">
   <button class="topleft" onclick ="javascript:history.go(-1);"><span class="iconfont icon-fanhui"></span></button>
	<a class="navbar-tit center-block">订单中心</a>
	<button class="topnav" id="open-button" onclick="window.location.href='index.php'"><span class="iconfont icon-1"></span></button>
</nav>
<br/>

<div id="myTabContent" class="tab-content">
<table class="zy-table" cellpadding="0" cellspacing="1">	
   <tbody>
   <tr class="tb-head">
     <td  align="center">购买VIP</td>
     <td  align="center">支付方式</td>
     <td  align="center">支付帐号</td>
     <td  align="center"  width="10%">金额（元）</td>
	 <td  align="center"  width="20%" >订单号</td>
	 <td  align="center">支付时间</td>
	 <td  align="center"  width="10%">状态</td>
  </tr>
     <?php while($row = $cm->fetch_array($rs)){?>
   <tr>
   <td  align="center"><?=$grade[$row['dd_vip']]?></td>
   <td  align="center"><?=$paytype[$row['dd_paytype']]?></td>
   <td  align="center"><?=$row['dd_paynum']?></td>
   <td  align="center"><?=$row['dd_rmb']?></td>
   <td  align="center"><?=$row['dd_order']?></td>
   <td  align="center"><?=date('Y-m-d',$row['dd_time'])?></td>
   <td  align="center" style="color:#F00"><?=$ddtype[$row['dd_type']]?></td>
   </tr>
    <?php } ?>
   </tbody>
</table>
</div>
<div class="footnav">
 <div class="footer">
 <div class="col-xs-3 text-center" style="width:50%"><a href="index.php" style="color:#FF7831"><i class="iconfont icon-yonghu"></i><p>用户中心</p></a></div>
 <div class="col-xs-3 text-center" style="width:50%"><a  onclick="window.location.href='/index.php'"><i class="iconfont icon-home"></i><p>返回首页</p></a></div>
 </div>
</div>
</div>
</body>
</html>