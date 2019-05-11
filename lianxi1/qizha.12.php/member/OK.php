<?php 
require '../conn/conn2.php';
require '../conn/function.php';
require 'auto.php';
require 'member_check.php';
require 'left.php';

$O_id=intval(trim($_REQUEST["O_id"]));
$action=trim($_REQUEST["action"]);
if($action=="ok"){
$sql="select * from SL_orders,SL_product where O_pid=P_id and O_id=".$O_id;

		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		if (mysqli_num_rows($result) > 0) {
		$P_title=$row["P_title"];
		$O_num=$row["O_num"];
		$O_shuxing=$row["O_shuxing"];
		$O_price=$row["O_price"];
		}
sendmail("您的网站有订单已确认","<h2>您的网站“".$C_webtitle."”有订单已确认</h2><hr>商品名称：".$P_title."<br>数量：".$O_num."<br>属性：".$O_shuxing."<br>价格：".round($O_num*$O_price,2)."元<hr>请进入“网站后台” - “商城管理” - “订单管理”查看详情！",$C_email);
mysqli_query($conn,"update SL_orders set O_state=3 where O_id=".$O_id);
box("感谢您的购物，祝下次购物愉快！","member_order.php","success");
}
if($action=="tui"){
mysqli_query($conn,"update SL_orders set O_state=4 where O_id=".$O_id);
$sql="select * from SL_orders,SL_product where O_pid=P_id and O_id=".$O_id;

		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		if (mysqli_num_rows($result) > 0) {
		$P_title=$row["P_title"];
		$O_num=$row["O_num"];
		$O_shuxing=$row["O_shuxing"];
		$O_price=$row["O_price"];
		}
sendmail("您的网站有退款待处理","<h2>您的网站“".$C_webtitle."”有退款待处理</h2><hr>商品名称：".$P_title."<br>数量：".$O_num."<br>属性：".$O_shuxing."<br>价格：".round($O_num*$O_price,2)."元<hr>请进入“网站后台” - “商城管理” - “订单管理”查看详情！",$C_email);
box("申请成功!等待卖家处理！","member_order.php","success");
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="<?php echo lang("会员中心/l/Member Center")?>">
  <title><?php echo lang("会员中心/l/Member Center")?></title>
<link href="../<?php echo $C_ico?>" rel="shortcut icon" />

  <!-- Stylesheets -->
    <link rel="stylesheet" href="../css/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/site.min.css">
  <!-- css plugins -->
  <link rel="stylesheet" href="css/icheck.min.css">
  <link rel="stylesheet" href="css/cropper.min.css">

 
  <!--[if lt IE 9]>
    <script src="/assets/js/plugins/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <link rel="stylesheet" href="/assets/css/ie8.min.css">
    <script src="/assets/js/plugins/respond/respond.min.js"></script>
    <![endif]-->
	<script>
		var _ctxPath='';
	</script>    
</head>

<body class="body-index">

		<?php require 'top.php';?>
		
	
		<div class="container m_top_10">
					<ol class="breadcrumb">
				<li><i class="icon fa-home" aria-hidden="true"></i><a href="../">首页</a></li>
				<li>我的订单</li>

			</ol>
					<div class="yto-box">
						
						<div class="panel panel-default">
							<div class="panel-heading">我的订单</div>
							<div class="table-responsive">
								<table class="table table-bordered">
								 <thead>
									<tr>
										<th><?php echo lang("商品名称/l/Product title")?></th>
										<th><?php echo lang("图片/l/PIc")?></th>
										<th><?php echo lang("单价/l/price")?></th>
										<th><?php echo lang("数量/l/number")?></th>
										<th><?php echo lang("总价/l/Total")?></th>
										<th><?php echo lang("折扣价/l/Discount price")?></th>
										<th><?php echo lang("状态/l/state")?></th>
										<th><?php echo lang("操作/l/operation")?></th>
									</tr>
									</thead>
									<tbody>
									<?php 
$sql="select * from SL_orders,SL_product,SL_lv,SL_member where M_lv=L_id and O_member=M_id and O_pid=P_id and O_id=".$O_id;

		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
		if ($row["O_state"]==0){
		$O_state=lang("未付款/l/No payment");
		$O_pay="<a href='member_pay.php?O_id=".$row["O_id"]."' class='del'>支付</a>";
		}
		if ($row["O_state"]==1){
		$O_state=lang("已付款/l/Already paid");
		$O_pay=lang("请等待发货/l/Please wait for delivery");
		}
		if ($row["O_state"]==2){
		$O_state=lang("已发货(<a href='member_wuliu.php?O_id=".$row["O_id"]."'>查物流</a>)/l/Already shipped(<a href='member_wuliu.php?O_id=".$row["O_id"]."'>Check Logistics</a>)");
		$O_pay="<a href='OK.php?O_id=".$row["O_id"]."'>".lang("确认/退款/l/Confirmation / refund")."</a>";
		}
		if ($row["O_state"]==3){
		$O_state=lang("已确认/l/confirmed");
		$O_pay=lang("已确认/l/confirmed");
		}
		if ($row["O_state"]==4){
		$O_state=lang("已申请退款/l/Has applied for a refund");
		$O_pay=lang("等待卖家处理/l/Waiting for the seller to deal with");
		}
		if ($row["O_state"]==5){
		$O_state=lang("已退款/l/Refunded");
		$O_pay=lang("交易结束/l/end of transaction");
		}
		
		echo "<tr><td>".substr(lang($row["P_title"]),0,24)."...</td><td><a href='".$C_dir."index.php?type=productinfo.S_id=".$row["P_id"]."' target='_blank'><img src='".$C_dir.splitx($row["P_path"],"|",0)."' height='30'></a></td><td>".round($row["O_price"],2).lang("元/l/yuan")."</td><td>".$row["O_num"]."</td><td><font color='red'><b>".round($row["O_num"]*$row["O_price"],2).lang("元/l/yuan")."</b></font></td><td><font color='red'><b>".round($row["O_num"]*$row["O_price"]*$row["L_discount"]*0.01,2).lang("元/l/yuan")."</b></font></td><td>".$O_state."</td><td>".$O_pay."</td></a></tr>";
	}
}

?>
									</tbody>
								</table>
								<input name="Submit" type="button" class="submit" onMouseOver="this.className='submit2'" onMouseOut="this.className='submit'" onClick="document.location.href='OK.php?action=ok&O_id=<?php echo $O_id?>'" value="确认收货" style="float:right; margin:10px" />
<input name="Submit" type="button" class="submit" onMouseOver="this.className='submit2'" onMouseOut="this.className='submit'" onClick="document.location.href='OK.php?action=tui&O_id=<?php echo $O_id?>'" value="申请退款" style="float:right; margin:10px;" />
					</div>
				</div>
			</div>
		</div>

	</div>
	
		<?php require 'foot.php';?>

	<!-- js plugins  -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/icheck.min.js"></script>
	<script src="js/page.js"></script>
	
</body>
</html>