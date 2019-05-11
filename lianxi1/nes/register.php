<?php

header('Content-Type:text/html; charset=utf-8');

session_start();

require dirname(__FILE__) . "/config.inc.php";//连接数据库

include ('./inc/aik.config.php');//连接数据库

	if(isset($_POST['sub']))//当用户点击提交时

	{

if($aik['sms_kg']==1){

	$smscode=$_SESSION['smscode'];

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

					echo "<script type='text/javascript'>alert('该QQ已被注册,请重新选择QQ注册');history.go(-1);</script>";

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

							echo "<script>alert('注册失败，请重新注册？');history.go(-1);</script>"; 	

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

					echo "<script type='text/javascript'>alert('该QQ已被注册,请重新选择QQ注册');history.go(-1);</script>";

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

							echo "<script>alert('注册失败，请重新注册？');history.go(-1);</script>"; 	

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

<!DOCTYPE html>

<html lang="en">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

  <title>会员注册</title>

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

    <img src="images/logo.png" width="170" style="padding: 20px 0;"></a>

<div class="restructure-into-register" id="ppsContainer">

    <div class="panel panel-default res-complete" style="padding-bottom:20px; border: none;">

        <div class="panel-body">

            <h4 style="padding-bottom: 20px; padding-top: 15px; font-size: 18px;">用户注册</h4>

             <form class="form-horizontal registerform" action = "" method = "post"    name = "rgform" onsubmit = "return checkform();">

                <div class="form-group">

                    <div class="col-sm-8 col-sm-offset-2">

                        <input type="text" class="form-control numeric" name="name" maxlength="12" placeholder="登陆账号（英文）" autocomplete="on" value="">

                    </div>

                </div>

                <div class="form-group">

                    <div class="col-sm-8 col-sm-offset-2">

                        <input type="password" id="userpwd" name="userpwd" class="form-control" placeholder="密码(6~16个字符，区分大小写)" autocomplete="off">

                    </div>

                </div>

                <div class="form-group">

                    <div class="col-sm-8 col-sm-offset-2">

                        <input type="password" name="password" class="form-control" placeholder="请再次填写密码" autocomplete="off">

                    </div>

                </div>

               <div class="form-group">

                    <div class="col-sm-8 col-sm-offset-2">

                        <input type="text"  class="form-control numeric" name="admin_qq" maxlength="11" placeholder="常用联系QQ" autocomplete="on" value="">

                    </div>

                </div>

                <div class="form-group">

                    <div class="col-sm-8 col-sm-offset-2">

                        <input type="text"  class="form-control numeric" id="admin_tel" name="admin_tel" maxlength="11" placeholder="手机号码" autocomplete="on" value="">

                    </div>

                </div>

<?php 
if($aik['sms_kg']==0){ 
?>
                 <div class="form-group">

                    <div class="col-sm-8 col-sm-offset-2">

                        <input type="button" value="发送短信" class="form-control" name="sendsms" id="sendsms" style="background-color:#fca246;color:#ffffff;" >

                    </div>

                </div>

                 <div class="form-group">

                    <div class="col-sm-8 col-sm-offset-2">

                        <input type="text"  class="form-control numeric" name="admin_code" maxlength="11" placeholder="短信验证码" autocomplete="on" value="">

                    </div>

                </div>

<?php } ?>              

                <!--<div class="form-group">

				

					<div class="col-sm-4 col-sm-offset-2">

						<input type="text" maxlength="6" class="form-control" name="validate" placeholder="图片验证码" style="height:40px; line-height:40px;">

					</div>

					<div class="col-sm-4">

						 <img  title="点击刷新" src="conf/captcha.php" align="absbottom" onclick="this.src='conf/captcha.php?'+Math.random();" style="width:100px; height:40px; line-height:40px; cursor:pointer"/>

					</div>

					

				</div>-->

                <div class="form-group">

                    <div class="col-sm-offset-2  col-sm-8">

                        <button type="submit" class="btn o-btn8" name="sub" style="width:100%;  ">立即注册</button>

                    </div>

                    <p class="col-sm-8  col-sm-offset-2 text-center" style="margin-top:10px; font-size: 12px;">已有账户？<a style="font-size: 12px; color: #2196f3;" href="login.php" target="_self">立即登录</a></p>

                </div>



            </form>

        </div>

    </div>

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

		if(rgform.name.value == "")//账号不能为空

		{

			alert("用户名不能为空！");

			rgform.name.focus();

			return false;

		}

		

	   if(rgform.name.value.length>12){

         alert('用户名太长，建议在12位之内！');

         rgform.name.focus();

         return false;

         }

		if(rgform.userpwd.value == "")//密码不能为空

		{

			alert("密码不能为空！");

			rgform.userpwd.focus();

			return false;

		}

		if(rgform.password.value == "")//密码不能为空

		{

			alert("确认密码不能为空！");

			rgform.password.focus();

			return false;

		}

	   if(rgform.userpwd.value.length < 6)//如果密码小于6位

		{

			alert("密码不能少于6位,请重新输入！");

			rgform.userpwd.focus();

			return false;

		}

		

		if(rgform.password.value.length < 6)//如果密码小于6位

		{

			alert("确认密码不能少于6位,请重新输入！");

			rgform.password.focus();

			return false;

		}

		if(rgform.userpwd.value != rgform.password.value)//判断两次输入的密码是否一致

		{

			alert("两次输入的密码不一致,请重新输入！");

			rgform.userpwd.focus();

			return false;

		}

		if(rgform.admin_qq.value==''){

            alert('请输入您的QQ号码！');

            rgform.admin_qq.focus();

           return false;

          }

       if(rgform.admin_qq.value.length<5){

         alert('请输入您的真实QQ号码！');

         rgform.admin_qq.focus();

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

</div>

</div>

</body>

</html>