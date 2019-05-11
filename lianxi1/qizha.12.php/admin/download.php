<?php
require '../conn/conn2.php';
require '../conn/function.php';

if ($_COOKIE["user"]=="" || $_COOKIE["pass"]==""){
	setcookie("user","");
	setcookie("pass","");
	setcookie("auth","");
	Header("Location:index.php");
	die();
}else{
	$sql="select * from SL_admin where A_login like '".filter_keyword($_COOKIE["user"])."' and A_pwd like '".filter_keyword($_COOKIE["pass"])."'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if (mysqli_num_rows($result) > 0) {

	}else{
		setcookie("user","");
		setcookie("pass","");
		setcookie("auth","");
		Header("Location:index.php");
		die();
	}
}


$DownName=$_GET["DownName"];
$DownName=str_replace("@@","..",$DownName);

if(strpos($DownName,".php")!==false){
	die("禁止下载PHP格式文件！");
}

downtemplateAction($DownName);

function downtemplateAction($f){
    header("Content-type:text/html;charset=utf-8");
    $file_name = $f;
    $file_name = iconv("utf-8","gb2312",$file_name);
    $file_path=$file_name;
    if(!file_exists($file_path))
    {
        echo "下载文件不存在！";
        exit;
    }
 
    $fp=fopen($file_path,"r");
    $file_size=filesize($file_path);
    Header("Content-type: application/octet-stream");
    Header("Accept-Ranges: bytes");
    Header("Accept-Length:".$file_size);
    Header("Content-Disposition: attachment; filename=".$file_name);
    $buffer=1024;
    $file_count=0;
    while(!feof($fp) && $file_count<$file_size)
    {
        $file_con=fread($fp,$buffer);
        $file_count+=$buffer;
        echo $file_con;
    }
    fclose($fp);
}
?>