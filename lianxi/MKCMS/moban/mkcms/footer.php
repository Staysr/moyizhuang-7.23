<div class="hy-gototop hidden-sm hidden-xs">
   <ul class="item clearfix">
    <li><a href="<?php echo $mkcms_domain;?>ucenter" title="会员中心"><i class="icon iconfont icon-tubiaozhizuomobanyihuifu-"></i></a></li>
    <li><a href="<?php echo $mkcms_domain;?>book.php" title="留言求片"><i class="icon iconfont icon-qiu"></i></a></li>
	<li><a href="javascript:()" title="观看记录"><i class="icon iconfont icon-icon-"></i></a><div class="history clearfix" style="width:200px">
				<div class="head">
					<h5 class="margin-0 text-muted">观看历史</h5>
				</div>
<?php if ($timu!=""){?>
<script type="text/javascript ">
					$MH.limit = 5;
					$MH.WriteHistoryBox(200, 170, 'font');
					$MH.recordHistory({
						name: '<?php echo $timu; ?>',
						link: '<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>',
						pic: ''
					})
				</script>
<?php }elseif ($d_name!=""){?>
<script type="text/javascript ">
					$MH.limit = 5;
					$MH.WriteHistoryBox(200, 170, 'font');
					$MH.recordHistory({
						name: '<?php echo $d_name; ?>',
						link: '<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>',
						pic: ''
					})
				</script>
<?php }else {?>
<script type="text/javascript ">
					$MH.limit = 5;
					$MH.WriteHistoryBox(200, 170, 'font');
					$MH.recordHistory({
						name: '',
						link: '',
						pic: ''
					})
				</script>
<?php }?>

			</div>	</li>		
    <li><a class="" href="javascript:#" title="扫码手机观看" onclick="ewm()" style="z-index:9999999;"><i class="icon iconfont icon-erweima"></i></a></li>
    <li><a data-toggle="tooltip" data-placement="top" class="" href="javascript:scroll(0,0)" title="TOP"><i class="icon iconfont icon-top02"></i></a></li>   </ul>
  </div>
<div class="tabbar visible-xs">
		<a href="<?php echo $mkcms_domain;?>" class="item ">
        <i class="icon iconfont icon-shouye"></i>
        <p class="text">首页</p>
    </a>
	<a href="<?php echo $mkcms_domain;?>movie.php" class="item ">
        <i class="icon iconfont icon-caidanicondianyinghui"></i>
        <p class="text">电影</p>
    </a><a href="<?php echo $mkcms_domain;?>tv.php" class="item ">
        <i class="icon iconfont icon-tv_icon"></i>
        <p class="text">电视剧</p>
    </a><a href="<?php echo $mkcms_domain;?>dongman.php" class="item ">
        <i class="icon iconfont icon-liebiaodaohang_dongman"></i>
        <p class="text">动漫</p>
    </a><a href="<?php echo $mkcms_domain;?>zongyi.php" class="item ">
        <i class="icon iconfont icon-jiemu"></i>
        <p class="text">综艺</p>
    </a>    </div>
	<div style="position:fixed;width:300px;height:350px;top:50%;left:0%;margin-left:-150px;margin-top:-175px;display: none;z-index: 9999999;" id="gbewm" onclick="ewmgb()">
	<div style="text-align:center;line-height: 50px;background-color: #2db2ea;color: #fff;font-size: 20px;font-weight: bold;border-radius: 5px 5px 0px 0px;">扫码二维码，手机观看！</div>
	<img src="https://i.loli.net/2018/01/19/5a617da73ac6a.png" id="ewmtp" style="width: 300px;height: 300px;border-radius: 0px 0px 5px 5px;"/>
</div>
<div class="row" style="margin-top:10px"></div>
		 <div class="hy-layout hidden-xs" style="border-top: 2px solid #204060;">
	         <div class="hy-footer-link">
	             <div class="item clearfix">
	                 <p style="padding: 0 4px;text-align:center" class="container-fluid"><?php echo $mkcms_copyright;?><?php echo $mkcms_tongji;?></p>
				 </div>
			 </div>
	     </div>
<script type="text/javascript" charset="utf-8">
    $(function() {
        $(".videopic.lazy").lazyload({effect: "fadeIn"});  
        $("[data-toggle='tooltip']").tooltip();
    });
	function ewm(){
		var url = "http://qr.liantu.com/api.php?text="+window.location.href;
		$("#ewmtp").attr('src',url);
		$("#gbewm").css("display","block");
		$("#gbewm").animate({left:'50%'});
	}
	function ewmgb(){
		$("#gbewm").animate({left:'100%'});
		$("#gbewm").css("display","none");
	}
</script>	
<div style="display:none;">
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?1b228034eab3f86498adfd4e9d337209";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</div>
</body>
</html>
