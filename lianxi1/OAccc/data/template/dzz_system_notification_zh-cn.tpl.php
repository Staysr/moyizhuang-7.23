<?php if(!defined('IN_DZZ')) exit('Access Denied'); /*a:1:{s:85:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./dzz/system/template/notification.htm";i:1536850350;}*/?>
<?php if($filter=='new') { ?>
    <div class="popbox-header text-center">
          <button class="close notice-close dzz dzz-close"></button>
        <h3>通知</h3>
      </div>
      <div class="popbox-body notification-list" style="min-width:300px;max-height:400px;overflow:auto;padding:0 10px">
        <?php if($list) { ?>
            <?php if(is_array($list)) foreach($list as $value) { ?>            <div class="notification-list-item clearfix">
                <?php if($value['avatarstatus']) { ?>
                <div class="member member-no-menu">
                    <img class="member-avatar" src="avatar.php?uid=<?php echo $value['authorid'];?>&amp;size=small" alt="<?php echo $value['author'];?>" title="<?php echo $value['author'];?>" style="width: 100%;">
                </div>
                <?php } else { ?>
                <div class="member member-no-menu">
                    <span class="member-initials" title="<?php echo $value['author'];?>"><?php echo substr(ucfirst($value[author]),0,1);?></span>
                </div>
                <?php } ?>
                <div class="details">
                  <p class="note u-bottom" ><?php echo $value['note'];?></p>
                  <p class="dateline u-bottom"><?php echo $value['dateline'];?></p>
                </div>
            </div>
            <?php } ?>
        <?php } else { ?>
        <p class="text-warning u-bottom" style="line-height:35px;">还没有通知</p>
        <?php } ?>
      </div>
     <div class="popbox-footer" style="border-top:1px solid #DDD;padding:10px 5px;margin:0 5px">
     	<a href="<?php echo DZZSCRIPT;?>?mod=system&op=notification" class="notification-all">查看所有通知</a>
     </div>    
<script type="text/javascript" reload="1">
try{_notice.showTips(0);}catch(e){}
</script>
<?php } ?>