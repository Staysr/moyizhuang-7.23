<?php
	session_start();
	include_once 'config.php';
	include_once 'func.php';
	header("Content-Type:text/html;charset=utf-8");
	header("cache-control:no-cache");
?>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
}
body {
	margin-left: 12px;
	margin-top: 12px;
}
-->
</style>
<script language="javascript" src="main.js"></script>
<script language="javascript" src="xmlhttprequest.js"></script>
<script language="javascript">
//定位滚动条
function scrollWindow(){
	document.getElementById('publist').scrollTop = document.getElementById('publist').scrollHeight;
	setTimeout('scrollWindow()',1000);
}
</script>
<div style=" background-image:url(images/apple.gif); background-position:left; background-repeat:no-repeat; height:24px; line-height:24px; font-size:12px; color: #666699; font-weight:bolder; text-indent:25px;"><?php echo WELCOME; ?></div>
<?php
	$tmparr = file(MESS);
	//print_r($tmparr);
	echo $totmax = count($tmparr);  	//总的留言条数，用于检测是否有新的留言信息发表
	//$_SESSION['pubnum'] = getRows(MESS);
	$youline = $_SESSION['pubnum']; 	//打开窗口前(未发表留言前)已经存在的留言信息条数
	if($_SESSION['rollscreen'] != 1){
		if(($totmax - $youline) > LINE){
			$min = $totmax - LINE;
		}else{
			$min = $youline;
		}
	}else{
		$min = $youline;
	}
	for($i = $min; $i<$totmax;$i++){
		$tmpstr .= $tmparr[$i].'<br>';
	}
?>
<div id="publist" style="width:800px; height:auto; overflow-x:hidden; overflow-y:auto; work-break:break-all; word-wrap: break-word; line-height:20px;"><?php echo $tmpstr;?></div>
<script>scrollWindow()</script>
<script>
setInterval("showpub()",1000); 
</script>