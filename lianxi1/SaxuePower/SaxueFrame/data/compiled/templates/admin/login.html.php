<?php
echo '<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="'.$this->_tpl_vars['saxue_skin_server'].'/admin/css/login.css" />
<title>'.$this->_tpl_vars['saxue_pagetitle'].'</title>
</head>
<body >
<div class="login_wrap">
	<div class="login_content">
    	<form method="post">
			<input type="hidden" name="action" value="login">
			<h3 class="login-hd">管理员登录</h3>
            <ul class="login-bd">
                <li>用户名：<br><input type="text" name="account" id="account" class="txt" maxlength="30" onKeyPress="javascript: if (event.keyCode==32) return false;" /></li>
                <li>密&nbsp;&nbsp;&nbsp;码：<br><input type="password" name="password" id="password" class="txt" maxlength="30"/></li>
            	<li><input type="submit" value="登录" class="btn_login" title="登录" /></li>
            </ul>
		</form> 
	</div>
</div>
</body>
</html>
';
?>