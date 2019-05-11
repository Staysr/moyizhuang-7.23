<?php
$mod = $_GET['mod'];
if ($mod == ''){
	$mod = 'index';
}
if ($mod == 'index'){
	require_once(PATH.'Home/index.php');
}else if ($mod == 'login'){
	require_once(PATH.'login.php');
}else if ($mod == 'reg'){
	require_once(PATH.'reg.php');
}else if ($mod == 'logout'){
	require_once(PATH.'logout.php');
}else{
	if(file_exists(PATH.'Home/'.$mod.'.php')){
    	require_once(PATH.'Home/'.$mod.'.php');
    }else if (file_exists(PATH.'Admin/'.$mod.'.php')){
        require_once(PATH.'Admin/'.$mod.'.php');
	}else{
		require_once(PATH.'404.php');
	}
}