<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>注册</title>
<link href="style/yiqi.css" rel="stylesheet" type="text/css">
<link href="style/reset.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jQuery.min.js"></script>
<script type="text/javascript" src="js/yiqi.js"></script>

</head>

<body>
	<div class="yiqi-login-head">
		<a href="index.php"><h3><span>&#8249;</span>返回</h3></a>
	</div>
	<div class="yiqi-login-content">
		<div class="yiqi-login-content-head" align="center">
				<img src="images/icon/pengyouquan1.png">
		</div>
		<div class="yiqi-login-table" align="center">
			<input type="text" placeholder="请输入账号" class="yiqi-login-user-icon" id="reg-username">
			<input type="password" placeholder="请输入密码" class="yiqi-login-pass-icon" id='reg-pass'>
			<input type="password" placeholder="请确认密码" class="yiqi-login-pass-icon" id='reg-okpass'>
			<input type="text" placeholder="请输入邮箱" class="yiqi-login-email-icon" id='reg-email'>
			<p id="regtishi"></p>
			<button type="submit" id="Dregbut">注册</button>
			<span onClick="Dqopen('/login.php')">点我登录</span><span></span>
		</div>
	</div>
</body>
	<script type="text/javascript" src="./js/logreg.js"></script>
</html>
