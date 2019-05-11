<?php
	session_start();
	include_once 'config.php';
	include_once 'func.php';
	header("Content-Type:text/html;charset=utf-8");
	header("cache-control:no-cache");
	$tmparr = file(MESS);
	if(count($tmparr) > 1000){
		$tmparr = array_slice($tmparr,50);
		file_put_contents(MESS,$tmparr);
	}
	$totmax = count($tmparr);
	$youline = $_SESSION['pubnum'];
	$tmpstr = '';
	if($_SESSION['rollscreen'] != 1){
		if(($totmax - $youline) > LINE){
			$mix = $totmax - LINE;
		}else{
			$mix = $youline;
		}
	}else{
		$mix = $youline;
	}
	for($i = $mix; $i<$totmax;$i++){
		$tmpstr .= $tmparr[$i].'<br>';
	}
	echo $tmpstr;
?>