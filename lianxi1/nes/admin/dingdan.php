<?php
require dirname(__FILE__) . "/dzsck.php";
date_default_timezone_set('PRC'); // 中国时区
include "../conf/pager.class.php";
$CurrentPage = (isset($_GET["page"]) ? $_GET["page"] : 1);
$nowtime=time();
if($_GET['type']=='agree' and $_GET['id']!=''){ 
        $cm->query("SELECT * FROM d_ddcenter where dd_id='" . $_GET['id'] . "' order by dd_id desc");
        $km_number = $cm->fetch_array($rs);
		
		
		$cm->query("SELECT * FROM d_adminuser where admin_id='" . $km_number["dd_adminid"] . "'    ");
        $km_number3 = $cm->fetch_array($rs);
		
		
		if($km_number["dd_vip"]==1){
           if( $km_number3['admin_endtime']<time())$ddvip = $cm->query("UPDATE d_adminuser SET admin_endtime=".time()."+2678400,admin_level=1,admin_opentime='".$nowtime."' WHERE admin_id='" . $km_number["dd_adminid"] . "'");
           else $ddvip = $cm->query("UPDATE d_adminuser SET admin_endtime=admin_endtime+2678400,admin_level=1,admin_opentime='".$nowtime."' WHERE admin_id='" . $km_number["dd_adminid"] . "'");
	        }
/*******季度会员*****/
       else if($km_number["dd_vip"]==2){
	 	   if( $km_number3['admin_endtime']<time())$ddvip = $cm->query("UPDATE d_adminuser SET admin_endtime=".time()."+8035200,admin_level=2,admin_opentime='".$nowtime."' WHERE admin_id='" . $km_number["dd_adminid"] . "'");
	 	   else $ddvip = $cm->query("UPDATE d_adminuser SET admin_endtime=admin_endtime+8035200,admin_level=2,admin_opentime='".$nowtime."' WHERE admin_id='" . $km_number["dd_adminid"] . "'");
	       }
/*******年度会员*****/
       else if($km_number["dd_vip"]==3){
	 	 if( $km_number3['admin_endtime']<time())$ddvip = $cm->query("UPDATE d_adminuser SET admin_endtime=".time()."+31536000,admin_level=3,admin_opentime='".$nowtime."' WHERE admin_id='" . $km_number["dd_adminid"] . "'");
	 	 else $ddvip = $cm->query("UPDATE d_adminuser SET admin_endtime=admin_endtime+31536000,admin_level=3,admin_opentime='".$nowtime."' WHERE admin_id='" . $km_number["dd_adminid"] . "'");
	       }
        $agree=$cm->query("UPDATE d_ddcenter SET dd_type=1 WHERE dd_id ='" .$_GET['id']. "'");
	     if($ddvip && $agree)
           {
		    echo tiao("审核成功！", "adminuser.php");
            exit();
           }
        else{
			echo tiao("审核失败，请重新审核！", "dingdan.php");
            exit();
		   }
   }
