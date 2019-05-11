<?php 
require '../conn/conn2.php';
require '../conn/function.php';
require 'auto.php';
require 'member_check.php';
require 'left.php';


$genkey = gen_key(20);
if (urlencode($_REQUEST["action"]) == "sign") {
    $sql = "Select * from SL_list where L_title like '每日签到' and L_mid=" . $_SESSION["M_id"] . " and day(L_time)='" . date("d", strtotime(date('Y-m-d H:i:s'))) . "' and month(L_time)='" . date("m", strtotime(date('Y-m-d H:i:s'))) . "' and year(L_time)='" . date("Y", strtotime(date('Y-m-d H:i:s'))) . "'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
    	box(lang("今日已签到，请明天再来！/l/error!") , "back", "error");
    } else {
        mysqli_query($conn, "update SL_member set  M_fen=M_fen+" . $C_sign . " where M_id=" . $_SESSION["M_id"]);
        mysqli_query($conn, "insert into SL_list(L_title,L_mid,L_change,L_time,L_type,L_no) values('每日签到'," . $_SESSION["M_id"] . "," . $C_sign . ",'" . date('Y-m-d H:i:s') . "',1,'" . $genkey . "')");
        box(lang("签到成功！/l/Success!") , "member_fenlist.php", "success");
    }
}
if (urlencode($_REQUEST["action"]) == "tofen") {
    $money = urlencode($_REQUEST["money"]);
    if ($money >= 0.01) {
        if ($money - $M_money <= 0) {
            mysqli_query($conn, "update SL_member set M_fen=M_fen+" . $money * $C_tofen_rate . " where M_id=" . $_SESSION["M_id"]);
            mysqli_query($conn, "update SL_member set M_money=M_money-" . $money . " where M_id=" . $_SESSION["M_id"]);
            mysqli_query($conn, "insert into SL_list(L_title,L_mid,L_change,L_time,L_type,L_no,'" . $genkey . "') values('余额转积分（" . $money . "元转" . $money * $C_tofen_rate . "分）'," . $_SESSION["M_id"] . "," . (-$money) . ",'" . date('Y-m-d H:i:s') . "',0)");
            mysqli_query($conn, "insert into SL_list(L_title,L_mid,L_change,L_time,L_type,L_no,'" . $genkey . "') values('余额转积分（" . $money . "元转" . $money * $C_tofen_rate . "分）'," . $_SESSION["M_id"] . "," . $money * $C_tofen_rate . ",'" . date('Y-m-d H:i:s') . "',1)");
            box("转换成功！", "member_fenlist.php", "success");
        } else {
            box("余额不足！请重新输入", "back", "error");
        }
    } else {
        box("至少输入0.01元！", "back", "error");
    }
}
if (urlencode($_REQUEST["action"]) == "tomoney") {
    $fen = urlencode($_REQUEST["fen"]);
    if ($fen >= 1) {
        if ($fen - $M_fen <= 0) {
            mysqli_query($conn, "update SL_member set M_fen=M_fen-" . $fen . " where M_id=" . $_SESSION["M_id"]);
            mysqli_query($conn, "update SL_member set M_money=M_money+" . $fen * $C_tomoney_rate . " where M_id=" . $_SESSION["M_id"]);
            mysqli_query($conn, "insert into SL_list(L_title,L_mid,L_change,L_time,L_type,L_no) values('积分转余额（" . $fen . "分转" . round($fen * $C_tomoney_rate, 2) . "元）'," . $_SESSION["M_id"] . "," . (-$fen) . ",'" . date('Y-m-d H:i:s') . "',1,'" . $genkey . "')");
            mysqli_query($conn, "insert into SL_list(L_title,L_mid,L_change,L_time,L_type,L_no) values('积分转余额（" . $fen . "分转" . roundr($fen * $C_tomoney_rate, 2) . "元）'," . $_SESSION["M_id"] . "," . $fen * $C_tomoney_rate . ",'" . date('Y-m-d H:i:s') . "',0,'" . $genkey . "')");
            box("转换成功！", "member_moneylist.php", "success");
        } else {
            box("积分不足！请重新输入", "back", "error");
        }
    } else {
        box("至少输入1积分！", "back", "error");
    }
}
if (urlencode($_REQUEST["action"]) == "tx") {
    $money = urlencode($_REQUEST["money"]);
    $name = urlencode($_REQUEST["name"]);
    $alipay = urlencode($_REQUEST["alipay"]);
    if ($money >= 1) {
        if ($money - $M_money <= 0) {
            mysqli_query($conn, "update SL_member set M_money=M_money-" . $money . " where M_id=" . $_SESSION["M_id"]);
            mysqli_query($conn, "insert into SL_list(L_title,L_mid,L_change,L_time,L_type,L_no,L_sh) values('余额提现（" . urldecode($alipay) . "/" . urldecode($name) . "）'," . $_SESSION["M_id"] . "," . (-$money) . ",'" . date('Y-m-d H:i:s') . "',0,'" . $genkey . "',1)");
            box("提交成功！请等待管理员审核", "member_moneylist.php", "success");
        } else {
            box("余额不足！请重新输入", "back", "error");
        }
    } else {
        box("至少输入1元！", "back", "error");
    }
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

		<div class="container m_top_30">
					<div class="yto-box">
						<h5><?php echo lang("订单记录/l/Orders")?></h5>
						<span style="float: right;margin-top: -40px"><a href="member_order.php" class='btn btn-xs btn-info'><i class='fa fa-plus-square'></i> <?php echo lang("查看更多/l/More")?></a></span>
						<div class="panel panel-default">
							<div class="panel-heading"><?php echo lang("订单记录/l/Orders")?></div>
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
$sql="select * from SL_orders,SL_product,SL_lv,SL_member where M_lv=L_id and O_member=M_id and O_pid=P_id and O_member=".$M_id." order by O_id desc limit 5";

		$result = mysqli_query($conn, $sql);
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
		
		echo "<tr><td>".mb_substr(lang($row["P_title"]),0,24,"utf-8")."...</td><td><a href='".$C_dir."index.php?type=productinfo&S_id=".$row["P_id"]."' target='_blank'><img src='".$C_dir.splitx(splitx($row["P_path"],"|",0),"__",0)."' height='30'></a></td><td>".round($row["O_price"],2).lang("元/l/yuan")."</td><td>".$row["O_num"]."</td><td><font color='red'><b>".round($row["O_num"]*$row["O_price"],2).lang("元/l/yuan")."</b></font></td><td><font color='red'><b>".round($row["O_num"]*$row["O_price"]*$row["L_discount"]*0.01,2).lang("元/l/yuan")."</b></font></td><td>".$O_state."</td><td>".$O_pay."</td><td><a href='member_order.php?action=del&O_id=".$row["O_id"]."' class='btn btn-xs btn-warning'><i class='fa fa-times-circle'></i> ".lang("删除/l/delete")."</td></a></tr>";
				}
}
?>
									</tbody>
								</table>
					</div>
				</div>
			</div>
			
			<div class="yto-box">
						<h5><?php echo lang("表单记录/l/Form")?></h5>
						<span style="float: right;margin-top: -40px"><a href="member_form.php" class='btn btn-xs btn-info'><i class='fa fa-plus-square'></i> <?php echo lang("查看更多/l/More")?></a></span>
						<div class="panel panel-default">
							<div class="panel-heading"><?php echo lang("表单记录/l/Form")?></div>
							<div class="table-responsive">
								<?php 
