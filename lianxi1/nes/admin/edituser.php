<?php
require dirname(__FILE__) . "/dzsck.php";
if (($_GET["type"] == "edit") && $_POST) {
	$date = array("admin_aglevel" => $_POST["admin_aglevel"]);
	$updates = $cm->cmupdate($date, "admin_id='" . $_POST["id"] . "'", "d_adminuser");
 if($updates)
   {echo tiao("修改成功！", "edituser.php?id=" . $_POST["id"]);
   exit();
   }
   else{echo tiao("修改失败,请重新修改！", "edituser.php?id=" . $_POST["id"]);
   exit();
   } 
	}
$cm->query("SELECT * FROM d_adminuser where admin_id ='".$_GET["id"]."' order by admin_id desc");
$row = $cm->fetch_array($rs);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改商品</title>
<link href="public/css/base.css" rel="stylesheet" type="text/css" />
<link href="public/css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
        #myEditor{
            width: 600px;
            height: 180px;
        }
		#myEditor1{
            width: 600px;
            height: 180px;
        }
</style>
</head>
<body>
<div class="tab" id="tab"> <a class="selected" href="#">修改用户</a></div>
<div class="page_form">
<form name="form2" method="post" action="?type=edit">
<div class="page_table form_table">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        <td width="132" align="right">用户名</td>
        <td width="500"><?=$row['admin_name']?></td>
     </tr>
    <tr>
        <td width="132" align="right">代理级别</td>
        <td width="385">
        	   <select name="admin_aglevel" style="width:150px;">
                <option <?php if($row['admin_aglevel']==1 || $row['admin_aglevel']==0) {?> value="1">普通代理</option> <?php } if($row['admin_aglevel']==2) {?> value="2" >高级代理</option> <?php } ?> 
               <option <?php if($row['admin_aglevel']==2) {?> value="1">普通代理</option> <?php } if($row['admin_aglevel']==1 || $row['admin_aglevel']==0) {?> value="2" >高级代理</option> <?php } ?> 
               </select>
               &nbsp;&nbsp; 
        </td>
        
     </tr>
    </table>
</div>
<!--普通提交-->
<div class="form_submit">
<input name="id" type="hidden" value="<?=$row['admin_id']?>" />
<button type="submit" class="button">修改</button> 
</div>
</form>
</div>
</div>
<div class="fn_clear"></div>
</body>
</html>