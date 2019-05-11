<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="renderer" content="webkit">
		<title></title>
		<link rel="stylesheet" href="/tengbo/Public/admin/css/pintuer.css">
		<link rel="stylesheet" href="/tengbo/Public/admin/css/admin.css">
		<script src="/tengbo/Public/admin/js/jquery.js"></script>
		<script src="/tengbo/Public/admin/js/pintuer.js"></script>
	</head>

	<body>
		<div class="panel admin-panel">
			<div class="panel-head"><strong><span class="icon-key"></span> 修改账号信息</strong></div>
			<div class="body-content">
				<form method="post" class="form-x" action="">
					<div class="form-group">
						<div class="label">
							<label>管理员帐号：</label>
						</div>
						<div class="field">
							<label style="line-height:33px;"><input type="text" class="input w50" id="username" name="username" size="50" readonly value="<?php echo ($info["username"]); ?>"/></label>
						</div>
					</div>
					<div class="form-group">
						<div class="label">
							<label>输入新密码：</label>
						</div>
						<div class="field">
							<input type="password" class="input w50" name="password" size="50" placeholder="请输入新密码" data-validate="required:请输入新密码,length#>=5:新密码不能小于5位" />
						</div>
					</div>
					<div class="form-group">
						<div class="label">
							<label>确认新密码：</label>
						</div>
						<div class="field">
							<input type="password" class="input w50" name="password1" size="50" placeholder="请再次输入新密码" data-validate="required:请再次输入新密码,repeat#password:两次输入的密码不一致" />
						</div>
					</div>

					<div class="form-group">
						<div class="label">
							<label></label>
						</div>
						<div class="field">
							<button class="button bg-main icon-check-square-o" type="submit">修改</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>

</html>