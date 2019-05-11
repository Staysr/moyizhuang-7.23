<?php 
require '../conn/conn2.php';
require '../conn/function.php';
require 'auto.php';
require 'member_check.php';
require 'left.php';

$action=$_GET["action"];
$O_id=intval($_GET["O_id"]);
$typex=$_GET["type"];
if($typex!=""){
$state="and O_state=".intval($typex);
}else{
$state="";
}
if($action=="del"){
mysqli_query($conn,"delete from SL_orders where O_id=".$O_id);
box(lang("删除成功！/l/success!"),"member_order.php","success");
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
		
		
		<form action="member_pay.php" method="post">
		<div class="container m_top_10">
					<ol class="breadcrumb">
				<li><i class="icon fa-home" aria-hidden="true"></i><a href="../">首页</a></li>
				<li>
				<?php if ($typex!="") {?>
				购物车
				<?php }else{?>
				我的订单
				<?php }?>
				</li>

			</ol>
					<div class="yto-box">
						
						<div class="panel panel-default">
							<div class="panel-heading"><?php if ($typex!="") {?>
				购物车
				<?php }else{?>
				我的订单
				<?php }?></div>
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
										<th><?php echo lang("删除/l/delete")?></th>
									</tr>
									</thead>
									<tbody>
									<?php 
$sql="select * from SL_orders,SL_product,SL_lv,SL_member where M_lv=L_id && O_member=M_id && O_pid=P_id && O_member=".$M_id." ".$state." order by O_id desc";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
		$money=$money+$row["O_num"]*$row["O_price"];
		$moneyx=$moneyx+$row["O_num"]*$row["O_price"]*$row["L_discount"]*0.01;

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
		echo "<tr><td>".mb_substr(lang($row["P_title"]),0,24,"utf-8")."<input type='hidden' name='O_id' value='".$row["O_id"]."'></td><td><a href='".$C_dir."index.php?type=productinfo&S_id=".$row["P_id"]."' target='_blank'><img src='".$C_dir.splitx(splitx($row["P_path"],"|",0),"__",0)."' height='30'></a></td><td>".round($row["O_price"],2).lang("元/l/yuan")."</td><td>".$row["O_num"]."</td><td style='text-decoration:line-through'>".round($row["O_num"]*$row["O_price"],2).lang("元/l/yuan")."</td><td><font color='red'><b>".round($row["O_num"]*$row["O_price"]*$row["L_discount"]*0.01,2).lang("元/l/yuan")."</b></font></td><td>".$O_state."</td><td>".$O_pay."</td><td><a href='member_order.php?action=del&O_id=".$row["O_id"]."' class='btn btn-xs btn-warning'><i class='fa fa-times-circle'></i> ".lang("删除/l/delete")."</td></a></tr>";
				;
		}
}

?>
									</tbody>
								</table>
					</div>

				</div>
				<?php if ($typex!="" ){?>
				<div class="pull-right">
								<p style="text-decoration:line-through">总价：<?php echo round($money,2)?>元</p>
								<p style="font-size: 15px; font-weight: bold;color: #FF0000">折扣价：<?php echo round($moneyx,2)?>元</p>
								<input type="submit" value="全部支付" class="btn btn-primary btn-block m_top_20">
								</div>
								<?php }?>
			</div>
		</div>

	</div>
	</form>
		<?php require 'foot.php';?>

	<!-- js plugins  -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/icheck.min.js"></script>
	<script src="js/page.js"></script>
	
</body>
</html>