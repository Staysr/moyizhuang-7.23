<?php
ob_start();
include_once 'config.php';
include_once 'func.php';
ignore_user_abort(true);
$arr = '';
$max = 1024;
for($i =0;$i<$max;$i++){
	$arr .= $i;
}
echo $arr;
while(true){
	if(!connection_aborted()){
		echo ' ';
		ob_flush();
		flush();
		sleep(1);
	}else{
		include_once 'logout.php';
		exit();
	}
}
?>