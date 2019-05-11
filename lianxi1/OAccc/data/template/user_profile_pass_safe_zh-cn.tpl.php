<?php if(!defined('IN_DZZ')) exit('Access Denied'); /*a:12:{s:84:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./user/profile/template/pass_safe.htm";i:1536850350;s:101:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_start.htm";i:1536850350;s:99:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_end.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/commer_header.htm";i:1536850350;s:93:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_left.htm";i:1536850350;s:0:"";b:0;s:94:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_right.htm";i:1536850350;s:79:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./user/profile/template/left.htm";i:1536850350;s:83:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./user/profile/template/editpass.htm";i:1536850350;s:90:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/seccheck.htm";i:1536850350;s:86:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./user/profile/template/changeemail.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/footer_simple.htm";i:1536850350;}*/?>
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
<script type="text/javascript" src="./data/template/user_profile_pass_safe_header_zh-cn.js" ></script><script type="text/javascript" src="static/js/header.js?<?php echo VERHASH;?>" ></script>
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
<link href="<?php echo MOD_PATH;?>/css/passsafe.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<script type="text/javascript" src="./data/template/user_profile_pass_safe_register_zh-cn.js" ></script><script src="user/scripts/register.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript" src="static/js/jquery.leftDrager.js?<?php echo VERHASH;?>" ></script>
<style>
    .main-content{padding-top:30px;}
</style><script type="text/javascript" src="./data/template/user_profile_pass_safe_common_zh-cn.js" ></script><script type="text/javascript" src="static/js/common.js?<?php echo VERHASH;?>" ></script>
</head>
<body id="nv_<?php echo $_G['basescript'];?>" class="<?php echo $bodyClass;?>" >
<div id="append_parent" style="z-index:99999;"></div>
<div id="ajaxwaitid" style="z-index:99999;"></div>
<nav class="navbar navbar-inverse resNav bs-top-container" >
<div class="resNav-item resNav-left">     
    <ul class="nav navbar-nav navbar-nav-left">
    <li>
        <a href="javascript:;" class="leftTopmenu" onclick="_header.leftTopmenu(this)" style="padding-left:24px;padding-right:17px;">
            <span class="dzz dzz-menu"></span>
        </a>
    </li>
    <li>
        <a href="<?php echo $_G['siteurl'];?>"><?php echo $_G['setting']['sitename'];?></a>
    </li>
</ul>    </div>
    <div class="resNav-item resNav-center">    </div>
     <div class="resNav-item resNav-right">
     <ul class="nav navbar-nav">
<li>
<a href="javascript:;">
<span class="navbar-borderleft"></span>
</a>
</li>
<li class="app_popup-parent">

<a href="javascript:;" id="desktop_app" data-href="index.php?mod=system&amp;op=app_ajax&amp;operation=app" class="app_popup_icon js-popbox" data-placement="bottom" data-trigger="focus" data-auto-adapt="true" data-toggle="popover"><span class="dzz dzz-apps basil"></span></a>
</li>
<li>
<a href="javascript:;" id="dzz_notification" data-href="index.php?mod=system&amp;op=notification&amp;filter=new" class="navbar-notice js-popbox" data-placement="bottom" data-trigger="focus" data-auto-adapt="true" data-toggle="popover">
<span class="dzz dzz-notifications"></span>
<span class="badge hide">&nbsp;</span>
</a>
</li>
<li>
<a href="javascript:;" class="imgHeight js-popbox" data-href="user.php?mod=space&amp;op=navmenu&amp;modname=<?php echo MOD_NAME;?>" data-placement="bottom" data-trigger="focus" data-auto-adapt="true" data-toggle="popover"><?php echo avatar_block($_G[uid]);?></a>
</li>
</ul></div>
</nav>


