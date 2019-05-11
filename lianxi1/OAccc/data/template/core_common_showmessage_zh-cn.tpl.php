<?php if(!defined('IN_DZZ')) exit('Access Denied'); /*a:5:{s:93:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/showmessage.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_common.htm";i:1536850350;s:93:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_ajax.htm";i:1536850350;s:88:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/footer.htm";i:1536850350;s:93:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/footer_ajax.htm";i:1536850350;}*/?>
<?php if(!$_G['inajax']) { ?><!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title><?php if(!empty($navtitle)) { ?><?php echo $navtitle;?> - <?php } if(!empty($_G['setting']['sitename'])) { ?> <?php echo $_G['setting']['sitename'];?> - <?php } ?></title>
<meta name="keywords" content="<?php if(!empty($_G['setting']['metakeywords'])) { echo htmlspecialchars($_G['setting']['metakeywords']); } ?>" />
<meta name="description" content="<?php if(!empty($_G['setting']['metadescription'])) { echo htmlspecialchars($_G['setting']['metadescription']); ?> <?php } ?>" />
<meta name="generator" content="DzzOffice" />
<meta name="author" content="DzzOffice" />
<meta name="copyright" content="2012-<?php echo dgmdate(TIMESTAMP,'Y-m-d');?> www.dzzoffice.com" />
    <meta name="MSSmartTagsPreventParsing" content="True" />
    <meta http-equiv="MSThemeCompatible" content="Yes" />
    <meta name="renderer" content="webkit">
<base href="<?php echo $_G['siteurl'];?>" />
     <link rel="stylesheet" type="text/css" href="static/bootstrap/css/bootstrap.min.css?<?php echo VERHASH;?>">
     <link rel="stylesheet" type="text/css" href="static/css/app_manage.css?<?php echo VERHASH;?>">
<script type="text/javascript" src="static/jquery/jquery.min.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript" src="static/jquery/jquery.json-2.4.min.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript">var DZZSCRIPT='<?php echo DZZSCRIPT;?>',LANG='<?php echo $_G['language'];?>', STATICURL = 'static/', IMGDIR = '<?php echo $_G['setting']['imgdir'];?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', dzz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>',attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>',  REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>', JSPATH = '<?php echo $_G['setting']['jspath'];?>',MOD_PATH='<?php echo MOD_PATH;?>',APP_URL='<?php echo MOD_URL;?>',MOD_URL='<?php echo MOD_URL;?>';</script>
<script type="text/javascript" src="./data/template/core_common_showmessage_common_zh-cn.js" ></script><script type="text/javascript" src="static/js/common.js?<?php echo VERHASH;?>" ></script>
    </head>
    <body id="nv_dzz" class="<?php echo $bodyClass;?>">
<div id="append_parent" style="z-index:99999;"></div><div id="ajaxwaitid" style="z-index:99999;"></div><div id="ct" class="container " style="position: absolute;top: 30%;width: 100%;text-align: center;">
<?php if(!$param['login']) { ?>
<div class="">
<?php } else { ?>
<div class="" id="main_succeed" style="max-width:500px;margin:0 auto;display: none">
<div class="f_c altw">
<div class="alert_right">
<h5 id="succeedmessage"></h5>
<p id="succeedlocation" class="alert_btnleft"></p>
<p class="alert_btnleft"><a id="succeedmessage_href">如果您的浏览器没有自动跳转，请点击此链接</a></p>
</div>
</div>
</div>
<div class="well" id="main_message">
             
<?php } } else { ob_end_clean();
ob_start();
@header("Expires: -1");
@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
@header("Pragma: no-cache");
@header("Content-type: text/xml; charset=".CHARSET);
echo '<?xml version="1.0" encoding="'.CHARSET.'"?>'."\r\n";?><root><![CDATA[<?php } if($param['msgtype'] == 1 || $param['msgtype'] == 2 && !$_G['inajax']) { ?>
<div class="f_c altw">
<div id="messagetext">
<?php if($alerttype == 'alert_right') { ?>
<img src="static/image/common/noFilePage-successful.png">
<?php } elseif($alerttype == 'alert_info') { ?>
<img src="static/image/common/noFilePage-fail.png">
<?php } ?>
<h5 style="color: #999999;"><?php echo $show_message;?></h5>
<?php if($url_forward) { if(!$param['redirectmsg']) { ?>
<button class="btn-jump btn btn-primary" onclick="location.href='<?php echo $url_forward;?>';return false;" >立即跳转（<span class="num">3</span>s）</button>
<?php } else { ?>
<button class="btn-jump btn btn-primary" onclick="location.href='<?php echo $url_forward;?>';return false;">返回上一级（<span class="num">3</span>s）</button>
<!--<p class="alert_btnleft"><a href="<?php echo $url_forward;?>">如果 <?php echo $refreshsecond;?> 秒后下载仍未开始，请点击此链接</a></p>-->
<?php } } elseif($allowreturn) { ?>
<script type="text/javascript">
if(history.length > (BROWSER.ie ? 0 : 1)) {
document.write('<p class="alert_btnleft"><a href="javascript:history.back()">[ 点击这里返回上一页 ]</a></p>');
} else {
document.write('<p class="alert_btnleft"><a href="./">[ <?php echo $_G['setting']['bbname'];?> 首页 ]</a></p>');
}

</script>
<?php } ?>
</div>
<?php if($param['login']) { } ?>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
function jump(cont){						
window.setTimeout(function(){
cont--;
if(cont>0){
$('.num').text(cont);
jump(cont);
}
},1000)
}
jump(3);
});
</script>
<?php } elseif($param['msgtype'] == 2) { ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">提示信息</h4>
        </div>
        <div class="modal-body">
<div class="<?php echo $alerttype;?>"><?php echo $show_message;?></div>
        </div>
<div class="modal-footer">
<?php if($param['closetime']) { ?>
<span class="btn btn-link text-muted"><?php echo $param['closetime'];?> 秒后窗口关闭</span>
<?php } elseif($param['locationtime']) { ?>
<span class="btn btn-link text-muted"><?php echo $param['locationtime'];?> 秒后页面跳转</span>
<?php } if($param['login']) { ?>
<button type="button" class="btn btn-info" onclick="hideWindow('<?php echo $_GET['handlekey'];?>');showWindow('login', 'user.php?mod=login&action=login');"><strong>登录</strong></button>
<?php if(!$_G['setting']['bbclosed']) { ?>
<button type="button" class="btn btn-info" onclick="hideWindow('<?php echo $_GET['handlekey'];?>');window.open('user.php?mod=rigister');"><em><?php echo $_G['setting']['reglinkname'];?></em></button>
<?php } } ?>
            <button type="button"  data-dismiss="modal" class="btn btn-default"><strong>关闭</strong></button>
</div>
<?php } else { ?><?php echo $show_message;?><?php } if(!$_G['inajax']) { ?>
</div>
</div><?php updatesession();?><?php if(debuginfo()) { ?>
<script type="text/javascript">
try{
if(console && console.log){
console.log('Processed in <?php echo $_G['debuginfo']['time'];?> second(s), <?php echo $_G['debuginfo']['queries'];?> queries <?php if($_G['gzipcompress']) { ?>, Gzip On<?php } if(C::memory()->type) { ?>, <?php echo ucwords(C::memory()->type); ?> On<?php } ?>.');
}
}catch(e){}
</script>
<?php } ?>	
<?php if(!$_G['setting']['bbclosed']) { if(!isset($_G['cookie']['sendmail'])) { ?>
<script type="text/javascript" src="misc.php?mod=sendmail&rand=<?php echo $_G['timestamp'];?>" ></script>
<?php } ?>
    <script type="text/javascript" src="misc.php?mod=sendwx&rand=<?php echo $_G['timestamp'];?>" ></script> 
<?php } if($_G['uid'] && $_G['adminid'] == 1) { if(!isset($_G['cookie']['checkupgrade'])) { ?>
<script type="text/javascript">jQuery.getScript('misc.php?mod=upgrade&action=checkupgrade&rand=<?php echo $_G['timestamp'];?>');</script>
<?php } if(!isset($_G['cookie']['checkappupgrade'])) { ?>
<script type="text/javascript">jQuery.getScript('misc.php?mod=upgrade&action=checkappupgrade&rand=<?php echo $_G['timestamp'];?>');</script>
<?php } if(!isset($_G['cookie']['upgradenotice'] )) { ?>
<script type="text/javascript">
jQuery(document).ready(function(){
try{jQuery('#systemNotice').load('misc.php?mod=upgrade&action=upgradenotice');}catch(e){};	
});
</script>
<div id="systemNotice" class="systemNotice" style="position: fixed;right:10px;bottom:10px;max-width:50%;box-shadow:0px 5px 10px RGBA(0,0,0,0.3);z-index:999999"></div>
<?php } } if($_G['setting']['statcode']) { ?>
<?php echo $_G['setting']['statcode'];?>
<?php } ?>	
</body>
</html>
<?php } else { echo output_ajax(); ?>]]></root><?php exit;?><?php } ?>
