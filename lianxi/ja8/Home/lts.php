<?php
if(!defined('VER'))exit('非法访问!');
$title = "聊天室";
require_once(PATH.'Home/header.php');
?>
<script language="JavaScript"> 
	function chat(){
	xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("value").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","/index.php?mod=value&do=cx",true);
	xmlhttp.send();
}
function fs(){
	xmlhttp=new XMLHttpRequest();
	var txt = document.getElementById('txt').value;
	if (txt == ""){
		return alert("发送的消息不能为空");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("txt").value="";
			alert("发送成功");
		}
	}
	xmlhttp.open("GET","/index.php?mod=value&do=cx&fs=fs&txt="+txt,true);
	xmlhttp.send();
}
window.setInterval('chat()', 1000); 
</script>
<!-- 主页面 Start-->
<div class="row">
<div class="col-sm-12">
<section class="panel">
<header class="panel-heading" style="text-align:center">
聊天室
</header>
<div class="panel-body profile-activity" style="overflow-x:hidden;overflow-y:scroll;height:500px;" id="value">
</div>
</section>
</div>

<div class="col-sm-12>
<section class="panel">
<div class="panel-body">
<textarea id="txt" placeholder="欢迎来到聊天室,请大家文明发言!" rows="4" class="form-control input-lg p-text-area"></textarea>
<footer class="panel-footer" style="height:50px">
<input type="submit" class="btn btn-danger pull-right" value="发送" onclick="fs()">
</footer>
</div>
</section>
</div>

	
<!-- 主页面 End -->
<?php
require_once(PATH.'Home/footer.php');
?>