if($_GET['type']=='refuse' and $_GET['id']!=''){  
          $agree=$cm->query("UPDATE d_ddcenter SET dd_type=2 WHERE dd_id ='" .$_GET['id']. "'");
	      if($agree)
           {
		    echo tiao("已拒绝！", "dingdan.php");
            exit();
           }
        else{
			echo tiao("拒绝失败，请重新拒绝!", "dingdan.php");
            exit();
		   }
  }
 if($_GET['type']=='delete' and $_GET['id']!=''){  
   $delete=$cm->delete('d_ddcenter',"dd_id in(".$_GET['id'].")");
		echo tiao("订单删除成功！", "dingdan.php");
		exit();
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
function agree() { 
if (!confirm("确定要通过吗？")) { 
window.event.returnValue = false; 
} } 
function refuse() { 
if (!confirm("确定要拒绝吗？")) { 
window.event.returnValue = false; 
} } 
function del() { 
if (!confirm("确定要删除订单吗？")) { 
window.event.returnValue = false; 
} } 
</script> 
</head>
<body>
<?php
if($_GET['type']!='s'){	
 if($_GET['dd_type']!=""){	
    $cm->query("SELECT * FROM d_ddcenter left join d_adminuser on d_ddcenter.dd_adminid=d_adminuser.admin_id where dd_type ='" .$_GET['dd_type']. "' order by dd_time desc");
     }
 else{
	 $cm->query("SELECT * FROM d_ddcenter left join d_adminuser on d_ddcenter.dd_adminid=d_adminuser.admin_id order by dd_time desc");
    }
}else{
$cm->query("SELECT * FROM d_ddcenter left join d_adminuser on d_ddcenter.dd_adminid=d_adminuser.admin_id where admin_name like '%".$_POST['key']."%' or admin_level like '%".$_POST['key']."%' order by dd_time desc");	
}
$mypagesnum=$cm->db_num_rows();
$p_pageSize = 20;
$myPage = new pager($mypagesnum, intval($CurrentPage), $p_pageSize);
$min_page = ($CurrentPage - 1) * $p_pageSize;

if($_GET['type']!='s'){	
 if($_GET['dd_type']!=""){	
    $cm->query("SELECT * FROM d_ddcenter left join d_adminuser on d_ddcenter.dd_adminid=d_adminuser.admin_id where dd_type ='" .$_GET['dd_type']. "' order by dd_time desc LIMIT " . $min_page . "," . $p_pageSize);
     }
 else{
    $cm->query("SELECT * FROM d_ddcenter left join d_adminuser on d_ddcenter.dd_adminid=d_adminuser.admin_id order by dd_time desc LIMIT " . $min_page . "," . $p_pageSize); }	
  }
else{
$cm->query("SELECT * FROM d_ddcenter left join d_adminuser on d_ddcenter.dd_adminid=d_adminuser.admin_id where admin_name like '%".$_POST['key']."%' or admin_level like '%".$_POST['key']."%' order by dd_time desc LIMIT " . $min_page . "," . $p_pageSize);	
}
		
?>
<div class="tab" id="tab"> 
<a class="selected" href="dingdan.php">所有</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="dingdan.php?type=to&dd_type=0" >待审</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="dingdan.php?type=to&dd_type=1">通过</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="dingdan.php?type=to&dd_type=2">拒绝</a>
<form name="forms1" method="post" action="?type=s" style="float:right">
	会员名称：<input type="text" name="key" value="" class="text_value" style="height:20px; width:120px" />
    <button type="submit" class="button" style="height:20px; line-height:20px">搜索</button> 
</form>
</div>

<div class="page_main">
  <div class="page_table table_list">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th width="8%"><center>用户名</center></th>
        <th width="8%"><center>购买VIP</center></th>
        <th width="8%"><center>支付方式</center></th>
        <th width="8%"><center>支付帐号</center></th>
        <th width="8%"><center>订单号</center></th>
        <th width="10%"><center>支付时间</center></th>
        <th width="10%"><center>状态</center></th>
      </tr>
      <?php
while($row = $cm->fetch_array($rs)){
?>
      <tr> 
        <td><center><?=$row['admin_name']?></center></td>
        <td><center><?=$grade[$row['dd_vip']]?>(<?=$row['dd_rmb']?>)</center></td>
        <td><center><?=$paytype[$row['dd_paytype']]?></center></td>
        <td><center><?=$row['dd_paynum']?></center></td>
		<td><center><?=$row['dd_order']?></center></td>
        <td><center><?=date('Y-m-d',$row['dd_time'])?></center></td>
        <td><center><?=$ddtype[$row['dd_type']]?>&nbsp;&nbsp;<a onClick="agree()" href="?type=agree&id=<?=$row['dd_id']?>">审核</a>&nbsp;&nbsp;<a onClick="refuse()" href="?type=refuse&id=<?=$row['dd_id']?>">拒绝</a>&nbsp;&nbsp;<a onClick="del()" href="?type=delete&id=<?=$row['dd_id']?>">删除</a></center></td>
      </tr>
     <?php
}
?>
    </table>
  </div>
</div>
<div class="page_tool">
  <div class="page">
  <?php $pageStr= $myPage->GetPagerContent();
	 echo $pageStr;
    ?></div>
</div>

<div class="fn_clear"></div>
</body>

</html>