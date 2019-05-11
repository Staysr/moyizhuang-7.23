<?php
header('Content-Type:text/html; charset=utf-8');
session_start();
require dirname(__FILE__) . "/config.inc.php";//连接数据库
if ($_SESSION["adminid"]!="" and ($_SESSION["userkey"] == "ktkey2016")) {
	echo "<script>window.location.href='index.php';</script>"; 
	exit();
}
if($_GET["type"] == "login"){
 if($_POST["validate"]==$_SESSION[""]){//判断验证码
		$cm->cmselect("d_adminuser", "*", "where admin_name='" . $_POST["username"] . "' AND admin_pass='" . md5($_POST["password"]) . "'");
		if ($cm->db_num_rows($rs) == 1) {
			$row = $cm->fetch_array($rs);
			$_SESSION["adminid"] = $row["admin_id"];
			$_SESSION["adminname"] = $row["admin_name"];
			$_SESSION["userkey"] = $row["admin_key"];
			echo tiaos("index.php");
			exit();
		}
		else {
			echo backs("账号或密码错误，请重新输入！");
			exit();
		}
  }else  
  {
  echo "<script>alert('验证码输入不对，请重新输入！');history.go(-1);</script>";
  exit(); 
  }
}
?>
<!DOCTYPE html>
<html lang="CN">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <title>会员登录</title>
  <link href="css/reg.css" rel="stylesheet"> 		
  <link rel="stylesheet" type="text/css" href="js/css/Dialog.1.0.css">
  <script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/Dialog.js"></script>
<style>
body{  
    background: url(../images/bj.png) top center no-repeat !important;
	background-size: cover;}
.common-bg {
    width: 100%;
    height: 100%;
   background:none;
    text-align: center;
    position: relative;
}
.tip-err2 p{ font-size: 12px;  }
</style>
</head>
<body style="height: 671px;">
<div class="container-fluid common-bg">
	<div class="common-warp">
	<a href="/">
    <img src="../images/logo.png" width="170" style="padding: 20px 0;"></a>
<div class="restructure-into-register" id="ppsContainer">
    <div class="panel panel-default res-complete" style="padding-bottom:20px; border: none;">
        <div class="panel-body">
            <h4 style="padding-bottom: 20px; padding-top: 15px; font-size: 18px;">用户登录</h4>
             <form class="form-horizontal"  action="?type=login"  method = "post"  class="registerform"  name = "myform" onsubmit = "return checkform();">
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                        <input type="text" class="form-control numeric" name="username" maxlength="12" placeholder="用户名" autocomplete="on" value="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                        <input type="password" id="userpwd" name="password" class="form-control" placeholder="密码(6~16个字符，区分大小写)" autocomplete="off">
                    </div>
                </div>
                <!--<div class="form-group">				
					<div class="col-sm-4 col-sm-offset-2">
						<input type="text" maxlength="6" class="form-control" name="validate" placeholder="图片验证码" style="height:40px; line-height:40px;">
					</div>
					<div class="col-sm-4">
						 <img  title="点击刷新" src="../conf/captcha.php" align="absbottom" onclick="this.src='conf/captcha.php?'+Math.random();" style="width:100px; height:40px; line-height:40px; cursor:pointer"/>
					</div>
				</div>-->
                <div class="form-group">
                    <div class="col-sm-offset-2  col-sm-8">
                        <button type="submit" class="btn o-btn8" name="sub" style="width:100%;  ">登录</button>
                    </div>
				   <p class="col-sm-8  col-sm-offset-2 text-center" style="margin-top:10px; font-size: 12px;">没有账户？<a style="font-size: 12px; color: #2196f3;" href="register.php" target="_self">立即注册</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
function checkform()//使用JS来验证用户输入是否符合规范
	{
		if(myform.username.value == "")//账号不能为空
		{
			alert("用户名不能为空！！");
			myform.username.focus();
			return false;
		}
		
		if(myform.password.value == "")//密码不能为空
		{
			alert("密码不能为空！");
			myform.password.focus();
			return false;
		}
		if(myform.validate.value == "")//密码不能为空
		{
			alert("请输入右边验证码！");
			myform.validate.focus();
			return false;
		}
	}
</script> 
</div>
</div>
</body>
</html>