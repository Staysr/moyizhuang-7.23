<?php
echo '<div class="block-title">开始安装程序</div>
<div class="block-summary">设置完成，现在开始安装程序。。。</div>
<div class="block-content" id="notice"></div>
<div class="block-menu">
	<input type="button" id="bt0" value="返回安装首页" class="button-off" onclick=""><span class="span-space"></span>
	<input type="button" id="bt1" value="登录后台" class="button-off" onclick="">
	<input type="button" id="bt2" value="返回首页" class="button-off" onclick="">
	<input type="button" id="bt3" value="关闭本页" class="button-off" onclick="">
</div>
<script>
// 安装完成
function showcomplete(type) {
	document.getElementById("bt0").className=\'button\';
	document.getElementById("bt0").onclick = Function("window.location=\'index.php\';");
	if (type==1) {
		document.getElementById("bt1").className=\'button\';
		document.getElementById("bt2").className=\'button\';
		document.getElementById("bt3").className=\'button\';
		document.getElementById("bt1").onclick = Function("window.location=\''.$this->_tpl_vars['saxue_admin_url'].'\';");
		document.getElementById("bt2").onclick = Function("window.location=\''.$this->_tpl_vars['saxue_url'].'\';");
		document.getElementById("bt3").onclick = Function("window.close();");
	}
}
</script>';
?>