<script type="text/javascript">
jQuery(document).ready(function(e) {
    _header.init('<?php echo FORMHASH;?>');//初始化头部效果
    //_header.Topcolor();
//_notice.init();
jQuery(".resNav .js-popbox").each(function(){
jQuery(this).popbox();
});
_notice.getNotificationCount();
});
_notice={};
_notice.flashStep=1;
_notice.checkurl='index.php?mod=system&op=notification&filter=checknew';
_notice.normalTitle= document.title;
_notice.getNotificationCount=function(){
jQuery.getJSON(_notice.checkurl,function(json){
var sum=parseInt(json.sum);
_notice.showTips(sum);
if(json.timeout>0) window.setTimeout(_notice.getNotificationCount,json.timeout);
});
}
_notice.showTips=function(sum){
if(sum>0){
jQuery('#dzz_notification>span.badge').html(sum).removeClass('hide');
jQuery('#dzz_notification>span.dzz').hide();
//_notice.flashTitle();
}else{
jQuery('#dzz_notification>span.badge').addClass('hide');
jQuery('#dzz_notification>span.dzz').show();
//_notice.flashTitle(1);
}
}
_notice.flashTitle=function(flag){
//仅窗口不在焦点时闪烁title，回到焦点时停止闪烁并将title恢复正常
if(flag ||　CurrentActive){//当前处于焦点
document.title=_notice.normalTitle;
_notice.flashTitleRun = false;
return;//退出循环
}
_notice.flashTitleRun = true;
_notice.flashStep++;
if (_notice.flashStep==3) {_notice.flashStep=1;}
if (_notice.flashStep==1) {document.title="【您有新的通知】";}
if (_notice.flashStep==2) {document.title="【　　　　　　】";}
setTimeout(function(){_notice.flashTitle();},500);  //循环
}
</script><div class="bs-container clearfix">
    <div class="bs-left-container  clearfix">
        <div class="leconMenu">
<h3 class="bs-left-title">个人中心</h3>
<ul class="nav-stacked">
    <li <?php if(OP_NAME=='index' && !$vid) { ?>class="active"<?php } ?>><a href="user.php?mod=profile">基本资料</a></li>
    <li <?php if(OP_NAME=='avatar') { ?>class="active"<?php } ?>><a  href="user.php?mod=profile&amp;op=avatar">修改头像</a></li>
    <li <?php if(OP_NAME=='password') { ?>class="active"<?php } ?>><a href="user.php?mod=profile&amp;op=password">密码与安全</a></li>
 <?php if(is_array($_G['setting']['verify'])) foreach($_G['setting']['verify'] as $key => $value) { ?>  	<?php if($value['available'] && (empty($value['groupid']) || ($value['groupid'] && in_array($_G['groupid'],$value['groupid'])))) { ?>
   <li <?php if(MOD_NAME=='profile' && $vid==$key) { ?>class="active"<?php } ?>>
        <a href="user.php?mod=profile&amp;vid=<?php echo $key;?>"><?php echo $value['title'];?></a>
   </li>
   <?php } ?>
      <?php } ?>
