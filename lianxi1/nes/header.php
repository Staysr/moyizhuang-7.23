<?php
session_start();
require dirname(__FILE__) . "/config.inc.php";
include ('./inc/aik.config.php');
if ($_GET["type"] == "loginout") {
	$_SESSION["adminid"] = "";
	$_SESSION["adminname"] = "";
	$_SESSION["userkey"] = "";
	echo tiao("您已成功退出", "index.php");
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
$cm->query("SELECT * FROM d_adminuser where admin_id='" .$_SESSION["adminid"]. "'");
$adminid = $cm->fetch_array($rs);
$auth=0;
if (empty($_SESSION["adminid"]) || ($_SESSION["userkey"] != "ktkey2016")) {
	$auth=1;//没有登录
}else{
  if($adminid['admin_endtime']<time()||$adminid['admin_endtime']==""){
	 $auth=2;//过期用户，提升升级
 }
  }
?>
<header class="header">
<div class="container">
		<h1 class="logo"><a href="<?php echo $aik['pcdomain'];?>" title="<?php echo $aik['keywords'];?>"><?php echo $aik['logo_dh'];?><span><?php echo $aik['title'];?></span></a></h1>		
	<div class="sitenav">
	  <ul>
		<li id="menu-item-18" class="menu-item"><a href="/">首页</a></li>
		<li id="menu-item-20" class="menu-item"><?php echo $aik['daohang_1'];?></li>
		<li id="menu-item-20" class="menu-item"><?php echo $aik['daohang_2'];?></li>
      </ul>
	</div>
		<span class="sitenav-on"><i class="icon-list"></i></span>
		<span class="sitenav-mask"></span>
		<div class="accounts">
			<a class="account-weixin" href="javascript:;"><i class="fa"></i>
			  <div class="account-popover"><div class="account-popover-content"><?php echo $aik['weixin_ad'];?></div></div>
			</a>
			 <?php if($_SESSION['adminid']!=''){?>
			<a class="username"  href="user/index.php" target="_blank"><i class="icon-user"></i><?php echo $_SESSION["adminname"]?></a>
			<a class="register"  href="user/payvip.php" target="_blank">开通VIP</a>
            <a class="exit" href="index.php?type=loginout" title="退出"><i class="icon-exit"></i>退出</a>
					<?php }else{?>
					<a class="login"  href="login.php" target="_blank">请登录</a>
					<a class="register"  href="register.php" target="_blank">免费注册</a>
					<?php }?>
		</div>
		<span class="searchstart-on"><i class="icon-search"></i></span>
		<span class="searchstart-off"><i class="icon-search"></i></span>
		<form method="post" class="searchform" action="./seacher.php" >
				<button tabindex="3" class="sbtn" type="submit"><i class="fa"></i></button><input tabindex="2" class="sinput" name="wd" type="text" placeholder="输入关键字" value="">
		</form>
</div>
</header>