<?php if(!defined('IN_DZZ')) exit('Access Denied'); /*a:11:{s:80:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/setting/template/main.htm";i:1536850350;s:101:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_start.htm";i:1536850350;s:99:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_end.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/commer_header.htm";i:1536850350;s:87:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/setting/template/header_left.htm";i:1536850350;s:0:"";b:0;s:94:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_right.htm";i:1536850350;s:80:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/setting/template/left.htm";i:1536850350;s:86:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/setting/template/perm_group.htm";i:1536850350;s:90:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/seccheck.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/footer_simple.htm";i:1536850350;}*/?>
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
<script type="text/javascript" src="./data/template/admin_setting_main_header_zh-cn.js" ></script><script type="text/javascript" src="static/js/header.js?<?php echo VERHASH;?>" ></script>
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
<link href="static/icheck/skins/minimal/blue.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<link href="static/select2/select2.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<link href="static/select2/select2-bootstrap.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<link href="static/css/common.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<link href="static/css/app_manage.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<script type="text/javascript" src="static/js/jquery.leftDrager.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript" src="static/js/jquery.textareaexplander.js?<?php echo VERHASH;?>" ></script>
<script src="admin/scripts/admin.js?<?php echo VERHASH;?>" ></script>
<style>
.input-black {
margin-bottom: 0px;
}
.form-horizontal-left label {
padding-top: 0;
}
.loginset-template {
width: 100px;
overflow: hidden;
float: left;
margin-right: 10px;
display: block;
position: relative;
}
.loginset-template .loginset-template-icon {
width: 20px;
height: 20px;
border: 1px solid #AAB479;
position: absolute;
right: 1px;
top: 1px;
color: #DD4B39;
font-size: 15px;
display: none;
}
.loginset-template:hover .loginset-template-icon {
display: block;
}
.loginset-template:hover .loginset-template-icon > span {
display: none;
}
.loginset-template .loginset-template-icon1 {
display: block !important;
}
.loginset-template .loginset-template-icon1 > span {
display: block !important;
}
#cpform {
margin-top: 15px;
}
.file-hidde-content{
    position: relative;
    float: left;
}
.file-hidde-content .upold-add{
    max-height: 55px;
    max-width: 55px;
}
.file-hidde-content .file-hidde{
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    opacity: 0;
}
.file-hidde-content .progress-bar{
   position: absolute;
    height: 1px;
}
</style><script type="text/javascript" src="./data/template/admin_setting_main_common_zh-cn.js" ></script><script type="text/javascript" src="static/js/common.js?<?php echo VERHASH;?>" ></script>
</head>
<body id="nv_<?php echo $_G['basescript'];?>" class="<?php echo $bodyClass;?>" >
<div id="append_parent" style="z-index:99999;"></div>
<div id="ajaxwaitid" style="z-index:99999;"></div>
<nav class="navbar navbar-inverse resNav bs-top-container" >
<div class="resNav-item resNav-left">     
    <ul class="nav navbar-nav navbar-nav-left" style="min-width:168px"> 
    <li>
       <a class="leftTopmenu" href="index.php?mod=appmanagement" style="padding:8px"><div class="gb_fc"><span class="dzz dzz-chevron-left" style="display:block"></span></div></a>
    </li>
    <li>
        <a href="<?php echo MOD_URL;?>">系统设置</a>
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
    <ul class="nav-stacked">
<li <?php if($operation=='basic' || $operation=='datetime' || $operation=='upload' || $operation=='desktop' || $operation=='at' ) { ?>class="active"<?php } ?>>
<a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=basic">基本设置</a>
</li>

