<?php include('../system/inc.php');?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>打赏</title>
	<meta name="format-detection" content="telephone=no, address=no">
	<meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
	<meta name="apple-touch-fullscreen" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="pay/bootstrap.min.css?v=20170802" rel="stylesheet">
	<link href="pay/common.min.css?v=20170802" rel="stylesheet">
	
</head>
<body>
<div class="container container-fill">
2<div class="mui-content pay-method">
	<h5 class="mui-desc-title mui-pl10">订单详情</h5>
	<ul class="mui-table-view">
		<li class="mui-table-view-cell">
			商品名称<span class="mui-pull-right mui-text-muted">打赏</span>
		</li>
		<li class="mui-table-view-cell">
			订单编号<span class="mui-pull-right mui-text-muted"><?php echo date("YmdHis").mt_rand(100,999); ?></span>
		</li>
		<li class="mui-table-view-cell">
			商家名称<span class="mui-pull-right mui-text-muted"><?php echo $mkcms_name;?></span>
		</li>
				<li class="mui-table-view-cell">
			商品价格<span class="mui-pull-right mui-text-success mui-big mui-rmb"><?php echo $_GET['fee']; ?>元</span>
		</li>
	</ul>
		<ul class="mui-table-view">
		<li class="mui-table-view-cell mui-table-view-chevron">
			还需支付<span class="mui-pull-right mui-text-success mui-big mui-rmb js-need-pay" data-price="0.78"><?php echo $_GET['fee']; ?>元</span>
		</li>
	</ul>
	<h5 class="mui-desc-title mui-pl10">选择支付方式</h5>
	<ul class="mui-table-view mui-table-view-chevron">
						<li class="mui-table-view-cell">
			<p class="mui-navigate-right mui-media js-pay" href="javascript:;">
				<form name=alipayment action=pay/epayapi.php method=post>
					<input type="hidden" name="WIDout_trade_no" value="<?php echo date("YmdHis").mt_rand(100,999); ?>"/>
					<input type="hidden" name="WIDsubject" value="打赏"/>
					<input type="hidden" name="WIDtotal_fee" value="<?php echo $_GET['fee']; ?>"/>
					<input type="hidden" name="type" value="alipay"/>
					<img src="pay/zfb-icon.png" alt="" class="mui-media-object mui-pull-left"/>
					<button type="submit" class="mui-media-body mui-block" style="width: 80%;border: 0px;text-align: left;padding: 0px">
						支付宝
						<span class="mui-block mui-text-muted mui-mt5">简单、安全、快速</span>
					</button>
				</form>
			</p>
		</li>
		
		<li class="mui-table-view-cell">
			<p class="mui-navigate-right mui-media js-pay" href="javascript:;">
				<form name=alipayment action=pay/epayapi.php method=post>
					<input type="hidden" name="WIDout_trade_no" value="<?php echo date("YmdHis").mt_rand(100,999); ?>"/>
					<input type="hidden" name="WIDsubject" value="打赏"/>
					<input type="hidden" name="WIDtotal_fee" value="<?php echo $_GET['fee']; ?>"/>
					<input type="hidden" name="type" value="wxpay"/>
					<img src="pay/wx-icon.png" alt="" class="mui-media-object mui-pull-left"/>
					<button type="submit" class="mui-media-body mui-block" style="width: 80%;border: 0px;text-align: left;padding: 0px">
						微信支付
						<span class="mui-block mui-text-muted mui-mt5">简单、安全、快速</span>
					</button>
				</form>
			</p>
		</li> 
		<!-- <p> 正在调试  第三方支付  暂时不要支付</p>  --> 
			</ul>
</div>
<script type="text/javascript">
	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
		$('.js-wechat-pay').removeClass('mui-disabled');
		$('.js-wechat-pay a').addClass('js-pay');
		$('#wetitle').html('微信支付');
	});
	$(document).on('click', '.js-pay', function() {
		$(this).find('form').submit();
	})
</script>



