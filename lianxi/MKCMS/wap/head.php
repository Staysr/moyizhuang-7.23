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
<link rel="stylesheet" href="<?php echo $mkcms_domain;?>wap/weui/swiper.min.css"/>
<!--JQ库-->
<script src="<?php echo $mkcms_domain;?>wap/weui/zepto.min.js"></script>
<script src="<?php echo $mkcms_domain;?>wap/style/js/li.js"></script>
<script src="<?php echo $mkcms_domain;?>wap/weui/iscroll.js"></script>
<script src="<?php echo $mkcms_domain;?>wap/weui/swiper.min.js"></script> 
<script type="text/javascript " src="<?php echo $mkcms_domain;?>style/js/history.js "></script>	
<script>
  $(function(){
    TagNav('#tagnav',{
        type: 'scrollToFirst',
    });
    $('.weui_tab').tab({
    defaultIndex: 0,
    activeClass:'weui_bar_item_on',
    onToggle:function(index){
    if(index>0){
    alert(index)
    }
    }
});
});     
</script>
<style type="text/css">
  .leimu_zui{width: auto}
  .weui-navigator-list li{font-weight: 500}
  .weui-navigator-list li.weui-state-hover, .weui-navigator-list li.weui-state-active a:after{background-color: none}
</style>
