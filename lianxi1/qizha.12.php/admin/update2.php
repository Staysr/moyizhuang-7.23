<?php 
require '../conn/conn2.php';
require '../conn/function.php';

if($_GET["action"]=="mod"){
  mysqli_query($conn,"update SL_config set C_admin='".splitx(dirname(__FILE__),"\\",count(explode("\\",dirname(__FILE__)))-1)."'");
  box("修复成功！","update2.php","success");
}

if(splitx(dirname(__FILE__),"\\",count(explode("\\",dirname(__FILE__)))-1)!=$C_admin){
  die("后台目录出错！<a href='?action=mod'>点击此处</a>进行修复");
}

$version_info=trim(file_get_contents("version.txt"),"\xEF\xBB\xBF");
$update=file_get_contents("http://cdn.shanling.top/php/update.txt");
$update=str_replace(PHP_EOL,"",$update);
$update=trim($update,"\xEF\xBB\xBF");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理</title>
 <link rel="stylesheet" href="../css/css/font-awesome.min.css" type="text/css" />
 <link rel="stylesheet" href="../css/sweetalert.css" type="text/css" />
<script src="../js/sweetalert.min.js"></script>
<style>
*{font-size: 12px;line-height: 170%;}
a {
  color: #363f44;
  text-decoration: none;
  cursor: pointer;
}
.add{background:#0099ff; color:#FFFFFF; border:#0099ff solid 1px; padding:2px 5px;-moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius:5px; margin-top:5px;white-space:nowrap;}
.add:hover{background:#ffffff; color:#0099ff; }
</style>
</head>
<body>
当前版本号：<?php echo $version_info?><br>
<?php 
if ($_GET["action"]=="update"){
if(splitx($update,"|",0)!=$version_info){
$up_info="true";

echo "<div style='border:#CCCCCC solid 1px; padding:5px; margin:5px;'>最新版为：".splitx($update,"|",0)."<br>需要更新的文件列表是<div style='height:180px; overflow:auto;background-color:#EEEEEE;padding:5px;'>".str_replace("@","<br>",splitx($update,"|",3))."</div><div style='height:20px;'></div><div style='height:180px; overflow:auto;background-color:#EEEEEE;padding:5px;'>".str_replace("@","<br>",splitx($update,"|",1))."</div><br>说明：请保证以上目录有写入权限，更新过程请勿中断，如果遇到更新失败请联系客服寻求解决方案。</div>";
}else{
$up_info="false";
echo "<p>当前为最新版本，如有需要可强制更新。</p>";
}
}
if($_GET["action"]=="update2"){

$file_list=splitx($update,"|",3);
$file_list2=splitx($update,"|",2);

$file_list=explode("@",$file_list);
for($i = 0 ;$i< count($file_list);$i++){

$file_str=trim(file_get_contents("http://cdn.shanling.top/php/".trim(splitx($file_list2,"@",$i)).".txt"),"\xEF\xBB\xBF");

if($file_str!=trim(file_get_contents(trim($file_list[$i])),"\xEF\xBB\xBF")){

file_put_contents(trim($file_list[$i]),$file_str);
echo "更新".$file_list[$i]."完成！<br>";
}
}
@ready(trim(splitx($update,"|",4),"\xEF\xBB\xBF"));
echo "所有文件更新完毕<font color='#FF6600'><b>请重启浏览器后登录后台</b>！</font>";
}
?>

<?php if ($_GET["action"]=="update"){?>
<?php if ($up_info=="true") {?>
<a href="?action=update2" onClick="swal({title: '',text: '耐心等待，请不要关闭页面',imageUrl: 'img/loading.gif',html: true,showConfirmButton: false});" class='add'><i class='fa fa-refresh'></i> 开始更新</a>
<?php }?>
<?php if ($up_info=="false" ){?>
<a href="?action=update2" onClick="swal({title: '',text: '耐心等待，请不要关闭页面',imageUrl: 'img/loading.gif',html: true,showConfirmButton: false});" class='add'><i class='fa fa-refresh'></i> 强制更新</a>
<?php }?>
<?php }?>
<?php if ($_GET["action"]==""){?>
<a href="?action=update" onClick="swal({title: '',text: '耐心等待，请不要关闭页面',imageUrl: 'img/loading.gif',html: true,showConfirmButton: false});" class='add'><i class='fa fa-refresh'></i> 检测更新</a>
<?php }?>

</body>﻿
</html>