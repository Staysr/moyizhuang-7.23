<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script language="javascript" src="xmlhttprequest.js"></script>
<script type="text/javascript">
function changename(name){
	//document.getElementById('obtobt').innerHTML =name;
	
	url = "b.php?action=to&name="+name;
	xmlhttp.open("get",url,true);
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4){
			var msg = xmlhttp.responseText;
			document.getElementById('obtobt').innerHTML = msg;
		}
	}
	xmlhttp.send(null);
}
//禁止刷新
//function enterkey(){
//	if(event.keyCode == 116){
//		alert('禁止刷新');
//		event.keyCode = 0;
//		return false;
//	}
//}
//document.onkeydown=enterkey;
//禁止鼠标右键
//function mouseright(){
//	if(event.button==2){
//		alert('禁止鼠标右键');
//		return false;
//	}
//}
//document.onmousedown=mouseright;
</script>
<pre>
<?php
session_start();
print_r($_SESSION['per']);
?>
<a onclick="changename('user')" style="cursor: hand;"> tianjiaaniu</a>
<div id="obtobt">


ss
</div>
</pre>
</body>
</html>