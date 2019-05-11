<script src="<?php echo $mkcms_domain;?>wap/weui/dropload.min.js"></script>
<!-- 轮播 效果 JS文件   -->
<section class="guanyin_box guanyin_box2">
  <div class="meiyou_box">
    <p class="zhanshi_p">最近十条观影记录</p>
    
    <div class="jilu_box">
     <ul class="clearfix">
	 <script type="text/javascript " src="<?php echo $mkcms_domain;?>style/js/history.js "></script>
       <script type="text/javascript ">
					$MH.limit = 10;
					$MH.WriteHistoryBox(400, 170, 'font');
					$MH.recordHistory({
						name: '',
						link: '',
						pic: ''
					})
				</script>   
     </ul>
    </div>   
  </div>
<div class="fanhui_box2 fanhui_box3">
<a class="fanhui_dianji" href="javascript:void(0)"><em class="close_2"></em></a>
</div>
</section>
<div id="api"></div> 
<section class="guanyin_box index_guanzhu" id="guanzhu" style="display: none">
  <div class="meiyou_box">
    <p class="zhanshi_p">长按二维码识别</p>
    <div class="dianying_box dianying_box2 clearfix" style="padding: 10%">
      <img src="<?php echo $mkcms_weixin;?>" width="100%">
    </div>
    <div class="jilu_box">
   
    </div>
  </div>
  <div class="fanhui_box2 fanhui_box3">
    <a class="fanhui_dianji" href="javascript:void(0)"><em class="close_3"></em></a>
  </div>
</section>
<!-- 轮播 效果 JS文件   -->
<script>      
     var swiper = new Swiper('.swiper-container', {
          pagination: '.swiper-pagination',
          // autoHeight: true,
          loop:true,
          autoplay: 2500, 
      });
     $("#shaixuan").click(function(){
        $(".lebiao_box").toggle();        
      });      
      $(".close_a").click(function(){
        $(".guanzhu_box").hide();
      });

      $(".tanchu").click(function(){
        $(".guanyin_box2").show();       
      });
      $(".fanhui_dianji").click(function(){
        $(".guanyin_box2").hide();
      });
      $(".guanzhu").click(function(){
        $("#guanzhu").show();
        $("body").scrollTop(1000); 
      }); 
      $(".close_3").click(function(){
        $("#guanzhu").hide(); 
        $("body").scrollTop(0);  
      });   
      $(".close").click(function(){
        $(".guanzhu_box").hide();       
      });   
      $('#clean').on('click',function(){
          $.post('./index.php?i=71&c=entry&do=clean&m=super_mov',function(data){ 
              alert(data);
          })
      });
</script> 
<div style="background: #f6f6f6;padding-top:60px;"></div>
<footer class="footer">
  <ul class="clearfix">
    <li>
      <a href="<?php echo $mkcms_domain;?>wap/vlist.php?cid=0"><em class="sopian"></em> 
      <p>尝鲜</p>
      </a>
    </li>
    <li>
      <a href="<?php echo $mkcms_domain;?>wap/zhibo.php"><em class="dianshi"></em> 
      <p>电视</p>
      </a>
    </li>    
    <li><a href="<?php echo $mkcms_domain;?>wap/"><em class="shexiang"></em></a></li>
    <li>
      <a href="<?php echo $mkcms_domain;?>wap/book.php"><em class="faxian"></em> 
      <p>求片</p>
      </a>
    </li>
    <li>
      <a href="<?php echo $mkcms_domain;?>wap/user.php"><em class="wode" ></em> 
      <p>我的</p> 
      </a>
    </li>     
  </ul>
</footer>
<div style="display: none">
<?php echo $mkcms_tongji;?>
</div>
</body>
</html>
