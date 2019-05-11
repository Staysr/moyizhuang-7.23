<?php
require dirname(__FILE__) . "/dzsck.php";
include('../inc/aik.config.php'); 
date_default_timezone_set('PRC'); // 中国时区
$nowtime=time();
if($_GET['act']=='number'){
   $cm->query("SELECT * FROM d_kami where km_number='" . $_POST["kami"] . "' order by km_id desc");
   $kmcountr = $cm->db_num_rows();
   $km_number = $cm->fetch_array($rs);
   
   
   $cm->query("SELECT * FROM d_adminuser where admin_id='" . $_POST["admin_id"] . "' ");

   $km_number3 = $cm->fetch_array($rs);
   
   
   
  if($kmcountr>0)
   {
if($km_number["km_type"]==0){
	if( $km_number3['admin_endtime']<time()) $endtime = $cm->query("UPDATE d_adminuser SET admin_endtime=".(time()+2678400).",admin_level=1 ,admin_dlid='".$km_number["km_uid"]."',admin_opentime='".$nowtime."' WHERE admin_id='" . $_POST["admin_id"] . "'");
 else $endtime = $cm->query("UPDATE d_adminuser SET admin_endtime=admin_endtime+2678400,admin_level=1 ,admin_dlid='".$km_number["km_uid"]."',admin_opentime='".$nowtime."' WHERE admin_id='" . $_POST["admin_id"] . "'");
 $cm->query("UPDATE d_adminuser SET admin_user=admin_user+1 WHERE admin_id='" . $km_number["km_uid"] . "'");
 $delete=$cm->delete('d_kami',"km_id in(".$km_number['km_id'].")");
	  	if ($endtime) {
		      echo tiao("恭喜您，升级成为月度vip会员！","index.php");
		        exit();
	      }
	     else {
		     echo tiao("哎呦喂，升级失败，请重新升级？", "payvip.php");
		     exit();
	         }	
	        }
/*******季度会员*****/
 else if($km_number["km_type"]==1){
	 	 if( $km_number3['admin_endtime']<time())$endtime = $cm->query("UPDATE d_adminuser SET admin_endtime=".(time()+8035200).",admin_level=2,admin_dlid='".$km_number["km_uid"]."' ,admin_opentime='".$nowtime."' WHERE admin_id='" . $_POST["admin_id"] . "'");
		 else $endtime = $cm->query("UPDATE d_adminuser SET admin_endtime=admin_endtime+8035200,admin_level=2,admin_dlid='".$km_number["km_uid"]."' ,admin_opentime='".$nowtime."' WHERE admin_id='" . $_POST["admin_id"] . "'");
		 $cm->query("UPDATE d_adminuser SET admin_user=admin_user+1 WHERE admin_id='" . $km_number["km_uid"] . "'");
	   	$delete=$cm->delete('d_kami',"km_id in(".$km_number['km_id'].")"); 
	  	if ($endtime) {
		       echo tiao("恭喜您，升级成为季度vip会员！","index.php");
		       exit();
	         }
	     else {
	  	      echo tiao("哎呦喂，升级失败，请重新升级？", "payvip.php");
		      exit();
	           }	   
	       }
/*******年度会员*****/
 else if($km_number["km_type"]==2){
	 	  if( $km_number3['admin_endtime']<time())$endtime = $cm->query("UPDATE d_adminuser SET admin_endtime=".(time()+31536000).",admin_level=3,admin_dlid='".$km_number["km_uid"]."' ,admin_opentime='".$nowtime."' WHERE admin_id='" . $_POST["admin_id"] . "'");
	 	 else $endtime = $cm->query("UPDATE d_adminuser SET admin_endtime=admin_endtime+31536000,admin_level=3,admin_dlid='".$km_number["km_uid"]."' ,admin_opentime='".$nowtime."' WHERE admin_id='" . $_POST["admin_id"] . "'");
		 $cm->query("UPDATE d_adminuser SET admin_user=admin_user+1 WHERE admin_id='" . $km_number["km_uid"] . "'");
	   	 $delete=$cm->delete('d_kami',"km_id in(".$km_number['km_id'].")");				 		 		 
	  	if ($endtime) {
		       echo tiao("恭喜您，升级成为年度vip会员！","index.php");
		       exit();
	         }
	     else {
	  	      echo tiao("哎呦喂，升级失败，请重新升级？", "payvip.php");
		      exit();
	           }	   
	       }

		   }
  else{
	  echo tiao("没有此卡密号，请购买后再进行升级！", "payvip.php");
    exit();
     }
}  
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
	<title>用户VIP升级</title>
	<link rel="stylesheet" href="">
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
   <button class="topleft" onclick ="javascript:history.go(-1);"><span class="iconfont icon-fanhui"></span></button>
  <a class="navbar-tit center-block">开通VIP会员</a>
  <button class="topnav" id="open-button" onclick="window.location.href='index.php'"><span class="iconfont icon-1"></span></button>
</nav>
<ul id="myTab" class="nav nav-tabs" style="margin-top:10px;">
   <li class="active"><a href="payvip.php">卡密开通</a>
   </li>
   <li><a href="payvip2.php">自助开通</a></li>
</ul>
<form action="?act=number" id="signupok" name="chxform" method="post">
<div class="usercenter  accdv">
  <div class="row">
     <div class="col-md-2">输入卡密号&nbsp;升级会员：</div>
     <div class="col-md-10"><input type="text" name="kami" id="kami" class="form-control"></div>
  </div>
   <div class="row">
     <div class="col-md-2"></div>
      <input type="hidden" name="admin_id" value="<?=$_SESSION["adminid"]?>" />
<div class="col-md-10">
<button type="submit" class="btn btn-danger btn-block btn-lg" onclick="return postcheck();" style=" float:left;width:48%;margin-top: 5px;">确认升级</button>
<a class="btn btn-success btn-block btn-lg" href="<?php echo $aik['km_url']?>"  target="_blank" style=" float:right;width:48%;">购买卡密</a>
</div>
  </div>
</div>
</form>
<div class="dingdan">
   <div class="ddlist">
      <div class="dtit">VIP赞助标准</div>
      <div class="dz"><p class="ziku">月度VIP：</p><strong><?php echo $aik['vip_month']?></strong> 元/月</div>
      <div class="dz"><p class="ziku">季度VIP：</p><strong><?php echo $aik['vip_season']?></strong> 元/季</div>
	  <div class="dz"><p class="ziku">年度VIP：</p><strong><?php echo $aik['vip_year']?></strong> 元/年</div>
      <div class="dz noblord"><p class="ziku">开通会员后，无限畅想看各大vip电影哦！</span><br/><font style="color:#F00"></div>
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