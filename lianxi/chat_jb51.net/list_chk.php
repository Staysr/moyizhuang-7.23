<?php
	include_once 'config.php';
	include_once 'func.php';
	header("Content-Type:text/html;charset=utf-8");
	header("CACHE-CONTROL:NO-CACHE");
	$arr = storeuser(PERSON);
	$list = '';
?>
<?php
	foreach($arr as $value){
		$tmparr = explode(',',$value);
		$list .= '<img src="images/'.($tmparr[1]==1?'boy.gif':'girl.gif').'" border="0" width="25" height="26" />&nbsp;&nbsp;';
		//$list .= '<a onclick=changename("'.$tmparr[0].'") style="cursor: hand;">'.$tmparr[0].'</a><br>';
		$list .= '<a>'.$tmparr[0].'</a><br>';
	}
	$list .= '<p /><span style="font-size:12px;font-weight:bolder; color:#cc0000;">目前人数<font color="#000000">('.getRows(PERSON).'/'.MAX.')</font>在线</span>';
	//$list = '';
	echo $list;
?>