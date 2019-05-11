<?php
require dirname(dirname(__FILE__)) . "/config.inc.php";
if ($_GET["type"] == "loginout") {
	$_SESSION["adminidkt123"] = "";
	$_SESSION["adminnamekt123"] = "";
	$_SESSION["key"] = "";
	echo tiao("您已成功退出", "index.php");
	exit();
}

if ($_SESSION["key"] == "kt2017key") {
	echo tiaos("index.php");
	exit();
}

if (($_GET["type"] == "login") && ($_POST["username"] != "") && ($_POST["password"] != "")) {
	$names = "/^[a-zA-Z0-9_]{2,10}$/";
	$passwords = "/^[a-zA-Z0-9_]{3,16}$/";
	if (preg_match($names, $_POST["username"]) && preg_match($passwords, $_POST["password"])) {
		$cm->cmselect("d_admin", "*", "where admin_name='" . $_POST["username"] . "' AND admin_pass='" . md5($_POST["password"]) . "'");

		if ($cm->db_num_rows($rs) == 1) {
			$row = $cm->fetch_array($rs);
			$_SESSION["adminidkt123"] = $row["admin_id"];
			$_SESSION["adminnamekt123"] = $row["admin_name"];
			$_SESSION["key"] = $row["admin_key"];
			echo tiaos("index.php");
			exit();
		}
		else {
			echo backs("账号或密码错误");
			exit();
		}
	}
	else {
		echo backs("账号或密码错误");
		exit();
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>购啊购影院管理后台</title> 
<meta name="keywords" content="" />
<meta name="description" content="超越梦想" />
<meta http-equiv=“X-UA-Compatible” content=“chrome=1″ />
  <meta http-equiv=“X-UA-Compatible” content=“IE=8″>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/login2.css" rel="stylesheet" type="text/css" />
<script language=javascript>
<!--
function SetFocus()
{
if (document.Login.name.value=="")
	document.Login.name.focus();
}
function CheckForm()
{
	if(document.Login.username.value=="")
	{
		alert("请输入用户名！");
		document.Login.username.focus();
		return false;
	}
	if(document.Login.password.value == "")
	{
		alert("请输入密码！");
		document.Login.password.focus();
		return false;
	}
}
</script>
</head>
<body>
<h1>影院管理后台<sup>（购啊购授权）</sup></h1>

<div class="login" style="margin-top:50px;">
    
    <div class="header">
        <div class="switch" id="switch">
        <a class="switch_btn_focus">快速登录</a>	
   <div class="switch_bottom" id="switch_bottom" style="position: absolute; width: 64px; left: 0px;"></div>
        </div>
    </div>    
  
    
    <div class="web_qr_login" id="web_qr_login" style="display: block; height: 235px;">    

            <!--登录-->
            <div class="web_login" id="web_login">
              <div class="login-box">
			<div class="login_form">
			 <form name=Login action="?type=login" method="post" onSubmit="return CheckForm();">
                <div class="uinArea" id="uinArea">
                <label class="input-tips" for="u">帐号：</label>
                <div class="inputOuter" id="uArea">
               <input type="text" name="username" class="inputstyle"  onclick="JavaScript:this.value=''"/>
                </div>
                </div>
                <div class="pwdArea" id="pwdArea">
               <label class="input-tips" for="p">密码：</label> 
               <div class="inputOuter" id="pArea">
             <input type="password" name="password" class="inputstyle" onclick="JavaScript:this.value=''"/>
                </div>
                </div>
               
                <div style="padding-left:50px;margin-top:20px;">
                <input type="submit" value="登 录" style="width:150px;" class="button_blue"/></div>
              </form>
           </div>
           
            	</div>
               
            </div>
            <!--登录end-->
  </div>
</div>
<div class="jianyi"  style="color:#F00">Copyright © gouagou.com 购啊购 </div>
</body>
</html>