<?php
echo '<div class="block-title">安装协议</div>
<div class="block-summary">请仔细阅读下述安装协议，要继续安装必须同意以下协议条款。</div>
<div class="block-content"><iframe class="license" src="templates/lic.htm" frameborder="0"></iframe></div>
<form name="f1">
<div class="block-summary"><input type="checkbox" onclick="doAgree();" name="cb1">我接受许可协议</div>
<div class="block-menu">
	<input type="button" name="bt0" value="返回安装首页" class="button" onclick="window.location=\'index.php\';"><span class="span-space"></span>
	<input type="button" name="bt1" value="下一步" class="button-off" id="check_lic" onclick="window.location=\'?step=checkenv\';" disabled>
</div>
</form>';
?>