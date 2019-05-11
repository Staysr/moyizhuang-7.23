<?php
echo '<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>SaxuePower企业网站管理系统安装程序</title>
<link href="style/style.css" type="text/css" rel="stylesheet">
<script language="javascript" src="style/install.js"></script>
</head>
<body>
<div id="header"><span class="title">欢迎使用SaxuePower企业网站管理系统</span></div>
<div id="main">
	<div id="left">
		<div ';
if($_REQUEST['step'] == 'license'){
echo 'class="step-on"';
}else{
echo 'class="step-off"';
}
echo '>安装协议</div>
		<div ';
if($_REQUEST['step'] == 'checkenv'){
echo 'class="step-on"';
}else{
echo 'class="step-off"';
}
echo '>检测系统环境</div>
		<div ';
if($_REQUEST['step'] == 'checkwrite'){
echo 'class="step-on"';
}else{
echo 'class="step-off"';
}
echo '>检测读写权限</div>
		<div ';
if($_REQUEST['step'] == 'configs'){
echo 'class="step-on"';
}else{
echo 'class="step-off"';
}
echo '>写入配置参数</div>
		<div ';
if($_REQUEST['step'] == 'database'){
echo 'class="step-on"';
}else{
echo 'class="step-off"';
}
echo '>检测数据库连接</div>
		<div ';
if($_REQUEST['step'] == 'install'){
echo 'class="step-on"';
}else{
echo 'class="step-off"';
}
echo '>开始安装程序</div>
	</div>
	<div id="right">'.$this->_tpl_vars['saxue_content'].'</div>
	<div class="clear"></div>
</div>
<div id="footer">Powered by SaxueCMS &copy; 2014 <br />技术支持：<a href="http://www.saxue.com" target="_blank">SaxueCMS</a></div>
</body>
</html>';
?>