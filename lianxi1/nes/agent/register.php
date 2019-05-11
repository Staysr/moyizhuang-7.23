<?php
header('Content-Type:text/html; charset=utf-8');
session_start();
require dirname(dirname(__FILE__)) . "/config.inc.php";//连接数据库
include('../inc/aik.config.php'); 
	if(isset($_POST['sub']))//当用户点击提交时
	{
	if($_POST["validate"]==$_SESSION["authnum_session"]){
	   $name = $_POST['name'];//取得用户昵称
	   $admin_qq = $_POST['admin_qq'];//取得用户QQ
	   $password = md5($_POST['password']);//取得用户密码
	   $admin_key = "ktkey2016";
	   $admin_time = time();
	   $admin_endtime = $admin_time+$aik['config_day']*86400;
         $cm->cmselect("d_adminuser", "*");
		 $row = $cm->fetch_array($rs);
		 
      $cm->query("SELECT * FROM d_adminuser where admin_name='" . $_POST['name'] . "'order by admin_id desc");
      $namenum=$cm->db_num_rows(); 
	  $cm->query("SELECT * FROM d_adminuser where admin_qq='" . $_POST['admin_qq'] . "'order by admin_id desc");
      $qqnum=$cm->db_num_rows();   
		if($namenum>0)
		  {
			echo "<script type='text/javascript'>alert('该用户名已被注册,请重新选择注册！');history.go(-1);</script>";
			exit();
          }
		else if($qqnum>0)
		  {
			echo "<script type='text/javascript'>alert('该QQ已被注册过,请重新选择QQ注册');history.go(-1);</script>";
			exit();
          }
		  else
		  {
			$sql = "INSERT INTO d_adminuser(admin_name,admin_qq,admin_pass,admin_time,admin_endtime,admin_key) VALUES('$name','$admin_qq','$password','" . $admin_time . "','" . $admin_endtime . "','$admin_key')";//SQL语句
			$installs = mysql_query($sql);//执行SQL语句，写入用户数据
				if ($installs) {
             echo "<script>alert('注册成功！');window.location= 'login.php';</script>"; 	
			exit();	
	                  }              
	             else {
                    echo "<script>alert('注册失败，请重新注册？');</script>"; 	
			exit();	
	                  }   
          }
		}
	else{
		  echo "<script>alert('验证码输入不对，请重新输入！');history.go(-1);</script>";
          exit();
		}
		
       
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>代理会员注册</title>
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
	<p>注册帐号</p>
<div>	
	<div class="blank10"></div>
 <form action = "" method = "post"  class="registerform"  name = "rgform" onsubmit = "return checkform();">
		<input name="id" value="" type="hidden">
	<dl class="clearfix">
			<dd>用户名：</dd>
			<dd><input type="text" class="input_txt" id="userid" value="" name="name" placeholder="登陆账号（英文）" datatype="m" errormsg="登陆账号（英文）"></dd>
			<dd><div class="Validform_checktip"></div></dd>	
		</dl>
		<dl class="clearfix">
			<dd>密码：</dd>
			<dd><input type="password" class="input_txt" id="userpwd" value="" name="userpwd" placeholder="密码(6~16个字符，区分大小写)" datatype="*6-16" nullmsg="密码(6~16个字符，区分大小写)" errormsg="密码范围在6~16位之间！"></dd>
					<dd><div class="Validform_checktip"></div></dd>
</dl>
        <dl class="clearfix">
			<dd>确认密码：</dd>
			<dd><input type="password" class="input_txt" id="repwd" value="" name="password" placeholder="请再次输入密码" datatype="*6-16" nullmsg="请设置密码！" errormsg="密码范围在6~16位之间！"></dd>
					<dd><div class="Validform_checktip"></div></dd>
</dl>
        <dl class="clearfix">
			<dd>Q Q：</dd>
			<dd><input type="text" class="input_txt" id="qq" value="" name="admin_qq" placeholder="常用联系QQ" datatype="*2-12" nullmsg="请设置QQ！" errormsg="请设置QQ！"></dd>
					<dd><div class="Validform_checktip"></div></dd>
</dl>
         <dl class="clearfix">
			<dd>验证码：</dd>
			<dd>
            <div class="yzm" style="width:140px;">
<input type="text" class="input_txt" id="validate" value="" name="validate" placeholder="请输入验证码">
            </div>
          <div class="yzm" style="margin-left:10px;width:110px;" >
            <img  title="点击刷新" src="../conf/captcha.php" align="absbottom" onclick="this.src='../conf/captcha.php?'+Math.random();"/>
            </div>
         </dd>
		</dl>
		<div class="btn_boxx">
			<input type="submit" name="sub" class="button" value="注册帐号">
		</div>
        <div class="blank10" style="margin-bottom:50px;"></div>
	</form>
</div>
<?php include('foo2.php');?>
<script type="text/javascript">
function checkform()//使用JS来验证用户输入是否符合规范
	{
		if(rgform.userid.value == "")//账号不能为空
		{
			alert("用户名不能为空！！");
			rgform.userid.focus();
			return false;
		}
		
	   if(rgform.userid.value.length>12){
         alert('用户名太长，建议在12位之内！');
         rgform.userid.focus();
         return false;
         }
		if(rgform.userpwd.value == "")//密码不能为空
		{
			alert("密码不能为空！");
			rgform.userpwd.focus();
			return false;
		}
		if(rgform.repwd.value == "")//密码不能为空
		{
			alert("确认密码不能为空！");
			rgform.repwd.focus();
			return false;
		}
	   if(rgform.userpwd.value.length < 6)//如果密码小于6位
		{
			alert("密码不能少于6位,请重新输入！");
			rgform.userpwd.focus();
			return false;
		}
		
		if(rgform.repwd.value.length < 6)//如果密码小于6位
		{
			alert("确认密码不能少于6位,请重新输入！");
			rgform.repwd.focus();
			return false;
		}
		if(rgform.userpwd.value != rgform.repwd.value)//判断两次输入的密码是否一致
		{
			alert("两次输入的密码不一致,请重新输入！");
			rgform.userpwd.focus();
			return false;
		}
		if(rgform.qq.value==''){
            alert('请输入您的QQ号码！');
            rgform.qq.focus();
           return false;
          }
       if(rgform.qq.value.length<5){
         alert('请输入您的真实QQ号码！');
         rgform.qq.focus();
         return false;
         }
	   if(rgform.validate.value == "")//密码不能为空
		{
			alert("请输入右边验证码！");
			rgform.validate.focus();
			return false;
		}
	}
</script> 
</body>
</html>