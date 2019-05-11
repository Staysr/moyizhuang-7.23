<?php
if(!defined('VER'))exit('非法访问!');
$title = "修改密码";
require_once(PATH.'Home/header.php');

if ($_POST['do'] == 'do'){
	$opwd = md5(md5(isnull('opwd')).md5('211154860'));
	$npwd = isnull('npwd');
	$qpwd = isnull('qpwd');
	$old = $userrow['pwd'];
	
	if ($opwd != $old){
		msg('原密码填写错误!');
	}else{
		if (strlen($npwd) < 6){
			msg('密码不能小于6位!');
		}else if ($npwd != $qpwd){
			msg('两次输入的密码不一致!');
		}else{
			$pwd = md5(md5($npwd).md5('211154860'));
			$set = "pwd='{$pwd}'";
			$where = "uid='{$userrow['uid']}'";
			$sql = "UPDATE ".$Mysql['prefix']."users SET {$set} WHERE {$where}";
			if ($db->query($sql)){
				msg('修改成功,请重新登录!','/logout.php');
			}else{
				msg('修改失败');
			}
		}
	}
}
?>
<!-- 主页面 Start-->

<!-- 头像栏 Start-->
<div class="row">
<aside class="profile-nav col-sm-12">
<section class="panel">
<div class="user-heading round">
<a href="#">
<img src="http://q1.qlogo.cn/g?b=qq&nk=<?=$userrow['qq']?>&s=160" alt="">
</a>
<h2 style="text-transform:capitalize;"><?=$userrow['user'] ?></h2>
<p>
<?=$userrow['gxqm'] ?>
</div>
</section>
</aside>
</div>
<!-- 头像栏 End-->

<!-- 修改密码 Start-->
<div class="row">
<div class="col-sm-12">
<section class="panel">
<div style="height:50px;line-height:50px;text-align:center;background-color:#1C86EE;color:#fff;border-radius:5px 5px 0px 0px">
<span style="font-size:18px"><i class="icon-edit"></i> 修改密码</span>
</div>
<div class="panel-body">
<form class="form-horizontal tasi-form" method="post">

<input type="hidden" name="do" value="do">

<div class="form-group">
<label class="col-sm-2 control-label">用户名:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" value="<?=$userrow['user'];?>" disabled="">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">原密码:</label>
<div class="col-sm-10">
	<input type="password" name="opwd" class="form-control" placeholder="请输入原密码!">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">新密码:</label>
<div class="col-sm-10">
	<input type="password" name="npwd" class="form-control" placeholder="请输入新密码!">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">确认密码:</label>
<div class="col-sm-10">
	<input type="password" name="qpwd" class="form-control" placeholder="请在输入一遍!">
</div>
</div>

<div align="right">
<button type="submit" class="btn btn-primary">确定修改</button>   
</div>

</form>
</div>
</section>
<!-- 修改密码 End-->

<!-- 主页面 End -->
<?php
require_once(PATH.'Home/footer.php');
?>