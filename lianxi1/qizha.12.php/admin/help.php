<?php 
require '../conn/conn2.php';
require '../conn/function.php';

$page=$_GET["page"];
switch($page){

case "0.1":
$url="843625";
break;
case "0.2":
$url="843626";
break;
case "0.3":
$url="843627";
break;
case "1.1.1":
$url="843630";
break;
case "1.1.2":
$url="843631";
break;
case "1.1.3":
$url="843632";
break;
case "1.2.1":
$url="843634";
break;
case "1.2.2":
$url="843635";
break;
case "1.3.1":
$url="843637";
break;
case "1.3.2":
$url="843638";
break;
case "1.3.3":
$url="843639";
break;
case "1.3.4":
$url="843645";
break;
case "1.3.5":
$url="843642";
break;
case "1.3.6":
$url="843643";
break;
case "1.3.7":
$url="843644";
break;
case "2.1":
$url="843464";
break;
case "2.2":
$url="843465";
break;
case "2.3":
$url="843466";
break;
case "2.4":
$url="843467";
break;
case "3.1":
$url="843470";
break;
case "3.2":
$url="843471";
break;
case "3.2.1":
$url="843472";
break;
case "3.2.2":
$url="843473";
break;
case "3.3":
$url="843474";
break;
case "3.3.1":
$url="843475";
break;
case "3.4":
$url="843477";
break;
case "3.4.1":
$url="843477";
break;
case "3.4.2":
$url="843478";
break;
case "3.5":
$url="843479";
break;
case "4.1":
$url="843486";
break;
case "4.2":
$url="843487";
break;
case "4.3":
$url="843488";
break;
case "4.4":
$url="843489";
break;
case "4.5":
$url="843490";
break;
case "5.1":
$url="843491";
break;
case "5.2":
$url="843492";
break;
case "6.1":
$url="843493";
break;
case "6.2":
$url="843493";
break;
case "6.3":
$url="843495";
break;
case "7.1":
$url="843496";
break;
case "8.1":
$url="843497";
break;
case "8.2":
$url="843498";
break;
case "9.1":
$url="843499";
break;
case "9.2":
$url="843500";
break;
case "9.3":
$url="843501";
break;
case "9.4":
$url="843502";
break;
case "9.5":
$url="843503";
default:
$url="843625";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
<link rel="shortcut icon" href="<?php echo $C_dir.$C_ico?>" type="image/x-icon" />
<link rel="Bookmark" href="<?php echo $C_dir.$C_ico?>" />
<title>用户使用手册</title>
<link href="css/jquery-accordion-menu.css" rel="stylesheet" type="text/css" />
<link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body{margin:0px; overflow:hidden }
</style>
<script language="JavaScript">
function show()
{
document.getElementById("iframeid").style.height=(document.documentElement.clientHeight)+"px";
}
window.onresize = function(){
document.getElementById("iframeid").style.height=(document.documentElement.clientHeight)+"px";
}
</script>
</head>
<body>
<iframe src="http://help.s-cms.cn/<?php echo $url?>" width="100%" frameBorder="0" id="iframeid" onLoad="show()"></iframe>
</body>
</html>