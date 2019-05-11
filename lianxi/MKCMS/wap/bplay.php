<?php include('../system/inc.php');
error_reporting(0);
//获取详情字段
function get_play($t0){
	$result = mysql_query('select * from mkcms_player where id ='.$t0.'');
	if (!!$row = mysql_fetch_array($result)){
return $row['n_url'];
	}else{
		return $t0;
	};
}
if (isset($_GET['bf'])){
$_GET['play']=$_GET['bf'];	
}

$result = mysql_query('select * from mkcms_vod where d_id = '.$_GET['play'].' ');
if (!!$row = mysql_fetch_array($result)) {
	$d_id = $row['d_id'];
	$d_name = $row['d_name'];
	$d_jifen = $row['d_jifen'];
	$d_user = $row['d_user'];
	$d_parent = $row['d_parent'];
	$d_picture = $row['d_picture'];
	$d_content = $row['d_content'];
	$d_scontent = $row['d_scontent'];
	$d_seoname = $row['d_seoname'];
	$d_keywords = $row['d_keywords'];
	$d_description = $row['d_description'];
	$d_player = $row['d_player'];
	$d_title = ($d_seoname == '') ? $d_name .' - '.$mkcms_name : $d_seoname.' - '.$d_name.' - '.$mkcms_name ;
} else {
	die ('您访问的详情不存在');
}
$result1 = mysql_query('select * from mkcms_vod_class where c_id='.$d_parent.' order by c_id asc');
while ($row1 = mysql_fetch_array($result1)){
$c_hide=$row1['c_hide'];
}
if($c_hide>0){
if(!isset($_SESSION['user_name'])){
		alert_href('请注册会员登录后观看',''.$mkcms_domain.'wap/login.php');
	};
    $result = mysql_query('select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');//查询会员积分
     if($row = mysql_fetch_array($result)){
	 $u_group=$row['u_group'];//到期时间
     }
 if($u_group<=1){//如果会员组
 alert_href('对不起,您不能观看会员视频，请升级会员！',''.$mkcms_domain.'wap/user.php?op=open');
 } 
}
include('system/shoufei.php');
if($d_jifen>0){//积分大于0,普通会员收费
	if(!isset($_SESSION['user_name'])){
		alert_href('请注册会员登录后观看',''.$mkcms_domain.'wap/login.php');
	};
    $result = mysql_query('select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');//查询会员积分
     if($row = mysql_fetch_array($result)){
     $u_points=$row['u_points'];//会员积分
     $u_plays=$row['u_plays'];//会员观看记录
     $u_end=$row['u_end'];//到期时间
	 $u_group=$row['u_group'];//到期时间
     }	

	     if($u_group<=1){//如果会员组
     if($d_jifen>$u_points){
	 alert_href('对不起,您的积分不够，无法观看收费数据，请充值续费！',''.$mkcms_domain.'wap/user.php?op=open');
    }  else{

    if (strpos(",".$u_plays,$d_id) > 0){ 

	}	
	//有观看记录不扣点
else{

   $uplays = ",".$u_plays.$d_id;
   $uplays = str_replace(",,",",",$uplays);
   $_data['u_points'] =$u_points-$d_jifen;
   $_data['u_plays'] =$uplays;
   $sql = 'update mkcms_user set '.arrtoupdate($_data).' where u_name="'.$_SESSION['user_name'].'"';
if (mysql_query($sql)) {

alert_href('您成功支付'.$d_jifen.'积分,请重新打开视频观看!',''.$mkcms_domain.'bplay.php?play='.$d_id.'');
}
}
	
}
}
}
if($d_user>0){	
if(!isset($_SESSION['user_name'])){
		alert_href('请注册会员登录后观看',''.$mkcms_domain.'wap/login.php');
	};
    $result = mysql_query('select * from mkcms_user where u_name="'.$_SESSION['user_name'].'"');//查询会员积分
     if($row = mysql_fetch_array($result)){
     $u_points=$row['u_points'];//会员积分
     $u_plays=$row['u_plays'];//会员观看记录
     $u_end=$row['u_end'];//到期时间
	 $u_group=$row['u_group'];//到期时间
     }		 
if($u_group<$d_user){
	alert_href('您的会员组不支持观看此视频!',''.$mkcms_domain.'ucenter/mingxi.php');
}
}

?>
<!DOCTYPE html>
<html>
<head lang="en">
<?php  include 'head.php';?>
<title><?php echo $d_title;?></title>
<meta name="keywords" content="<?php echo $d_keywords;?>">
<meta name="description" content="<?php echo $d_description;?>">
<style type="text/css">
  #timer{background: rgba(0, 0, 0, 0.59);padding: 5px;text-align: center;width: 30px;position: absolute;top: 5%;right: 2%;color: #fff;font-size: 16px;border-radius: 50%;height: 30px;line-height: 20px}
  #xiang{background: rgba(177, 13, 13, 0.87);padding: 5px;text-align: center;width: auto;position: absolute;bottom: 2%;right: 1%;color: #fff;font-size: 16px;border-radius: 10px;height: 20px;line-height: 9px}
