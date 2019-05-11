<?php if(!defined('IN_DZZ')) exit('Access Denied'); /*a:1:{s:80:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./user/space/template/navmenu.htm";i:1536850350;}*/?>
<div class="popbox-body" style="padding:15px 18px;min-width:120px;">
<ul class="popbox-menu u-bottom list-unstyled">
<li>
<a href="javascript:;" onclick="showWindow('about','user.php?mod=space&op=about&modname=<?php echo $_GET['modname'];?>');">关于</a>
</li>
<?php if($_G['uid']>0) { ?>
<li>
<a href="user.php?mod=profile" target="_blank">用户中心</a>
</li>

<li>
<a href="javascript:;" onclick="_header.loging_close();">退出登录</a>
</li>
<?php } else { ?>
<li>
<a href="user.php?mod=login">登录</a>
</li>
<?php } ?>
</ul>
</div>