</ul>
</div>    </div>
    <div class="left-drager">
    </div>

    <div class="bs-main-container  clearfix" >
        <div class="main-header">
            <ul class="nav nav-pills nav-pills-bottomguide">
                <li <?php if($do == 'editpass') { ?>class="active"<?php } ?>><a href="user.php?mod=profile&amp;op=password">修改密码</a></li>
                <li <?php if($do == 'changeemail') { ?>class="active"<?php } ?>><a href="user.php?mod=profile&amp;op=password&amp;do=changeemail">綁定邮箱</a></li>
                <!--<li <?php if($do == 'bindphone') { ?>class="active"<?php } ?>><a href="">绑定手机</a></li>-->
               
            </ul>
        </div>
        <div class="main-content">
            <?php if($do == 'editpass') { ?>
                <form id="pass" name="passform" class="form-horizontal form-horizontal-left" role="form" action="user.php?mod=profile&amp;op=password" method="post" onsubmit="editpass_submit(this);return false">
<input type="hidden" name="editpass" value="true" />
<input type="hidden" name="uid" value="<?php echo $uid;?>" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<?php if($showoldpassword>0) { ?>
<div class="form-group">
<label class="control-label" for="password0" required>原密码</label>
<input type="password" name="password0" class="form-control" autocomplete="off" id="password0" placeholder="这里输入原密码" data-chk="false">
<span id="chk_password0" class="help-msg"> <span id="suc_password0"></span> <kbd  class="p_chk"></kbd> </span>
</div>
<?php } ?>
<div class="form-group">
<label class="control-label" for="password">新密码</label>
<input type="password" name="password" class="form-control" autocomplete="off" id="password" placeholder="" data-chk="false">
<span id="chk_password" class="help-msg"> <span id="suc_password"></span> <kbd  class="p_chk"></kbd> </span>
</div>
<div class="form-group">
<label class="control-label" for="password2">确认新密码</label>
<input type="password" id="password2" class="form-control" name="password2" autocomplete="off" placeholder="" data-chk="false">
<span id="chk_password2" class="help-msg"> <span id="suc_password2"></span> <kbd  class="p_chk"></kbd> </span>
</div>
<?php if($secqaacheck || $seccodecheck) { ?>
<div class="form-group">
<label class="control-label">验证码</label>
<div class="controls"><?php $_G['sechashi'] = !empty($_G['cookie']['sechashi']) ? $_G['sechash'] + 1 : 0;
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
?><?php unset($secshow);?><?php if(empty($secreturn)) { ?><?php echo $seccheckhtml;?><?php } ?></div>
</div>
<?php } ?>

<div class="form-group">
<label class="control-label"></label>
<div class="controls"><input type="submit" class="btn btn-primary" value="保存更改" ></div>
</div>
</form>
<script type="text/javascript">
    var pwlength = "<?php echo $_G['setting']['pwlength'];?>";
    var strongpw = eval('<?php echo $strongpw;?>');
    var ignoreEmail = false;
    if( jQuery('#password0').length>0 ){
        jQuery('#password0').on('blur',function(){
            if(jQuery(this).val()==''){
                errormessage(jQuery(this),'请输入原密码');
            }else{
 errormessage(jQuery(this),'');
            }
   return false;
        });
    }
checkPwdComplexity(document.getElementById('password'),document.getElementById('password2'));
   
    function editpass_submit(form){
       
       var error=0;
jQuery(form).find('.help-msg').each(function(){
if(!jQuery(this).hasClass('chk_right')){
jQuery(this).parent().find('input').trigger('blur').focus();
error=1;
return false;
}
});
if(error) return false;
        var formdata = jQuery(form).serialize();
        var url = jQuery(form).attr('action');
        jQuery.post(url+'&returnType=json',formdata,function(data){
            if(data['success']){
                showmessage(data['success'],'success',1000,1);
                window.setTimeout(function(){
                    location.href='user.php?mod=login&op=logging&action=login';
                },3000);

            }else if(data['error']){
                showmessage(data['error'],'danger',2000,1);
            }
        },'json');
        return false;
    }
</script>            <?php } elseif($do == 'changeemail') { ?>
                <div class="all firstme " id="step" style=" background-image:url(<?php echo MOD_PATH;?>/images/step.png);background-repeat:  no-repeat;">
    <div class="first">
        <ul class="firstul">
            <li class="active">1.进行安全验证</li>
            <?php if(!$emailchange) { ?> <li >2.设置邮箱</li><?php } else { ?><li >2.修改邮箱</li><?php } ?>
            <?php if(!$bindstatus) { ?> <li >3.绑定成功</li><?php } else { ?><li >3.修改成功</li><?php } ?>

        </ul>
    </div>
</div>
<script type="text/javascript">
    function safeverifystep(i){

            jQuery('#safechkbox').html('');

            var index = parseInt(i);
            switch(index){
                case 0: className = 'firstme';
                    break;
                case 1: className = 'secondme';
                    break;
                case 2: className = 'thirdme';
                    break;
                default: className = 'firstme';
            }

            jQuery('#step').removeClass().addClass('all '+className);

            jQuery('#step').find('ul li').removeClass('active');

            jQuery('#step').find('ul li:eq('+index+')').addClass('active');

            jQuery('#changeemailbox').show();

    }
</script>
<?php if(!$newchange) { ?>
<form id="emailform" name="emailform" class="form-horizontal form-horizontal-left" role="form" action="user.php?mod=profile&amp;op=password&amp;do=changeemail" method="post" onsubmit="bind_email();return false">
    <input type="hidden" name="changeemail" value="true" />
    <input type="hidden" name="uid" value="<?php echo $uid;?>" />
    <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
  <div id="safechkbox"><?php Hook::listen('safe_chk') ?></div>
    <div id="changeemailbox" style="display:none;">
    <div class="form-group">
        <label class="control-label" for="newemail" required>新邮箱</label>
        <input type="text" name="newemail" class="form-control" autocomplete="off" id="newemail" placeholder="这里输入邮箱">
        <span id="chk_newemail" class="help-inline"> <span id="suc_newemail"></span> <kbd  class="p_chk"><?php if(!$emailchange) { ?>*若输入邮箱和登录邮箱不一致，将替代登录邮箱<?php } else { ?>*更改后，此邮箱将作为登录邮箱<?php } ?></kbd> </span>
    </div>
    <?php if(!$emailchange) { ?>
    <div class="form-group">
        <label class="control-label"></label>
        <div class="controls"><input type="button" class="btn btn-primary" value="设置" onclick="bind_email()"></div>
    </div>
    <?php } else { ?>
        <div class="form-group">
            <label class="control-label"></label>
            <div class="controls"><input type="button" class="btn btn-primary" value="更改" onclick="bind_email()"></div>
        </div>
        <script>
            <?php if($verifyresult) { ?> safeverifystep(1); <?php } ?>
        </script>
    <?php } ?>
    </div>
</form>
<div class="conTent" id="emailsendmsg" style="display:none;">
    <div class="success">
        <span class="glyphicon glyphicon-ok"></span>
        <span class="msgobj">验证邮件已发送</span>
    </div>
    <div class="theme">
        <p><span class="msgobj">验证邮件</span>已发送至您的邮箱 <span class="phone"><a  href="" id="returnemail" target="_blank"></a></span>,点击邮件中的链接完成操作。</p>
        <p>验证邮件24小时内有效，请尽快验证。</p>
        <p>邮件可能会进入推广邮件或垃圾邮件中，请注意查收。</p>
    </div>
    <div class="email">
        <button type="button" class="btn btn-success" id="refferemail">现在去邮箱</button>
        <span><span id="send_start">已发送至您的邮箱</span><span id="send_status" style="display:none;"><b class="time" id="downtime">60</b>s<span id="falseresend">重新发送</span><span id="resend" style="display:none"><input type="button" class="btn btn-success"  value="重新发送" onclick="bind_email()" ></span></span></span>
    </div>
</div>
<?php } elseif($id && $newchange) { ?>
<div class="conTent">
    <div class="success">
        <span class="glyphicon glyphicon-ok"></span>
        绑定成功
    </div>
</div>
<script>
    safeverifystep(2);
</script>
<?php } ?>
<script>
    function bind_email(){
        jQuery('#send_status').hide();
        jQuery('#downtime').html(60);
        jQuery('#resend').hide();
        jQuery('#send_start').html('发送中，请稍后...');
        var form = jQuery('#emailform');
        var url = form.attr('action');
        jQuery.post(url+'&returnType=json',form.serialize(),function(json){
                if(json['success']){
                    jQuery('#send_start').html('验证邮件已发送');
                    jQuery('#send_status').show();
                    jQuery('#falseresend').show();
                    jQuery('#emailform').hide();
                    jQuery('#emailsendmsg').show();
                    var path = getEmailPath(json['success']['email']);
                    jQuery('#returnemail').html(json['success']['email']).attr('href',path);
                    jQuery('#refferemail').click(function(){
                        window.location.href = path;
                    });
                    var sum = 60;
                    var timer = setInterval(function(){
                        if(sum <= 0) {
                            sum = 0;
                            jQuery('#falseresend').hide();
                            jQuery('#resend').show();
                            clearTimeout(timer);
                        }
                        jQuery('#downtime').html(sum);
                        sum--;
                    },1000);
                }else if(json['error']){
                    showmessage(json['error'],'danger',3000,1);
                }
        },'json')
        return false;
    }
</script>           <?php } ?>
        </div>
<script type="text/javascript"  reload="1">
    jQuery('.left-drager').leftDrager_layout();
</script>
<script src="static/bootstrap/js/bootstrap.min.js?<?php echo VERHASH;?>" ></script><?php output();?><?php updatesession();?><?php if(debuginfo()) { ?>
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
<?php } if(!isset($_G['cookie']['upgradenotice'])) { ?>
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