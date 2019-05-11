<?php if(!defined('IN_DZZ')) exit('Access Denied'); /*a:6:{s:86:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./user/login/template/login_single1.htm";i:1536850350;s:101:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_start.htm";i:1536850350;s:99:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_end.htm";i:1536850350;s:90:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/seccheck.htm";i:1536850350;s:88:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./user/login/template/login_copyright.htm";i:1536850350;s:88:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/footer.htm";i:1536850350;}*/?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title><?php if(!empty($navtitle)) { ?><?php echo $navtitle;?> - <?php } ?><?php echo $_G['setting']['sitename'];?> </title>
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
<link rel="stylesheet" type="text/css" href="static/dzzicon/icon.css?<?php echo VERHASH;?>"/>
<link rel="stylesheet" href="static/popbox/popbox.css">
<script type="text/javascript" src="static/jquery/jquery.min.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript" src="static/jquery/jquery.json-2.4.min.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript">var DZZSCRIPT='<?php echo DZZSCRIPT;?>',LANG='<?php echo $_G['language'];?>', STATICURL = 'static/', IMGDIR = '<?php echo $_G['setting']['imgdir'];?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', dzz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>',attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>',  REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>', JSPATH = '<?php echo $_G['setting']['jspath'];?>',MOD_PATH='<?php echo MOD_PATH;?>',APP_URL='<?php echo MOD_URL;?>',MOD_URL='<?php echo MOD_URL;?>';</script>
<script type="text/javascript" src="./data/template/user_login_login_single1_header_zh-cn.js" ></script><script type="text/javascript" src="static/js/header.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript" src="static/popbox/jquery.popbox.js?<?php echo VERHASH;?>" ></script>
<!--[if lt IE 9]>
  <script src="static/bootstrap/js/html5shiv.min.js" ></script>
  <script src="static/bootstrap/js/respond.min.js" ></script>
<![endif]--><?php Hook::listen('header_tpl') ?> <script type="text/javascript">
 if(!!window.ActiveXObject || "ActiveXObject" in window){
 try{$.ajaxSetup({ cache: false });}catch(e){}
 window.MSIE=1;
 } 
</script>
<link href="static/css/common.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<link href="static/css/checkbox.css?<?php echo VERHASH;?>" rel="stylesheet">
<link href="user/login/images/login_single1.css?<?php echo VERHASH;?>" rel="stylesheet" />
<!--[if lt IE 9]>
  <script src="static/js/jquery.placeholder.js"  type="text/javascript"></script>
<![endif]-->
<script type="text/javascript" src="./data/template/user_login_login_single1_login_zh-cn.js" ></script><script type="text/javascript" src="user/scripts/login.js?<?php echo VERHASH;?>" ></script><script type="text/javascript" src="./data/template/user_login_login_single1_common_zh-cn.js" ></script><script type="text/javascript" src="static/js/common.js?<?php echo VERHASH;?>" ></script>
</head>
<body id="nv_<?php echo $_G['basescript'];?>" class="<?php echo $bodyClass;?>" >
<div id="append_parent" style="z-index:99999;"></div>
<div id="ajaxwaitid" style="z-index:99999;"></div><?php $loginhash = 'L'.random(4);?><!--背景层-->
<div id="wrapper_div" style="width: 100%;height:100%;  position: absolute; top: 0px; left: 0px; margin: 0px; padding: 0px; overflow: hidden;z-index:0;  font-size: 0px; background:<?php echo $_G['setting']['loginset']['bcolor']?$_G['setting']['loginset']['bcolor']:'#566481';?>;"> 
<?php if($_G['setting']['loginset']['img']) { ?>
<img src="<?php echo $_G['setting']['loginset']['img'];?>" name="imgbg" id="imgbg" style="right: 0px; bottom: 0px; top: 0px; left: 0px; z-index:10;margin:0;padding:0;overflow:hidden; position: absolute;width:100%;height:100%" height="100%" width="100%">
<?php } ?>
    <?php if($_G['setting']['loginset']['url']) { ?>
    <iframe id="wrapper_frame" name="wrapper_frame" src="<?php echo $_G['setting']['loginset']['url'];?>" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="100%" allowtransparency="true" style="z-index:20;position:absolute;width:100%;height:100%;background:url(dzz/images/b.gif);"></iframe>
    <?php } ?>
