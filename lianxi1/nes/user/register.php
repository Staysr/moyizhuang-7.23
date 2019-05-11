<?php

session_start();

header('Content-Type:text/html; charset=utf-8');

require dirname(dirname(__FILE__)) . "/config.inc.php";

include('../inc/aik.config.php'); 

	if(isset($_POST['sub']))//当用户点击提交时

	{

if($aik['sms_kg']==1){
		//$smscode=$_SESSION['smscode'];

	if($_POST["validate"]==$_SESSION[""]){

		   $name = $_POST['name'];//取得用户昵称

		   $admin_qq = $_POST['admin_qq'];//取得用户QQ

		   $password = md5($_POST['password']);//取得用户密码

		   $admin_key = "ktkey2016";

		   $admin_time = time();

		   $admin_tel=$_POST['admin_tel'];

		   $admin_endtime = $admin_time+$aik['config_day']*86400;

		   $cm->cmselect("d_adminuser", "*");

		   $row = $cm->fetch_array($rs);

			 

		  $cm->query("SELECT * FROM d_adminuser where admin_name='" . $_POST['name'] . "'order by admin_id desc");

		  $namenum=$cm->db_num_rows(); 

		  $cm->query("SELECT * FROM d_adminuser where admin_qq='" . $_POST['admin_qq'] . "'order by admin_id desc");

		  $qqnum=$cm->db_num_rows();  

		   $cm->query("SELECT * FROM d_adminuser where admin_iphone='" . $_POST['admin_tel'] . "'order by admin_id desc");

			  $telnum=$cm->db_num_rows();  

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

			  else if($telnum>0){

					echo "<script type='text/javascript'>alert('该手机号码已被注册,请重新输入手机号码注册');history.go(-1);</script>";

					exit();

				  }

			  else

			  {

				$sql = "INSERT INTO d_adminuser(admin_name,admin_qq,admin_iphone,admin_pass,admin_time,admin_endtime,admin_key) VALUES('$name','$admin_qq','$admin_tel','$password','" . $admin_time . "','" . $admin_endtime . "','$admin_key')";//SQL语句

				$installs = mysql_query($sql);//执行SQL语句，写入用户数据

					if ($installs) {

				 echo "<script>alert('注册成功！系统赠送你".$aik['config_day']."天免费畅享影视！');"."window.location= 'login.php';</script>"; 	

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

}else{

		$smscode=$_SESSION['smscode'];

	if($_POST["validate"]==$_SESSION[""]){

		if($_POST['admin_code']==$smscode){

		   $name = $_POST['name'];//取得用户昵称

		   $admin_qq = $_POST['admin_qq'];//取得用户QQ

		   $password = md5($_POST['password']);//取得用户密码

		   $admin_key = "ktkey2016";

		   $admin_time = time();

		   $admin_tel=$_POST['admin_tel'];

		   $admin_endtime = $admin_time+$aik['config_day']*86400;

		   $cm->cmselect("d_adminuser", "*");

		   $row = $cm->fetch_array($rs);

			 

		  $cm->query("SELECT * FROM d_adminuser where admin_name='" . $_POST['name'] . "'order by admin_id desc");

		  $namenum=$cm->db_num_rows(); 

		  $cm->query("SELECT * FROM d_adminuser where admin_qq='" . $_POST['admin_qq'] . "'order by admin_id desc");

		  $qqnum=$cm->db_num_rows();  

		   $cm->query("SELECT * FROM d_adminuser where admin_iphone='" . $_POST['admin_tel'] . "'order by admin_id desc");

			  $telnum=$cm->db_num_rows();  

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

			  else if($telnum>0){

					echo "<script type='text/javascript'>alert('该手机号码已被注册,请重新输入手机号码注册');history.go(-1);</script>";

					exit();

				  }

			  else

			  {

				$sql = "INSERT INTO d_adminuser(admin_name,admin_qq,admin_iphone,admin_pass,admin_time,admin_endtime,admin_key) VALUES('$name','$admin_qq','$admin_tel','$password','" . $admin_time . "','" . $admin_endtime . "','$admin_key')";//SQL语句

				$installs = mysql_query($sql);//执行SQL语句，写入用户数据

					if ($installs) {

				 echo "<script>alert('注册成功！系统赠送你".$aik['config_day']."天免费畅享影视！');"."window.location= 'login.php';</script>"; 	

				exit();	

						  }              

					 else {

						echo "<script>alert('注册失败，请重新注册？');</script>"; 	

				exit();	

						  }   

			  }

		}else{

			echo "<script>alert('短信验证码输入不对，请重新输入！');history.go(-1);</script>";

          		exit();

		}

		}

	else{

		  echo "<script>alert('验证码输入不对，请重新输入！');history.go(-1);</script>";

          exit();

		}

}		

       

    }

?>

<!DOCTYPE HTML>

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta charset="utf-8">

<title>注册会员</title>

<meta name="description" content="" />

<meta name="viewport" content="width=device-width , initial-scale=1.0 , user-scalable=0 , minimum-scale=1.0 , maximum-scale=1.0" />



<style>

.button_buy a p{height: 3em;overflow: hidden;}

img{

	width: 100%;

	height: auto;

	display: block;

}

.bot_main li.ico_1{

  background:#F1901F;

}

.buttony{

	height:40px;

	line-height:40px;

	cursor:pointer;

	color:#fff;

	font-size:20px;

	text-align:center;

	border-radius:5px;

	width:150px;

	background-color:#66ccff;

	border:none;

	margin-left:50px;

	

	}

</style>

<link rel="stylesheet" href="css/css.css">

<script src="../js/jquery-1.7.2.min.js" type="text/javascript"></script>

</head>

<body>

<div class="apply" id="apply">

<p>注册帐号</p>

<div>

	<div class="topshow" id="topshow">

    </div>	

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

			<dd><input type="password" class="input_txt" id="userpwd" value="" name="userpwd" placeholder="密码(6~16个字符，区分大小写)" datatype="*6-16" nullmsg="密码(6~16个字符，区分大小写)！" errormsg="密码范围在6~16位之间！"></dd>

					<dd><div class="Validform_checktip"></div></dd>

</dl>

        <dl class="clearfix">

			<dd>确认密码：</dd>

			<dd><input type="password" class="input_txt" id="repwd" value="" name="password" placeholder="请再次输入密码" datatype="*6-16" nullmsg="请设置密码！" errormsg="密码范围在6~16位之间！"></dd>

					<dd><div class="Validform_checktip"></div></dd>

</dl>

        <dl class="clearfix">

			<dd>Q Q：</dd>

			<dd><input type="text" class="input_txt" id="qq" value="" name="admin_qq" placeholder="常用联系QQ" datatype="*2-12" nullmsg="常用联系QQ" errormsg="请设置QQ！"></dd>

					<dd><div class="Validform_checktip"></div></dd>

</dl>

<dl class="clearfix">

			<dd>手机号码：</dd>

			<dd><input type="text" class="input_txt" id="admin_tel" value=""  name="admin_tel" placeholder="电话号码" datatype="*2-12" nullmsg="电话号码" errormsg="请设置电话号码！"></dd>

					<dd><div class="Validform_checktip"></div></dd>

</dl>

<?php 
if($aik['sms_kg']==0){ 
?>
 <dl class="clearfix">

			<dd>短信验证码：</dd>

			<dd><input type="text" class="input_txt" id="admin_code" value="" style="width:128px;" name="admin_code" placeholder="短信验证码" datatype="*2-12" nullmsg="短信验证码" errormsg="短信验证码！"><input type="button" value="获取短信验证码" class="buttony"  name="sendsms" id="sendsms"></dd>

					<dd><div class="Validform_checktip"></div></dd>

</dl>

<?php } ?>  

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

		<div class="btn_boxx">

			<input type="submit" name="sub" class="button" value="注册帐号">

		</div>

       <div class="blank10"></div>

        <div class="btn_box">

			<input type="button" name="signup" class="button" value="登录" onClick="window.location.href='login.php'">

		</div>

        <div class="blank10" style="margin-bottom:50px;"></div>

	</form>

</div>

<script type="text/javascript">

function invokeSettime(obj){

    var countdown=60;

    settime(obj);

    function settime(obj) {

        if (countdown == 0) {

            $(obj).attr("disabled",false);

            $(obj).val("获取验证码");

            countdown = 60;

            return;

        } else {

            $(obj).attr("disabled",true);

            $(obj).val("(" + countdown + ") s 重新发送");

            countdown--;

        }

        setTimeout(function() {

                    settime(obj) }

                ,1000)

    }

}



  

	$("#sendsms").click(function(){

		if($("#admin_tel").val()==""){

			alert('手机号码为空！');

			$("#admin_tel").focus();

			return false;

		}else{

			$.post("smstest.php",{"tel":$("#admin_tel").val()},function(data){alert(data);});

			new invokeSettime("#sendsms");

		}

	});

</script>

<script type="text/javascript">

function checkform()//使用JS来验证用户输入是否符合规范

	{

		if(rgform.userid.value == "")//账号不能为空

		{

			alert("用户名不能为空！");

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

		 if(rgform.admin_tel.value == "")//密码不能为空

		{

			alert("请输入手机号码！");

			rgform.admin_tel.focus();

			return false;

		}
<?php 
if($aik['sms_kg']==0){ 
?>
		if(rgform.admin_code.value == "")//密码不能为空

		{

			alert("请输入短信验证码！");

			rgform.admin_code.focus();

			return false;

		}
<?php } ?> 
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