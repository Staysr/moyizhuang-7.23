<?php if (!defined('THINK_PATH')) exit(); if(C('LAYOUT_ON')) { echo ''; } ?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="/Public/admin/css/pintuer.css">
		<title>跳转提示</title>
		<style type="text/css">
			* {
				margin: 0px;
				padding: 0px;
			}
			
			.error-container {
				background: #fff;
				border: 1px solid #0ae;
				text-align: center;
				width: 450px;
				margin: 250px auto;
				font-family: Microsoft Yahei;
				padding-bottom: 30px;
				border-top-left-radius: 5px;
				border-top-right-radius: 5px;
			}
			
			.error-container h1 {
				font-size: 16px;
				padding: 12px 0;
				background: #0ae;
				color: #fff;
			}
			
			.errorcon {
				padding: 35px 0;
				text-align: center;
				color: #0ae;
				font-size: 18px;
			}
			
			.errorcon i {
				display: block;
				margin: 12px auto;
				font-size: 30px;
			}
			
			.errorcon span {
				color: red;
			}
			
			h4 {
				font-size: 14px;
				color: #666;
			}
			
			a {
				color: #0ae;
			}
		</style>
	</head>

	<body>
		<div class="error-container">
			<h1> 后台管理系统-信息提示 </h1>
			<div class="errorcon">
				<?php if(isset($message)) {?>
					<i class="icon-smile-o"></i><?php echo($message); ?>
				<?php }else{?>
					<span><i class="icon-frown-o"></i><?php echo($error); ?></span>
				<?php }?>
			</div>
			<h4 class="smaller">页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b></h4>
		</div>
		<script type="text/javascript">
			(function() {
				var wait = document.getElementById('wait'),
					href = document.getElementById('href').href;
				var interval = setInterval(function() {
					var time = --wait.innerHTML;
					if(time <= 0) {
						location.href = href;
						clearInterval(interval);
					};
				}, 1000);
			})();
		</script>
	</body>

	</html>