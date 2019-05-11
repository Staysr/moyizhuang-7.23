<?php
require dirname(dirname(__FILE__)) . "/config.inc.php";//连接数据库
if ($_GET["type"] == "loginout") {
	$_SESSION["adminid"] = "";
	$_SESSION["adminname"] = "";
	$_SESSION["userkey"] = "";
	echo tiao("您已成功退出", "index.php");
	exit();
}
if ($_SESSION["adminid"]!="" and ($_SESSION["userkey"] == "ktkey2016")) {
	echo "<script>window.location.href='index.php';</script>"; 
	exit();
}
if($_GET["type"] == "login"){
if($_POST["validate"]==$_SESSION[""]){//判断验证码
if ($_POST["username"] != "" && $_POST["password"] != "") {
	$names = "/^[a-zA-Z0-9_]{2,10}$/";
	$passwords = "/^[a-zA-Z0-9_]{3,16}$/";
	if (preg_match($names, $_POST["username"]) && preg_match($passwords, $_POST["password"])) {
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
	}
	else {
		echo backs("账号或密码错误，请重新输入！");
		exit();
	}
}
  }else
  
  {
  echo "<script>alert('验证码输入不对，请重新输入！');history.go(-1);</script>";
  exit(); 
  }
}
$cm->query("SELECT * FROM d_config where config_id='1'");
$config = $cm->fetch_array($rs);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>代理会员登录</title>
<meta name="description" content="" />
<meta name="viewport" content="width=device-width , initial-scale=1.0 , user-scalable=0 , minimum-scale=1.0 , maximum-scale=1.0" />
<link rel="stylesheet" href="css/css.css">
<link rel="stylesheet" type="text/css" href="css/flexslider.css" /> 
<script type='text/javascript' src='js/jquery-2.0.3.min.js'></script>
<script type='text/javascript' src='js/LocalResizeIMG.js'></script>
<script type='text/javascript' src='js/patch/mobileBUGFix.mini.js'></script>
<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>

<script type="text/javascript">
$(function() {
    $(".flexslider").flexslider({
		slideshowSpeed: 4000, //展示时间间隔ms
		animationSpeed: 400, //滚动时间ms
		animation: "slide",
		controlNav:true,//控制菜单
		directionNav: false,//左右控制按钮
		touch: true //是否支持触屏滑动
	});
});	
</script>
<style>
	.button_buy a p{height: 3em;overflow: hidden;}
img{
	width: 100%;
	height: auto;
	display: block;
}
 .bot_main li.ico_1{background:#F1901F;}
</style>
</head>
<body>
<div class="apply" id="apply">
	<p>代理登录</p>
<div>
<div class="blank10"></div>
	<form action="?type=login" id="signupok" method="post" name = "myform" onsubmit = "return checkform();">
		<input type="hidden" name="formhash" value="850dee3b" />
		<input type="hidden" name="vid" value="1" />
		<dl class="clearfix">
			<dd>用户名：</dd>
			<dd><input name="username" type="text" class="input_txt" id="username" placeholder="请输入用户名" value=""></dd>
		</dl>
		<dl class="clearfix">
			<dd>密码：</dd>
			<dd><input type="password" class="input_txt" id="password" value="" name="password" placeholder="请输入密码"></dd>
		</dl>
         <!--<dl class="clearfix">
			<dd>验证码：</dd>
			<dd>
            <div class="yzm" style="width:140px;">
<input type="text" class="input_txt" id="validate" value="" name="validate" placeholder="请输入验证码">
            </div>
          <div class="yzm" style="margin-left:10px;width:110px;" >
            <img  title="点击刷新" src="../conf/captcha.php" align="absbottom" onclick="this.src='../conf/captcha.php?'+Math.random();"/>
            </div>
         </dd>
		</dl>-->
		<div class="btn_box">
			<input type="submit" name="signup" class="button" value="立即登录">
		</div>
        <div class="blank10" style=""></div>
      	</form>
        <div class="btn_boxx">
		<input name="signup" type="submit" class="button" onclick="window.location.href='../user/register.php'" value="注册帐号">
		</div>
		<div class="blank10" style="margin-bottom:10px;"></div>
        <div class="blank10" style="margin-bottom:10px;"></div>
        <div class="blank10" style="margin-bottom:10px;"></div>
</div>
<?php include('foo1.php');?>
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
</body>
</html>