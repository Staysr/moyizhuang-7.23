<?php if(!defined('IN_DZZ')) exit('Access Denied'); /*a:1:{s:81:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./dzz/system/template/app_ajax.htm";i:1536850350;}*/?>
<?php if($operation=='app') { ?>
    <div id="app_context" >
        <ul id="app_popup" class="app_popup">
        <?php if(is_array($applist_1)) foreach($applist_1 as $key => $value) { ?>        <?php if($key>11) continue;?>        	<li>
          <a class="app-popup-li" href="<?php echo $value['url'];?>" title="<?php echo $value['appname'];?>" <?php if($value['open']) { ?>target="_blank"<?php } ?>>
                <span class="app-popup-li-appico">
                    <img src="<?php echo $value['appico'];?>">
                </span>
                <span class="app-popup-li-appname">
                    <?php echo $value['appname'];?>
                </span>
</a>
         </li>
        <?php } ?>
        </ul>
        <ul id="app_popup1" class="app_popup" style="display: none;border-top:1px solid #EBEBEB;">
  
         <?php for($i=12;$i<count($applist_1);$i++){?>        <?php $value=$applist_1[$i];?>        	<li>
          <a class="app-popup-li" href="<?php echo $value['url'];?>" title="<?php echo $value['appname'];?>" <?php if($value['open']) { ?>target="_blank"<?php } ?>>
                <span class="app-popup-li-appico">
                    <img src="<?php echo $value['appico'];?>">
                </span>
                <span class="app-popup-li-appname">
                    <?php echo $value['appname'];?>
                </span>
</a>
         </li>
        <?php }?>        </ul>
       
        <a class="app-more <?php if(count($applist_1)<=12) { ?>hide<?php } ?>" href="javascript:;">更多应用</a>
        
    </div>  
<script type="text/javascript" reload="1">

jQuery('#app_context').off().on("mousewheel DOMMouseScroll", function (e) {
    var delta = (e.originalEvent.wheelDelta && (e.originalEvent.wheelDelta > 0 ? 1 : -1)) ||  // chrome & ie
                (e.originalEvent.detail && (e.originalEvent.detail > 0 ? -1 : 1));              // firefox
                
    if(jQuery('#app_popup1').find('li').length){
    	if (delta > 0) {
        // 向上滚
        if(jQuery('#app_context').scrollTop() < 150){
        	jQuery('#app_popup1').hide();
       	 	jQuery('#app_context .app-more').removeClass('hide');
        }
    } else if (delta < 0) {
        // 向下滚
        jQuery('#app_popup1').show();
        jQuery('#app_context .app-more').addClass('hide');
    }
    }

});
    
    jQuery('#app_context .app-more').off('click.app-more').on('click.app-more',function(){
    	jQuery('#app_popup1').show();
        jQuery('#app_context .app-more').addClass('hide');
        return false;
    }) 
</script><?php output();?><?php } ?>