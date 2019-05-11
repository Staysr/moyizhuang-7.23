<?php
if(!defined('VER'))exit('非法访问!');
$title = "修改资料";
$isinfo = true;
require_once(PATH.'Home/header.php');
if ($_POST['do'] == 'do') {
	$gxqm = $_POST['gxqm'];
	$qq = $_POST['qq'];
	$mail = $_POST['mail'];
	$phone = $_POST['phone'];
	$name = $_POST['name'];
	$xb = $_POST['xb'];
	$xz = $_POST['xz'];
	$sr = $_POST['sr'];
	$xh = $_POST['xh'];
	$dz = $_POST['dz'];
	$ah = $_POST['ah'];
	$tc = $_POST['tc'];
	$srgs = '((((1[6-9]|[2-9]\d)\d{2})-(1[02]|0?[13578])-([12]\d|3[01]|0?[1-9]))|(((1[6-9]|[2-9]\d)\d{2})-(1[012]|0?[13456789])-([12]\d|30|0?[1-9]))|(((1[6-9]|[2-9]\d)\d{2})-0?2-(1\d|2[0-8]|0?[1-9]))|(((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))-0?2-29-))';
	$f = explode('-', $sr);
	if ($sr != ''){
		if(!preg_match($srgs,$sr)){
			msg('生日的格式错误');
		}
		if ($f[0] > date('Y')){
			msg('生日的格式错误');
		}
	}
	if ($db->get_row('SELECT * FROM '.$Mysql['prefix']."users WHERE name = '{$name}' and uid != '{$userrow['uid']}' LIMIT 1")){
		msg('已有该姓名的用户存在,如有疑问请联系管理员处理');
	}
	$set = "gxqm='{$gxqm}',qq='{$qq}',mail='{$mail}',phone='{$phone}',name='{$name}',xb='{$xb}',age='{$age}',xz='{$xz}',sr='{$sr}',xh='{$xh}',dz='{$dz}',ah='{$ah}',tc='{$tc}'";
	$where = "uid='{$userrow['uid']}'";
	$sql = "UPDATE ".$Mysql['prefix']."users SET {$set} WHERE {$where}";
		if ($db->query($sql)){
			msg('修改成功!');
		}else{
			msg('修改失败!');
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
	
<!-- 修改资料 Start-->
<div class="row">
<div class="col-sm-12">
<section class="panel">
<div style="height:50px;line-height:50px;text-align:center;background-color:#1C86EE;color:#fff;border-radius:5px 5px 0px 0px">
<span style="font-size:18px"><i class="icon-edit"></i> 修改资料</span>
</div>
<div class="panel-body">
<form class="form-horizontal tasi-form" method="post">
<input type="hidden" name="do" value="do">
<?php
	if ($userrow['tj'] != ''){
?>
		<div class="form-group">
			<label class="col-sm-2 control-label">头衔:</label>
			<div class="col-sm-10">
				
			</div>
		</div>
<?php
}
?>
<div class="form-group">
<label class="col-sm-2 control-label">用户名:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" value="<?=$userrow['user']; ?>" disabled="">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">个性签名:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="gxqm" value="<?=$userrow['gxqm']; ?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">QQ*:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="qq" value="<?=$userrow['qq'] ?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">邮箱*:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="mail" value="<?=$userrow['mail']; ?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">电话*:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="phone" value="<?=$userrow['phone']; ?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">姓名*:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="name" value="<?=$userrow['name']; ?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">性别*:</label>
<div class="col-sm-10">
	<select class="form-control m-bot15" name="xb">
	<option value="1">男</option>
    <option value="2" <?php if($userrow['xb'] == 2) echo'selected';?>>女</option>
	</select>  
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">星座*:</label>
<div class="col-sm-10">
	<select class="form-control m-bot15" name="xz">
		<option value="1" >天蝎座</option>
		<option value="2" <?php if($userrow['xz'] == 2) echo'selected';?>>白羊座</option>
		<option value="3" <?php if($userrow['xz'] == 3) echo'selected';?>>水瓶座</option>
		<option value="4" <?php if($userrow['xz'] == 4) echo'selected';?>>狮子座</option>
		<option value="5" <?php if($userrow['xz'] == 5) echo'selected';?>>金牛座</option>
		<option value="6" <?php if($userrow['xz'] == 6) echo'selected';?>>摩羯座</option>
		<option value="7" <?php if($userrow['xz'] == 7) echo'selected';?>>双子座</option>
		<option value="8" <?php if($userrow['xz'] == 8) echo'selected';?>>处女座</option>
		<option value="9" <?php if($userrow['xz'] == 9) echo'selected';?>>巨蟹座</option>
		<option value="10" <?php if($userrow['xz'] == 10) echo'selected';?>>双鱼座</option>
		<option value="11" <?php if($userrow['xz'] == 11) echo'selected';?>>射手座</option>
		<option value="12" <?php if($userrow['xz'] == 12) echo'selected';?>>天秤座</option>
	</select>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">生日*:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="sr" value="<?=$userrow['sr']; ?>">
	请按格式填写! 例如:<?=date("Y-m-d");?>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">学号:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="xh" value="<?=$userrow['xh']; ?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">住址:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="dz" value="<?=$userrow['dz']; ?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">爱好:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="ah" value="<?=$userrow['ah']; ?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">特长:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="tc" value="<?=$userrow['tc']; ?>">
</div>
</div>
<div align="right">
<button type="submit" class="btn btn-primary">确定修改</button>   
</div>
</form>
</div>
</section>
<!-- 修改资料 End -->                     
         
<!-- 主页面 End -->
<?php
require_once(PATH.'Home/footer.php');
?>