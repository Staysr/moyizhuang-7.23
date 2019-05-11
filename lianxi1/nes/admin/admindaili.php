<?php
require dirname(__FILE__) . "/dzsck.php";
include "../conf/pager.class.php";
$CurrentPage = (isset($_GET["page"]) ? $_GET["page"] : 1);
if($_GET['type']=='del' and $_GET['id']!=''){  
   $admin_aglevel=0;
   $date = array("admin_aglevel" => $admin_aglevel);
   $updates = $cm->cmupdate($date, "admin_id='" . $_GET['id'] . "'", "d_adminuser");
 if($updates)
   {echo backs("代理权限取消成功");
   exit();
   }
   else{echo backs("取消失败，请重新取消！");
   exit();
   } 
  }
 
 //重置密码 123456
if($_GET['type']=='upd' and $_GET['id']!=''){ 
$cm->query("SELECT * FROM d_adminuser where admin_id ='" . $_GET["id"] . "' order by admin_id desc");
    $row = $cm->fetch_array($rs);
	$rtnotice="登录密码已重置为:123456 请知晓！";
    $admin_pass=md5("123456");
    $reset=$cm->query("UPDATE d_adminuser SET admin_pass='" . $admin_pass . "' WHERE admin_id ='" . $_GET['id'] . "'");
	$date = array("adn_adminid" => $row["admin_id"], "adn_notice" => $rtnotice,"adn_time" => time());
   $installs = $cm->cmadd($date, "d_adnotice");
 if($reset && $installs)
   {echo backs("密码重置成功(123456)");
   exit();
   }
   else{echo backs("密码重置失败，请重重置！");
   exit();
   } 
  } 
 //今日用户统计
$y = date("Y");
$m = date("m");
$d = date("d");
$day_start = mktime(0,0,0,$m,$d,$y);
 $cm->query("SELECT * FROM d_adminuser where admin_time > '" .$day_start."' and admin_aglevel>0 order by admin_id desc");
 $todaymum=$cm->db_num_rows();
 
 //普通代理
$cm->query("SELECT * FROM d_adminuser where admin_aglevel=1 order by admin_id desc");
 $dlmum=$cm->db_num_rows();

 //高级代理
$cm->query("SELECT * FROM d_adminuser where admin_aglevel=2 order by admin_id desc");
 $gjdlmum=$cm->db_num_rows();
 
if($_GET['type']!='s'){	
$cm->query("SELECT * FROM d_adminuser where admin_aglevel >0 order by admin_id desc");
}else{
$cm->query("SELECT * FROM d_adminuser where admin_aglevel >0 and admin_name like '%".$_POST['key']."%' or admin_level like '%".$_POST['key']."%' order by admin_id desc");	
}
		$mypagesnum=$cm->db_num_rows();
		$p_pageSize = 20;
        $myPage = new pager($mypagesnum, intval($CurrentPage), $p_pageSize);
        $min_page = ($CurrentPage - 1) * $p_pageSize;
		
if($_GET['type']!='s'){
	$cm->query("SELECT * FROM d_adminuser where admin_aglevel >0 order by admin_id desc LIMIT " . $min_page . "," . $p_pageSize);
}
else {
	$cm->query("SELECT * FROM d_adminuser where admin_aglevel >0 and admin_name like '%".$_POST['key']."%' or admin_level like '%".$_POST['key']."%' order by admin_id desc LIMIT " . $min_page . "," . $p_pageSize);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品列表</title>
<link href="public/css/base.css" rel="stylesheet" type="text/css" />
<link href="public/css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript"> 
function updcfm() { 
if (!confirm("确认把密码重置为：123456 吗？")) { 
window.event.returnValue = false; 
} 
} 
</script> 

<script language="javascript"> 
function delcfm() { 
if (!confirm("确认要取消吗？")) { 
window.event.returnValue = false; 
} 
} 
</script> 
<script language="javascript"> 
function paycfm() { 
if (!confirm("确认要通知续费？")) { 
window.event.returnValue = false; 
} 
} 
</script> 
</head>
<body>
<div class="tab" id="tab">
<a class="selected" href="#">代理会员</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="kami.php">卡密列表</a>
&nbsp;&nbsp;&nbsp;今日新增&nbsp;<strong style="color:#F00"><?=$todaymum?></strong>&nbsp;个代理
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;统计：普通代理&nbsp;<strong style="color:#00F"><?=$dlmum?></strong>&nbsp;个&nbsp;&nbsp;高级代理&nbsp;<strong style="color:#00F"><?=$gjdlmum?></strong>&nbsp;个
<form name="forms1" method="post" action="?type=s" style="float:right">
	代理名称：<input type="text" name="key" value="" class="text_value" style="height:20px; width:120px" />
    <button type="submit" class="button" style="height:20px; line-height:20px">搜索</button> 
</form>
</div>
<div class="page_main">
  <div class="page_table table_list">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th width="10%"><center>代理名称</center></th>
        <th width="10%">注册时间</th>
         <th width="10%">用户QQ</th>
        <th width="8%"><center>代理级别</center></th>
        <th width="8%"><center>开通会员</center></th>
        <th width="10%"><center>销售推荐</center></th>
		<th width="17%"><center>操作</center></th>
      </tr>
      <?
while($row = $cm->fetch_array($rs)){
?>
      <tr>
        <td><center><?=$row['admin_name']?></center></td>
        <td><?=date('Y-m-d',$row['admin_time'])?></td>
        <td><?=$row['admin_qq']?></td>
		<td <? if($row['admin_aglevel']==0){?> style="color:#00F" <? }?><? if($row['admin_level']==1){?> style="color:#F00" <? }?>><center><?=$agent[$row['admin_aglevel']]?></center></td>
         <td><center><? if($row['admin_user']>0){?> <?=$row['admin_user']?>人<? }?></center></td>
        <td><center><? if($row['admin_slink']!=""){?> √ <? }?></center></td>
        <td><a href="?type=del&id=<?=$row['admin_id']?>"  onClick="delcfm()">取消代理</a>&nbsp;&nbsp;<a href="edituser.php?id=<?=$row['admin_id']?>">修改</a>&nbsp;&nbsp;<a href="?type=upd&id=<?=$row['admin_id']?>"  onClick="updcfm()">重置密码</a></td>
      </tr>
     <?
}
?>
    </table>
  </div>
</div>
<div class="page_tool">
  <div class="page"><?
     $pageStr= $myPage->GetPagerContent();
	 echo $pageStr;
    ?></div>
</div>

<div class="fn_clear"></div>
</body>

</html>