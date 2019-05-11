<?php
require dirname(__FILE__) . "/dzsck.php";
$nowtime=time();
$cm->query("SELECT * FROM d_adminuser where admin_id='" . $_SESSION["adminid"] . "' order by admin_id desc");
$row = $cm->fetch_array($rs);
if($_GET['act']=='number'){
   	  $cm->query("SELECT * FROM d_adminuser where admin_name='" . $_POST['admin_name'] . "'order by admin_id desc");
      $namenum=$cm->db_num_rows(); 
	  $cm->query("SELECT * FROM d_adminuser where admin_qq='" . $_POST['admin_qq'] . "'order by admin_id desc");
      $qqnum=$cm->db_num_rows();  
	    if($namenum>0)
		  {
			echo "<script type='text/javascript'>alert('该用户名已被注册,请重新修改！');history.go(-1);</script>";
			exit();
          }
		else if($qqnum>0)
		  {
			echo "<script type='text/javascript'>alert('该QQ已被注册过,请重新修改');history.go(-1);</script>";
			exit();
          }
        $date = array("admin_name" => $_POST["admin_name"],"admin_pass" => md5($_POST["admin_pass"]),"admin_qq" => $_POST["admin_qq"]);
		$updates = $cm->cmupdate($date, "admin_id='" . $_SESSION["adminid"] . "'", "d_adminuser");
		if ($updates) {
			echo tiao("修改密码成功", "login.php?type=loginout");
			exit();
		}
		else {
			echo tiao("哎呦喂，修改密码失败请重新修改！", "edituser.php");
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
	<title>用户信息</title>
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
  <a class="navbar-tit center-block">用户信息修改</a>
  <button class="topnav" id="open-button" onclick="window.location.href='index.php'"><span class="iconfont icon-1"></span></button>
</nav>

<form action="?act=number" id="signupok" name="chxform" method="post">
<div class="usercenter  accdv">
  <div class="row">
     <div class="col-md-2">用户名：</div>
     <div class="col-md-10"><input type="text" name="admin_name" id="admin_name" class="form-control" value="<?=$row['admin_name']?>" /></div>
  </div>
     <div class="row">
       <div class="col-md-2">QQ号：</div>
        <div class="col-md-10"><input type="text" name="admin_qq" id="admin_qq" class="form-control" value="<?=$row['admin_qq']?>"></div>
   </div> 
  <div class="row">
       <div class="col-md-2">密码：</div>
        <div class="col-md-10"><input type="text" name="admin_pass" id="admin_pass" class="form-control" value="" /></div>
   </div>
     <div class="row">
       <div class="col-md-2">确认密码：</div>
        <div class="col-md-10"><input type="text" name="admin_pass2" id="admin_pass2" class="form-control" value="" /></div>
   </div>
<div class="dingdan" style="min-height: 100px;">
      <div class="ddlist">
      <div class="dtit" style="text-align:center;font-size: 1.3em;"><?=$grade[$row['admin_level']]?>&nbsp;|&nbsp;<a href="payvip.php" style="color:#00F">升级VIP</a> </div>
      <div class="dzdv">
          <span class="dd">注册时间：<?=date('Y-m-d H:i:s',$row['admin_time'])?></span>
          <span class="dd">VIP到期时间：<font style="color:#F00"><?php if($row['admin_endtime']<time()||$row['admin_endtime']==""){ echo"已过期!";}else{ echo date('Y-m-d H:i:s',$row['admin_endtime']);} ?> <br/>(注意：一定要VIP到期后才能再使用卡密或充值升级VIP，否则不生效或者降级。造成损失概不负责。)</div>
		  </font></span>
      </div>
   </div>
</div> 
     <div class="row">
     <div class="col-md-2"></div>
      <input type="hidden" name="admin_id" value="<?=$_SESSION["adminid"]?>" />
<div class="col-md-10"><button type="submit" class="btn btn-danger btn-block btn-lg" onclick="return postcheck();">确认修改</button></div>
  </div>
</div>
</form>
<div class="footnav">
 <div class="footer">
 <div class="col-xs-3 text-center" style="width:50%"><a href="index.php" style="color:#FF7831"><i class="iconfont icon-yonghu"></i><p>用户中心</p></a></div>
 <div class="col-xs-3 text-center" style="width:50%"><a  onclick="window.location.href='/index.php'"><i class="iconfont icon-home"></i><p>返回首页</p></a></div>
 </div>
</div>
</div>
<script type="text/javascript">
function postcheck()//使用JS来验证用户输入是否符合规范
	{
		if(chxform.admin_name.value == "")//账号不能为空
		{
			alert("用户名不能为空！");
			chxform.admin_name.focus();
			return false;
		}
		
	   if(chxform.admin_name.value.length>12){
         alert('用户名太长，建议在12位之内！');
         chxform.admin_name.focus();
         return false;
         }
		 if(chxform.admin_qq.value==''){
            alert('请输入您的QQ号码！');
            chxform.admin_qq.focus();
           return false;
          }
       if(chxform.admin_qq.value.length<5){
         alert('请输入您的真实QQ号码！');
         chxform.admin_qq.focus();
         return false;
         }
		if(chxform.admin_pass.value == "")//密码不能为空
		{
			alert("密码不能为空！");
			chxform.admin_pass.focus();
			return false;
		}
	   if(chxform.admin_pass.value.length < 6)//如果密码小于6位
		{
			alert("密码不能少于6位,请重新输入！");
			chxform.admin_pass.focus();
			return false;
		}
		if(chxform.admin_pass2.value == "")//密码不能为空
		{
			alert("确认密码不能为空！");
			chxform.admin_pass2.focus();
			return false;
		}
	   if(chxform.admin_pass2.value.length < 6)//如果密码小于6位
		{
			alert("确认密码不能少于6位,请重新输入！");
			chxform.admin_pass2.focus();
			return false;
		}
		
		if(chxform.admin_pass.value != chxform.admin_pass2.value)//判断两次输入的密码是否一致
		{
			alert("两次输入的密码不一致,请重新输入！");
			chxform.admin_pass.focus();
			return false;
		}
	}
</script> 
</body>
</html>