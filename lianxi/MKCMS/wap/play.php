<?php include('../system/inc.php');
include('../system/playurl.php');
if ($mkcmstyle=='m'){
$movie='class="weui-state-active"';
}
if ($mkcmstyle=='tv'){
$tv='class="weui-state-active"';
}
if ($mkcmstyle=='ct'){
$dm='class="weui-state-active"';
}
if ($mkcmstyle=='va'){
$zy='class="weui-state-active"';
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
<?php  include 'head.php';?>
<title><?php echo $timu; ?>-正在播放-<?php echo $mkcms_seoname;?></title>
<meta name="keywords" content="<?php echo $timu; ?>,<?php echo $mkcms_keywords;?>">
<meta name="description" content="<?php echo $timu; ?>,<?php echo $mkcms_description;?>">
<style type="text/css">
  .weui-navigator-list li{font-weight: 500}
  .weui-navigator-list li.weui-state-hover, .weui-navigator-list li.weui-state-active a:after{background-color: none} 
  .weui_toast{} 
  .yugao{position: absolute;display: block; z-index: 10;width: 16px;height: 16px;top: -4px;right: -4px;background: url(http://cs.aiflg.cn/addons/hmyx_vip/style/images/yugao.png) no-repeat;}
#timer{background: rgba(0, 0, 0, 0.59);padding: 5px;text-align: center;width: 30px;position: absolute;top:4px;right: 4px;color: #fff;font-size: 16px;border-radius: 50%;height: 30px;line-height: 20px}
#xiang{background: rgba(177, 13, 13, 0.87);padding: 5px;text-align: center;width: auto;position: absolute;bottom: 2%;right: 1%;color: #fff;font-size: 16px;border-radius: 10px;height: 20px;line-height: 9px}
#ys { background: deepskyblue;color: black; }
.jkbtn{
border-bottom:#9fc732 0.03rem solid;color: black;
        }
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
        $("#shiping_box").html('<iframe id="video" src="<?php
if (empty($panduan) && empty($panduan1)) {
	 $dyurl = str_replace('http://cps.youku.com/redirect.html?id=0000028f&url=', '', "$c[0]");
	echo"$mjk$dyurl";
}

 else{
	 if(!empty($b[0])){echo "$mjk$b[0]";}
	 
	 else{
		 echo"$mjk$zyvi[1]";
		 }
	 }
	 ?>"  allowfullscreen="true" allowtransparency="true" style="width:100%;border:none;height:210px"></iframe>');  
    }
    //五秒钟后自动收起
    var t = setTimeout(adsUp,<?php echo $mkcms_miaoshu*1000;?>); 
    
</script>

<section class="sanguo_box bgfff">
 
  <div class="jishu_y9">
    <ul class="clearfix">     
      <li  id="xuji">正在为您播放-<?php echo $timu; ?><span class="js"></span></li>  
      
    </ul>
  </div>
<div class="fr lianjie_box_y9">  <a href="javascript:;" onclick="$('.weui-share').show().addClass('fadeIn');"><em class="icon icon-3" style="margin-right: 10px"></em></a>  
<a href="<?php echo $mkcms_domain;?>wap/addfav.php?title=<?php echo $timu; ?>&dizhi=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>"><em class="icon icon-48" style="font-size: 19px;"></em></a> </div>
</section>

<section class="gonggao_box clearfix">
 <span style="font-size: 10px;color: #ff4306">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注意：若播放失败请切换 【来源】 或者 【路线】 ↓↓</span>
<div class="jishu_y9 gonggao_box2 " style="margin-bottom: 3px;">
  <span style="line-height: 27px;
    padding: 0 0.05rem;
    background: #9fc732;
    color: #FFF;
    border-radius: 0.03rem;
    margin-top: 0.1rem;
	margin-right: 0.16rem;
    display: inline-block;
    font-size: 0.2rem;float: left;" href="javascript:;">线路</span>
    <ul class="clearfix" id="xlus">
<?php if($mjk!=""){ ?><li style="margin-right:2px;"><a onClick="xldata(this)" data-jk="<?php echo $mjk; ?>">默认</a></li><?php } ?>  
<?php

$jkjk=explode("\r\n",$mkcms_jiekou);
for($k=0;$k<count($jkjk);$k++){
$jkjk[$k]=explode('$',$jkjk[$k]);
echo '<li style="margin-right:2px;"><a onclick="xldata(this)" data-jk="'.$jkjk[$k][1].'">'.$jkjk[$k][0].'</a></li>  ';
}
?>


	        </ul>
	
  </div>
</section>

<div class="weui-share" onclick="$(this).fadeOut();$(this).removeClass('fadeOut')">
<div class="weui-share-box">
点击右上角发给朋友<i></i> 
</div>
</div>
<style type="text/css">
  .jishi_box2 ul li:nth-child(5n){ margin-right:0;} 
</style>
<section class="jishi_box_y9 p_r">
  <?php
if (empty($panduan) && empty($panduan1)) {
	echo '<div class="jishi_box2">
  <ul class="clearfix">';
	foreach ($c as $kk => $vod) {
    $dyurl = str_replace('http://cps.youku.com/redirect.html?id=0000028f&url=', '', "$vod");
	$dyname = str_replace('(付费)', '', "$d[$kk]");
		//echo $much++;
		//echo $video.'<br/>';
		//echo $key.'<br/>';
		echo "<li><a href='$dyurl' id=''>";
		echo "$dyname</a></li>";
	}
echo '</ul></div>
';
} else {
	$i=0;

	foreach ($yuan as $vv => $ly) {

		//echo $much++;
		//echo $video.'<br/>';
		//echo $key.'<br/>';
echo '<div class="weui-flex js-category" >
    <a class="weui-flex-item" style="margin-top: 18px;">';
echo unicode_decode("$yuanname[$vv]");
echo '</a>

</div><div class="jishi_box2';
if ($i==0){	
echo ' js-show">';
}
else{	
echo '">';
}	
  echo '<ul class="clearfix">';

 $site = $ly;
  $id=$mkcmsid;
  if ($mkcmstyle==tv){
  $category="2";
  }
  else{
 $category="4";
	  }
  $url = "http://www.360kan.com/cover/switchsite?site=".$site."&id=".$id."&category=".$category;
  $html = file_get_contents($url);
  $data=json_decode($html);
  
 $tvzz='#<div class="num-tab-main g-clear\s*js-tab"\s*(style="display:none;")?>[\s\S]+?<a data-num="(.*?)" data-daochu="to=(.*?)" href="(.*?)">[\s\S]+?</div>#';
   $tvzz1 = '#<a data-num="(.*?)" data-daochu="to=(.*?)" href="(.*?)">#';
   preg_match_all($tvzz, $data, $tvarr);
   $zcf = implode($glue, $tvarr[0]);
  preg_match_all($tvzz1,  $zcf, $tvarr);
  $b = $tvarr1[3];
  $yeshu=$tvarr1[1];

	foreach ($b as $yy => $tvurl) {
		echo "<li><a data-num='$yeshu[$yy]' href='$b[$yy]' class='btn-play-source' style='position: relative;'>";
		echo '第'.$yeshu[$yy].'集';
		$yugao=explode('http://v.360kan.com/',$b[$yy]);
		for($k=0;$k<count($yugao);$k++){
			if ($k>0){
		echo '<span class="yugao"></span></a>';	
		}}
echo '</li>';	
	}

echo '</ul></div>';
$i ++;}

	if (!empty($panduan1)) 
		
	echo '<div class="jishi_box2">
  <ul class="clearfix">';
foreach ($zyvi as $keya=>$tvideoa){
 			
		echo "<a data-num='$noqi[$keya]' href='$tvideoa' class='btn-play-source' style='width:48%;float:left'><img src='$zypic[$keya]' width=100%/><br>$noqi[$keya]<br>$zyname[$keya]</a>";
    	
		
		}
		echo '</ul></div>';
}
?>
</section> 

<script>
               $(function () {
	               $.each($('.jishi_box_y9.p_r'),function () {
		             var al = $('.jishi_box2 a');
	                al.attr('class','am-btn am-btn-default lipbtn');
	   });

                    $.each($('.lipbtn'),function () {
                        var url = $(this).attr('href');
                        $(this).attr('data-href',url);
                        $(this).attr('href','javascript:;');
                        $(this).attr('onclick','bofang(this)');
                    });
                    var biaoti = $('#xuji').text();
					var jk = $('#xlus a:eq(0)');
	                jk.attr('class','jkbtn');
                    var autourl = $('.lipbtn:eq(0)').attr('data-href');
                    $('.lipbtn:eq(0)').attr('id','ys');
                    var text = $('.lipbtn:eq(0)').text();
                    $('.js').text('-'+text+'');
                    var jiekou = $('#xlus').children('a:eq(0)').attr('data-jk');
                    if(autourl!=''||autourl!=null){
                        setTimeout(function () {
                            $('#video').attr('src', jiekou + autourl);
                        },0)
                    }
					    // 上一集
    
    $("#btn-pre").click(function() {
        $("#ys.lipbtn").prev().click();
    });
    
    // 下一集
    $("#btn-next").click(function() {
        $("#ys.lipbtn").next().click();
    });
	
	});
            </script>
            <script>
                function bofang(obj) {
                    var href = $(obj).attr('data-href');
                    var text = $(obj).text();
                    $('.js').text('-' + text+'');
                    $.each($('.lipbtn'), function () {
                        $(this).attr('id','');
                    });
                    $(obj).attr('id','ys');
                    var jiekou = $('.jkbtn').attr('data-jk');
                    if (href != '' || href != null) {
                        setTimeout(function () {
                            $('#video').attr('src', jiekou + href);
                        },0)
                    }
                }
                function xldata(obj) {
                    var url = $(obj).attr('data-jk');
                    $.each($('.jkbtn'), function () {
                        $(this).removeClass('jkbtn');
                    });
                    $(obj).addClass('jkbtn');
                    var src = $('#ys').attr('data-href');
                    $('#video').attr('src', url + src);
                }
		
			
            </script>
<?php echo get_ad(13)?>
<section class="jianjie_y9 bgfff clearfix">
<p class="jianjie_y9_p part"><?php echo $jian; ?>...</p>
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


<section class="">
 <div class="bgfff cainin_box"> <h2 class="clearfix tuijian caini_xihuan bgfff">猜你喜欢</h2></div> 
  <div class="dianying_box dianying_box3 clearfix p_r">
  <em class="jiao_icon"></em>
    <ul class="clearfix">
<?php $result = mysql_query('select * from mkcms_vod order by d_id desc LIMIT 0,12');
		while ($row = mysql_fetch_array($result)){
$cc="./bplay.php?play=";
								$dd="../../bplay/";
if ($mkcms_wei==1){
$ccb=$dd.$row['d_id'];
}
else{
$ccb=$cc.$row['d_id'];	
}
echo '<li><a href="'.$ccb.'"><img src="'.$row['d_picture'].'"></a>
        <!-- <p class="clearfix leimu"><span class="fl"></span><span class="fr"></span></p> -->
        <a href="'.$ccb.'"><span class="biaoti">'.$row['d_name'].'</span></a></li>
';     

		}?>			
		

      
    </ul>
  </div>
</section>


<section class=" bgfff">
 <div class="bgfff pinglun_box"> <div class="clearfix tuijian caini_xihuan bgfff p_r"><em class="kuai"></em><h2 class="pinglun_h2 clearfix">评论<a class="fr woyao_shuo" href="javascript:;" id="sd3">我要说两句</a></h2></div></div> 
<div class="pinglun_box2">
<ul id="list">
<?php echo $mkcms_changyan; ?>
</ul>

</div>
</section> 
<script>
    $(".change").click(function(){
        if($(this).hasClass("down")){
            $(this).removeClass("down").addClass("up");
            $(".all").show();
            $(".part").hide();
            $(".up").text('收起详情'); 
        }else{
            $(this).removeClass("up").addClass("down");
            $(".part").show();
            $(".all").hide();
            $(".down").text('展开详情'); 
        }
    });
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
<script type="text/javascript">
   wx.ready(function () {
        sharedata = {         
             title: '我正在收看<?php echo $timu; ?>',
            desc: '简介：<?php echo $jian; ?>',            
            imgUrl: '',            
                        success: function(){                           
            },
            cancel: function(){
            }
                    
        };
    wx.onMenuShareAppMessage(sharedata);
    wx.onMenuShareTimeline(sharedata);
    wx.onMenuShareQQ(sharedata);
    wx.onMenuShareWeibo(sharedata); 
  });
</script>


<?php include 'footer.php'; ?>
<script type="text/javascript ">
					$MH.limit = 10;
					$MH.WriteHistoryBox(200, 170, 'font');
					$MH.recordHistory({
						name: '<?php echo $timu; ?>',
						link: '<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>',
						pic: '/m-992/uploads/allimg/201706/a0a13289528feabb.jpg'
					})
				</script>