<li <?php if($operation=='access' || $operation=='sec' || $operation=='qqlogin' || $operation=='loginset' ) { ?>class="active"<?php } ?>>
<a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=access">登录设置</a>
</li>
<li <?php if($operation=='space') { ?>class="active"<?php } ?>>
<a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=space">空间设置</a>
</li>
<li <?php if($operation=='mail' || $op=='mailcheck' ) { ?>class="active"<?php } ?>>
<a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=mail">邮件设置</a>
</li>
<li <?php if($operation=='smiley' || $op=='smiley' ) { ?>class="active"<?php } ?>>
<a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=smiley">表情管理</a>
</li>
<li <?php if($operation=='permgroup') { ?>class="active"<?php } ?>>
<a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=permgroup">权限包设置</a>
</li>
<li <?php if($operation=='censor' ) { ?>class="active"<?php } ?>>
<a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=censor">敏感词管理</a>
</li>
<!--<li <?php if($operation=='qywechat' || $op=='assistant' || $op=='wxsyn' ) { ?>class="active"<?php } ?>>
<a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=qywechat">微信企业号</a>
</li>-->
</ul> 
  </div>
  <div class="left-drager"> </div>
  <div class="bs-main-container  clearfix"> 
    <?php if($operation=='censor' || $operation=='space' || $operation == 'permgroup') { ?>
    <div class="main-header clearfix" style="border:none;">
    <?php } else { ?>
    <div class="main-header clearfix"> 
      <?php } ?> 
      <?php if($operation=='mail') { ?>
      <ul class="nav navbar-nav nav-pills-bottomguide">
        <li class="active"><a href="<?php echo BASESCRIPT;?>?mod=setting&operation=mail">设置</a></li>
        <li><a href="<?php echo BASESCRIPT;?>?mod=setting&op=mailcheck">检测</a></li>
      </ul>
      <?php } elseif($operation=='smiley') { ?>
      <ul class="nav navbar-nav nav-pills-bottomguide">
        <li class="active"><a href="<?php echo BASESCRIPT;?>?mod=setting&operation=smiley">表情设置</a> </li>
        <li><a href="<?php echo BASESCRIPT;?>?mod=setting&op=smiley">表情分类</a></li>
      </ul>
      <?php } elseif($operation=='qywechat') { ?>
      <ul class="nav navbar-nav nav-pills-bottomguide">
        <li class="active"><a href="<?php echo BASESCRIPT;?>?mod=setting&operation=qywechat">企业号绑定</a></li>
        <?php if($setting['CorpID'] && $setting['CorpSecret']) { ?>
        <li><a href="<?php echo BASESCRIPT;?>?mod=setting&op=assistant">企业小助手</a></li>
        <li><a href="<?php echo BASESCRIPT;?>?mod=setting&op=wxsyn">数据同步</a></li>
        <?php } ?>
      </ul>
      
      <?php } elseif($operation=='basic') { ?>
      <ul class="nav navbar-nav nav-pills-bottomguide">
        <li class="active" style="margin-left: 0px;"> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=basic">基本设置</a> </li>
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=datetime">时间设置</a> </li>
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=upload">上传设置</a> </li>
        <!--<li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=desktop">桌面设置</a> </li>-->
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=at">@部门设置</a> </li>
      </ul>
      <?php } elseif($operation=='at') { ?>
      <ul class="nav navbar-nav nav-pills-bottomguide">
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=basic">基本设置</a> </li>
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=datetime">时间设置</a> </li>
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=upload">上传设置</a> </li>
        <!--<li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=desktop">桌面设置</a> </li>-->
        <li class="active"> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=at">@部门设置</a> </li>
      </ul>
      <?php } elseif($operation=='upload') { ?>
      <ul class="nav navbar-nav nav-pills-bottomguide">
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=basic">基本设置</a> </li>
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=datetime">时间设置</a> </li>
        <li class="active"> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=upload">上传设置</a> </li>
        <!--<li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=desktop">桌面设置</a> </li>-->
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=at">@部门设置</a> </li>
      </ul>
      <?php } elseif($operation=='desktop') { ?>
      <ul class="nav navbar-nav nav-pills-bottomguide">
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=basic">基本设置</a> </li>
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=datetime">时间设置</a> </li>
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=upload">上传设置</a> </li>
        <!--<li class="active"> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=desktop">桌面设置</a> </li>-->
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=at">@部门设置</a> </li>
      </ul>
     
      <?php } elseif($operation=='loginset') { ?>
      <ul class="nav navbar-nav nav-pills-bottomguide">
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=access">注册和访问</a> </li>
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=sec">验证码设置</a> </li>
        
        <li class="active"> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=loginset">登录页设置</a> </li>
      </ul>
      <?php } elseif($operation=='access') { ?>
      <ul class="nav navbar-nav nav-pills-bottomguide">
        <li class="active"> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=access">注册和访问</a> </li>
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=sec">验证码设置</a> </li>
        
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=loginset">登录页设置</a> </li>
      </ul>
      <?php } elseif($operation=='datetime') { ?>
      <ul class="nav navbar-nav nav-pills-bottomguide">
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=basic">基本设置</a> </li>
        <li class="active"> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=datetime">时间设置</a> </li>
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=upload">上传设置</a> </li>
        <!--<li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=desktop">桌面设置</a> </li>-->
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=at">@部门设置</a> </li>
      </ul>
      <?php } elseif($operation=='sec') { ?>
      <ul class="nav navbar-nav nav-pills-bottomguide">
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=access">注册和访问</a> </li>
        <li class="active"> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=sec">验证码设置</a> </li>
        
        <li> <a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&operation=loginset">登录页设置</a> </li>
      </ul>
      <?php } ?> 
    </div>
    <div class="main-content">
    <?php if($operation=='basic') { ?>
    <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left" method="post"  name="cpform">
      <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
      <input type="hidden" value="basic" name="operation">
      <dl>
        <a href=""></a>
        <dt>平台LOGO:</dt>
        <dd class="clearfix">			
<div class="file-hidde-content">
<?php if($setting['sitelogo'] > 0) { ?>
<img src="index.php?mod=io&amp;op=thumbnail&amp;size=small&amp;path=<?php echo dzzencode('attach::'.$setting[sitelogo]);?>" class="upold-add">
<?php } else { ?>
<img src="static/image/common/logo.png" class="upold-add">
<?php } ?>
<input type="file" name="files[]" value="" class="file-hidde" />
<input type="hidden" name="settingnew[sitelogo]" value="<?php echo $setting['sitelogo'];?>" class="build-images" /> 
<div class="progress-bar"></div>
</div>
         	
        </dd>
      </dl>
      <dl>
        <a href=""></a>
        <dt>平台名称:</dt>
        <dd class="clearfix">
          <input type="text" id="sitename" name="settingnew[sitename]" class="form-control" value="<?php echo $setting['sitename'];?>">
          <span class="help-inline text-muted">平台名称，将显示在浏览器窗口标题等位置 </span> </dd>
      </dl>
<dl> 
        <dt>默认首页:</dt>
        <dd class="clearfix">
<input type="hidden" name="old_default_mod" class="form-control" value="<?php echo $setting['default_mod'];?>">
          <select name="settingnew[default_mod]" class="form-control">
<option value="">请选择默认首页</option> <?php if(is_array($applist)) foreach($applist as $value) { ?> 
<option value="<?php echo $value['identifier'];?>" <?php if($value[ 'identifier']==$setting['default_mod']) { ?>selected="selected"  <?php } ?>><?php echo $value['appname'];?> </option>
<?php } ?>
          </select>
          <span class="help-inline text-muted">进入系统后的默认首页 </span> </dd>
      </dl>
      <dl>
        <dt>用户默认加入部门:</dt>
        <dd class="clearfix">
          <div class="dropdown">
            <input id="sel_defaultdepartment" type="hidden" name="settingnew[defaultdepartment]"
                                       value="<?php echo $setting['defaultdepartment'];?>"/>
            <button type="button" id="defaultdepartment_Menu"
                                        class="btn btn-default dropdown-toggle" data-toggle="dropdown"> <?php echo $defaultdepartment;?> <span class="caret"></span></button>
            <div id="defaultdepartment_dropdown_menu" class="dropdown-menu org-sel-box" role="menu" aria-labelledby="defaultdepartment_Menu">
              <iframe name="defaultdepartment_iframe" class="org-sel-box-iframe" src="index.php?mod=system&amp;op=orgtree&amp;ctrlid=defaultdepartment&amp;nouser=1"
                                            frameborder="0" marginheight="0" marginwidth="0" width="100%" height="100%"
                                            allowtransparency="true"></iframe>
            </div>
          </div>
          <span class="help-inline text-muted">选择新注册用户默认加入的部门,不选择默认不加入部门</span>
</dd>
      </dl>
      <dl>
        <dt>缩略图大小</dt>
        <dd class="clearfix">
          <dl style="margin-top:0px">
            <dd class="clearfix"><span class="label label-default"
                                                           style="display:inline-block;padding:10px 15px;margin-right:10px;">小图尺寸</span>
              <input name="settingnew[thumbsize][small][width]" class="form-control"
                                           style="display:inline-block;float:none;width:60px" placeholder="宽度"
                                           value="<?php echo $setting[thumbsize][small][width]?$setting[thumbsize][small][width]:'256'?>"/>
              <span style="display:inline-block;padding:6px 3px">X</span>
              <input name="settingnew[thumbsize][small][height]" class="form-control"
                                           style="display:inline-block;float:none;width:60px"
                                           placeholder="高度"
                                           value="<?php echo $setting[thumbsize][small][height]?$setting[thumbsize][small][height]:'256'?>"/>
            </dd>
          </dl>
          <dl style="margin-top:0px">
            <dd class="clearfix"><span class="label label-default"
                                                           style="display:inline-block;padding:10px 15px;margin-right:10px;">中图尺寸</span>
              <input name="settingnew[thumbsize][middle][width]" class="form-control"
                                           style="display:inline-block;float:none;width:60px" placeholder="宽度"
                                           value="<?php echo $setting[thumbsize][middle][width]?$setting[thumbsize][middle][width]:'800'?>"/>
              <span style="display:inline-block;padding:6px 3px">X</span>
              <input name="settingnew[thumbsize][middle][height]" class="form-control"
                                           style="display:inline-block;float:none;width:60px"
                                           placeholder="高度"
                                           value="<?php echo $setting[thumbsize][middle][height]?$setting[thumbsize][middle][height]:'600'?>"/>
            </dd>
          </dl>
          <dl style="margin-top:0px">
            <dd class="clearfix"><span class="label label-default"
                                                           style="display:inline-block;padding:10px 15px;margin-right:10px;">大图尺寸</span>
              <input name="settingnew[thumbsize][large][width]" class="form-control"
                                           style="display:inline-block;float:none;width:60px" placeholder="宽度"
                                           value="<?php echo $setting[thumbsize][large][width]?$setting[thumbsize][large][width]:'1440'?>"/>
              <span style="display:inline-block;padding:6px 3px">X</span>
              <input name="settingnew[thumbsize][large][height]" class="form-control"
                                           style="display:inline-block;float:none;width:60px"
                                           placeholder="高度"
                                           value="<?php echo $setting[thumbsize][large][height]?$setting[thumbsize][large][height]:'900'?>"/>
            </dd>
          </dl>
          <ul class="help-block">
            <li>系统缩略图尺寸规格</li>
							<li>可以根据需要调整，系统会根据此处的大小调用对应尺寸的缩略图</li>
          </ul>
        </dd>
      </dl>
      <dl>
        <dt>缩略图生成方式</dt>
        <dd class="clearfix">
          <label class="radio-inline"><input type="radio"  name="settingnew[thumb_active]" <?php if($setting['thumb_active']) { ?>checked="checked"<?php } ?> value="1"> 主动模式</label>
          <label class="radio-inline"> <input type="radio" name="settingnew[thumb_active]" <?php if(!$setting['thumb_active']) { ?>checked="checked"<?php } ?> value="0">被动模式</label> 
        <ul class="help-block" >
          <li>主动模式时，上传图片的同时生成大、中、小三种尺寸的的缩略图。上传速度会变慢，但用户浏览速度比较快</li>
							<li>被动模式时，只有用户浏览时才生成缩略图，上传速度比较快。由于用户浏览时才生成缩略图，图片加载稍慢，打开很多图片的文件夹时，服务压力较大</li>
							<li>两种模式根据实际需要选择使用，此设置对于云端图片不适用，云端（如ftp，云存储）图片始终采用被动模式</li>
        </ul>
        </dd>
      </dl>
      <dl>
        <dt>文件分享:</dt>
        <dd class="clearfix">
          <label class="radio-inline"> <input type="radio" name="settingnew[allowshare]" value="0" <?php if(!$setting['allowshare']) { ?>checked<?php } ?> > 启用</label>
          <label class="radio-inline"> <input type="radio" name="settingnew[allowshare]"  value="1"<?php if($setting['allowshare']) { ?>checked <?php } ?> >禁用</label>
          <span class="help-block"> 禁用分享，文件属性页中不再出现分享和下载链接，Dzz文档，网址和网络视频类除外</span> </dd>
      </dl>
      
      <dl>
        <dt>备案信息:</dt>
        <dd class="clearfix">
          <input type="text" class="form-control" id="sitebeian" name="settingnew[sitebeian]" value="<?php echo $setting['sitebeian'];?>" />
          <span class="help-block text-muted">支持html代码,面板可视区域大小为263*235</span> </dd>
      </dl>
      <dl>
        <dt>平台关键词:</dt>
        <dd class="clearfix">
          <textarea type="textarea" class="form-control" id="metakeywords"
  name="settingnew[metakeywords]" row="6"><?php echo $setting['metakeywords'];?></textarea>
          <span class="help-block text-muted"> 平台SEO关键词</span></dd>
      </dl>
      <dl>
        <dt>平台描述:</dt>
        <dd class="clearfix">
          <textarea type="textarea" class="form-control" id="metadescription"
  name="settingnew[metadescription]"
  row="6"><?php echo $setting['metadescription'];?></textarea>
          <span class="help-block text-muted"> 平台SEO描述</span></dd>
      </dl>
      <dl>
        <dt>统计代码:</dt>
        <dd class="clearfix">
          <textarea type="textarea" class="form-control" id="statcode" name="settingnew[statcode]"
  row="6"><?php echo $setting['statcode'];?></textarea>
          <span class="help-block text-muted">支持html代码</span></dd>
      </dl>
      <!--<dl>
        <dt>提示离开平台:</dt>
        <dd class="clearfix">
          <label class="radio-inline"> <input type="radio" name="settingnew[leavealert]" value="1" <?php if($setting['leavealert']) { ?>checked<?php } ?>>是</label>
          <label class="radio-inline"> <input type="radio" name="settingnew[leavealert]" value="0"<?php if(!$setting['leavealert']) { ?>checked 
            <?php } ?>>否</label>
          <span class="help-block"> 是否提示离开平台开关，设置否时，刷新页面将不会出现离开的提示信息</span>
      </dl>-->
      <dl>
        <dt>关闭平台:</dt>
        <dd class="clearfix">
          <label class="radio-inline"> <input type="radio" name="settingnew[bbclosed]" value="1" <?php if($setting['bbclosed']) { ?>checked<?php } ?> onclick="document.getElementById('bbclosedreason').style.display='block'">是</label>
          <label class="radio radio-inline"> <input type="radio" name="settingnew[bbclosed]" value="0" <?php if(!$setting['bbclosed']) { ?>checked<?php } ?> onclick="document.getElementById('bbclosedreason').style.display='none'">否</label>
          <span class="help-block">暂时将平台关闭，其他人无法访问，但不影响管理员访问</span> </dd>
        <dd class="clearfix">
          <dl id="bbclosedreason" style=" <?php if(!$setting['bbclosed']) { ?>display:none;<?php } ?> ">
            <dt>关闭平台的原因:</dt>
            <dd class="clearfix">
              <textarea type="textarea" class="form-control" id="closedreason"
                                              name="settingnew[closedreason]" row="6"><?php echo $setting['closedreason'];?></textarea>
              <span class="help-block text-muted">平台关闭时出现的提示信息</span></dd>
          </dl>
        </dd>
        <dd>
          <input class="btn btn-primary" id="submit_editsubmit" name="settingsubmit"
                                   value="保存更改" type="submit">
        </dd>
      </dl>
    </form>
    <script type="text/javascript">
        var selorg = {};
        //添加
        selorg.add = function (ctrlid, vals) {
            if (vals[0].orgid == 'other') vals[0].path = '不加入机构或部门';
            jQuery('#' + ctrlid + '_Menu').html(vals[0].path + ' <span class="caret"></span>');
            jQuery('#sel_' + ctrlid).val(vals[0].orgid);
        }
    </script> 
    <?php } elseif($operation=='at') { ?>
    
    <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left" method="post"
                      name="cpform" style="margin-top: 15px;">
      <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
      <input type="hidden" value="upload" name="operation">
      <dl>
        <dt>@部门范围设置:</dt>
        <?php if(is_array($usergroups)) foreach($usergroups as $value) { ?>        <dd class="clearfix">
          <dl>
            <dt><?php echo $value['grouptitle'];?></dt>
            <dd class="clearfix">
              <label class="radio-inline ml10" style="padding-left:0px"><input type="radio"
                                                                                                     name="settingnew[at_range][<?php echo $value['groupid'];?>}]"
                                        <?php if($setting['at_range'][$value['groupid']]==3) { ?>checked="checked" 
                <?php } ?> value="3">所有机构部门</label>
              <label class="radio-inline"><input type="radio"
                                                                             name="settingnew[at_range][<?php echo $value['groupid'];?>]"
                                        <?php if($setting['at_range'][$value['groupid']]==2) { ?>checked="checked" 
                <?php } ?> value="2">本机构部门</label>
              <label class="radio-inline"><input type="radio"
                                                                             name="settingnew[at_range][<?php echo $value['groupid'];?>]"
                                        <?php if($setting['at_range'][$value['groupid']]==1) { ?>checked="checked" 
                <?php } ?> value="1">本部门</label>
              <label class="radio-inline"><input type="radio"
                                                                             name="settingnew[at_range][<?php echo $value['groupid'];?>]"
                                        <?php if($setting['at_range'][$value['groupid']]==0) { ?>checked="checked" 
                <?php } ?> value="0">不能@部门</label>
            </dd>
          </dl>
        </dd>
        <?php } ?>
      </dl>
      <dl>
        <dd>
          <input class="btn btn-primary" id="submit_editsubmit" name="settingsubmit"
                                   value="保存更改" type="submit">
        </dd>
      </dl>
    </form>
    <?php } elseif($operation=='upload') { ?>
    
    <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left" method="post"
                      name="cpform">
      <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
      <input type="hidden" value="upload" name="operation">
      <dl>
        <dt>禁止运行的文件后缀:</dt>
        <dd class="clearfix">
          <input type="text" name="settingnew[unRunExts]" class="form-control" style="width:90%;"
                                   value="<?php echo $setting['unRunExts'];?>">
          <ul class="help-block text-muted" style="color:#FF451A;">
            <li>设置禁止运行的文件后缀，多个用半角逗号隔开。</li>
							<li>出于安全考虑，通常php,asp,jsp等可以被利用后缀名都需要在此处设置来禁止运行。</li>
							<li>此处设置的后缀文件，系统将通过特殊处理，防止其运行，提高系统的安全性。</li>
          </ul>
        </dd>
      </dl>
      <dl>
        <dt>上传分块大小</dt>
        <dd class="clearfix">
          <div class="input-group" style="width:120px;float:left">
            <input type="text" class="form-control" style="width:100px;"
                                       name="settingnew[maxChunkSize]" value="<?php echo $setting['maxChunkSize'];?>">
            <span class="input-group-addon">M</span></div>
          <ul class="help-block" style="color:#FF451A;">
            <li>此处设置分块时每块的大小，当上传文件大于此值时 上传程序会分块来上传</li>
							<li>分块太大或太小都会影响上传的性能,请根据服务器设置来调整此参数</li>
							<li>分块大小必须小于php.ini中设置的post_max_size和upload_max_filesize的大小</li>
          </ul>
        </dd>
      </dl>
      <dl>
        <dt>文件多版本设置</dt>
        <dd class="clearfix">
          <label class="radio-inline"><input type="radio" name="settingnew[fileVersion]" value="1"
                                <?php if(!isset($setting['fileVersion']) || (isset($setting['fileVersion']) && $setting['fileVersion'])) { ?> checked="checked" <?php } ?>/>启用</label>
          <label class="radio-inline"> <input type="radio" name="settingnew[fileVersion]" value="0"
                                <?php if(isset($setting['fileVersion']) && !$setting['fileVersion']) { ?>checked="checked"<?php } ?>/>关闭</label>
        </dd>
        <dd class="clearfix" style="margin-top:20px;">
          <dl id="fileVersionNumber" class="function-space <?php if(isset($setting['fileVersion']) && !$setting['fileVersion']) { ?> hide <?php } ?>">
            <dt>文件多版本设置</dt>
            <dd class="clearfix">
              <div class="input-group function-space"> <input type="text" class="form-control"  name="settingnew[fileVersionNumber]"
<?php if(isset($setting['fileVersion'])) { ?>value="<?php echo $setting['fileVersionNumber'];?>" <?php } ?> 
                placeholder="0" /> <span class="input-group-addon">个</span> </div>
            </dd>
            <dd class="clearfix"><span class="help-block">文件版本个数控制，默认值为0，表示不限版本数量</span></dd>
          </dl>
        </dd>
      </dl>
      <dl>
        <dd>
          <input class="btn btn-primary" id="submit_editsubmit" name="settingsubmit"
                                   value="保存更改" type="submit">
        </dd>
      </dl>
    </form>
    <script type="text/javascript">
                    jQuery('input[name="settingnew[fileVersion]"]').click(function(){
                        var val = $(this).val();
                        if(val == 0){
                           jQuery('#fileVersionNumber').addClass('hide');
                        }else{
                            jQuery('#fileVersionNumber').removeClass('hide');
                        }
                    })
                </script> 
    <?php } elseif($operation=='desktop') { ?>
    
    <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left" method="post"
                      name="cpform">
      <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
      <input type="hidden" value="desktop" name="operation">
      <dl>
        <dt>任务栏位置：</dt>
        <dd class="clearfix">
          <label class="radio-inline"><input type="radio"
                                                                                          name="settingnew[desktop_default][taskbar]"
                                                                                          value="left"
                                <?php if($setting['desktop_default']['taskbar']=='left') { ?>checked<?php } ?>>左侧</label>
          <label class="radio-inline"><input type="radio"
                                                                     name="settingnew[desktop_default][taskbar]"
                                                                     value="right"
                                <?php if($setting['desktop_default']['taskbar']=='right') { ?>checked<?php } ?>>右侧</label>
          <label class="radio-inline "><input type="radio" name="settingnew[desktop_default][taskbar]"
                                                                value="top"
                                <?php if($setting['desktop_default']['taskbar']=='top') { ?>checked<?php } ?>>顶部</label>
          <label class="radio-inline "><input type="radio" name="settingnew[desktop_default][taskbar]"
                                                                value="bottom"
                                <?php if($setting['desktop_default']['taskbar']=='bottom') { ?>checked<?php } ?>>底部</label>
        </dd>
        <dd class="clearfix"><span class="help-inline">默认的任务栏位置。（用户设置后，以用户设置为准）</span></dd>
      </dl>
      <dl>
        <dt>桌面图标大小：</dt>
        <dd class="clearfix">
          <select name="settingnew[desktop_default][iconview]" class="form-control">
            <?php if(is_array($iconview)) foreach($iconview as $value) { ?> 
            <option value="<?php echo $value['id'];?>"
              <?php if($value[ 'id']==$setting['desktop_default']['iconview']) { ?>selected="selected" 
            <?php } ?>><?php echo $value['name'];?> </option>
            <?php } ?>
          </select>
          <span class="help-block">默认的桌面图标大小。（用户设置后，以用户设置为准）</span>
        </dd>
      
      </dl>
      <dl>
        <dt>图标排列位置：</dt>
        <dd class="clearfix">
         
          <label class="radio-inline">
          <input type="radio"
                                                                                          name="settingnew[desktop_default][iconposition]"
                                                                                          value="0"
                                <?php if($setting['desktop_default']['iconposition']=='0') { ?>checked<?php } ?>>
          左上角</label>
          <label class="radio-inline"> 
            <input type="radio" name="settingnew[desktop_default][iconposition]"
                                                                    value="1"
                                    <?php if($setting['desktop_default']['iconposition']=='1') { ?>checked<?php } ?>>
           右上角</label>
          
          <label class="radio-inline "><input type="radio"
                                                                name="settingnew[desktop_default][iconposition]"
                                                                value="2"
                                <?php if($setting['desktop_default']['iconposition']=='2') { ?>checked<?php } ?>>右下角</label>
          <label class="radio-inline "><input type="radio"
                                                                name="settingnew[desktop_default][iconposition]"
                                                                value="3"
                                <?php if($setting['desktop_default']['iconposition']=='3') { ?>checked<?php } ?>>左下角</label>
          <label class="radio-inline "><input type="radio"
                                                                name="settingnew[desktop_default][iconposition]"
                                                                value="4"
                                <?php if($setting['desktop_default']['iconposition']=='4') { ?>checked<?php } ?>>居中</label>
        </dd>
        <dd class="clearfix"><span class="help-inline">默认的桌面图标排列起始位置。（用户设置后，以用户设置为准）</span></dd>
      </dl>
      <dl>
        <dt>图标排列方向：</dt>
        <dd class="clearfix">
          <label class="radio-inline"><input type="radio"
                                                                                          name="settingnew[desktop_default][direction]"
                                                                                          value="0"
                                <?php if($setting['desktop_default']['direction']=='0') { ?>checked<?php } ?>>纵向排列</label>
          <label class="radio-inline "><input type="radio"
                                                                name="settingnew[desktop_default][direction]" value="1"
                                <?php if($setting['desktop_default']['direction']=='1') { ?>checked<?php } ?>>横向排列</label>
        </dd>
        <dd class="clearfix"><span class="help-inline">默认的桌面图标排列方向。（用户设置后，以用户设置为准）</span></dd>
      </dl>
      <dl>
        <dd>
          <input class="btn btn-primary" id="submit_editsubmit" name="settingsubmit"
                                   value="保存更改" type="submit">
        </dd>
      </dl>
    </form>
  
    <?php } elseif($operation=='loginset') { ?>
    
    <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left" method="post"
                  name="cpform">
      <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
      <input type="hidden" value="loginset" name="operation">
      <input type="hidden" value="1" name="settingnew[loginset][available]">
      <dl>
        <dt>页面主标题：</dt>
        <dd class="clearfix">
          <input type="text" class="form-control" name="settingnew[loginset][title]"
                               value="<?php echo $setting['loginset']['title'];?>"/>
        </dd>
        <dd class="clearfix"><span class="help-inline">独立登录页左侧大标题。</span></dd>
      </dl>
      <dl>
        <dt>页面副标题：</dt>
        <dd class="clearfix">
          <input type="text" class="form-control" name="settingnew[loginset][subtitle]"
                               value="<?php echo $setting['loginset']['subtitle'];?>"/>
        </dd>
        <dd class="clearfix"><span class="help-inline">独立登录页左侧副标题。</span></dd>
      </dl>
      <dl>
        <dt>页面背景：</dt>
        <dd class="clearfix">
          <input type="text" class="form-control" name="settingnew[loginset][background]"
                               value="<?php echo $setting['loginset']['background'];?>"/>
        </dd>
        <dd class="clearfix"><span class="help-inline">可以为颜色(如:#FFF);图片(以.jpeg,.jpg,.png结尾)或网址。</span></dd>
      </dl>
      <dl>
        <dt>登录：</dt>
        <dd class="clearfix"> <a class="loginset-template" href="admin/setting/images/template1.jpg" target="_blank">
          <div class="loginset-template-icon<?php if($setting['loginset']['template'] == 1) { ?> loginset-template-icon1<?php } ?>"
                                 data-template="1"> <span class="glyphicon glyphicon-ok"></span> </div>
          <img style="width: 100%;" src="admin/setting/images/template1.jpg" alt=""/> </a> <a class="loginset-template" href="admin/setting/images/template2.jpg" target="_blank">
          <div class="loginset-template-icon<?php if($setting['loginset']['template'] == 2) { ?> loginset-template-icon1<?php } ?>"
                                 data-template="2"> <span class="glyphicon glyphicon-ok"></span> </div>
          <img style="width: 100%;" src="admin/setting/images/template2.jpg" alt=""/> </a> <a class="loginset-template" href="admin/setting/images/template3.jpg" target="_blank">
          <div class="loginset-template-icon<?php if($setting['loginset']['template'] == 3) { ?> loginset-template-icon1<?php } ?>"
                                 data-template="3"> <span class="glyphicon glyphicon-ok"></span> </div>
          <img style="width: 100%;" src="admin/setting/images/template3.jpg" alt=""/> </a>
          <input type="hidden" class="form-control loginset-template-input"
                               name="settingnew[loginset][template]" value="<?php echo $setting['loginset']['template'];?>"/>
        </dd>
        <dd class="clearfix"><span class="help-block">独立登录页登录模版。</span></dd>
      </dl>
      <dl>
        <dd>
          <input class="btn btn-primary" id="submit_editsubmit" name="settingsubmit"
                               value="保存更改" type="submit">
        </dd>
      </dl>
    </form>
    <script type="text/javascript">
                jQuery(document).on('click', '.loginset-template-icon', function () {
                    jQuery(this).addClass('loginset-template-icon1').closest('.loginset-template').siblings().find('.loginset-template-icon').removeClass('loginset-template-icon1');
                    jQuery('.loginset-template-input').val(jQuery(this).data('template'));
                    return false;
                })
            </script> 
    <?php } elseif($operation=='mail') { ?>
    <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left" method="post"
                  name="cpform">
      <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
      <input type="hidden" value="mail" name="operation">
      <dl>
        <dt>管理员邮箱:</dt>
        <dd class="clearfix">
          <input type="text" class="form-control" id="adminemail" name="settingnew[adminemail]"
                               value="<?php echo $setting['adminemail'];?>">
          <span class="help-block text-muted"> 管理员 E-mail，将作为系统发邮件的时候的发件人地址</span></dd>
      </dl>
      <dl>
        <dt>邮件发送方式:</dt>
        <dd class="clearfix">
          <label class="radio radio-inline"><input type="radio" name="settingnew[mail][mailsend]"
                                                                 value="1" <?php if($setting['mail']['mailsend']=='1') { ?> 
            checked<?php } ?> 
            onclick="document.getElementById('hidden1').style.display='none';document.getElementById('hidden2').style.display='none';">通过 PHP 函数的 sendmail 发送(推荐此方式)</label>
        </dd>
        <dd class="clearfix">
          <label class="radio radio-inline"><input type="radio" name="settingnew[mail][mailsend]"
                                                                 value="2" <?php if($setting['mail']['mailsend']=='2') { ?> 
            checked<?php } ?> 
            onclick="document.getElementById('hidden1').style.display='table';document.getElementById('hidden2').style.display='none';">通过 SOCKET 连接 SMTP 服务器发送(支持 ESMTP 验证)</label>
        </dd>
        <dd class="clearfix">
          <label class="radio radio-inline"><input type="radio" name="settingnew[mail][mailsend]"
                                                                 value="3" <?php if($setting['mail']['mailsend']=='3') { ?> 
            checked<?php } ?> 
            onclick="document.getElementById('hidden2').style.display='table';document.getElementById('hidden1').style.display='none';">通过 PHP 函数 SMTP 发送 Email(仅 Windows 主机下有效，不支持 ESMTP 验证)</label>
        </dd>
        <dd class="clearfix">
          <table id="hidden1" class="table text-center"
                               style="margin-bottom:0; <?php if($setting['mail']['mailsend']!=2) { ?>display:none<?php } ?>">
            <thead>
              <tr> <th>删除</th><th>SMTP 服务器</th><th>端口</th><th>验证</th><th>发信人邮件地址</th><th>SMTP 身份验证用户名</th><th>SMTP 身份验证密码</th></tr>
            </thead>
            <?php if(is_array($smtps)) foreach($smtps as $id => $smtp) { ?>            <tr>
              <td><label>
                  <input type="checkbox" name="settingnew[mail][esmtp][delete][]" value="<?php echo $id;?>"/>
                </label></td>
              <td><input class="form-control" style="width:120px;" type="text"
                                           name="settingnew[mail][esmtp][<?php echo $id;?>][server]" value="<?php echo $smtp['server'];?>"/></td>
              <td width="40"><input class="form-control" style="width:30px" type="text"
                                                      name="settingnew[mail][esmtp][<?php echo $id;?>][port]" value="<?php echo $smtp['port'];?>"/></td>
              <td width="40"><label>
                  <input type="checkbox" name="settingnew[mail][esmtp][<?php echo $id;?>][auth]" value="1"
                                           <?php echo $smtp['authcheck'];?>/>
                </label></td>
              <td><input class="form-control" style="width:120px;" type="text"
                                           name="settingnew[mail][esmtp][<?php echo $id;?>][from]" value="<?php echo $smtp['from'];?>"/></td>
              <td><input class="form-control" style="width:100px;" type="text"
                                           name="settingnew[mail][esmtp][<?php echo $id;?>][auth_username]"
                                           value="<?php echo $smtp['auth_username'];?>"/></td>
              <td><input class="form-control" style="width:100px;" type="text"
                                           name="settingnew[mail][esmtp][<?php echo $id;?>][auth_password]"
                                           value="<?php echo $smtp['auth_password'];?>"/></td>
            </tr>
            <?php } ?>
            <tr>
              <td colspan="7" align="left"><a href="javascript:;" onclick="addSMTP(this,1)"><i
                                        class="glyphicon glyphicon-plus"></i>添加新SMTP服务器</a></td>
            </tr>
          </table>
          <table id="hidden2" class="table"
                               style="margin-bottom:0; <?php if($setting['mail']['mailsend']!=3) { ?>display:none<?php } ?>">
            <thead>
            
            <th>删除</th><th>SMTP 服务器</th><th>端口</th>
              </thead>
            
            
            <?php if(is_array($smtps)) foreach($smtps as $id => $smtp) { ?>            <tr>
              <td><label>
                  <input type="checkbox" name="settingnew[mail][smtp][delete][]" value="<?php echo $id;?>"/>
                </label></td>
              <td><input class="form-control" type="text" name="settingnew[mail][smtp][<?php echo $id;?>][server]"
                                           value="<?php echo $smtp['server'];?>"/></td>
              <td width="60"><input class="form-control" style="width:50px" type="text"
                                                      name="settingnew[mail][smtp][<?php echo $id;?>][port]" value="<?php echo $smtp['port'];?>"/></td>
            </tr>
            <?php } ?>
            <tr>
              <td colspan="7" align="left"><a href="javascript:;" onclick="addSMTP(this,0)"><i
                                        class="glyphicon glyphicon-plus"></i>添加新SMTP服务器</a></td>
            </tr>
          </table>
        </dd>
      </dl>
      <dl>
        <dt>邮件头的分隔符:</dt>
        <dd class="clearfix">
          <label class="radio-inline "><input type="radio" name="settingnew[mail][maildelimiter]"
                                                            value="1"<?php if($setting['mail']['maildelimiter']=='1') { ?> 
            checked<?php } ?>>使用 CRLF 作为分隔符(通常为 Windows 主机)</label>
        </dd>
        <dd class="clearfix">
          <label class="radio-inline "><input type="radio" name="settingnew[mail][maildelimiter]"
                                                            value="0"<?php if($setting['mail']['maildelimiter']=='0') { ?> 
            checked<?php } ?>>使用 LF 作为分隔符(通常为 Unix/Linux 主机)</label>
        </dd>
        <dd class="clearfix">
          <label class="radio-inline "><input type="radio" name="settingnew[mail][maildelimiter]"
                                                            value="2"<?php if($setting['mail']['maildelimiter']=='2') { ?> 
            checked<?php } ?>>使用 CR 作为分隔符(通常为 Mac 主机)</label>
        </dd>
        <dd class="clearfix"><span class="help-block "> 请根据您邮件服务器的设置调整此参数</span></dd>
      </dl>
      <dl>
        <dt>收件人地址中包含用户名:</dt>
        <dd class="clearfix">
          <label class="radio-inline ">
            <input type="radio" name="settingnew[mail][mailusername]" value="1" checked>
            是</label>
          &nbsp;&nbsp;
          <label class="radio radio-inline"><input type="radio" name="settingnew[mail][mailusername]"
                                                                 value="0"<?php if(!$setting['mail']['mailusername']) { ?> 
            checked<?php } ?>>否</label>
        </dd>
      </dl>
      <dl>
        <dt>屏蔽邮件发送中的全部错误提示:</dt>
        <dd class="clearfix">
          <label class="radio-inline ">
            <input type="radio" name="settingnew[mail][sendmail_silent]" value="1" checked>
            是</label>
          &nbsp;&nbsp;
          <label class="radio-inline "><input type="radio" name="settingnew[mail][sendmail_silent]"
                                                            value="0"<?php if(!$setting['mail']['sendmail_silent']) { ?>checked 
            <?php } ?>>否</label>
        </dd>
      </dl>
      <dl>
        <input class="btn btn-primary" id="submit_editsubmit" name="settingsubmit"
                           value="保存更改" type="submit">
      </dl>
    </form>
    <script>
                function addSMTP(obj, p) {
                    var html = '';
                    html += '<tr>';
                    html += ' <td>&nbsp;</td>';
                    html += ' <td><input class="form-control" style="width:120px;" type="text"  name="newsmtp[server][]" class="txt"></td>';
                    html += '<td><input class="form-control" style="width:30px" type="text" value="25" name="newsmtp[port][]" class="txt"></td>';
                    if (p > 0) {
                        html += ' <td><label><input type="checkbox" value="1" name="newsmtp[auth][]"></label></td>';
                        html += ' <td><input class="form-control" style="width:120px;" type="text"  name="newsmtp[from][]" class="txt"></td>';
                        html += ' <td ><input class="form-control" style="width:100px;" type="text"  name="newsmtp[auth_username][]" class="txt"></td>';
                        html += ' <td><input class="form-control" style="width:100px;" type="text"  name="newsmtp[auth_password][]" class="txt"></td>';
                    }
                    html += '</tr>';
                    jQuery(obj).parent().parent().before(html);
                }
            </script> 
    <?php } elseif($operation=='access') { ?>
    
    <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left" method="post"
                  name="cpform">
      <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
      <input type="hidden" value="access" name="operation">
      <dl>
        <dt>允许新用户注册:</dt>
        <dd class="clearfix">
          <label class="checkbox-inline"> <input type="checkbox" name="settingnew[regstatus]" value="1"
                            <?php if($setting['regstatus']>0) { ?>checked="checked"<?php } ?>>开放注册</label>
          
          <span class="help-block">设置是否允许游客注册成为平台会员，您可以根据平台需求选择注册方式</span></dd>
      </dl>
      <dl>
        <dt>注册链接文字:</dt>
        <dd class="clearfix">
          <input type="text" class="form-control" name="settingnew[reglinkname]"
                               value="<?php echo $setting['reglinkname'];?>">
          
          <span class="help-block text-muted">设置平台注册页的链接文字，默认为“立即注册”</span></dd>
      </dl>
      <dl>
        <dt>密码最小长度:</dt>
        <dd class="clearfix">
          <input type="text" class="form-control" name="settingnew[pwlength]" value="<?php echo $setting['pwlength'];?>">
          
          <span class="help-block text-muted">新用户注册时密码最小长度，0或不填为不限制</span></dd>
      </dl>
      <dl>
        <dt>强制密码复杂度:</dt>
        <dd class="clearfix">
          <label class="checkbox-inline"><input type="checkbox" name="settingnew[strongpw][]" value="1"
                            <?php if(in_array(1,$setting['strongpw'])) { ?>checked="chcked"<?php } ?> />数字</label>
        </dd>
        <dd class="clearfix">
          <label class="checkbox-inline"><input type="checkbox" name="settingnew[strongpw][]" value="2"
                            <?php if(in_array(2,$setting['strongpw'])) { ?>checked="chcked"<?php } ?> />小写字母</label>
        </dd>
        <dd class="clearfix">
          <label class="checkbox-inline"><input type="checkbox" name="settingnew[strongpw][]" value="3"
                            <?php if(in_array(3,$setting['strongpw'])) { ?>checked="chcked"<?php } ?> />大写字母</label>
        </dd>
        <dd class="clearfix">
          <label class="checkbox-inline"><input type="checkbox" name="settingnew[strongpw][]" value="4"
                            <?php if(in_array(4,$setting['strongpw'])) { ?>checked="chcked"<?php } ?> />特殊符号</label>
        </dd>
        <dd class="clearfix"><span class="help-block">新用户注册时密码中必须存在所选字符类型，不选则为无限制</span></dd>
      </dl>
      <input type="hidden" name="settingnew[regverify]" value="0">
     
      <dl>
        <dt>显示网站服务条款:</dt>
        <dd>
          <label class="radio radio-inline"><input type="radio" name="settingnew[bbrules]" value="1"
                            <?php if($setting['bbrules']>0) { ?>checked<?php } ?> onclick="jQuery('#bbrules_more').show()"
            />是</label>
          <label class="radio radio-inline"><input type="radio" name="settingnew[bbrules]" value="0"
                            <?php if($setting['bbrules']<1) { ?>checked<?php } ?> onclick="jQuery('#bbrules_more').hide()"
            />否</label>
          <span class="help-block">新用户注册时显示网站服务条款</span>
          <dl id="bbrules_more"
                            style="<?php if($setting['bbrules']>0) { ?>display:block<?php } else { ?>display:none<?php } ?>">
           
            <dt>服务条款内容：</dt>
            <dd class="clearfix">
              <textarea class="form-control" type="texterea" name="settingnew[bbrulestxt]" rows="5"><?php echo $setting['bbrulestxt'];?></textarea>
              
              <span class="help-block">网站服务条款的详细内容</span></dd>
          </dl>
        </dd>
        <input class="btn btn-primary" id="submit_editsubmit" name="settingsubmit"
                           value="保存更改" type="submit">
      </dl>
    </form>
    <!--文件夹权限设置--> 
    <?php } elseif($operation == 'permgroup') { ?> 
    <link rel="stylesheet" href="static/switchery/switchery.min.css">
<link rel="stylesheet" href="static/css/checkbox.css">
<link rel="stylesheet" href="<?php echo MOD_PATH;?>/images/setting.css">

<div class="middle-center-content"> 
  
  <!--地址栏结束-->
  <div class="">
    <div class="perm-top middletopMenu">
      <div class="new-button">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myjurisdic"> 新建权限 </button>
        <div class="modal fade" id="myjurisdic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-center" role="document">
            <div class="modal-content modal-color">
              <form action="<?php echo MOD_URL;?>&op=permgroup&do=addpermgroup" method="post"
                                  onsubmit="return permchk(this);">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">添加文件夹权限组</h4>
                </div>
                <div class="modal-body group-top">
                  <div class="col-md-12 clearfix">
                    <label class="control-label  input-label"> 文件夹权限名称 </label>
                    <input type="text" class="form-control"
                                                name="pername" value=""/>
                  </div>
                  <div class="select-p clearfix">
                    <p class="select-perm ">权限选择：</p>
                    <ul class="select-properties col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <?php if(is_array($perms)) foreach($perms as $k => $val) { ?>                      <li class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="checkbox-custom checkbox-primary">
                          <input type="checkbox" name="perms[]" value="<?php echo $val['1'];?>" >
                          <label> <span class="<?php echo $val['2'];?> view-eidt"></span><?php echo $val['0'];?> </label>
                        </div>
                      </li>
                      <?php } ?>
                    </ul>
                  </div>
                </div>
                <div class="modal-footer">
                  <div class="proper-bottom" style="position: relative;">
                    <div class="checkbox-custom checkbox-primary">
                      <input type="checkbox" name="default" value="1" id="inputfore">
                      <label for="inputfore"> <span class="proper-span">设为默认权限组</span> </label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">确定</button>
                  <button type="button" class="btn btn-primary-outline" data-dismiss="modal">取消 </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="properties-table">
      <div class="properties-th">
        <div class="properties-left">
          <p class="properties-Name">名称</p>
          <p class="properties-establish">权限</p>
        </div>
        <div class="properties-operation"> 操作 </div>
      </div>
      <div class="recent-con scroll-y">
        <div class="properties-con"> 
          <?php if(is_array($permgroups)) foreach($permgroups as $v) { ?>          <li class="properties-list" id="perm_<?php echo $v['id'];?>">
          <div class="properties-listLeft">
            <div class="proper-leftimg"> <img src="dzz/styles/thame/colorful/system/folder.png"> <span class="properties-admin"><?php echo $v['pername'];?></span> </div>
            <ul class="proper-show proper-iconshow">
              <?php if(is_array($perms)) foreach($perms as $k => $val) { ?> 
              <li  <?php if($val['1']&$v['perm']) { ?>style="display:block"<?php } else { ?> 
              style="display:none"<?php } ?>><span class="<?php echo $val['2'];?>"></span>
              </li>
              <?php } ?>
            </ul>
          </div>
          <div class="properties-listRight">
            <div class="proper-absoleopera"> 
              <?php if(!$v['system']) { ?> 
              <span class="dzz dzz-netdisk-edit proper-delete" onclick="editpermgroup('<?php echo $v['id'];?>')"
                                      style="cursor:pointer;"></span> <span class="dzz dzz-delete proper-delete" onclick="delete_perm(this,'<?php echo $v['id'];?>')"></span> <input type="checkbox" onchange="edit_perm(this,'<?php echo $v['id'];?>')" class="js-switch"
                                <?php if(!$v['off']) { ?>checked="checked" <?php } ?> /> 
              <?php } else { ?>
              <p class="label label-gainsboro">系统默认</p>
              <input type="checkbox" onchange="edit_perm(this,'<?php echo $v['id'];?>')" class="js-switch"
                                <?php if(!$v['off']) { ?>checked="checked" <?php } ?> /> 
              <?php } ?> 
            </div>
            <div class="proper-delhover"> 
              <?php if($v['default']) { ?> 
              <span class="proper-perm proper-default"><span
                                        class="icon ti-check perm-ok perm-ok-color"></span>默认权限</span> 
              <?php } else { ?> 
              <span class="proper-perm proper-set" onclick="setDefault(this,'<?php echo $v['id'];?>')"><span
                                        class="icon ti-check perm-ok"></span>设为默认</span> 
              <?php } ?> 
            </div>
          </div>
          </li>
          <?php } ?> 
        </div>
      </div>
    </div>
  </div>
  <div class="properties-title">
    <div class="properties-baground">
      <p class="properties-orange">文件夹属性用于部门、群组中创建文件夹的权限</p>
      <ul class="properties-explain">
        <?php if(is_array($perms)) foreach($perms as $k => $val) { ?>        <li><span class="<?php echo $val['2'];?>"></span><?php echo $val['0'];?></li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>
<script type="text/javascript">
    //鼠标滑过
//  jQuery(document).on('mouseenter','.proper-absoleopera .proper-edit',function(){
//      jQuery(this).removeClass('edit3').addClass('edit1');
//  })
//  jQuery(document).on('mouseleave','.proper-absoleopera .proper-edit',function(){
//      jQuery(this).removeClass('edit1').addClass('edit3');
//  })
    //名称初始化
    jQuery(document).ready(function (e) {
        $('.input-black').each(function() {			
InputAnimate.init($(this));			
});
    });
    function permchk(form) {
        jQuery.post(form.action, jQuery(form).serialize(), function (data) {
            if (data['success']) {
                var perms = data['success']['perm'];
                var permstr = '';
                if (data['success']['default'] == 0) {
                    var defaultstr = '<span class="proper-perm proper-set" onclick="setDefault(this,'+data['success']['id']+')"><span class="dzz dzz-done perm-ok"></span>设为默认</span> ';
                } else {
                    var defaultstr = '<span class="proper-perm proper-default"><span class="dzz dzz-done perm-ok perm-ok-color"></span>默认权限</span>';
                    jQuery('.properties-list').each(function(){
                        var idval = jQuery(this).attr('id');
                      idval = idval.replace('perm_','');
                        jQuery(this).find('.proper-delhover').html('<span class="proper-perm proper-set" onclick="setDefault(this,'+idval+')"><span class="dzz dzz-done perm-ok"></span>设为默认</span>')

                    })
                }
                for(var o in perms){
                    permstr += '<li><span class="'+perms[o]+'" ></span></li>';
                }

                var html ='<li class="properties-list" id="perm_'+data['success']['id']+'"> ' +
                        '<div class="properties-listLeft">' +
                        ' <div class="proper-leftimg">' +
                        ' <img src="dzz/styles/thame/colorful/system/folder.png"> <span class="properties-admin">'+data['success']['pername']+'</span> ' +
                        '</div> ' +
                        '<ul class="proper-show proper-iconshow">' +permstr+'</ul> </div> ' +
                        '<div class="properties-listRight"> ' +
                        '<div class="proper-absoleopera">' +
                        '<span class="dzz dzz-netdisk-edit proper-delete" onclick="editpermgroup('+data['success']['id']+')" style="cursor:pointer;"></span> ' +
                        '<span class="dzz dzz-delete proper-delete" onclick="delete_perm(this,'+data['success']['id']+')"></span> ' +
                        '<input type="checkbox" onchange="edit_perm(this,'+data['success']['id']+')" class="js-switch" checked="checked"/>' +
                        '</div> ' +
                        '<div class="proper-delhover"> '+defaultstr+'</div> ' +
                        '</div> ' +
                        '</li>';
                var elem = jQuery(html).appendTo('.properties-con').find('.js-switch');
                var switchery = new Switchery(elem.get(0));
                jQuery('#myjurisdic').modal('hide');
                return false;
            } else {
                showDialog(data['error']);
                return false;
            }
        }, 'json');
        return false;
    }
    function edit_perm(obj, pid) {
        if (jQuery(obj).prop('checked')) {
            var off = 0;
        } else var off = 1;
        jQuery.post(MOD_URL+'&op=permgroup&do=editpermgroup_off', {'off': off, id: pid}, function (data) {
            if (data['success']==true) {
                if (off == 0) {
                    jQuery(obj).attr('checked', true);
                    showmessage('权限组开启成功','success',1000,1);

                }else {
                    jQuery(obj).attr('checked', false);
                    showmessage('权限组关闭成功','success',1000,1);
                }
            }
        }, 'json')
    }
    function setDefault(obj, pid) {
        jQuery.post(MOD_URL+'&op=permgroup&do=setdefault', {'id': pid}, function (data) {
            if (data['success']) {
                jQuery('.properties-list').each(function () {
                    var id = jQuery(this).attr('id').replace('perm_', '');
                    if (id != pid) {
                        jQuery(this).find('.proper-delhover').html('<span class="proper-perm proper-set" onclick="setDefault(this,' + id + ')"><span class="dzz dzz-done perm-ok"></span>设为默认</span>');
                    }

                })
                jQuery(obj).replaceWith('<span class="proper-perm proper-default"><span class="dzz dzz-done perm-ok perm-ok-color"></span>默认权限</span>');
                showmessage('默认权限设置成功','success',1000,1);
            }
        }, 'json');
    }
    function delete_perm(obj, pid) {
        if(confirm('您确定要删除该权限组吗？删除之后不可恢复')){
            jQuery.post(MOD_URL+'&op=permgroup&do=deleteperm', {'id': pid}, function (data) {
                if (data['success']) {
                    jQuery(obj).parents('.properties-list').remove();
                    showmessage('权限组开启成功','success',1000,1);
                }
            }, 'json')
        }
        return false;
    }
    function editpermgroup(pid) {
        showWindow('editpermgroup', MOD_URL+'&op=ajax&operation=editpermgroup&id=' + pid);
    }
    //开关样式
    jQuery.getScript('static/switchery/switchery.min.js',function(){
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function (html) {
            var switchery = new Switchery(html);
        });
    });

</script>  
    <!--系统空间设置--> 
    <?php } elseif($operation == 'space') { ?> 
    <script type="text/javascript">
                try {
                    var openarr = <?php echo $openarr;?>;
                } catch (e) {
                }
                $.getScript('dzz/system/scripts/selorg.js?<?php echo VERHASH;?>', function () {
                    selorg.openarr = openarr;
                });
            </script>
    <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left" method="post" name="cpform">
      <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash"/>
      <input type="hidden" value="space" name="operation"/>
      <dl>
        <dt>系统空间设置:</dt>
        <dd class="clearfix">
          <div class="input-group function-space">
            <input type="text" class="form-control" placeholder="0" name="settingnew[systemSpace]"
                   value="<?php echo $setting['systemSpace'];?>">
            <span class="input-group-addon" id="basic-addon2">M</span></div>
          <span class="help-inline">设置系统空间大小，如果留空或为0则空间无限制，为-1则没有存储空间</span> </dd>
      </dl>
      
      <!-- <dt>个人存储:</dt>
           <dd class="clearfix">
             <label class="radio radio-inline"><input type="radio" name="setting[usermemoryOn]" value="1"
                         &lt;!&ndash;<?php if(!isset($setting['usermemoryOn']) || (isset($setting['usermemoryOn']) && $setting['usermemoryOn'])) { ?>&ndash;&gt; checked="checked" &lt;!&ndash;<?php } ?>&ndash;&gt;/>开启</label>
             <label class="radio radio-inline"> <input type="radio" name="setting[usermemoryOn]" value="0"
                                    &lt;!&ndash;<?php if(isset($setting['usermemoryOn']) && !$setting['usermemoryOn']) { ?>&ndash;&gt;checked="checked"&lt;!&ndash;<?php } ?>&ndash;&gt;/>关闭</label>
           </dd>
           <dd class="clearfix"><span class="help-block">控制系统用户是否有个人存储空间 </span></dd>-->
      <dl id="user_space_set">
        <dt>用户上传权限设置:</dt>
        <dd class="clearfix">
          <p class="text-danger ml20" style="margin-left:0px"> 注： 用户私有云(我的云中用户添加的云)不做限制，所以此处的设置的”默认空间“对用户私有云不起作用。 </p>
          <!-- <label class="checkbox-inline"> <input type="radio"  name="setting[mermoryusersetting]" value="all" &lt;!&ndash;<?php if($setting['mermoryusersetting'] != 'appoint') { ?>&ndash;&gt;checked="checked"&lt;!&ndash;<?php } ?>&ndash;&gt;>所有人员</label>
            <label class="checkbox-inline"> <input type="radio"  name="setting[mermoryusersetting]" value="appoint"
&lt;!&ndash;<?php if($setting['mermoryusersetting'] == 'appoint') { ?>&ndash;&gt; checked="checked"&lt;!&ndash;<?php } ?>&ndash;&gt;>指定人员或部门人员</label>--> 
        </dd>
        <dd class="clearfix">
          <div class="all_user_setting"  style="margin-top:20px">
          <?php if(is_array($usergroups)) foreach($usergroups as $value) { ?><dd class="clearfix">
  <dl>
<dt><?php echo $value['grouptitle'];?></dt>
<dd class="clearfix"><span class="pull-left mr20" style="padding:6px;padding-left:0px;">默认空间</span>
  <div class="input-group" style="width:120px;float:left">
<input type="text" class="form-control" style="width:100px;"
   name="group[<?php echo $value['groupid'];?>][maxspacesize]" value="<?php echo $value['maxspacesize'];?>">
<span class="input-group-addon">M</span></div>
  
  <span class="help-inline">用户的默认空间大小，单位M。0或不填 不限制； -1: 无空间</span></dd>
<dd class="clearfix mt10"><span class="pull-left mr20"
style="padding:6px;padding-left:0px;">文件大小</span>
  <div class="input-group" style="width:120px;float:left">
<input type="text" class="form-control" style="width:100px;"
   name="group[<?php echo $value['groupid'];?>][maxattachsize]" value="<?php echo $value['maxattachsize'];?>">
<span class="input-group-addon">M</span></div>
  
  <span class="help-inline">允许上传的最大文件大小，单位M。0或不填 不限制；</span></dd>
<dd class="clearfix mt10"><span class="pull-left mr20"
style="padding:6px;padding-left:0px;">文件类型</span>
  <input type="text" class="form-control" style="width:250px;"
   name="group[<?php echo $value['groupid'];?>][attachextensions]"
   value="<?php echo $value['attachextensions'];?>">
  
  <span class="help-inline">允许上传的文件后缀，多个使用半角逗号隔开，留空不限制</span></dd>
  </dl>
</dd>
          <?php } ?>
      </dl>
     
     
      <dl>
        <dt>机构存储空间设置:</dt>
       
        <dd class="clearfix spacesetting "> 
         
          <div class="input-group function-space">
            <input type="text" class="form-control" placeholder="0" name="settingnew[orgmemorySpace]"
                                   value="<?php echo $setting['orgmemorySpace'];?>">
            <span class="input-group-addon" id="basic-addon2">M</span></div>
          <span class="help-inline">设置机构默认空间大小，如果留空或为0则共享系统所有空间，为-1则没有存储空间</span> </dd>
      </dl>
      <dl>
        <dt>群组存储空间设置:</dt>
      
        <dd class="clearfix spacesetting ">
          <div class="input-group function-space">
            <input type="text" class="form-control" placeholder="0" name="settingnew[groupmemorySpace]"
                                   value="<?php echo $setting['groupmemorySpace'];?>">
            <span class="input-group-addon" id="basic-addon2">M</span></div>
          <span class="help-inline">设置群组默认空间大小，如果留空或为0则共享系统所有空间，为-1则没有存储空间</span> </dd>
      </dl>
      <dl>
        <input class="btn btn-primary" id="submit_editsubmit" name="settingsubmit"
                           value="保存更改" type="submit">
      </dl>
    </form>
   
    <?php } elseif($operation=='smiley') { ?>
    <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left" method="post"
                  name="cpform">
      <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
      <input type="hidden" value="smiley" name="operation">
      <dl>
        <dt>表情图片的宽高:</dt>
        <dd class="clearfix">
          <input type="text" class="form-control" name="settingnew[smthumb]" value="<?php echo $setting['smthumb'];?>">
          
          <span class="help-inline text-muted">允许范围在 20～40 之间，图片实际尺寸超出设置值时将自动缩略显示</span></dd>
      </dl>
      <dl>
        <dt>表情列数:</dt>
        <dd class="clearfix">
          <input type="text" class="form-control" name="settingnew[smcols]" value="<?php echo $setting['smcols'];?>">
          
          <span class="help-inline text-muted">表情显示的列数，允许范围在 8～12之间</span></dd>
      </dl>
      <dl>
        <dt>表情行数:</dt>
        <dd class="clearfix">
          <input type="text" class="form-control" name="settingnew[smrows]" value="<?php echo $setting['smrows'];?>">
          
          <span class="help-inline text-muted">表情显示的行数</span></dd>
      </dl>
      <input class="btn btn-primary" name="settingsubmit" value="保存更改" type="submit">
    </form>
    
    <?php } elseif($operation=='datetime') { ?>
    
    <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left" method="post"
                  name="cpform">
      <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
      <input type="hidden" value="datetime" name="operation">
      <dl>
        <dt>默认日期格式:</dt>
        <dd class="clearfix">
          <input type="text" name="settingnew[dateformat]" class="form-control"
                               value="<?php echo $setting['dateformat'];?>">
          
          <span class="help-block text-muted">使用 yyyy(yy) 表示年，mm 表示月，dd 表示天。如 yyyy-mm-dd 表示 2000-1-1</span></dd>
      </dl>
      <dl>
        <dt>默认时间格式:</dt>
        <dd class="clearfix">
          <label class="radio radio-inline">
            <input type="radio" name="settingnew[timeformat]" value="24" <?php echo $checktimeformat['24'];?>/>
            24 小时制</label>
          <label class="radio radio-inline">
            <input type="radio" name="settingnew[timeformat]" value="12" <?php echo $checktimeformat['12'];?>/>
            12 小时制</label>
        </dd>
      </dl>
      <dl>
        <dt>人性化时间格式:</dt>
        <dd class="clearfix">
          <label class="radio radio-inline"><input type="radio"
                                                                                           name="settingnew[dateconvert]"
                                                                                           value="1"
                            <?php if($setting['dateconvert']>0) { ?>checked<?php } ?> />是</label>
          <label class="radio radio-inline"><input type="radio" name="settingnew[dateconvert]" value="0"
                            <?php if($setting['dateconvert']<1) { ?>checked<?php } ?> />否</label>
        </dd>
        </dd>
        <dd class="clearfix"><span class="help-block">选择“是”，平台中的时间将显示以“n分钟前”、“昨天”、“n天前”等形式显示</span>
      </dl>
      <dl>
        <dt>默认时差:</dt>
        <dd class="clearfix">
          <select onchange="if(this.value !== '')document.getElementById('settingnew[timeoffset]').value=this.value;"
                                style="width:350px" name="global_timeoffset" class="form-control">
            <?php if(is_array($timezones)) foreach($timezones as $key => $value) { ?> 
            <option value="<?php echo $key;?>" <?php if($key==$setting['timeoffset']) { ?>selected="selected" 
            <?php } ?>><?php echo cutstr($value, 40, '..')?>            </option>
            <?php } ?>
          </select>
        </dd>
        <dd class="clearfix" style="margin-top:10px;">
          <input type="text" name="settingnew[timeoffset]" class="form-control"
                               value="<?php echo $setting['timeoffset'];?>" style="width:350px" id="settingnew[timeoffset]">
        </dd>
        <dd class="clearfix"><span class="help-block">当地时间与 GMT 的时差。遇夏制时的情况也可以手动输入，如：-7.5</span></dd>
        <input class="btn btn-primary" name="settingsubmit" value="保存更改" type="submit">
      </dl>
    </form>
    <?php } elseif($operation=='sec') { ?>
    
    <dl class="clearfix" style="margin-top: 15px;">
      <dt>提示信息</dt>
      <ul class="help-block">
        <li>使用图片作为验证码文字，图片必须包含字符“2346789BCEFGHJKMPQRTVWXY”24 个字符，且必须为 GIF 透明图片、背景透明、前景黑色，黑色为图片的第一个索引色。图片大小不限制，但建议宽度不大于验证码宽度的 1/4，高度不大于验证码高度。制作完毕后在 static/image/seccode/gif/ 下创建一个新的子目录，目录名任意，把制作完毕的 24 个 GIF 图片上传到新子目录下</li>
					<li>使用图片作为验证码的背景，把制作好的 JPG 图片上传到 static/image/seccode/background/ 目录下，平台将随机使用里面的图片作为验证码的背景</li>
					<li>使用 TTF 字体作为验证码文字，把下载的 TTF 英文字体文件上传到 static/image/seccode/font/en/ 目录下，平台将随机使用里面的字体文件作为验证码的文字</li>
					<li>使用中文图片验证码前，需要把包含完整中文汉字的 TTF 中文字体文件上传到 static/image/seccode/font/ch/ 目录下，平台将随机使用里面的字体文件作为验证码的文字</li>
					<li>系统验证码位于 core/class/seccode/ 目录中。</li>
      </ul>
    </dl>
    <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left" method="post"
                  name="cpform">
      <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
      <input type="hidden" value="sec" name="operation">
      <dl>
        <dt>启用验证码:</dt>
        <dd class="clearfix">
          <label class="checkbox-inline"><input type="checkbox" value="1"
                                                              name="settingnew[seccodestatus][1]"
                            <?php if($seccodestatus['1']>0) { ?>checked<?php } ?>> 新用户注册</label>
        </dd>
        <dd class="clearfix">
          <label class="checkbox-inline"><input type="checkbox" value="1"
                                                              name="settingnew[seccodestatus][2]"
                            <?php if($seccodestatus['2']>0) { ?>checked<?php } ?>> 用户登录</label>
        </dd>
        <dd class="clearfix">
          <label class="checkbox-inline"><input type="checkbox" value="1"
                                                              name="settingnew[seccodestatus][3]"
                            <?php if($seccodestatus['3']>0) { ?>checked<?php } ?>> 修改密码</label>
        </dd>
        <dd class="clearfix"><span class="help-block">验证码可以避免恶意注册及登录，请选择需要打开验证码的操作。注意: 启用验证码会使得部分操作变得繁琐，建议仅在必需时打开</span></dd>
      </dl>
      <dl>
        <dt>验证码类型:</dt>
        <dd class="clearfix">
          <label class="radio radio-inline"><input type="radio"
                                                                 onclick="document.getElementById('seccodeimageext').style.display = '';document.getElementById('seccodeimagewh').style.display = '';"
                            <?php if($setting['seccodedata']['type']<1) { ?>checked<?php } ?> value="0"
            name="settingnew[seccodedata][type]"> 英文图片验证码 </label>
        </dd>
       
       
       
        <dd class="clearfix">
          <label class="radio radio-inline"><input type="radio"
                                                                 onclick="document.getElementById('seccodeimageext').style.display = 'none';document.getElementById('seccodeimagewh').style.display = 'none';"
                            <?php if($setting['seccodedata']['type']==99) { ?>checked<?php } ?> value="99"
            name="settingnew[seccodedata][type]"> 位图验证码 </label>
        </dd>
        <dd class="clearfix"><span class="help-block">设置验证码的类型。中文图片验证码需要您的主机支持 FreeType 库。要显示 Flash 验证码，建议您的主机支持 Ming 库以提高安全性</span></dd>
        <dd class="clearfix">
          <dl>
            <dt>验证码预览</dt>
            <dd class="clearfix">
             <div style="max-width:250px;"> 
              <?php $_G['sechashi'] = !empty($_G['cookie']['sechashi']) ? $_G['sechash'] + 1 : 0;
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
            </dd>
          </dl>
        </dd>
        <dd id="seccodeimagewh" <?php if($setting['seccodedata']['type']<3) { ?>style="display:block" 
        <?php } else { ?>style="display:none" 
        <?php } ?>>
        <dl>
          <dt>验证码图片宽度</dt>
          <dd class="clearfix">
            <input type="text" class="form-control" value="<?php echo $setting['seccodedata']['width'];?>"
                                   name="settingnew[seccodedata][width]">
            
            <span class="help-inline">验证码图片的宽度，范围在 100～200 之间</span>
        </dl>
        <dl>
          <dt>验证码图片高度</dt>
          <dd class="clearfix">
            <input type="text" class="form-control" value="<?php echo $setting['seccodedata']['height'];?>"
                                   name="settingnew[seccodedata][height]">
            
            <span class="help-inline">验证码图片的高度，范围在 30～80 之间</span>
        </dl>
        </dd>
        <dd id="seccodeimageext" <?php if($setting['seccodedata']['type']<2) { ?>style="display:block" 
        <?php } else { ?>style="display:none" 
        <?php } ?>>
        <dl>
          <dt>图片打散</dt>
          <dd class="clearfix">
            <input type="text" class="form-control" value="<?php echo $setting['seccodedata']['scatter'];?>"
                                   name="settingnew[seccodedata][scatter]">
            
            <span class="help-inline">打散生成的验证码图片，输入打散的级别，0 为不打散</span>
        </dl>
        <dl>
          <dt>随机图片背景</dt>
          <dd class="clearfix">
            <label class="radio radio-inline"><input type="radio"
                                <?php if($setting['seccodedata']['background']>0) { ?>checked<?php } ?> value="1"
              name="settingnew[seccodedata][background]">是</label>
            <label class="radio radio-inline"><input type="radio"
                                <?php if($setting['seccodedata']['background']<1) { ?>checked<?php } ?> value="0"
              name="settingnew[seccodedata][background]">否</label>
            <span class="help-block" 选择“是”将随机使用 static/image/seccode/background/ 目录下的 JPG 图片作为验证码的背景图片，选择“否”将使用随机的背景色</span>
        </dl>
        <dl>
          <dt>随机背景图形</dt>
          <dd class="clearfix">
            <label class="radio radio-inline"><input type="radio"
                                <?php if($setting['seccodedata']['adulterate']>0) { ?>checked<?php } ?> value="1"
              name="settingnew[seccodedata][adulterate]">是</label>
            <label class="radio radio-inline"><input type="radio"
                                <?php if($setting['seccodedata']['adulterate']<1) { ?>checked<?php } ?> value="0"
              name="settingnew[seccodedata][adulterate]">否</label>
            <span class="help-block">选择“是”将给验证码背景增加随机的图形</span>
        </dl>
        <dl>
          <dt>随机 TTF 字体</dt>
          <dd class="clearfix">
            <label class="radio radio-inline"><input type="radio"
                                <?php if($setting['seccodedata']['ttf']>0) { ?>checked<?php } ?> value="1"
              name="settingnew[seccodedata][ttf]">是</label>
            <label class="radio radio-inline"><input type="radio"
                                <?php if($setting['seccodedata']['ttf']<1) { ?>checked<?php } ?> value="0"
              name="settingnew[seccodedata][ttf]">否</label>
            <ul class="help-block">
              <li>选择“是”将随机使用 static/image/seccode/font/en/ 目录下的 TTF 字体文件生成验证码文字</li>
										<li>选择“否”将随机使用 static/image/seccode/gif/ 目录中的 GIF 图片生成验证码文字</li>
										<li>中文图片验证码将随机使用 static/image/seccode/font/ch/ 目录下的 TTF 字体文件，无需进行此设置</li>
            </ul>
        </dl>
        <dl>
          <dt>随机倾斜度</dt>
          <dd class="clearfix">
            <label class="radio radio-inline"><input type="radio"
                                <?php if($setting['seccodedata']['angle']>0) { ?>checked<?php } ?> value="1"
              name="settingnew[seccodedata][angle]">是</label>
            <label class="radio radio-inline"><input type="radio"
                                <?php if($setting['seccodedata']['angle']<1) { ?>checked<?php } ?> value="0"
              name="settingnew[seccodedata][angle]">否</label>
            <span class="help-block">选择“是”将给验证码文字增加随机的倾斜度，本设置只针对 TTF 字体的验证码</span>
        </dl>
        <dl>
          <dt>随机扭曲</dt>
          <dd class="clearfix">
            <label class="radio radio-inline"><input type="radio"
                                <?php if($setting['seccodedata']['warping']>0) { ?>checked<?php } ?> value="1"
              name="settingnew[seccodedata][warping]">是</label>
            <label class="radio radio-inline"><input type="radio"
                                <?php if($setting['seccodedata']['warping']<1) { ?>checked<?php } ?> value="0"
              name="settingnew[seccodedata][warping]">否</label>
            <span class="help-block">选择“是”将给验证码文字增加随机的扭曲，本设置只针对 TTF 字体的验证码</span>
        </dl>
        <dl>
          <dt>随机颜色</dt>
          <dd class="clearfix">
            <label class="radio radio-inline"><input type="radio"
                                <?php if($setting['seccodedata']['color']>0) { ?>checked<?php } ?> value="1"
              name="settingnew[seccodedata][color]">是</label>
            <label class="radio radio-inline"><input type="radio"
                                <?php if($setting['seccodedata']['color']<1) { ?>checked<?php } ?> value="0"
              name="settingnew[seccodedata][color]">否</label>
            <span class="help-block">选择“是”将给验证码的背景图形和文字增加随机的颜色</span>
        </dl>
        <dl>
          <dt>随机大小</dt>
          <dd class="clearfix">
            <label class="radio radio-inline"><input type="radio"
                                <?php if($setting['seccodedata']['size']>0) { ?>checked<?php } ?> value="1"
              name="settingnew[seccodedata][size]">是</label>
            <label class="radio radio-inline"><input type="radio"
                                <?php if($setting['seccodedata']['size']<1) { ?>checked<?php } ?> value="0"
              name="settingnew[seccodedata][size]">否</label>
            <span class="help-block">选择“是”验证码文字的大小随机显示</span>
        </dl>
        <dl>
          <dt>文字阴影</dt>
          <dd class="clearfix">
            <label class="radio radio-inline"><input type="radio"
                                <?php if($setting['seccodedata']['shadow']>0) { ?>checked<?php } ?> value="1"
              name="settingnew[seccodedata][shadow]">是</label>
            <label class="radio radio-inline"><input type="radio"
                                <?php if($setting['seccodedata']['shadow']<1) { ?>checked<?php } ?> value="0"
              name="settingnew[seccodedata][shadow]">否</label>
            <span class="help-block">选择“是”将给验证码文字增加阴影</span>
        </dl>
        <dl>
          <dt>GIF 动画</dt>
          <dd class="clearfix">
            <label class="radio radio-inline"><input type="radio"
                                <?php if($setting['seccodedata']['animator']>0) { ?>checked<?php } ?> value="1"
              name="settingnew[seccodedata][animator]">是</label>
            <label class="radio radio-inline"><input type="radio"
                                <?php if($setting['seccodedata']['animator']<1) { ?>checked<?php } ?> value="0"
              name="settingnew[seccodedata][animator]">否</label>
            <span class="help-block">选择“是”验证码将显示成 GIF 动画方式，选择“否”验证码将显示成静态图片方式</span>
        </dl>
        </dd>
        <input class="btn btn-primary" name="settingsubmit" value="保存更改" type="submit">
      </dl>
    </form>
    <?php } elseif($operation=='censor') { ?>
    
    <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left" method="post"
                  name="cpform">
      <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
      <input type="hidden" value="censor" name="operation">
      <dl>
        <dt>敏感词替换为:</dt>
        <dd class="clearfix">
          <input type="text" class="form-control" name="replace" value="<?php echo $replace;?>"/>
          
          <span class="help-inline">敏感词将会被替换为此处设置的字符</span></dd>
      </dl>
      <dl>
        <dt>需要替换的敏感词:</dt>
        <dd class="clearfix">
          <textarea class="form-control" name="badwords" rows="1" style="width:100%"/><?php echo $badwords;?></textarea>
          
          <span class="help-block">多个词请使用半角的逗号隔开</span></dd>
      </dl>
      <input class="btn btn-primary" name="settingsubmit" value="保存更改" type="submit">
    </form>
    <?php } elseif($operation=='qywechat') { ?>
    <form id="cpform" action="<?php echo BASESCRIPT;?>?mod=setting" class="form-horizontal-left" method="post" name="cpform"
                  onsubmit="return validate(this);">
      <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash">
      <input type="hidden" value="true" name="settingsubmit">
      <input type="hidden" value="qywechat" name="operation">
      <dl>
        <dt>CorpID:</dt>
        <dd class="clearfix">
          <input type="text" id="CorpID" class="form-control" name="settingnew[CorpID]"
                               value="<?php echo $setting['CorpID'];?>" required="true"/>
          <span class="help-block">此项是开发者凭据，您需登录［微信企业号平台］，去[设置]-［权限管理］-[管理]-[选择需要与DzzOffice平台绑定的管理组]，下拉至底部复制CorpID的值</span></dd>
      </dl>
      <dl>
        <dt>CorpSecret:</dt>
        <dd class="clearfix">
          <input type="text" id="CorpSecret" class="form-control" name="settingnew[CorpSecret]"
                               value="<?php echo $setting['CorpSecret'];?>" required="true"/>
          <span class="help-block">此项是开发者凭据，您需登录［微信企业号平台］，去[设置]-［权限管理］-[管理]-[选择需要与DzzOffice平台绑定的管理组]，下拉至底部复制Secret的值</span></dd>
      </dl>
      <dl>
        <dt>同步范围:</dt>
        <dd class="clearfix">
          <div class="dropdown">
            <input id="sel_syndepartment" type="hidden" name="settingnew[synorgid]"
                                   value="<?php echo $setting['synorgid'];?>"/>
            <button type="button" id="syndepartment_Menu" class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown"> <?php echo $syndepartment;?> <span class="caret"></span></button>
            <div id="syndepartment_dropdown_menu" class="dropdown-menu org-sel-box" role="menu"
                                 aria-labelledby="syndepartment_Menu">
              <iframe name="orgids_iframe" class="org-sel-box-iframe"
                                        src="index.php?mod=system&amp;op=orgtree&amp;ctrlid=syndepartment&amp;nouser=1"
                                        frameborder="0" marginheight="0" marginwidth="0" width="100%" height="100%"
                                        allowtransparency="true"></iframe>
            </div>
          </div>
        </dd>
        <ul class="help-block" style="line-height:2;">
          <li>只有同步范围内的用户才会同步到微信</li>
						<li>不在同步范围内的用户如果已经在微信里，将会被禁用</li>
						<li>如果微信企业号用户上限够用，请尽量设置全部</li>
        </ul>
      </dl>
      <dl>
        <dd>
          <input type="hidden" id="fbind" name="fbind" value="bind"/>
          <button class="btn btn-success btn-width"
                                onclick="document.getElementById('cpform').onsubmit();">绑定 </button>
          &nbsp;&nbsp;
          <button class="btn btn-danger btn-width"
                                onclick="document.getElementById('fbind').value='unbind';document.getElementById('cpform').onsubmit();"> 解绑 </button>
        </dd>
      </dl>
    </form>
    <script type="text/javascript">
                var selorg = {};

                //添加
                selorg.add = function (ctrlid, vals) {
                    if (vals.length > 0) {
                        if (vals[0].orgid == 'other') vals[0].path = '无机构用户';
                        jQuery('#' + ctrlid + '_Menu').html(vals[0].path + ' <span class="caret"></span>');
                        jQuery('#sel_' + ctrlid).val(vals[0].orgid);
                    } else {
                        jQuery('#' + ctrlid + '_Menu').html('全部用户 <span class="caret"></span>');
                        jQuery('#sel_' + ctrlid).val(0);
                    }
                }

                function validate(form) {
                    if (document.getElementById('CorpID').value == '') {
                        document.getElementById('CorpID').focus();
                        return false;
                    }
                    if (document.getElementById('CorpSecret').value == '') {
                        document.getElementById('CorpSecret').focus();
                        return false;
                    }
                    form.submit();
                }
            </script> 
    <?php } ?> 
  </div>
