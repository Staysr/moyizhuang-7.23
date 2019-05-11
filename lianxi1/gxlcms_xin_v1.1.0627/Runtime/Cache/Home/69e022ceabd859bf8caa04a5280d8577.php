<?php if (!defined('THINK_PATH')) exit(); if(C('LAYOUT_ON')) { echo ''; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo (C("site_name")); ?>-系统提示</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv='Refresh' content='<?php echo ($waitSecond); ?>;URL=<?php echo ($jumpUrl); ?>'>
</head>
<body>
<table border="0" align="center" cellpadding="5" cellspacing="1" style="color:#333333;margin-top:100px;background:#000">
<tr><th style="color:#FFFFFF"><?php echo ($msgTitle); ?></th></tr>
<tr><td style="background:#FFF; padding:20px 10px; font-size:12px; line-height:25px">
	<font style="color:#FF0000;font-size:14px"><?php if(isset($message)) {?>
<?php echo($message); ?>
<?php }else{?>
<?php echo($error); ?>
<?php }?></font><br />系统将在<span id="countDownSec" style="color:blue;font-weight:bold"><?php echo ($waitSecond); ?></span>&nbsp;秒后自动跳转，如果不想等待请<a href="<?php echo ($jumpUrl); ?>" style="color:#069;">点击这里</a>
</td></tr>
</table>
<script language="javascript" type="text/javascript">
var countDown = function(timer,eleId,interType){
	document.getElementById(eleId).innerHTML = timer;
	var interval = interType=='s'?1000:(interType=='m'?1000*60:1000*60*60);
	window.setInterval(function(){
		timer--;
		if (timer > 0) {
			document.getElementById(eleId).innerHTML = timer;
		}
	},interval);
};
countDown(parseInt(<?php echo ($waitSecond); ?>),'countDownSec','s');
</script>
</body>
</html>