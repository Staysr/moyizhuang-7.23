<?php
if(!defined('VER'))exit('非法访问!');
if ($_POST['do'] == 'login') {
	$user = isnull('user');
	$pwd = isnull('pwd');
	$pwd = md5(md5($pwd).md5('211154860'));
	if($row=$db->get_row("select * from ".$Mysql['prefix']."users where user='$user' and pwd='$pwd' limit 1")) {
		$sid=md5(uniqid().rand(1,1000));
		$db->query("update ".$Mysql['prefix']."users set cookie='$sid' where uid='{$row[uid]}'");
		setcookie("ssnh_sid",$sid,time()+3600*12,'/');
		msg('欢迎回来,'.$row['user'],'/index.php?mod=main');
	}else{
		   msg('账号或密码错误!');
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录中心-<?=$config['Webtitle']?></title>
    <link href="/Assets/Home/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Assets/Home/css/bootstrap-reset.css" rel="stylesheet">
    <link href="/Assets/Home/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="/Assets/Home/css/style.css" rel="stylesheet">
    <link href="/Assets/Home/css/style-responsive.css" rel="stylesheet" />
</head>
  <body class="login-body">
    <div class="container">
      <form class="form-signin" action="?mod=login" method="post">
        <h2 class="form-signin-heading"><?=$config['Webname']?>-欢迎您!</h2>
        <div class="login-wrap">
            <input type="text" name="user" class="form-control" placeholder="请输入用户名!" autofocus>
            <input type="password" name="pwd" class="form-control" placeholder="请输入您的密码!">
            <input type="hidden" name="do" value="login"/>
            <label class="checkbox">
            <span class="pull-right"> <a href="index.php?mod=reg"> 没有账号?前往注册一个</a></span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">确定登陆</button>
            <p><?=$config['Index_foot']?></p>
        </div>
      </form>
    </div>
  </body>
</html>
