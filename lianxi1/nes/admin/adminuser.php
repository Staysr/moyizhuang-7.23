<?php
require dirname(__FILE__) . "/dzsck.php";
include "../conf/pager.class.php";
$CurrentPage = (isset($_GET["page"]) ? $_GET["page"] : 1);
if($_GET['type']=='del' and $_GET['id']!=''){  
 $cm->query("SELECT * FROM d_adminuser left join d_zs on d_adminuser.admin_id=d_zs.uid left join d_user on d_user.u_zscmd5=d_zs.zs_cmd5 left join d_ip on d_ip.ip_uid=d_user.u_id where admin_id ='" . $_GET["id"] . "' order by admin_id desc");
   $row = $cm->fetch_array($rs);
    $payimage = "../user/".$row["admin_pay"];   //收款二维码图片
    $codeimg = "../user/".$row["admin_code"];   //推广二维码
   $cm->delete('d_ip',"ip_id in(".$row["ip_id"].")");
   $cm->delete('d_user',"u_id in(".$row["u_id"].")");
   $cm->delete('d_zs',"uid in(".$_GET['id'].")");
   $cm->delete('d_adnotice',"adn_adminid in(".$_GET['id'].")");
   $cm->delete('d_kami',"km_uid in(".$_GET['id'].")");
   if(file_exists($codeimg)){unlink($codeimg);}    //删除会员推广二维码图片文件	
   if(file_exists($payimage)){unlink($payimage);} //删除会员收款二维码图片文件	
   $cm->delete('d_adminuser',"admin_id in(".$_GET['id'].")");
     echo backs("会员删除成功！");
     exit();
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
 //续费通知
if($_GET['type']=='pay' and $_GET['id']!=''){ 
$cm->query("SELECT * FROM d_adminuser where admin_id ='" . $_GET["id"] . "' order by admin_id desc");
    $row = $cm->fetch_array($rs);
	$pynotice="亲，你的会员已到期，赶紧去续费啦！";
	$date = array("adn_adminid" => $row["admin_id"], "adn_notice" => $pynotice,"adn_time" => time());
   $installs = $cm->cmadd($date, "d_adnotice");
 if($installs)
   {echo backs("续费通知已发出！");
   exit();
   }
   else{echo backs("续费通知发布失败，请重新发布！");
   exit();
   }  
  } 
 //今日用户统计
$y = date("Y");
$m = date("m");
$d = date("d");
$day_start = mktime(0,0,0,$m,$d,$y);
 $cm->query("SELECT * FROM d_adminuser where admin_time > '" .$day_start."' order by admin_id desc");
 $todaymum=$cm->db_num_rows();
  
 //试用会员
$cm->query("SELECT * FROM d_adminuser where admin_level =0 order by admin_id desc");
$admintcmum=$cm->db_num_rows();
 //月度会员
$cm->query("SELECT * FROM d_adminuser where admin_level =1 order by admin_id desc");
$adminsymum=$cm->db_num_rows();
 //年度会员
$cm->query("SELECT * FROM d_adminuser where admin_level =3 order by admin_id desc");
$adminndmum=$cm->db_num_rows();
 //会员过期15天
$fifteen=time()-1296000;
 
if($_GET['type']=='s'){	
$cm->query("SELECT * FROM d_adminuser where admin_name like '%".$_POST['key']."%' or admin_qq like '%".$_POST['key']."%' order by admin_id desc");	
}
else if($_GET['type']=='admin'){
$cm->query("SELECT * FROM d_adminuser where admin_level ='".$_GET['level']."' order by admin_id desc");	
	}
else if($_GET['type']=='over'){
$cm->query("SELECT * FROM d_adminuser where admin_endtime <'".$fifteen."' order by admin_id desc");	
	}	
else{
$cm->query("SELECT * FROM d_adminuser order by admin_id desc");
}
		$mypagesnum=$cm->db_num_rows();
		$p_pageSize = 20;
        $myPage = new pager($mypagesnum, intval($CurrentPage), $p_pageSize);
        $min_page = ($CurrentPage - 1) * $p_pageSize;
		
if($_GET['type']=='s'){
$cm->query("SELECT * FROM d_adminuser where admin_name like '%".$_POST['key']."%' or admin_qq like '%".$_POST['key']."%' order by admin_id desc LIMIT " . $min_page . "," . $p_pageSize);
}
else if($_GET['type']=='admin'){
$cm->query("SELECT * FROM d_adminuser where admin_level ='".$_GET['level']."' order by admin_id desc LIMIT " . $min_page . "," . $p_pageSize);
	}	
else if($_GET['type']=='over'){
$cm->query("SELECT * FROM d_adminuser where admin_endtime <'".$fifteen."' order by admin_id desc LIMIT " . $min_page . "," . $p_pageSize);	
	}		
else {
$cm->query("SELECT * FROM d_adminuser order by admin_id desc LIMIT " . $min_page . "," . $p_pageSize);
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
function delcfm() { 
if (!confirm("确认要删除？")) { 
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
<a class="selected" href="adminuser.php">用户列表(<b>&nbsp;<?=$mypagesnum?>&nbsp;</b>)</a>
<span style="float:left">&nbsp;&nbsp;&nbsp;今日新增&nbsp;<strong style="color:#F00"><?=$todaymum?></strong>&nbsp;个用户</span>
<a href="?type=admin&level=0" style="padding-left:5px; padding-right:5px; margin-left:20px;">试用会员(<span style="color:#F00"><?=$admintcmum?></span>)</a>
<a href="?type=admin&level=1" style="padding-left:5px; padding-right:5px;">月度会员(<span style="color:#F00"><?=$adminsymum?></span>)</a>
<a href="?type=admin&level=3" style="padding-left:5px; padding-right:5px;">年度会员(<span style="color:#F00"><?=$adminndmum?></span>)</a>
<a href="?type=over" style="margin-left:20px;">到期15天筛选↓</a>
<form name="forms1" method="post" action="?type=s" style="float:right">
	用户名或QQ：<input type="text" name="key" value="" class="text_value" style="height:20px; width:120px" />
    <button type="submit" class="button" style="height:20px; line-height:20px">搜索</button> 
</form>
</div>
<div class="page_main">
  <div class="page_table table_list">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th width="11%"><center>用户名</center></th>
        <th width="6%">注册时间</th>
         <th width="10%">用户QQ</th>
		 <th width="10%">手机</th>
        <th width="6%"><center>会员等级</center></th>
        <th width="6%"><center>到期时间</center></th>
		<th width="15%"><center>操作</center></th>
      </tr>
      <?php
while($row = $cm->fetch_array($rs)){
?>
      <tr>
        <td style=" <? if($row['admin_time']>$day_start){?> color:#F00;<? }?>"><center><?=$row['admin_name']?></center></td>
<td style=" <? if($row['admin_time']>$day_start){?> color:#F00;<? }?>"><?=date('Y-m-d',$row['admin_time'])?></td>
        <td><?=$row['admin_qq']?></td>  <td><?=$row['admin_iphone']?></td>
		<td><center><?php echo $grade[$row['admin_level']]?><?php if($row['admin_aglevel']>0){ ?><span style="color:#F00">(<?php echo$uragent[$row['admin_aglevel']]?>)</span><?php } ?></center></td>
        <td style=" <? if($row['admin_endtime']<time()){?> color:#F00;<? }?>"><center><?=date('Y-m-d',$row['admin_endtime'])?></center></td>
        <td><center><a onClick="delcfm()" href="?type=del&id=<?=$row['admin_id']?>">删除</a>&nbsp;&nbsp;<a href="edituser.php?id=<?=$row['admin_id']?>">修改</a>&nbsp;&nbsp;<a onClick="updcfm()" href="?type=upd&id=<?=$row['admin_id']?>">重置密码</a>&nbsp;&nbsp;</center></td>
      </tr>
     <?php
}
?>
    </table>
  </div>
</div>
<div class="page_tool">
  <div class="page"><?php
     $pageStr= $myPage->GetPagerContent();
	 echo $pageStr;
    ?></div>
</div>

<div class="fn_clear"></div>
</body>

</html>