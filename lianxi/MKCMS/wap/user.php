<?php include('../system/inc.php');
error_reporting(0);
$op=$_GET['op'];
if(!isset($_SESSION['user_name'])){
		alert_href('请登陆后进入','login.php?op=login');
	};
	//退出
if ($op == 'out'){	
unset($_SESSION['user_name']);
unset($_SESSION['user_group']);
if (! empty ( $_COOKIE ['user_name'] ) || ! empty ( $_COOKIE ['user_password'] ))   
    {  
        setcookie ( "user_name", null, time () - 3600 * 24 * 365 );  
        setcookie ( "user_password", null, time () - 3600 * 24 * 365 );  
    }  
header('location:login.php?op=login');
}
//支付
if ( isset($_POST['paysave']) ) {
if ($_POST['pay']==1){

//判定会员组别
$result = mysql_query('select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
if($row = mysql_fetch_array($result)){

$u_points=$row['u_points'];
$u_group=$row['u_group'];
$send = $row['u_end'];

//获取会员卡信息
$card= mysql_query('select * from mkcms_userka where id="'.$_POST['cardid'].'"');
if($row2 = mysql_fetch_array($card)){
$day=$row2['day'];//天数
$userid=$row2['userid'];//会员组
$jifen=$row2['jifen'];//积分
}
//判定会员组
if ($row['u_group']>$userid){ 
alert_href('您现在所属会员组的权限制大于等于目标会员组权限值，不需要升级!','mingxi.php');
}

$baoshi=$jifen;//点数
if($u_group>1){//判定已经是会员
	
if ($u_points>=$jifen) {//如果点数大于包时数
$_data['u_points'] =$u_points-$baoshi;//扣点
$_data['u_group'] =$userid;
if($send < time()){
$u_end = time()+ 86400*$day;
}
else{
$u_end = $send + 86400*$day;
}
$_data['u_start'] =time();
$_data['u_end'] =$u_end;
$sql = 'update mkcms_user set '.arrtoupdate($_data).' where u_name="'.$_SESSION['user_name'].'"';
if (mysql_query($sql)) {
alert_href('续费成功!','user.php');
}

}
	else{
alert_href('您的积分不够，无法续费,请继续赚取积分或其他方式购买会员!','user.php');
}
}
else{//普通会员充值
if ($u_points>=$baoshi) {//如果点数大于包时数
$_data['u_points'] =$u_points-$baoshi;
$_data['u_group'] =$userid;
$u_end = time()+ 86400*$day;
$_data['u_start'] =time();
$_data['u_end'] =$u_end;
$_data['u_flag'] =1;
$sql = 'update mkcms_user set '.arrtoupdate($_data).' where u_name="'.$_SESSION['user_name'].'"';
if (mysql_query($sql)) {
alert_href('升级成功!','user.php');
}

}
	else{
alert_href('您的积分不够，无法升级到该会员组,请充值!','user.php');
}	
}
}
}
else{
//获取会员卡信息
$card= mysql_query('select * from mkcms_userka where id="'.$_POST['cardid'].'"');
if($row2 = mysql_fetch_array($card)){
$day=$row2['day'];//天数
$userid=$row2['userid'];//会员组
$money=$row2['money'];//积分
}

$result = mysql_query('select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
if($row = mysql_fetch_array($result)){

$u_points=$row['u_points'];
$u_group=$row['u_group'];
$send = $row['u_end'];
if ($row['u_group']>$userid){ 
alert_href('您现在所属会员组的权限制大于等于目标会员组权限值，不需要升级!','user.php');
}
}
require_once("pay/epay.config.php");
require_once("pay/lib/epay_submit.class.php");

/**************************请求参数**************************/
        $notify_url = 'http://'.$_SERVER['HTTP_HOST'].'wap/pay/notify_url.php';
        //需http://格式的完整路径，不能加?id=123这类自定义参数

        //页面跳转同步通知页面路径
        $return_url = 'http://'.$_SERVER['HTTP_HOST'].'/wap/pay/return_url.php';
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

        //商户订单号
        $out_trade_no = date("YmdHis").mt_rand(100,999);
        //商户网站订单系统中唯一订单号，必填


		//支付方式
        $type = $_POST['pay'];
        //用户名
        $name = $_SESSION['user_name'];
		//包月时间
        $money = $money;
		//会员类型
		$group = $userid;
		//站点名称
        $sitename = 'BL云支付测试站点';
        //必填

        //订单描述
//写入记录
$data['p_order'] =$out_trade_no;
$data['p_uid'] =$_SESSION['user_name'];
$data['p_price'] =$money;
$data['p_time'] =time();
$data['p_point'] =$day;//时间
$data['p_group'] =$userid;
$data['p_status'] =0;
$str = arrtoinsert($data);
$sql = 'insert into mkcms_user_pay ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql)){}

/************************************************************/

//构造要请求的参数数组，无需改动
$parameter = array(
		"pid" => trim($alipay_config['partner']),
		"type" => $type,
		"notify_url"	=> $notify_url,
		"return_url"	=> $return_url,
		"out_trade_no"	=> $out_trade_no,
		"name"	=> $name,
		"money"	=> $money,
		"group"	=> $group,
		"sitename"	=> $sitename
);

//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter);
echo $html_text;
}

}
//会员卡激活码
if ( isset($_POST['cardsave']) ) {
null_back($_POST['c_number'],'请填写充值卡号');

//判定卡号是否存在
$result = mysql_query('select * from mkcms_user_card where c_number = "'.$_POST['c_number'].'" and c_used=0');
if($row = mysql_fetch_array($result)){
$day1= $row['c_money'];//天数
if ($row['c_userid']!=""){
$group= $row['c_userid'];//会员组id
}
else{
$group= $row['c_pass'];//会员组id	
}
//获取会员组的参数

$day=round($day1);//除法取整
//获取会员开通天数
$result = mysql_query('select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
if($row = mysql_fetch_array($result)){
$u_group=$row['u_group'];//会员组
$send = $row['u_end'];//截止时间
}
if ($u_group>$group){alert_href('您现在所属会员组的权限制大于等于目标会员组权限值，不能降级!','user.php');}
//判定时间是否到期
if($send < time()){
$u_end = time()+ 86400*$day;//到期增加天数
}
else{
$u_end = $send + 86400*$day;//没到期增加天数
}
//更新数据
$_data['u_group'] =$group;
$_data['u_start'] =time();
$_data['u_end'] =$u_end;
$sql = 'update mkcms_user set '.arrtoupdate($_data).' where u_name="'.$_SESSION['user_name'].'"';	
	if (mysql_query($sql)) {
$data['c_used'] = 1;
$data['c_user'] = $_SESSION['user_name'];
$data['c_usetime'] =time();

$sql = 'update mkcms_user_card set '.arrtoupdate($data).' where c_number = "'.$_POST['c_number'].'"';	
if (mysql_query($sql)) {
		alert_href('激活成功!','user.php');
}	} else {
		alert_back('激活失败!');
	}
		

}
else{
	alert_back('卡号不存在,或者已经使用');
	}
}
//会员信息
if ( isset($_POST['usersave']) ) {
	null_back($_POST['u_password'],'请填写登录密码');
	$result = mysql_query('select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
    if($row = mysql_fetch_array($result)){
if ($_POST['u_password'] != $row['u_password']) {
$_data['u_password'] = md5($_POST['u_password']);
	}
	else{
$_data['u_password'] = $_POST['u_password'];	
	}
	}

	$_data['u_email'] = $_POST['u_email'];
	$_data['u_phone'] = $_POST['u_phone'];
	$_data['u_qq'] = $_POST['u_qq'];
$sql = 'update mkcms_user set '.arrtoupdate($_data).' where u_name="'.$_SESSION['user_name'].'"';
	if (mysql_query($sql)) {
		alert_href('修改成功!','user.php');
	} else {
		alert_back('修改失败!');
	}
}
	?>
<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<meta name="author" content="lsl">
<meta name="generator" content="webstorm">
<!--移动端响应式-->
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
<!--支持IE的兼容模式-->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--让部分国产浏览器默认采用高速模式渲染页面-->
<meta name="renderer" content="webkit">
<!--页面style css-->
<link rel="stylesheet" href="<?php echo $mkcms_domain;?>wap/weui/weuix.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $mkcms_domain;?>wap/style/css/base.css">
<link rel="stylesheet" type="text/css" href="<?php echo $mkcms_domain;?>wap/style/css/li.css">
<script src="<?php echo $mkcms_domain;?>wap/weui/zepto.min.js"></script>
<script src="<?php echo $mkcms_domain;?>wap/style/js/li.js"></script>
<script type="text/javascript " src="<?php echo $mkcms_domain;?>style/js/history.js "></script>
<title>会员中心-<?php echo $mkcms_seoname;?></title>
<style type="text/css">
  .weui_cell:before{width: 95%}
</style>
</head>
<body>

<?php
					$result = mysql_query('select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
					if($row = mysql_fetch_array($result)){
						$u_id=$row['u_id'];
					?>
<section class="touxiang_box">
  <div class="touxiang"> <img src="<?php echo $mkcms_domain;?>wap/style/images/icon_zjongxin_03.png"> </div>
  <p class="mingcheng_y8"><?php echo $_SESSION['user_name']?></p>
  <div class="jilu_y8">
    <ul class="clearfix">
      <li><a href="user.php?op=my"><em class="guankan_icon"></em><span>观看记录</span></a></li>
      <li><a href="user.php?op=open"><em class="xufei_icon"></em><span><?php if($row['u_group']>1){ echo"会员续费";}else{echo"会员开通";};?></span></a></li>
      <li><a href="user.php?op=order"><em class="dingdan_icon"></em><span>订单管理</span></a></li>
    </ul>
  </div>
</section>
<?php if ($op == ''){?>
<section class="wode_box bgfff">
  <ul>
 <?php if($row['u_group']>1){ ?>
    <li>
      <div class="huiyuan">
        <p class="clearfix">我的会员：<span class="fr"><?php echo date('Y-m-d',$row['u_end'])?><a href=""><em class="zhuandao2"></em></a></span></p>
      </div>
    </li>
 <?php }?>
    <li>
      <div class="huiyuan jifen">
        <p class="clearfix">我的积分：<span class="fr"><?php echo $row['u_points'];?><a href=""><em class="zhuandao2"></em></a></span></p>
      </div>
    </li>
	    <li>
      <a href="user.php?op=yaoqing" onclick="$('.weui-share').show().addClass('fadeIn');">
        <div class="huiyuan tuijian_y8">
          <p class="clearfix">推广记录<span class="fr"><?php $sql1="SELECT COUNT(*) AS count FROM mkcms_user where u_qid=$u_id"; 
$result1=mysql_fetch_array(mysql_query($sql1)); 
$count=$result1['count']; echo $count;?><em class="zhuandao2"></em></span></p>
        </div>
      </a>
    </li>
    <li>
      <div class="huiyuan jifen" style="background: url(<?php echo $mkcms_domain;?>wap/style/images/shoucang.png) no-repeat 0.33rem center;background-size: 0.31rem 0.29rem">
        <a href="user.php?op=shoucang"><p class="clearfix">我的收藏：<span class="fr"><em class="zhuandao2"></em></span></p></a>
      </div>
    </li>
    <li>
      <div class="huiyuan jifen" style="background: url(<?php echo $mkcms_domain;?>wap/style/images/bangding.png) no-repeat 0.33rem center;background-size: 0.31rem 0.29rem">
        <a href="user.php?op=out"><p class="clearfix">退出登陆<span class="fr"><em class="zhuandao2"></em></span></p></a>
      </div>
    </li>
  </ul>
</section>

<section class="wode_box bgfff">
  <ul>




    <li><a href="user.php?op=info">
      <div class="huiyuan meiri">
        <p class="clearfix">个人设置<span class="fr"><em class="zhuandao2"></em></span></p>
      </div></a>
    </li>
  
  </ul>
</section>

<?php }?>
<?php if ($op == 'open'){?>

<div class="weui_panel weui_panel_access">           
    <div class="weui_panel_bd">
        <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg">
            <div class="weui_media_hd">
                <img class="weui_media_appmsg_thumb circle" src="<?php echo $mkcms_domain;?>wap/style/images/icon_zjongxin_03.png" alt="">
            </div>
            <div class="weui_media_box  weui_media_text">
                <h4 class="weui_media_title"><?php echo $_SESSION['user_name']?><span class="icon icon-123" style="color: #9fc732"></span></h4>
                <p class="weui_media_desc">会员： <?php echo date('Y-m-d',$row['u_end'])?>到期 <br>积分：<?php echo $row['u_points'];?></p>
            </div>
        </a>                
    </div>           
</div>        
 <?php
					$result = mysql_query('select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
					if($row = mysql_fetch_array($result)){
					?>
<form class="form-horizontal" action="" method="post"> 
<input name="u_points" type="hidden" class="form-control" value="<?php echo $row['u_points'];?>">
<div class="weui_panel">          
    <div class="weui_panel_bd">
        <div class="weui_media_box weui_media_small_appmsg">
            <div class="weui_cells weui_cells_access">
                <div class="weui_cell">
                    <div class="weui_cell_hd"></div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>会员卡购买</p>
                    </div>
                </div>                      
            </div>
        </div>
    </div>
</div>
 
<div class="weui-form-preview" id="cardshow">   
        <div class="weui_cells_checkbox">
<?php
							$result = mysql_query('select * from mkcms_userka');
							while($row = mysql_fetch_array($result)){
						?>
            <label class="weui_cell weui_check_label" for="x{$data['card_day']}"> 
                <div class="weui_cell_bd weui_cell_primary">
                    <p><?php echo $row['name']?>-<?php echo $row['day']?>天[<?php echo $row['money']?>元][<?php echo $row['jifen']?>积分]</p>
                    <!-- <p>{if $data['card_fee']}{$data['card_fee']}元{/if} {if $data['card_credit']}{$data['card_credit']}积分{/if}</p> -->
                </div>
                <div class="weui_cell_ft" id="card">
				<input type="radio" id="profile_gender_0" name="cardid" required="required" value="<?php echo $row['id']?>" checked>
                </div>
            </label>
<?php
							}
						?>
        </div>
</div>

<div class="weui_cells weui_cells_form" style="margin-top: 1px">  
<div class="weui_btn_area">
<input type="radio" id="profile_gender_0" name="pay" required="required" value="1" checked="">
								<label for="profile_gender_0" class="required">积分支付</label>
								<?php if($mkcms_zhifu=1){?><input type="radio" id="profile_gender_1" name="pay" required="required" value="alipay">
								<label for="profile_gender_1" class="required">支付宝</label>
								<input type="radio" id="profile_gender_1" name="pay" required="required" value="wxpay">
								<label for="profile_gender_1" class="required">微信</label>
								<input type="radio" id="profile_gender_1" name="pay" required="required" value="qqpay">
								<label for="profile_gender_1" class="required">QQ钱包</label><?php } ?>
								<div class="page-hd-title" style="text-align: center;" ></div>

								<input name="paysave" type="submit" value="确认开通" class="weui_btn weui_btn_primary" />
</div>
</div> 
</form>
<?php
						}
					?>
<div class="weui_panel">          
    <div class="weui_panel_bd">
        <div class="weui_media_box weui_media_small_appmsg">
            <div class="weui_cells weui_cells_access">
                <a class="weui_cell" href="user.php?op=card">
                    <div class="weui_cell_hd"><span class="icon icon-120" style="font-size: 23px;margin-right: 5px;background: #9fc732;border-radius: 50%;color: #fff;line-height: 35px;"></span></div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>兑换码激活卡</p>
                    </div>
                    <span class="weui_cell_ft"></span>
                </a>                      
            </div>
        </div>
    </div>
</div>
<div class="weui_panel">
<img src="<?php echo $mkcms_domain;?>wap/style/images/tequan.png" width="100%"> 
</div>
<style type="text/css">
    .heifeng_p{margin-bottom: 80px}
</style>

<?php }?>
<?php if ($op == 'my'){?>

						
<section class="wode_box bgfff">
  <ul>
<script type="text/javascript ">
					$MH.limit = 30;
					$MH.WriteHistoryBox(200, 0, 'font');
					$MH.recordHistory({
						name: '',
						link: '',
						pic: ''
					})
				</script>   
  </ul>
</section>
<?php }?>
<?php if ($op == 'shoucang'){?>
<section class="wode_box bgfff">
  <ul>
<?php
                            $result = mysql_query('select * from mkcms_fav where userid="'.$u_id.'"');
							while($row= mysql_fetch_array($result)){
							?>
    <li>
      <div class="huiyuan jifen">
        <p class="clearfix"><?php echo $row['name'] ?><span class="fr"><a href="<?php echo $row['url'] ?>">继续观看<em class="zhuandao2"></em></span></a></p>  
      </div>
    </li>
  <?php } ?> 
  </ul>
</section>
<?php }?>
<?php if ($op == 'yaoqing'){?>

<section class="wode_box bgfff">
我的推广链接：<?php echo $mkcms_domain;?>wap/login.php?op=create&tg=<?php echo $u_id ?>
</section>


<section class="wode_box bgfff">
  <ul>
<?php
                            $result = mysql_query('select * from mkcms_user where u_qid="'.$u_id.'"');
							while($row= mysql_fetch_array($result)){
							?>
    <li>
      <div class="huiyuan jifen">
        <p class="clearfix"><?php echo $row['u_name'] ?><span class="fr"><a href=""><?php if($row['u_regtime']>0){ echo"";echo date('Y-m-d',$row['u_regtime']);;};?><em class="zhuandao2"></em></span></a></p>  
      </div>
    </li>
  <?php } ?> 
  </ul>我不想邀请，直接购买充值卡充值：<a href="<?php echo $mkcms_qqun;?>" target="_blank">点此购买>>></a>
</section>

<?php }?>
<?php if ($op == 'order'){?>
<?php
									$sql1 = 'select * from mkcms_user_pay where p_uid="'.$row['u_name'].'" order by p_id desc';
									$pager = page_handle('page',10,mysql_num_rows(mysql_query($sql1)));
									$result1 = mysql_query($sql1.' limit '.$pager[0].','.$pager[1].'');

							while($row1= mysql_fetch_array($result1)){
?>
<div class="weui-form-preview">
    <div class="weui-form-preview-hd">
        <label class="weui-form-preview-label">付款金额</label>
        <em class="weui-form-preview-value"><?php echo $row1['p_price'];?>元</em>
    </div>
    <div class="weui-form-preview-bd">
        <p>
            <label class="weui-form-preview-label">天数</label>
            <span class="weui-form-preview-value"><?php echo $row1['p_point'];?>天</span>
        </p>
        <p>
            <label class="weui-form-preview-label">付款时间</label>
            <span class="weui-form-preview-value"><?php echo date('Y-m-d',$row1['p_time']);?></span>
        </p>
        <p>
            <label class="weui-form-preview-label">支付状态</label>
            <span class="weui-form-preview-value"><?php if ($row1['p_status']==1){echo "已支付";}else{echo"未支付";}?></span>
        </p>
    </div>
    
</div>
<?php } ?>
<?php }?>
<?php if ($op == 'info'){?>
<?php
					$result = mysql_query('select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
					if($row = mysql_fetch_array($result)){
					?>
<form action="" method="post" class="form-horizontal form">

<div class="weui_cell weui_cells" style="margin-top: 5px">  
    <div class="weui_cell_hd"><label class="weui_label">用户名：</label></div>
    <div class="weui_cell_bd weui_cell_primary">
        <input class="weui_input" type="text" name="c_number" value="<?php echo $row['u_name'];?>"/>
    </div>
</div>
<div class="weui_cell weui_cells" style="margin-top: 5px">  
    <div class="weui_cell_hd"><label class="weui_label">密码：</label></div>
    <div class="weui_cell_bd weui_cell_primary">
        <input class="weui_input" name="u_password" type="password" value="<?php echo $row['u_password'];?>"/>
    </div>
</div>
<div class="weui_cell weui_cells" style="margin-top: 5px">  
    <div class="weui_cell_hd"><label class="weui_label">手机号码：</label></div>
    <div class="weui_cell_bd weui_cell_primary">
        <input class="weui_input" type="text" name="u_phone" value="<?php echo $row['u_phone'];?>"/>
    </div>
</div>
<div class="weui_cell weui_cells" style="margin-top: 5px">  
    <div class="weui_cell_hd"><label class="weui_label">QQ：</label></div>
    <div class="weui_cell_bd weui_cell_primary">
        <input class="weui_input" type="text" name="u_qq"  value="<?php echo $row['u_qq'];?>"/>
    </div>
</div>
<div class="weui_cell weui_cells" style="margin-top: 5px">  
    <div class="weui_cell_hd"><label class="weui_label">email：</label></div>
    <div class="weui_cell_bd weui_cell_primary">
        <input class="weui_input" type="text" name="u_email" value="<?php echo $row['u_email'];?>"/>
    </div>
</div>
<div class="weui_cells weui_cells_form" style="margin-top: 1px">  
<div class="weui_btn_area" style="margin: 15px">
<input name="usersave" type="submit" value="修改" class="weui_btn weui_btn_primary" style="background-color: #9fc732;border-radius: 50px"/>

</div>
</div> 
</form>
<?php
						}
					?>
<?php }?>
<?php if ($op == 'card'){?>

<div class="weui_panel weui_panel_access">           
    <div class="weui_panel_bd">
        <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg">
            <div class="weui_media_hd">
                <img class="weui_media_appmsg_thumb circle" src="<?php echo $mkcms_domain;?>wap/style/images/icon_zjongxin_03.png" alt="">
            </div>
            <div class="weui_media_box  weui_media_text">
                <h4 class="weui_media_title"><?php echo $_SESSION['user_name']?><span class="icon icon-123" style="color: #9fc732"></span></h4>
                <p class="weui_media_desc">会员： <?php echo date('Y-m-d',$row['u_end'])?>到期 <br>积分：<?php echo $row['u_points'];?></p>
            </div>
        </a>                    
    </div>           
</div> 
<?php
					$result = mysql_query('select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');
					if($row = mysql_fetch_array($result)){
					?>
<form action="" method="post" class="form-horizontal form">
 <input name="u_points" type="hidden" class="form-control" value="<?php echo $row['u_points'];?>">
				  <input type="hidden"  name="u_name" class="form-control"  value="<?php echo $row['u_name'];?>" disabled> 
<div class="weui_cell weui_cells" style="margin-top: 5px">  
    <div class="weui_cell_hd"><label class="weui_label">兑换码：</label></div>
    <div class="weui_cell_bd weui_cell_primary">
        <input class="weui_input" type="text" name="c_number" placeholder="请输入会员卡兑换码"/>
    </div>
</div>
<div class="weui_cells weui_cells_form" style="margin-top: 1px">  
<div class="weui_btn_area" style="margin: 15px">
<input name="cardsave" type="submit" value="激活会员卡" class="weui_btn weui_btn_primary" style="background-color: #9fc732;border-radius: 50px"/>
<br>

<input name="buycard" type="button" value="购买会员卡" onclick="window.open('<?php echo $mkcms_qqun;?>')" class="weui_btn weui_btn_primary" style="background-color: #9fc732;border-radius: 50px"/><a>

</div>
</div> 
</form>
<?php
						}
					?>

					<?php }}?>
<?php  include 'footer.php';?>
</body>
</html>