$sql2 = "select distinct(F_id) from SL_content,SL_form,SL_response where R_cid=C_id and C_fid=F_id and R_member=" . $_SESSION["M_id"] . " order by F_id limit 5";
$result2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result2) > 0) {
    while ($row2 = mysqli_fetch_assoc($result2)) {
        $F_id = $row2["F_id"];
        $line = $line . "<table class=\"table table-bordered\"><tr bgcolor='#f7f7f7'><td>" . lang("会员/l/Member") . "</td>";
        $sql = "select * from SL_content where C_Fid=" . $F_id . " order by C_order";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $line = $line . "<td>" . lang($row["C_title"]) . "</td>";
            }
        }
        $line = $line . "<td>" . lang("提交时间/l/Time") . "</td><td>" . lang("审核/l/Time") . "</td></tr>";
        $sql = "select distinct(R_rid),R_time,R_read,R_member from SL_response,SL_content where R_Cid=C_id and C_fid=" . $F_id . " and R_member=" . $_SESSION["M_id"] . " order by R_time";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $R_member = lang("未登录/l/Not logged");
                if ($row["R_member"] != "") {
                    $R_member = $_SESSION["M_login"];
                }
                $line = $line . "<tr ><td>" . $R_member . "</td>";
                $sql1 = "select * from SL_response,SL_content where R_Cid=C_id and C_fid=" . $F_id . " and R_rid like '" . $row["R_rid"] . "' order by C_order";
                $result1 = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        if (substr($row1["R_content"], -3) == "jpg" || substr($row1["R_content"], -3) == "png" || substr($row1["R_content"], -3) == "gif") {
                            $R_content = "<a href='../media/" . $row1["R_content"] . "' target='_blank'><img src='../media/" . $row1["R_content"] . "' height='30'> " . lang("点击查看大图/l/Click to enlarge") . "</a>";
                        } else {
                            if (substr($row1["R_content"], -3) == "doc" || substr($row1["R_content"], -3) == "pdf" || substr($row1["R_content"], -3) == "ppf" || substr($row1["R_content"], -3) == "rar") {
                                $R_content = "<a href='../media/" . $row1["R_content"] . "' target='_blank'><img src='img/file.gif'> " . lang("点击查看附件/l/Click to view attachments") . "</a>";
                            } else {
                                $R_content = $row1["R_content"];
                            }
                        }
                        $line = $line . "<td>" . $R_content . "</td>";
                    }
                }
                if ($row["R_read"] == 1) {
                    $read_info = "已审核";
                } else {
                    $read_info = "未审核";
                }
                $line = $line . "<td>" . $row["R_time"] . "</td><td>" . $read_info . "</td></tr>";
            }
        }
        $line = $line . "</table>";
    }
}
echo $line;
?>
</table>
					</div>
				</div>
			</div>
			
			<div class="yto-box">
						<h5><?php echo lang("我的投稿/l/Contribute")?></h5>
						<span style="float: right;margin-top: -40px"><a href="member_news.php?type=0" class='btn btn-xs btn-info'><i class='fa fa-plus-square'></i> <?php echo lang("查看更多/l/More")?></a></span>
						<div class="panel panel-default">
							<div class="panel-heading"><?php echo lang("我的投稿/l/Contribute")?></div>
							<div class="table-responsive">
								<table class="table table-bordered">
								 <thead>
									<tr>
										<th><?php echo lang("文章标题/l/Title")?></th>
										<th><?php echo lang("投稿时间/l/Time")?></th>
										<th><?php echo lang("文章分类/l/Category")?></th>
										<th><?php echo lang("审核/l/review")?></th>
										<th><?php echo lang("编辑/l/edit")?></th>
										<th><?php echo lang("删除/l/delete")?></th>
									</tr>
									</thead>
									<tbody>
									<?php 
