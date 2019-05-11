<?php
require dirname(__FILE__) . "/dzsck.php";
include "../conf/pager.class.php";
$CurrentPage = (isset($_GET["page"]) ? $_GET["page"] : 1);
$cm->query("SELECT * FROM d_config where config_id='1'");
$config = $cm->fetch_array($rs); 
if($_GET['type']=='del' and $_GET['id']!=''){  
  $cm->query("SELECT * FROM d_adminuser left join d_zs on d_adminuser.admin_id=d_zs.uid left join d_user on d_user.u_zscmd5=d_zs.zs_cmd5 left join d_ip on d_ip.ip_uid=d_user.u_id where zs_id ='" . $_GET["id"] . "' order by zs_id desc");
   $row = $cm->fetch_array($rs);
   $fileimage = "../user/".$row["zs_weicont"];//推广二维码图片
   $dlnotice="你发布的（".$row["zs_title"]."）活动存在违规，被系统删除！";
   $cm->query("UPDATE d_adminuser SET admin_fabu=admin_fabu-1 WHERE admin_id ='" .$row["uid"]. "'");
   $cm->query("UPDATE d_adminuser SET admin_total=admin_total-'" .$row["zs_cy"]. "' WHERE admin_id ='" .$row["uid"]. "'");
   $cm->delete('d_ip',"ip_id in(".$row["ip_id"].")");
   $cm->delete('d_user',"u_id in(".$row["u_id"].")");
    if(file_exists($fileimage)){unlink($fileimage);}  //删除推广二维码图片文件 
   $cm->delete('d_zs',"zs_id in(".$_GET['id'].")");
   $date = array("adn_adminid" => $row["admin_id"], "adn_notice" => $dlnotice,"adn_time" => time());
   $installs = $cm->cmadd($date, "d_adnotice");
   echo backs("活动删除成功！");
   exit();
  }
if($_GET['type']=='close' and $_GET['id']!=''){  
$cm->query("SELECT * FROM d_adminuser left join d_zs on d_adminuser.admin_id=d_zs.uid left join d_user on d_user.u_zscmd5=d_zs.zs_cmd5 left join d_ip on d_ip.ip_uid=d_user.u_id where zs_id ='" . $_GET["id"] . "' order by zs_id desc");
   $row = $cm->fetch_array($rs);
   $csnotice="你发布的（".$row["zs_title"]."）活动存在违规，被系统冻结！";
   $closezs = $cm->query("UPDATE d_zs SET zs_zt=2 WHERE zs_id ='" .$_GET["id"]. "'");  
   $date = array("adn_adminid" => $row["admin_id"], "adn_notice" => $csnotice,"adn_time" => time());
   $installs = $cm->cmadd($date, "d_adnotice");
   if($closezs && $installs)
   {echo backs("活动冻结成功！");
   exit();
   }
   else{echo backs("活动冻结失败，请重新冻结！");
   exit();}
  }
if($_GET['type']=='open' and $_GET['id']!=''){  
$cm->query("SELECT * FROM d_adminuser left join d_zs on d_adminuser.admin_id=d_zs.uid left join d_user on d_user.u_zscmd5=d_zs.zs_cmd5 left join d_ip on d_ip.ip_uid=d_user.u_id where zs_id ='" . $_GET["id"] . "' order by zs_id desc");
   $row = $cm->fetch_array($rs);
   $opnotice="你发布的（".$row["zs_title"]."）已重新开启";
   $opzs = $cm->query("UPDATE d_zs SET zs_zt=0 WHERE zs_id ='" .$_GET["id"]. "'");  
   $date = array("adn_adminid" => $row["admin_id"], "adn_notice" => $opnotice,"adn_time" => time());
   $installs = $cm->cmadd($date, "d_adnotice");
   if($opzs && $installs)
   {echo backs("活动开启成功！");
   exit();
   }
   else{echo backs("活动开启失败，请重新冻结！");
   exit();}
  }
 //今日活动统计
