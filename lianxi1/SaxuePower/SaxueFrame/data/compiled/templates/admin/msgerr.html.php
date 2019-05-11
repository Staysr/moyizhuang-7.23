<?php
echo '<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>错误提示</title>
<style type="text/css">
<!--
*{ padding:0; margin:0; font-size:12px}
div { text-align: left;}
a:link,a:visited{text-decoration:none;color:#0068a6}
a:hover,a:active{color:#ff6600;text-decoration: underline}
.showmsg{border:1px solid #E2E2E2;width:350px;zoom:1;text-align:center;position:absolute;top:30%;left:50%;margin-left:-175px}
.showtitle{border:#fff 1px solid;font-weight:bold;font-size:14px;background-color:#E0EDFF;color:#333;line-height:26px;padding-left:10px;}
.showcontent{width:330px;margin:0px !important;margin:3px;padding:10px;line-height:2;text-align:center}
.showbottom{border-top:#E2E2E2 1px solid;padding:3px;text-align:center;background:#F0F7FF;line-height:150%;}
-->
</style>
</head>
<body>
<div class="showmsg">
	<div class="showtitle">错误提示</div>
	<div class="showcontent">'.$this->_tpl_vars['errorinfo'];
if($this->_tpl_vars['debuginfo']!=''){
echo '<br /><br />'.$this->_tpl_vars['debuginfo'];
}
echo '</div>
	<div class="showbottom">[<a href="javascript:window.close()">关闭本窗口</a>]&nbsp;&nbsp;[<a href="javascript:history.back(1)">返回上一页</a>]</div>
</div>
</body>
</html>';
?>