$sql="select * from SL_news,SL_nsort where N_sort=S_id and N_author like '".$M_login."'  order by N_id desc limit 5";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
		if ($row["N_sh"]==0){
		$sh_info="<font color='#009900'>".lang("已通过/l/Already passed")."</font>";
		}
		if ($row["N_sh"]==1){
		$sh_info="<font color='#ff0000'>".lang("未通过/l/not passed")."</font>";
		}
		if ($row["N_sh"]==2){
		$sh_info="<font color='#ff9900'>".lang("未审核/l/Not audited")."</font>";
		}
		
		echo "<tr><td>".lang($row["N_title"])."</td><td>".$row["N_date"]."</td><td>".lang($row["S_title"])."</td><td>".$sh_info."</td><td><a href='member_newsinfo.php?N_id=".$row["N_id"]."' class='btn btn-xs btn-success'><i class='fa fa-pencil-square-o'></i> ".lang("编辑/l/edit")."</td><td><a href='member_news.php?action=del&N_id=".$row["N_id"]."' class='btn btn-xs btn-warning'><i class='fa fa-times-circle'></i> ".lang("删除/l/delete")."</td></a></tr>";
		}
}

?>
									</tbody>
								</table>
					</div>
				</div>
			</div>
		</div>

	</div>
	
<?php 
require 'foot.php';
?>

	<!-- js plugins  -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/icheck.min.js"></script>
	<script src="js/page.js"></script>
	
</body>
</html>