</div>

<div class="mainContainer" id="main_message">
<div class="modal-content">
 <div class="brand"> <img src="<?php echo $_G['setting']['sitelogo']?'index.php?mod=io&op=thumbnail&size=small&path='.dzzencode('attach::'.$_G['setting']['sitelogo']):'static/image/common/logo.png';?>" /> </div>
<?php if($_G['setting']['loginset']['title']) { ?>
<div class="main-title"><?php echo $_G['setting']['loginset']['title'];?></div>
<?php } ?> 
<?php if($_G['setting']['loginset']['subtitle']) { ?>
<div class="sub-title"><?php echo $_G['setting']['loginset']['subtitle'];?></div>
<?php } if($_G['setting']['bbclosed']) { ?>
<div class="text-danger">站点关闭中，请联系管理员</div>
<?php } ?>

<form method="post"  name="login" id="loginform_<?php echo $loginhash;?>" class="loginForm" role="form" onsubmit="<?php if($this->setting['pwdsafety']) { ?>pwmd5('password3_<?php echo $loginhash;?>');<?php } ?>pwdclear = 1; loginsub('loginform_<?php echo $loginhash;?>', 'returnmessage_<?php echo $loginhash;?>');return false;"  action="user.php?mod=login&amp;op=logging&amp;action=login&amp;loginsubmit=yes<?php if(!empty($_GET['handlekey'])) { ?>&amp;handlekey=<?php echo $_GET['handlekey'];?><?php } if(isset($_GET['frommessage'])) { ?>&amp;frommessage<?php } ?>&amp;loginhash=<?php echo $loginhash;?>">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="referer" value="<?php echo $referer;?>" />
<?php if($auth) { ?>
<input type="hidden" name="auth" value="<?php echo $auth;?>" />
<?php } else { ?> 
<div class="form-group">
<input type="text" class="form-control" id="email_<?php echo $loginhash;?>" placeholder="邮箱或用户名" name="email"  autocomplete="off">
</div>
<div class="form-group">
<input type="text" class="form-control" id="password3_<?php echo $loginhash;?>" placeholder="登录密码" name="password" onfocus="this.type='password'" autocomplete="off">
</div>
<?php } ?>


   <?php if($seccodecheck) { ?>
  <div class="form-group seccode-wrapper clearfix"> <?php $_G['sechashi'] = !empty($_G['cookie']['sechashi']) ? $_G['sechash'] + 1 : 0;
$sechash = 'S'.($_G['inajax'] ? 'A' : '').$_G['sid'].$_G['sechashi'];
$sectpl = !empty($sectpl) ? explode("<sec>", $sectpl) : array('',': ','','');
$sectpldefault = $sectpl;
$sectplqaa = str_replace('<hash>', 'qaa'.$sechash, $sectpldefault);
$sectplcode = str_replace('<hash>', 'code'.$sechash, $sectpldefault);
$secshow = !isset($secshow) ? 1 : $secshow;
$sectabindex = !isset($sectabindex) ? 1 : $sectabindex;?><?php
$seccheckhtml = <<<EOF

<input name="sechash" type="hidden" value="{$sechash}" />

EOF;
 if($sectpl) { if($seccodecheck) { 
$seccheckhtml .= <<<EOF

   			<div class="seccode-wrapper seccode_type_{$_G['setting']['seccodedata']['type']}">
    			<div class="input-group seccode-input">
                  <input name="seccodeverify" class="form-control" id="seccodeverify_{$sechash}" type="text" autocomplete="off" style="
EOF;
 if($_G['setting']['seccodedata']['type'] != 1) { 
$seccheckhtml .= <<<EOF
ime-mode:disabled;
EOF;
 } 
$seccheckhtml .= <<<EOF
"  onblur="checksec('code', '{$sechash}')"  placeholder="验证码" />
<span class="input-group-addon" id="checkseccodeverify_{$sechash}"></span>
                </div> 
                <div  class="seccode-show" >
{$sectplcode['2']}
<span id="seccode_{$sechash}"></span>
<a tabindex="-1" href="javascript:;" onclick="updateseccode('{$sechash}');doane(event);" class="seccode-refresh-guide"><span class="dzz dzz-refresh"></span></a>

EOF;
 if($secshow) { 
$seccheckhtml .= <<<EOF
<script type="text/javascript" reload="1">updateseccode('{$sechash}');</script>
EOF;
 } 
$seccheckhtml .= <<<EOF

{$sectplcode['3']}
                </div>
<span class="help-msg"></span>
</div>    


EOF;
 } } 
$seccheckhtml .= <<<EOF


EOF;
?><?php unset($secshow);?><?php if(empty($secreturn)) { ?><?php echo $seccheckhtml;?><?php } ?> 
  </div>
  <?php } ?>
  <div class="form-group  clearfix">
