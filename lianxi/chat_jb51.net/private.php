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
	background-image:url(images/priv.gif);
	background-position:left;
	background-repeat:no-repeat;
}
-->
</style>
<script language="javascript" src="main.js"></script>
<script language="javascript" src="xmlhttprequest.js"></script>
<script language="javascript">
//定位滚动条
function scrollWindow1(){
	this.scroll(0,75000);
	setTimeout('scrollWindow1()',200);
}
</script>
<?php
	$tmppath='priv/'.$_SESSION['user'];
	$tmparr = file($tmppath);
	$max = count($tmparr);
	$tmpstr = '';
	if($_SESSION['rollscreen'] != 1){
		if($max > PRLINE){
			$min = $max - PRLINE;
		}else{
			$min = 0;
		}
	}else{
		$min = 0;
	}
	for($i = $min; $i<$max;$i++){
		$tmpstr .= $tmparr[$i].'<br>';
	}
?>
<div id="privlist" style="height:20px; line-height:20px;"><?php echo $tmpstr; ?></div>
<script>scrollWindow1()</script>
<script>
setInterval("showpriv()",1000); 
</script>