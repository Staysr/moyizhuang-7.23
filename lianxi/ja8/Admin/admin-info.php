<?php
if(!defined('VER'))exit('非法访问!');
$title = "编辑用户";
require_once(PATH.'Admin/header.php');
$id=is_numeric($_GET['id'])?$_GET['id']:'0';
if (!$id || !$user=$db->get_row("SELECT * FROM ".$Mysql['prefix']."users where uid='{$id}' limit 1")){
	msg('此用户不存在','index.php?mod=admin-users');
} 
if ($userrow['active'] == 8 and $id == 1){
	msg('无权限','index.php?mod=admin-users');
}
if ($_POST['do'] == 'do'){
	$active = $_POST['active'];
	if ($userrow['active'] == 9 and $active != 9 and $id == 1){
		msg('不能修改管理员的权限');
	}
	$gxqm = $_POST['gxqm'];
	$tj = $_POST['tj'];
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
	$set = "active='{$active}',tj='{$tj}',gxqm='{$gxqm}',qq='{$qq}',mail='{$mail}',phone='{$phone}',name='{$name}',xb='{$xb}',age='{$age}',xz='{$xz}',sr='{$sr}',xh='{$xh}',dz='{$dz}',ah='{$ah}',tc='{$tc}'";
	$where = "uid='{$user['uid']}'";
	$sql = "UPDATE ".$Mysql['prefix']."users SET {$set} WHERE {$where}";
		if ($db->query($sql)){
			msg('修改成功!');
		}else{
			msg('修改失败!');
		}
}
?>
<aside class="lg-side">
<div class="inbox-head">
<h3>编辑用户</h3>
</div>
<div class="inbox-body">
<div class="col-sm-12">
<section class="panel">
<div class="panel-body">
<form class="form-horizontal tasi-form" method="post">
<input type="hidden" name="do" value="do">
<div class="form-group">
<label class="col-sm-2 control-label">用户名:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" value="<?=$user['user']; ?>" disabled="">
</div>
</div>
<?php if ($userrow['active'] == 9) { ?>
<div class="form-group">
<label class="col-sm-2 control-label">权限:</label>
<div class="col-sm-10">
	<select class="form-control m-bot15" name="active">
	<option value="1">普通同学</option>
    <option value="8" <?php if($user['active'] == 8) echo'selected';?>>副管理</option>
    <?php if($user['active'] == 9){ ?>
    <option value="9" <?php if($user['active'] == 9) echo'selected';?>>管理员</option>
    <?php } ?>
	</select>  
</div>
</div>
<?php } ?>
<div class="form-group">
<label class="col-sm-2 control-label">个性签名:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="gxqm" value="<?=$user['gxqm']; ?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">头衔:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="tj" value="<?=$user['tj']; ?>">
	填空等于不给头衔
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">QQ:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="qq" value="<?=$user['qq'] ?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">邮箱:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="mail" value="<?=$user['mail']; ?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">电话:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="phone" value="<?=$user['phone']; ?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">姓名:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="name" value="<?=$user['name']; ?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">性别:</label>
<div class="col-sm-10">
	<select class="form-control m-bot15" name="xb">
	<option value="1">男</option>
    <option value="2" <?php if($user['xb'] == 2) echo'selected';?>>女</option>
	</select>  
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">星座:</label>
<div class="col-sm-10">
	<select class="form-control m-bot15" name="xz">
		<option value="1" >天蝎座</option>
		<option value="2" <?php if($user['xz'] == 2) echo'selected';?>>白羊座</option>
		<option value="3" <?php if($user['xz'] == 3) echo'selected';?>>水瓶座</option>
		<option value="4" <?php if($user['xz'] == 4) echo'selected';?>>狮子座</option>
		<option value="5" <?php if($user['xz'] == 5) echo'selected';?>>金牛座</option>
		<option value="6" <?php if($user['xz'] == 6) echo'selected';?>>摩羯座</option>
		<option value="7" <?php if($user['xz'] == 7) echo'selected';?>>双子座</option>
		<option value="8" <?php if($user['xz'] == 8) echo'selected';?>>处女座</option>
		<option value="9" <?php if($user['xz'] == 9) echo'selected';?>>巨蟹座</option>
		<option value="10" <?php if($user['xz'] == 10) echo'selected';?>>双鱼座</option>
		<option value="11" <?php if($user['xz'] == 11) echo'selected';?>>射手座</option>
		<option value="12" <?php if($user['xz'] == 12) echo'selected';?>>天秤座</option>
	</select>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">生日:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="sr" value="<?=$user['sr']; ?>">
	请按格式填写! 例如:<?=date("Y-m-d");?>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">学号:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="xh" value="<?=$user['xh']; ?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">住址:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="dz" value="<?=$user['dz']; ?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">爱好:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="ah" value="<?=$user['ah']; ?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">特长:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="tc" value="<?=$user['tc']; ?>">
</div>
</div>
<div align="right">
<button type="submit" class="btn btn-primary">确定修改</button>   
</div>
</form>
</div>
</section>
</div>
</aside>
<?php
require_once(PATH.'Admin/footer.php');
?>