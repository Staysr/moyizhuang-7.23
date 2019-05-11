<?php 
header("Content-Type: text/plain;charset=utf-8"); 
session_start();
if(session_destroy()){
	header('Location:./index.php');
}


?>