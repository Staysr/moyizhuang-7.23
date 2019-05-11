<?php
if(!defined('VER'))exit('非法访问!');
if ($config['zc'] == 0){
	exit('本站已关闭注册,请联系管理员QQ:'.$config['Webqq']);
}
session_start();
if ($_POST['do'] == 'reg') {
	$user = isnull('user');
	$pwd = isnull('pwd');
	$mail = isnull('mail');
	$qq = isnull('qq');
	$phone = isnull('phone');
	$code = isnull('code');
	$email="/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i";
	if (strlen($user) < 5) {
		msg('用户名太短,至少5位!!');
	}elseif (strlen($pwd) < 6 or $pwd == "123456" or $pwd == "123456789") {
		msg('密码过于简单,请重新输入!');
	}elseif ($pwd != $_POST['cfpwd']){
		msg('两次输入的密码不一致!');
	}elseif (strlen($qq) > 10 or strlen($qq) < 5 or !is_numeric($qq)) {
		msg('QQ格式填写错误!');
	}elseif (!preg_match($email,$mail)) {
		msg('邮箱格式填写错误!');
	}elseif($_SESSION['ssnh_code']!=$code) {
	msg('验证码错误!');
	}elseif($db->get_row("select uid from ".$Mysql['prefix']."users where user='{$user}' limit 1")) {
		msg('用户名已存在!');
		}elseif($db->get_row("select uid from ".$Mysql['prefix']."users where qq='{$qq}' limit 1")) {
		msg('QQ已存在!');
		}elseif($db->get_row("select uid from ".$Mysql['prefix']."users where mail='{$mail}' limit 1")) {
		msg('邮箱已存在!');
	}else{
		$_SESSION['ssnh_code'] =md5(rand(100,500).time());
		$pwd=md5(md5($pwd).md5('211154860'));
		if ($db->query("INSERT INTO ".$Mysql['prefix']."users(`user`, `pwd`, `cookie`, `active`, `login`, `mail`, `qq`, `phone`, `name`, `sr`, `xb`, `age`, `dz`, `xh`, `xz`, `ah`, `tc`, `gxqm`, `tj`) VALUES ('{$user}','{$pwd}',NULL,1,1,'{$mail}','{$qq}','{$phone}',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL)")) {
			msg('注册成功,点击确定跳转进行登陆!','index.php?mod=login');
		}else{
			msg('注册失败!');
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注册中心-<?=$config['Webtitle']?></title>
    <link href="Assets/Home/css/bootstrap.min.css" rel="stylesheet">
    <link href="Assets/Home/css/bootstrap-reset.css" rel="stylesheet">
    <link href="Assets/Home/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="Assets/Home/css/style.css" rel="stylesheet">
    <link href="Assets/Home/css/style-responsive.css" rel="stylesheet" />
</head>
  <body class="login-body">
    <div class="container">
      <form class="form-signin" action="?mod=reg" method="post">
        <h2 class="form-signin-heading"><?=$config['Webname']?>-欢迎您!</h2>
         <input type="hidden" name="do" value="reg"/>
        <div class="login-wrap">
            <input type="text" class="form-control" placeholder="请输入用户名!" autofocus name="user">
               <input type="password" class="form-control" placeholder="请输入密码!" name="pwd"> 
               <input type="password" class="form-control" placeholder="请再输入一遍密码!" name="cfpwd">  
           <input type="text" class="form-control" placeholder="请输入您的QQ" autofocus name="qq"> 
  	    <input type="text" class="form-control" placeholder="请输入您的邮箱地址" autofocus name="mail">
      <input type="text" class="form-control" placeholder="请输入您的联系电话" autofocus name="phone">
                     <input type="text" class="form-control" placeholder="请输入验证码!" autofocus name="code">
                <img title="点击刷新" src="Common/code.php" onclick="javascript:this.src='Common/code.php?'+Math.random();"></img>
                <span class="pull-right"> <a href="?mod=login"> 已有账号?前往登录!</a></span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">确定注册</button>
            <p><?=$config['Index_foot']?></p>
        </div>
      </form>
    </div>
  </body>
</html>