$y = date("Y");
$m = date("m");
$d = date("d");
$day_start = mktime(0,0,0,$m,$d,$y);
 $cm->query("SELECT * FROM d_zs where zs_time > '" .$day_start."' order by zs_id desc");
 $todaymum=$cm->db_num_rows();
 
 if ($_GET["id"] != "") {
	$cm->query("SELECT * FROM d_zs left join d_adminuser on d_zs.uid=d_adminuser.admin_id where admin_id ='" . $_GET["id"] . "' order by zs_id desc");	
}
else {
if($_GET['type']!='s'){
$cm->query("SELECT * FROM d_zs left join d_adminuser on d_zs.uid=d_adminuser.admin_id order by zs_id desc");
}else{
$cm->query("SELECT * FROM d_zs left join d_adminuser on d_zs.uid=d_adminuser.admin_id where zs_title like '%".$_POST['key']."%' order by zs_id desc");	
}
}
		$mypagesnum=$cm->db_num_rows();
		$p_pageSize = 20;
        $myPage = new pager($mypagesnum, intval($CurrentPage), $p_pageSize);
        $min_page = ($CurrentPage - 1) * $p_pageSize;
		


if ($_GET["id"] != "") {
	$cm->query("SELECT * FROM d_zs left join d_adminuser on d_zs.uid=d_adminuser.admin_id where admin_id ='" . $_GET["id"] . "' order by zs_id desc LIMIT " . $min_page . "," . $p_pageSize);
}
else {
	if($_GET['type']!='s'){
	$cm->query("SELECT * FROM d_zs left join d_adminuser on d_zs.uid=d_adminuser.admin_id order by zs_id desc LIMIT " . $min_page . "," . $p_pageSize);
}
else {
	$cm->query("SELECT * FROM d_zs left join d_adminuser on d_zs.uid=d_adminuser.admin_id where zs_title like '%".$_POST['key']."%' order by zs_id desc LIMIT " . $min_page . "," . $p_pageSize);
}
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
function delcfm() { 
if (!confirm("确定要删除吗？")) { 
window.event.returnValue = false; 
} 
} 
</script> 
<script language="javascript"> 
function closecfm() { 
if (!confirm("确定要冻结吗？")) { 
window.event.returnValue = false; 
} 
} 
</script> 
<script language="javascript"> 
function opencfm() { 
if (!confirm("确定要重新开启吗？")) { 
window.event.returnValue = false; 
} 
} 
</script> 
</head>
<body>
<div class="tab" id="tab"> <a class="selected" href="#">活动(<?=$mypagesnum?>个)</a>&nbsp;&nbsp;&nbsp;今日新增&nbsp;<strong style="color:#F00"><?=$todaymum?></strong>&nbsp;个活动
<form name="forms1" method="post" action="?type=s" style="float:right">
 关键词：<input type="text" name="key" value="" class="text_value" style="height:20px; width:120px" />
    <button type="submit" class="button" style="height:20px; line-height:20px">搜索</button> 
</form>
</div>
<div class="page_main">
  <div class="page_table table_list">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th width="18%"><center>活动标题</center></th>
        <th width="6%">用户名</th>
        <th width="8%">添加时间</th>
        <th width="4%">参与人数</th>
        <th width="10%">赠品内容</th>
        <th width="6%">状态</th>
        <th width="8%"><center>操作</center></th>
      </tr>
      <?
while($row = $cm->fetch_array($rs)){
?>
      <tr  style=" <? if($row['zs_zt']==2){?> background-color:#f5f6f8; color:#CCC <? }?>">
        <td><a href="<?=$config['config_url']?><?=$row['zs_url']?>" target="_blank"><?=$row['zs_title']?></a></td>
        <td><?=$row['admin_name']?></td>
    <td style=" <? if($row['zs_time']>$day_start){?> color:#F00;<? }?>"><?=date('Y-m-d',$row['zs_time'])?></td>
        <td><a href="user.php?id=<?=$row['zs_cmd5']?>"><?=$row['zs_cy']?>人</a></td>
	    <td><?=$row['zs_fhcont']?></td>
        <td><?=$zszt[$row["zs_zt"]]?></td>
        <td><center><a href="?type=del&id=<?=$row['zs_id']?>"  onClick="delcfm()">删除</a>&nbsp;&nbsp;
        <? if($row['zs_zt']==2){ ?>
        <a href="?type=open&id=<?=$row['zs_id']?>"  onClick="opencfm()" style="color:#F00;" title="违规3次直接删除会员处理">开启</a>			
			 <? }
		else
		{?>	
<a href="?type=close&id=<?=$row['zs_id']?>"  onClick="closecfm()">冻结</a>        		
			<? }?></center>
        </td>
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