</div>
</div>
<script type="text/javascript">
    jQuery('.left-drager').leftDrager_layout();
    jQuery(document).ready(function (e) {
        jQuery('textarea').TextAreaExpander(30,500);
        jQuery('label.radio-inline input,label.radio input,label.checkbox-inline input,label.checkbox input').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        jQuery('label.radio-inline input,label.radio input,label.checkbox-inline input,label.checkbox input').on('ifChecked', function (e) {
            jQuery(this).trigger('click');
        });
       
        jQuery('input[required]').on('blur', function () {
            if (this.value == '') {
                jQuery(this).addClass('input-error')
            } else {
                jQuery(this).removeClass('input-error');
            }
        });
        jQuery('input[required]').on('change', function () {
            if (this.value == '') {
                jQuery(this).addClass('input-error')
            } else {
                jQuery(this).removeClass('input-error');
            }
        });

jQuery('.file-hidde').fileupload({
url: '<?php echo MOD_URL;?>&op=upload',
dataType: 'json',
autoUpload: true,
maxChunkSize: 2000000, //2M
maxFileSize: 2000000, // 2 MB
acceptFileTypes: new RegExp("\.([jpe?g|gif|png])$", 'i'),
sequentialUploads: true,
add: function(e, data) {
data.images = jQuery(this).siblings('.upold-add');
data.images_src = jQuery(this).siblings('.upold-add').attr('src');
data.input_id = jQuery(this).siblings('.build-images');
data.progre = jQuery(this).siblings('.progress-bar');
data.images.attr('src','dzz/images/default/thumb.png');
data.process().done(function() {
data.submit();
});
},
progress: function(e, data) {
var progress = parseInt(data.loaded / data.total * 100, 10);
data.progre.css(
'width',
progress + '%'
);
},
done: function(e, data) {
jQuery.each(data.result.files, function(index, file) {
if(file.error) {
data.images.attr('src',data.images_src);
data.progre.css('width', 0);
showmessage('图片上传失败', 'danger', 3000, 1);
} else {
data.images.attr('src',file.data.img);
data.input_id.val(file.data.aid);
setTimeout(function(){
data.progre.css('width', 0);
},2000)
}

});
}
});
    });
</script> 
<script src="static/bootstrap/js/bootstrap.min.js?<?php echo VERHASH;?>" ></script> 
<script type="text/javascript" src="static/icheck/icheck.min.js?<?php echo VERHASH;?>" ></script>

<script type="text/javascript" src="static/jquery_file_upload/jquery.ui.widget.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript" src="static/jquery_file_upload/jquery.iframe-transport.js?<?php echo VERHASH;?>" ></script>
<!-- The basic File Upload plugin -->
<script type="text/javascript" src="static/jquery_file_upload/jquery.fileupload.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript" src="static/jquery_file_upload/jquery.fileupload-process.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript" src="./data/template/admin_setting_main_jquery_fileupload-validate_zh-cn.js" ></script><script type="text/javascript" src="static/jquery_file_upload/jquery.fileupload-validate.js?<?php echo VERHASH;?>" ></script><?php output();?><?php updatesession();?><?php if(debuginfo()) { ?>
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