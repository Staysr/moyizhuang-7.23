<?php
	session_start();
	include_once 'config.php';
	include_once 'func.php';
	header("Content-Type:text/html;charset=utf-8");
	header("cache-control:no-cache");
	$tmppath='priv/'.$_SESSION['user'];
	$tmparr = file($tmppath);
	$max = count($tmparr);
	$tmpstr = '';
	if($_SESSION['rollscreen'] != 1){
		if($max > PRLINE){
			$mix = $max - PRLINE;
		}else{
			$mix = 0;
		}
	}else{
		$mix = 0;
	}
	for($i = $mix; $i<$max;$i++){
			$tmpstr .= $tmparr[$i].'<br>';
	}
	echo $tmpstr;
?>
