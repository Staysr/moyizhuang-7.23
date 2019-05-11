<?php
echo '<form name="f1" method="post" action="?step=install">
<div class="block-title">检测数据库连接</div>
<div class="block-summary">根据填写的配置参数判断是否能正常连接到Mysql服务器，并写入配置文件。</div>
<div class="block-content">';
if($this->_tpl_vars['link_status'] == 1){
echo '<span class="span-green">'.$this->_tpl_vars['step_content'].'</span>';
}else{
echo '<span class="span-red">'.$this->_tpl_vars['step_content'].'</span>';
}
if($this->_tpl_vars['modadmin'] == 2){
echo '<br><span class="span-blue">修改admin目录失败，可能没有修改权限，请登录后台设置后手动修改</span>';
}
echo '</div>
<!-- 是否安装演示数据 -->
<div class="block-title">是否安装演示数据</div>
<div class="block-summary">安装系统演示数据，包括内容栏目和文章，可以更方便的了解系统功能。</div>
<div class="block-content">
	<table cellpadding="0" cellspacing="1">
		<tr><td>
			<input name="demo" type="radio" value="1" checked /> 安装演示数据&nbsp;&nbsp;&nbsp;&nbsp;
			<input name="demo" type="radio" value="0" /> 不安装演示数据
		</td></tr>
	</table>
</div>
<div class="block-menu">
	<input type="button" name="bt0" value="返回安装首页" class="button" onclick="window.location=\'index.php\';"><span class="span-space"></span>	
	<input type="button" name="bt1" value="重新配置" class="button" onclick="history.go(-1);">
	<input type="submit" name="bt2" value="下一步" ';
if($this->_tpl_vars['link_status'] == 0){
echo 'class="button-off" disabled';
}else{
echo 'class="button"';
}
echo '>
</div>
</form>';
?>