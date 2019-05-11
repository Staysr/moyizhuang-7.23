<?php
 header('Content-type:text/html;charset=utf-8');  

?>

<!DOCTYPE HTML >
<head>
	<title>注册</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css" />
	<script type="text/javascript" src="../js/jquery1.7.2.js" ></script>
	
	<script type="text/javascript" src="../js/js.js" ></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#username").change(function(){
				var username=$("#username").val();
					$.get("inputJudge.php?username="+username,function(data,status){
					$("#div1").html(data);
					if(data!='')
						$("#username").val("");
				});			
			});
			
			$("#password1").change(function(){
				var password1=$("#password1").val();
				var password=$("#password").val();
					if(password!=password1)	
						$("#div2").html("密码不一致");
			});
			$("#name").change(function(){
				var name=$("#name").val();
				
					$.get("inputJudge.php?name="+name,function(data,status){
					$("#div3").html(data);
					if(data!='')
						$("#name").val("");
				});			
			});
		

		});
		
		
			</script>
</head>
<body style="width: 90%;margin: auto;">
	<br /><br />	
	
	<form class="form-horizontal" name="regForm" style="padding: 30px 100px 10px;"
		action="registerProcess.php" method="post" onsubmit="return isRegSubmit(this)">

		<fieldset>
			<legend>注册账号</legend>
		</fieldset>

		<div class="form-group">
			<label for="account" class="col-sm-2 control-label">账户：</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="username" name="username" placeholder="请输入登录名">
			<span id="div1" style="color: red;"></spqn>
			</div>
		</div>

		<div class="form-group">
			<label for="password" class="col-sm-2 control-label">密码：</label>
			<div class="col-sm-4">
				<input type="password" class="form-control" id="password" name="password" placeholder="请输入密码">
			</div>
			
		</div>

		<div class="form-group">
			<label for="conpsw" class="col-sm-2 control-label">再输一次：</label>
			<div class="col-sm-4">
				<input type="password" class="form-control" id="password1" name="password1" placeholder="请再次输入密码">
				<span id="div2" style="color: red;"></span>
			</div>
		</div>

		<div class="form-group">
			<label for="nickname" class="col-sm-2 control-label">昵称：(姓名)</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="name" name="name" placeholder="请输入昵称">
					<span id="div3" style="color: red;"></spqn>
			</div>
		</div>

		
		<div class="form-group">
			<label for="email" class="col-sm-2 control-label"></label>
			<div class="col-sm-4">
				<button type="submit" class="btn btn-success" name="submit">注册</button>
				<button type="button" class="btn btn-warning" onclick="clearAllReg(regForm)">清空</button>
				<button type="button" class="btn btn-info" onclick="javascript:history.back(-1);">返回</button>
			</div>
		</div>
	</form>

</body>
