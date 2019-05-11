<?php
require dirname(__FILE__) . "/dzsck.php";
$cm->query("SELECT * FROM d_adminuser where admin_id='" . $_SESSION["adminid"] . "' order by admin_id asc");  
$adminuser = $cm->fetch_array($rs);
$cm->query("SELECT * FROM d_adminuser where admin_dlid='" . $_SESSION["adminid"] . "' order by admin_id asc");  
$mypagesnum = $cm->db_num_rows();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>开通会员列表</title>
<meta name="description" content="" />
<meta name="viewport" content="width=device-width , initial-scale=1.0 , user-scalable=0 , minimum-scale=1.0 , maximum-scale=1.0" />
<link rel="stylesheet" href="css/css.css"> 
<script type='text/javascript' src='js/jquery-2.0.3.min.js'></script>
<script type='text/javascript' src='js/patch/mobileBUGFix.mini.js'></script>
<script type="text/javascript" src="js/notice.js"></script>
<style>
.bot_main li.ico_3{
  background:#F1901F;
}
</style>
</head>
<body>
<div class="apply" id="apply">
	<p>会员列表<span style="float:right;font-size:12px;margin-right:10px"><?=$agent[$adminuser['admin_aglevel']]?></span></p>

<form action="?type=s" id="signupok" method="post" name="chxform"  enctype="multipart/form-data">
        <dl class="clearfix" style="margin-top:10px;">
         <dd class="notice">共开通&nbsp;<?=$mypagesnum?>&nbsp;位会员
		</dl>
	</form>
         <div class="cjcontlist">
             <!--活动列表start-->
             <ul class="cjlist">
     <?php if ($mypagesnum == 0) {?>
	   <li class="tit">亲，你还没有开通过会员哦，赶快加油吧!</li>
	      <?php }
        else {
        while($row = $cm->fetch_array($rs)){
             ?>
             <li style="border-bottom:1px dashed #ccc;">
                  <ul>
                   <li class="cont2" style="text-align:center">
                   <span class="ydl2"><b><?php echo $row["admin_name"]?></b>&nbsp;&nbsp;(<?php echo $grade[$row['admin_level']]?>)</span>
  <span class="ydl2">&nbsp;&nbsp;&nbsp;&nbsp;开通时间：&nbsp;<?php echo date("Y-m-d", $row["admin_opentime"])?></span>
                   </li>
                  </ul>
             </li>
<?php 
}}
?>             
             </ul>
          <!--活动列表end-->
          </div> 
		<div class="blank10"></div>
</div>
<?php include('foot.php');?>
</body>
</html>