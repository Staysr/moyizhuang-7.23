<?php
require dirname(__FILE__) . "/dzsck.php";
if($_GET['type']=='Sell' and $_GET['id']!=''){  
   $cm->query("UPDATE d_kami SET km_sell=1 WHERE km_id ='".$_GET['id']."'");
   echo tiao("已复制好，可贴粘。", "index.php");
    exit();
  }
if($_GET['type']=='close' and $_GET['id']!=''){  
   $cm->query("UPDATE d_kami SET km_sell=0 WHERE km_id ='".$_GET['id']."'");
   echo backs("卡密取消复制成功！");
   exit();
  } 
$cm->query("SELECT * FROM d_adminuser where admin_id='" . $_SESSION["adminid"] . "' order by admin_id asc");  
$adminuser = $cm->fetch_array($rs);
$cm->query("SELECT * FROM d_kami where km_uid='" . $_SESSION["adminid"] . "' order by km_type asc");
$mypagesnum = $cm->db_num_rows();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>卡密管理</title>
<meta name="description" content="" />
<meta name="viewport" content="width=device-width , initial-scale=1.0 , user-scalable=0 , minimum-scale=1.0 , maximum-scale=1.0" />
<link rel="stylesheet" href="css/css.css"> 
<style type="text/css">
.bot_main li.ico_2{
  background:#F1901F;
}
</style>
<script type='text/javascript' src='js/jquery-2.0.3.min.js'></script>
<script type='text/javascript' src='js/patch/mobileBUGFix.mini.js'></script>
<script type="text/javascript" src="js/notice.js"></script>
</head>
<body>
<div class="apply" id="apply">
	<p>卡密管理<span style="float:right;font-size:12px;margin-right:10px"><?=$agent[$adminuser['admin_aglevel']]?></span>
    </p>

<form action="?act=sosuo" id="signupok" method="post" name="chxform"  enctype="multipart/form-data">
        <dl class="clearfix">
				 <div class="blank10"></div>
	   <dd class="notice">说明：价格统一出售，违规取消代理资格，不再通知！</dd>
		</dl>
         <div class="cjcontlist">
             <!--活动列表start-->
             <ul class="cjlist">
   <?php if ($mypagesnum == 0) {?>
	   <li class="tit" style="text-align:center"><span style="color:#009;">亲，你还没有出售的卡密哦，赶快进点货吧！</span><br><br><a onclick="window.location.href='kefu.php'" style="color:#F00; font-size:16px; font-weight:bold; cursor:pointer">点击进货》</a></li>
	      <?php }
        else {
        while($row = $cm->fetch_array($rs)){
             ?>
             <li>
                  <ul>
                  <li class="tit"><input class="iptkami"  id="content<?php echo $row['km_id']?>" type="text" value="<?php echo $row['km_number']?>" style="<?php if($row['km_sell']==1){?>color:#CCC<?php } ?>"/></li>
                   <li class="cont">
                   <span style="float:left; width:100%; text-align:center">
                   <?php echo $kmtype[$row['km_type']]?>
            <?php if($row['km_sell']==0){?>
		<a href="?type=Sell&id=<?php echo $row['km_id']?>" onClick="jsCopy<?php echo $row['km_id']?>()">复制出售</a>
			<?php }else{?>
          <a style="background-color:#999">已复制</a>
            <?php } ?>
                   </span>
                   </li>
                  </ul>
             </li>
             
 <script type="text/javascript"> 
    function jsCopy<?=$row['km_id']?>(){ 
        var e=document.getElementById("content<?=$row['km_id']?>");
        e.select();  
	   if (!confirm("确定复制出售吗？")) {window.event.returnValue = false; } 
        document.execCommand("Copy"); 
       //alert("已复制好，可贴粘。
    } 
</script>             
<?php 
}}
?>   
     </ul>
          <!--活动列表end-->
          </div> 
	</form>
</div>
<?php include('foot.php');?>
</body>
</html>