</style> 

</head>
<body>
<?php include 'header.php'; ?>
<div id="shiping_box"></div>
<script type="text/javascript"> 

          function run(){
        var s = document.getElementById("timer");      
        if(!s){          
            return false;
        }else{
          s.innerHTML = s.innerHTML * 1 - 1;
        }
        
    }
    window.setInterval("run();", 1000);
	$('#shiping_box').html('<div style="text-align:center;width:100%;position: relative;height:210px;background:#000"><?php echo get_ad(1)?><div id="timer"><?php echo $mkcms_miaoshu;?></div></div>');
    //设置延时函数
    function adsUp(){    
        $("#shiping_box").html('<iframe id="video" src="<?php echo $mkcms_domain;?>jx/jx.php?url=<?php $result = mysql_query('select * from mkcms_vod where d_id ='.$d_id.'');
	if (!!$row = mysql_fetch_array($result)){
$d_scontent=explode("\r\n",$row['d_scontent']);
//print_r($d_scontent);
for($i=0;$i<count($d_scontent);$i++)
{	$d_scontent[$i]=explode('|',$d_scontent[$i]);
		}
	echo $d_scontent[0][1];
	}else{
		return '';
	};?><?php $result = mysql_query('select * from mkcms_vod where d_id ='.$d_id.'');
	if (!!$row = mysql_fetch_array($result)){
$d_scontent=explode("\r\n",$row['d_scontent']);
//print_r($d_scontent);
for($i=0;$i<count($d_scontent);$i++)
{	$d_scontent[$i]=explode('$',$d_scontent[$i]);
		}
	echo $d_scontent[0][1];
	}else{
		return '';
	};?>"  allowfullscreen="true" allowtransparency="true" style="width:100%;border:none;height:210px"></iframe>');  
    }
    //五秒钟后自动收起
    var t = setTimeout(adsUp,<?php echo $mkcms_miaoshu*1000;?>); 
    
</script>
<div class="fr lianjie_box_y9">  <a href="javascript:;" onclick="$('.weui-share').show().addClass('fadeIn');"><em class="icon icon-3" style="margin-right: 10px"></em></a>  
<a href="<?php echo $mkcms_domain;?>wap/addfav.php?title=<?php echo $timu; ?>&dizhi=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>"><em class="icon icon-48" style="font-size: 19px;"></em></a> </div>
<section class="sanguo_box bgfff">
    <h2 class="sanguo_h2" id="xuji"></h2>
	
</section>
<div class="weui-share" onClick="$(this).fadeOut();$(this).removeClass('fadeOut')">
<div class="weui-share-box">
点击右上角发给朋友<i></i> 
</div>
</div> 
<span id="title" class="title" ></span>
<style type="text/css">
  .jishi_box2 ul li:nth-child(5n){ margin-right:0;} 
</style>
<section class="jishi_box_y9 p_r">
 
  <div class="jishi_box2">
  <ul class="clearfix">
<?php $result = mysql_query('select * from mkcms_vod where d_id ='.$d_id.'');
	if (!!$row = mysql_fetch_array($result)){
$d_scontent=explode("\r\n",$row['d_scontent']);
//print_r($d_scontent);
for($i=0;$i<count($d_scontent);$i++)
{	$d_scontent[$i]=explode('|',$d_scontent[$i]);
if($d_scontent[$i][1]!=""){
	echo'<li><a href="'.$mkcms_domain.'jx/jx.php?url='.$d_scontent[$i][1].'" target="ajax" id="'.$d_scontent[$i][0].'">'.$d_scontent[$i][0].'</a></li>';
}
	}
	}else{
		return '';
	};?>
<?php $result = mysql_query('select * from mkcms_vod where d_id ='.$d_id.'');
	if (!!$row = mysql_fetch_array($result)){
$d_scontent=explode("\r\n",$row['d_scontent']);
//print_r($d_scontent);
for($i=0;$i<count($d_scontent);$i++)
{	$d_scontent[$i]=explode('$',$d_scontent[$i]);
if($d_scontent[$i][1]!=""){
	echo'<li><a href="'.$mkcms_domain.'jx/jx.php?url='.$d_scontent[$i][1].'" target="ajax" id="'.$d_scontent[$i][0].'">'.$d_scontent[$i][0].'</a></li>';
}
	}
	}else{
		return '';
	};?>     
  </ul>
  </div>
</section>
<script type="text/javascript">
	var al = $('.jishi_box2 a');
	al.attr('class','am-btn am-btn-default lipbtn');
	var ji= new Array();
	var btnji= new Array();
	for(var g=0;g<al.length;g++){
		ji.push(al[g].href);
		btnji.push(al[g].id);
		al[g].href = 'javascript:void(0)';
		al[g].target = '_self';
		al.eq(g).attr('onclick','bofang(\''+ji[g]+'\',\''+btnji[g]+'\')');
	};
</script>
<script type="text/javascript">
var tishi = ('正在为您播放<?php echo $d_name; ?>');
document.getElementById('xuji').innerHTML = tishi;
	function bofang(mp4url,jiid){
		var tishi = ('正在为您播放<?php echo $d_name; ?> '+jiid+'');
		document.getElementById('xuji').innerHTML = tishi;
		document.getElementById('video').src=''+mp4url;
		
				//点击之后
document.getElementById('xuji').style.display='block';
document.getElementById('video').style.display='none';
function test() {
			document.getElementById('video').style.display='block';
		}
		setTimeout(test, 0);
	};
</script>
<?php echo get_ad(13)?>
<section class="jianjie_y9 bgfff clearfix">
<p class="jianjie_y9_p part"><?php echo $d_content; ?></p>
</section>
<div class="tcenter page-hd">
  <a href="javascript:;" class="weui_btn weui_btn_warn weui_btn_inline" id="shang">赏</a>
  <p class="page-hd-desc" style="text-align: center;">→_→土豪给打赏个呗←_←</p>  
</div>
<div id="dashang" style="display: none">  
  <img src="<?php echo $mkcms_dashang; ?>" style="border-radius: 50%;width: 100px;height: 100px">
  <p style="text-align: center;">喜欢就打赏个小红包吧</p>
  <p style="text-align: center;"><b style="font-size: 20px;color:red" class="shang_fee"></b>元</p>
  <p style="text-align: center;"><a href="javascript:;" onClick="generateMixed(2)">随机更换</a> <a href="javascript:;" onClick="shuru()">输入金额</a></p>
<script>
var shang_fee = $(".shang_fee").text();
if (!shang_fee) {
 var num = 1 * Math.random();    
 $(".shang_fee").text(num.toFixed(2));
}
function generateMixed(n) {
    var num = 10*Math.random();    
    $(".shang_fee").text(num.toFixed(2));
}
function shuru(n) { 
    $(".shang_fee").html('<input class="weui_input shuru" placeholder="请输入金额" type="text" style="width: 54%;border: 1px solid #ccc;border-radius: 50px;height: 1.2em;line-height: 1.2em;text-align: center;margin-right: 6px;">'); 
}
</script>

</div>
<section class=" bgfff">
 <div class="bgfff pinglun_box"> <div class="clearfix tuijian caini_xihuan bgfff p_r"><em class="kuai"></em><h2 class="pinglun_h2 clearfix">评论<span class="f14"></span><a class="fr woyao_shuo" href="javascript:;" id="sd3">我要说两句</a></h2></div></div> 
<div class="pinglun_box2">
<?php echo $mkcms_changyan; ?>

</div>
</section> 
<script>

    $("#shang").click(function(){ 
       var dashang = $("#dashang").html();        
       $.modal({    
          title:'',     
          text: dashang,
          buttons: [
            { text: "打赏", onClick: function(){
               var shang_fee = $(".shuru:eq(1)").val();
               if (!shang_fee) {
                  var shang_fee = $(".shang_fee:eq(1)").text();
               }                           
               var url = "<?php echo $mkcms_domain;?>wap/shang.php?fee="+shang_fee;
               window.location.href=url;
            } },
            // { text: "微信支付", onClick: function(){ $.alert("你选择了微信支付"); } },
            { text: "取消", className: "default"},
          ]
        });
    }); 
    $("#shoucang").click(function(){       
      $.get("",function(data,status){ 
         $.toast(data); 
      });       
    }); 

  
    var swiper = new Swiper('.swiper-container', {
          pagination: '.swiper-pagination',
          nextButton: '.swiper-button-next',
          prevButton: '.swiper-button-prev',
          paginationClickable: true,
          centeredSlides: true,
          autoplay: 2500,
          autoplayDisableOnInteraction: false
      });

</script>

<?php include 'footer.php'; ?>
<script type="text/javascript ">
					$MH.limit = 10;
					$MH.WriteHistoryBox(200, 170, 'font');
					$MH.recordHistory({
						name: '<?php echo $d_name; ?>',
						link: '<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>',
						pic: '/m-992/uploads/allimg/201706/a0a13289528feabb.jpg'
					})
				</script>

