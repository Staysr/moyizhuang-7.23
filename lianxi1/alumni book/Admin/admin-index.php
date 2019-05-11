<?php
if(!defined('VER'))exit('非法访问!');
$title = "后台管理";
require_once(PATH.'Admin/header.php');
if ($userrow['active'] != 9){
	msg('权限不足');
}
if ($_POST['do'] == 'do'){
	foreach($_POST as $k => $value){
		$db->query('UPDATE '.$Mysql['prefix']."config SET value='{$value}' WHERE vkey='{$k}'");
	}
	msg('修改成功');
}
?>
<aside class="lg-side">
<div class="inbox-head">
<h3>系统设置</h3>
</div>
<div class="inbox-body">
<form class="form-horizontal tasi-form" method="post">
<input type="hidden" name="do" value="do">
<div class="form-group">
<label class="col-sm-2 control-label">网站标题:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="Webtitle" value="<?=$config['Webtitle']; ?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">网站名称:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="Webname" value="<?=$config['Webname'];?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">站长QQ:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="Webqq" value="<?=$config['Webqq']; ?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">站长邮箱:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="Webemail" value="<?=$config['Webemail'];?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">首页简介:</label>
<div class="col-sm-10">
	<textarea class="form-control" name="Index_jianjie" rows="3"><?=$config['Index_jianjie'];?></textarea>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">首页描述:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="Index_miaoshu" value="<?=$config['Index_miaoshu']; ?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">网站版权:</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="Index_foot" value="<?=$config['Index_foot']; ?>">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">网站公告(支持HTML):</label>
<div class="col-sm-10">
	<textarea class="form-control" name="Gonggao" rows="3"><?=$config['Gonggao'];?></textarea>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">首页背景图:</label>
<div class="col-sm-10">
	<select class="form-control m-bot15" name="Index_bgapi">
	<option value="1">官方API</option>
    <option value="2" <?php if($config['Index_bgapi'] == 2) echo'selected';?>>绚丽彩虹API</option>
       <option value="3" <?php if($config['Index_bgapi'] == 3) echo'selected';?>>蓝柒API</option>
    <option value="0" <?php if($config['Index_bgapi'] == 0) echo'selected';?>>本地</option>
	</select>  
	更换本地的背景图请自行替换文件 路径:Assets/Index/img/bg.jpg
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">播放器类型:</label>
<div class="col-sm-10">
	<select class="form-control m-bot15" name="player">
	<option value="1">绚丽播放器</option>
    <option value="2" <?php if($config['player'] == 2) echo'selected';?>>官方播放器</option>
    <option value="0" <?php if($config['player'] == 0) echo'selected';?>>关闭</option>
	</select>  
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">播放器KEY(官方播放器填网易云歌单id):</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="playerkey" value="<?=$config['playerkey']; ?>">
	<a href="http://www.badapple.top" target="_black">获取绚丽播放器KEY</a>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">是否开放注册:</label>
<div class="col-sm-10">
	<select class="form-control m-bot15" name="zc">
	<option value="1">开启</option>
    <option value="0" <?php if($config['zc'] == 0) echo'selected';?>>关闭</option>
	</select>  
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">网页原始缩放比例(默认为1):</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="scale" value="<?=$config['scale']; ?>">
	<span style="color:red">该值为0.9时可以使绚丽播放器兼容手机页面,该值请勿随意乱调</span>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">加载动画颜色(RBG颜色代码):</label>
<div class="col-sm-10">
	<input type="text" class="form-control" name="pjax_loadanimation" value="<?=$config['pjax_loadanimation']; ?>">
</div>
</div>
<div align="right">
<button type="submit" class="btn btn-primary">确定修改</button>   
</div>
</form>
</div>
</aside>
<?php
require_once(PATH.'Admin/footer.php');
?>