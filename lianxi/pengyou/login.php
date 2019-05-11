<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>登录</title>
<link href="style/yiqi.css" rel="stylesheet" type="text/css">
<link href="style/reset.css" rel="stylesheet" type="text/css">
<script src="js/jquery.min.js"></script>
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
			<input type="text" placeholder="请输入账号" class="yiqi-login-user-icon" id="yiqi-js-user" maxlength="20">
			<input type="password" placeholder="请输入密码" class="yiqi-login-pass-icon" id="yiqi-js-pass" maxlength="30">
			<p id="yiqi-js-wz"></p>
			<button type="submit" onClick="yiqilogin()">登录</button>
			<span onClick="Dqopen('./register.php')">点我注册</span><span>忘记密码？</span>
		</div>
		<div class="yiqi-login-buttom" align="center">
			<div class="yiqi-login-hr"></div>
			<span>选择其他方式登录</span>
			<div class="yiqi-login-hr"></div>
			<div class="yiqi-login-buttom-icon">
				<img src="images/icon/qq.png">
				<img src="images/icon/weixin.png">
				<img src="images/icon/weibo.png">
			</div>
		</div>
	</div>
</body>
</html>
