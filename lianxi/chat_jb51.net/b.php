<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
session_start();
		if($_GET['action'] == 'to'){
			$name = $_GET['name'];
			if(!in_array($name,$_SESSION['per'])){
				$_SESSION['per'][] = $name;
			}
			$tmp = "<select id=\"obt\" name=\"obt\">";
			foreach($_SESSION['per'] as $value){
				if($name == $value){
					$tmp .= "<option value=".$value." selected>".$value."</option>";
				}else{
					$tmp .= "<option value=".$value.">".$value."</option>";
				}
			}
			$tmp .= "</select>";
			$reback = $tmp;	
		}
		echo $reback;
?>
</body>
</html>