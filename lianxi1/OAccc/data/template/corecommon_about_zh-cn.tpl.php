<?php if(!defined('IN_DZZ')) exit('Access Denied'); /*a:3:{s:87:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/about.htm";i:1536850350;s:93:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_ajax.htm";i:1536850350;s:93:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/footer_ajax.htm";i:1536850350;}*/?>
<?php ob_end_clean();
ob_start();
@header("Expires: -1");
@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
@header("Pragma: no-cache");
@header("Content-type: text/xml; charset=".CHARSET);
echo '<?xml version="1.0" encoding="'.CHARSET.'"?>'."\r\n";?><root><![CDATA[<div class="modal-header about-header <?php if(empty($about['sitelogo'])) { ?>about-header-noborder<?php } ?>">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span class="dzz dzz-close"></span>
</button>
<?php if($about['sitelogo']) { ?>
<h4 class="modal-title about-title">
<img class="img-sitelogo" src="<?php echo $about['sitelogo'];?>"><span class="sitename"><b>Dzz</b>Office</span>

</h4>
<?php } ?>
</div>
<div class="modal-body about-body">
        <p class="logo">
       	  <img src="<?php echo $about['logo'];?>" />
</p>
   		<p class="name">
   		<?php if($about['name_zh']) { ?>
<span class="name-zh"><?php echo $about['name_zh'];?></span>
   		<?php } ?>
   		<?php if($about['name_en']) { ?>
<span class="name-en"><b>Dzz</b><?php echo $about['name_en'];?></span>
   		<?php } ?>
   		
</p>
<div class="detail">
<?php if($about['version']) { ?>
<p class="version">
<span class="guide">当前版本:</span> 社区版 <?php echo $about['version'];?>
</p>
<?php } ?>
<p class="license">
<span class="guide">授权协议:</span> <a href="http://www.gnu.org/licenses/agpl-3.0.html" target="_blank">AGPL V3 开源协议</a>
  </p>
<p class="support">
<span class="guide">服务支持:</span> <a href="http://www.dzzoffice.com" target="_blank">www.dzzoffice.com</a>
</p>
  </div>
</div>
     <div class="about-copyright">Copyright ©2012-<?php echo dgmdate(TIMESTAMP,'Y');?> <a href="http://www.dzzoffice.com" target="_blank" >DzzOffice</a>&nbsp; All Rights Reserved</div>
   <?php echo output_ajax(); ?>]]></root><?php exit;?>