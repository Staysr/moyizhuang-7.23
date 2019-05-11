<div class="foornav">
	<center><a href="/"><span><img src="/images/index.png"/>首页</span></a>
	<a href="user/index.php"><span><img src="/images/user.png"/>会员中心</span></a>
	<a href="user/jiameng.php"><span><img src="/images/dianshiju.png"/>加盟代理</span></a></center>
</div>
<footer class="footer">
<div class="branding branding-black">
	<div class="container" style="text-align: center;">
		<h2><?php echo $aik['sitename'];?> - 搜索vip视频全网</h2>
						<a target="blank" class="gobtn" href="user/jiameng.php">加入我们</a>	
			</div>
</div>
<p style="padding: 0 4px;">友情链接：<?php echo $aik['youlian'];?><p/>
<p style="padding: 0 4px;"><?php echo $aik['foot'];?><br/>管理员邮箱：<?php echo $aik['admin_email'];?><br/>&copy; 2018 <a href="<?php echo $aik['pcdomain'];?>"><?php echo $aik['sitename'];?></a>&nbsp; <a href="http://www.miitbeian.gov.cn"><?php echo $aik['icp'];?></a>&nbsp; 
        本站主题由 <a href="<?php echo $aik['pcdomain']?>" target="_blank"><font color="red">【<?php echo $aik['sitename'];?>】</font></a> 提供 &nbsp; <?php echo $aik['tongji'];?> </footer>
	<div class="rewards-popover-mask" etap="rewards-close"></div>
<div class="rewards-popover">
        <div class="panel-body">
            <h4>用户登录</h4>
             <form class="form-horizontal"  action="?type=login"  method = "post"  class="registerform"  name = "myform" onsubmit = "return checkform();">
                <div class="form-group">
                    <div class="col-sm-8">
                        <input type="text" class="form-control numeric" name="username" maxlength="12" placeholder="用户名" autocomplete="on" value="">
                    </div>
                </div>
                <div class="form-group">
                     <div class="col-sm-8">
                        <input type="password" id="userpwd" name="password" class="form-control" placeholder="密码(6~16个字符，区分大小写)" autocomplete="off">
                    </div>
                </div>
                <!--<div class="form-group">				
					<div class="col-sm-4">
						<input type="text" maxlength="6" class="form-control" name="validate" placeholder="图片验证码" style="height:40px; line-height:40px;">
					</div>
					<div class="col-sm-4">
						 <img  title="点击刷新" src="../conf/captcha.php" align="absbottom" onclick="this.src='conf/captcha.php?'+Math.random();" style="width:100px; height:40px; line-height:40px; cursor:pointer"/>
					</div>
				</div>-->
                <div class="form-group" style="margin-top:30px;">
                    <div class="col-sm-8">
                        <button type="submit" class="btn o-btn8" name="sub" style="width:100%;  ">登录</button>
                    </div>
				   <p class="col-sm-8" style="margin-top:10px; font-size: 12px;">没有账户？<a style="font-size: 12px; color: #2196f3;" href="register.php" target="_self">立即注册</a></p>
                </div>
            </form>
        </div>
				<span class="rewards-popover-close" etap="rewards-close"></span>
</div> 
<script type="text/javascript">
function checkform()//使用JS来验证用户输入是否符合规范
	{
		if(myform.username.value == "")//账号不能为空
		{
			alert("用户名不能为空！！");
			myform.username.focus();
			return false;
		}
		
		if(myform.password.value == "")//密码不能为空
		{
			alert("密码不能为空！");
			myform.password.focus();
			return false;
		}
		if(myform.validate.value == "")//密码不能为空
		{
			alert("请输入右边验证码！");
			myform.validate.focus();
			return false;
		}
	}
</script> 
<script type='text/javascript' src='js/main.js'></script>