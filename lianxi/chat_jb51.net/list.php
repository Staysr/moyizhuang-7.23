<?php
	header('Content-Type:text/html; charset=utf-8');
?>
<script language="javascript" src="main.js"></script>
<script language="javascript" src="xmlhttprequest.js"></script>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right:0px;
	background-color:#e5eefa;
}
-->
</style>
<div style="width:168px; height:37px; background-image:url(images/left.gif); background-position:top; background-repeat:no-repeat;">&nbsp;</div>
<?php
	include_once 'config.php';
	include_once 'func.php';
	$arr = storeuser(PERSON);
	$tmp = '';
	foreach($arr as $key => $value){
		$tmparr = explode(',',$value);
		$tmp .= '<img id="head'.$key.'" src="images/'.($tmparr[1]==1?'boy.gif':'girl.gif').'" border="0" width="25" height="26" />&nbsp;&nbsp;';
		//$tmp .= '<a onclick=changename("'.$tmparr[0].'") style="cursor: hand;">'.$tmparr[0].'</a><br>';
		$tmp .= '<a>'.$tmparr[0].'</a><br>';
	}
	$tmp .= '<p /><span style="font-size:12px;font-weight:bolder; color:#cc0000;">目前人数<font color="#000000">('.getRows(PERSON).'/'.MAX.')</font>在线</span>';
?>
<div id="userlist" style=" height:25px; line-height:25px; padding-left:10px; "><?php echo $tmp; ?></div>
<script>
setInterval("showlist()",2000); 
</script>