<div class="checkbox-custom checkbox-primary pull-left">
  <input type="checkbox" name="cookietime" id="cookietime_<?php echo $loginhash;?>" value="2592000" <?php echo $cookietimecheck;?> />
  <label for="cookietime_<?php echo $loginhash;?>">30天内自动登录</label>
</div>
<?php if($_G['setting']['regstatus']>0) { ?> 
<a  class="pull-right"  href="user.php?mod=register&amp;referer=<?php echo urlencode($referer);?>"  <?php if(!empty($_GET['inajax'])) { ?>onclick="_login.register(<?php echo $referer;?>);return false;"<?php } ?> title="<?php echo $_G['setting']['reglinkname'];?>"><?php echo $_G['setting']['reglinkname'];?></a> 
<span class="spacer  pull-right">|</span> 
<?php } ?> 
<a class="pull-right"  href="user.php?mod=login&amp;op=logging&amp;action=lostpasswd">找回密码</a> </div>
<div class="third-wrapper clearfix"><?php Hook::listen('third_login') ?></div>
  <p class="error-msg text-danger" id="returnmessage_<?php echo $loginhash;?>"></p>
  <button class="btn btn-lg btn-primary btn-block" type="submit" name="loginsubmit" value="true">登&nbsp;&nbsp;&nbsp;录</button>
</form>
<div class="copyright-container"><footer class="page-copyright page-copyright-inverse">
<p>Powered By <a href="http://www.dzzoffice.com" target="_blank" >DzzOffice</a>&nbsp;<?php echo CORE_VERSION?></p>
<?php if($_G['setting']['sitebeian']) { ?>
<p><?php echo $_G['setting']['sitebeian'];?></p>
<?php } ?>
</footer></div>
</div>
</div>
<div class="nfl" id="main_succeed" style="display: none;text-align: center;">
<div class="modal-body">
  		<div class="alert_right" style="display: inline-block;">
    		<div id="succeedmessage"></div>
    		<div id="succeedlocation" class="alert_btnleft"></div>
    		<p class="alert_btnleft"><a id="succeedmessage_href" href="javascript:;">如果您的浏览器没有自动跳转，请点击此链接</a></p>
  		</div>
</div>
</div>
<?php if($_G['setting']['pwdsafety']) { ?> 
<script type="text/javascript" src="user/scripts/md5.js?<?php echo VERHASH;?>"  reload="1"></script> 
<?php } ?> 
<script type="text/javascript">

var pwdclear = 1;
function initinput_login() {
document.body.focus();
<?php if(!$auth) { ?>
if(document.getElementById('loginform_<?php echo $loginhash;?>')) {
document.getElementById('loginform_<?php echo $loginhash;?>').email.focus();
}
<?php } ?>
}

function clearpwd(self) {
self.type='password';
if(pwdclear) {
document.getElementById('password3_<?php echo $loginhash;?>').value = '';
}
pwdclear = 0;
}

jQuery(document).ready(function(e) {
initinput_login();
if(jQuery('.ie8,.ie9').length){ //ie8模拟placeholder;
jQuery(':input[placeholder]').each(function(){
jQuery(this).placeholder();
});
}
});

</script> 

<script src="static/bootstrap/js/bootstrap.min.js?<?php echo VERHASH;?>" ></script> <?php updatesession();?><?php if(debuginfo()) { ?>
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
