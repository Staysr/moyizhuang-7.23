<?php
echo '<form name="f1" method="post" action="?step=database">
<!-- 配置网站根路径 -->
<div class="block-title">配置网站根目录</div>
<div class="block-summary">配置网站程序的URL路径，请输入存储程序的根目录，通常是您网站的域名<br>例如：http://www.saxue.com，注意末尾不要“/”。</div>
<div class="block-content">
	<table cellpadding="0" cellspacing="1">
		<tr><td>网站根路径</td></tr>
		<tr><td><input name="local_root" type="text" class="input" onfocus="this.select();" value="'.$this->_tpl_vars['local_root'].'" size="50"/></td>
		</tr>
	</table>
</div>
<!-- 配置Mysql链接参数 -->
<div class="block-title">配置Mysql连接参数</div>
<div class="block-summary">输入Mysql的连接参数，以创建数据库并建立数据库、数据表。</div>
<div class="block-content">
	<table cellpadding="0" cellspacing="1">
		<tr><td>数据库服务器</td></tr>
		<tr><td><input name="mysql_host" type="text" class="input" onfocus="this.select();" value="localhost" size="30" style="width:150px" /></td></tr>
		<tr><td>数据表前缀</td></tr>
		<tr><td><input name="mysql_prefix" type="text" class="input" size="30" style="width:150px" value="saxue" /> 注意末尾不要带下划线 _</td></tr>
		<tr><td>数据库名称</td></tr>
		<tr><td><input name="mysql_name" type="text" class="input" size="30" style="width:150px" /> <input type="checkbox" name="setup_table" value="yes" onclick="doAlert();" /> 建立数据库</td></tr>
		<tr><td>数据库用户名</td></tr>
		<tr><td><input name="mysql_user" type="text" class="input" size="30" style="width:150px" /></td></tr>
		<tr><td>数据库用户密码</td></tr>
		<tr><td><input name="mysql_pass" type="password" class="input" size="30" style="width:150px" /></td></tr>
	</table>
</div>
<!-- 配置管理员用户 -->
<div class="block-title">配置管理员账号</div>
<div class="block-summary">配置系通管理员的账号信息，该账号拥有最高管理权限，全部留空将采用默认账号(admin)密码(123456)。</div>
<div class="block-content">
	<table cellpadding="0" cellspacing="1">
		<tr><td>管理员账号</td></tr>
		<tr><td><input name="system_user" type="text" class="input" size="30" style="width:150px" /></td></tr>
		<tr><td>管理员密码</td></tr>
		<tr><td><input name="system_pass" type="password" class="input" size="30" style="width:150px" /></td></tr>
		<tr><td>确认管理员密码</td></tr>
		<tr><td><input name="system_pass_confirm" type="password" class="input" size="30" style="width:150px" /></td></tr>
	</table>
</div>
<!-- 配置管理后台目录 -->
<div class="block-title">配置管理后台目录</div>
<div class="block-summary">为了系统安全，建议您修改管理后台的目录，系统默认目录是 admin。</div>
<div class="block-content">
	<table cellpadding="0" cellspacing="1">
		<tr><td>管理后台目录</td></tr>
		<tr><td><input name="admin_dir" type="text" class="input" size="30" style="width:150px" value="admin" /></td></tr>
	</table>
</div>
<div class="block-menu">
	<input type="button" name="bt0" value="返回安装首页" class="button" onclick="window.location=\'index.php\';"><span class="span-space"></span>
	<input type="submit" name="bt1" value="下一步" class="button" onClick="return checkConfigs();" />
</div>
</form>';
?>