<?php if(!defined('IN_DZZ')) exit('Access Denied'); /*a:9:{s:88:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/appmarket/template/appdefault.htm";i:1536850350;s:101:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_start.htm";i:1536850350;s:99:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_end.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/commer_header.htm";i:1536850350;s:79:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/template/header_left.htm";i:1536850350;s:91:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/appmarket/template/header_search.htm";i:1536850350;s:94:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_right.htm";i:1536850350;s:82:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/appmarket/template/left.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/footer_simple.htm";i:1536850350;}*/?>
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
<script type="text/javascript" src="./data/template/admin_appmarket_appdefault_header_zh-cn.js" ></script><script type="text/javascript" src="static/js/header.js?<?php echo VERHASH;?>" ></script>
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
<link rel="stylesheet" href="static/switchery/switchery.min.css">
<link href="static/css/common.css?<?php echo VERHASH;?>" rel="stylesheet" media="all"> 

<script type="text/javascript" src="static/js/jquery.leftDrager.js?<?php echo VERHASH;?>" ></script>
<style>
.bs-main-container{
margin-left:200px;
}
.main-header2 .nav>li>a{
padding:6px 10px;
}

/*12.2添加*/
.main-header2 .nav>li{
padding-top: 8px 
}
ul, ul li, li {
list-style: unset;
}
/*结束*/
</style><script type="text/javascript" src="./data/template/admin_appmarket_appdefault_common_zh-cn.js" ></script><script type="text/javascript" src="static/js/common.js?<?php echo VERHASH;?>" ></script>
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
        <a href="<?php echo MOD_URL;?>">应用市场</a>
    </li> 
</ul>    </div>
    <div class="resNav-item resNav-center"><?php if($_GET['op']=='extopen') { ?>
 <div class="input-search">
 <form name="search" action="<?php echo BASESCRIPT;?>" method="get">
    <input type="hidden" name="mod" value="appmarket" />
    <input type="hidden" name="op" value="extopen" />
    <i class="input-search-icon glyphicon glyphicon-search" aria-hidden="true" onclick="this.parentNode.submit()"></i>
    <input type="text" class="form-control search  form-search" name="ext" value="<?php echo $_GET['ext'];?>" placeholder="扩展名" id="searchval">
    <span aria-hidden="true" id="emptysearchcondition" class="header-closebutton">×</span>
 </form>
</div>
<?php } elseif(empty($_GET['op'])) { ?>
 <div class="input-search">
 <form name="search" action="<?php echo BASESCRIPT;?>" method="get">
    <input type="hidden" name="mod" value="appmarket" />
    <input type="hidden" name="op" value="" />
    <input type="hidden" name="tagid" value="<?php echo $_GET['tagid'];?>" />
     <input type="hidden" name="group" value="<?php echo $_GET['group'];?>" />
    <i class="input-search-icon glyphicon glyphicon-search" aria-hidden="true" onclick="this.parentNode.submit()"></i>
    <input type="text" class="form-control search  form-search" name="keyword" value="<?php echo $_GET['keyword'];?>" placeholder="应用名称或供应商" id="searchval">
    <span aria-hidden="true" id="emptysearchcondition" class="header-closebutton">×</span>

 </form>
</div>
<?php } elseif($_GET['op']==upgrade) { ?>
 <div class="input-search">
 <form name="search" action="<?php echo BASESCRIPT;?>" method="get">
    <input type="hidden" name="mod" value="<?php echo MOD_NAME;?>" /> 
    <input type="hidden" name="op" value="upgrade" />
    <i class="input-search-icon glyphicon glyphicon-search" aria-hidden="true" onclick="this.parentNode.submit()"></i>
    <input type="text" class="form-control search  form-search" name="keyword" value="<?php echo $_GET['keyword'];?>" placeholder="应用市场" id="searchval">
 <span aria-hidden="true" id="emptysearchcondition" class="header-closebutton">×</span>			
 </form>
</div>
<?php } elseif($_GET['op']=='default') { ?>
 <div class="input-search">
 <form name="search" action="<?php echo BASESCRIPT;?>" method="get">
    <input type="hidden" name="mod" value="<?php echo MOD_NAME;?>" /> 
    <input type="hidden" name="op" value="<?php echo $_GET['op'];?>" />
    <input type="hidden" name="group" value="<?php echo $_GET['group'];?>" />
    <input type="hidden" name="position" value="<?php echo $_GET['position'];?>" />
    <input type="hidden" name="depid" value="<?php echo $_GET['depid'];?>" />
    <i class="input-search-icon glyphicon glyphicon-search" aria-hidden="true" onclick="this.parentNode.submit()"></i>
    <input type="text" class="form-control search  form-search" name="keyword" value="<?php echo $_GET['keyword'];?>" placeholder="应用市场" id="searchval">
     <span aria-hidden="true" id="emptysearchcondition" class="header-closebutton">×</span>

 </form>
</div>
<?php } ?>
<script type="text/javascript">

jQuery('#searchval').focus(function (e) {//头部搜索框变颜色
    jQuery(this).closest('.input-search').addClass('focus');
if(this.value!='') jQuery('#emptysearchcondition').show();
});
jQuery('#searchval').blur(function (e) {//失去焦点时
 jQuery(this).closest('.input-search').removeClass('focus');
 if(this.value=='') jQuery('#emptysearchcondition').hide();
});
jQuery('#searchval').keyup(function (e) {//失去焦点时
if(this.value!='') jQuery('#emptysearchcondition').show();
});
jQuery('#emptysearchcondition').on('click',function(){
jQuery('#searchval').val('');
jQuery('#searchval').closest('form').submit();
jQuery('#emptysearchcondition').hide();
return false;
});
</script>    </div>
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
<div class="bs-left-container  clearfix"><ul class="nav-stacked">
<li <?php if($op=='index' || ($op=='edit' && $appid)) { ?>class="active"<?php } ?>>
<a href="<?php echo MOD_URL;?>"><i class="glyphicon glyphicon-file"></i> 已安装</a>
</li>
   
    <li <?php if($op=='upgrade_app' || $op=='appupgrade') { ?>class="active"<?php } ?>>
<a href="<?php echo MOD_URL;?>&op=appupgrade&refer=<?php echo $refer;?>"><i class="glyphicon glyphicon-upload"></i> 升级 <span id="update_app_num" class="badge badge-danger <?php if(($upsum=get_update_app_num())<1) { ?>hide<?php } ?>"><?php echo $upsum;?></span></a>
</li>
<li <?php if($op=='cloudappmarket' || $op=='list') { ?>class="active"<?php } ?>>
<a href="<?php echo MOD_URL;?>&op=cloudappmarket"><i class="glyphicon glyphicon-th-large"></i> 应用市场</a>
</li>
<li <?php if($op=='extopen') { ?>class="active"<?php } ?>>
<a href="<?php echo MOD_URL;?>&op=extopen"><i class="glyphicon glyphicon-filter"></i> 打开方式</a>
</li>
<li <?php if($op=='default') { ?>class="active"<?php } ?>>
<a href="<?php echo MOD_URL;?>&op=default"><i class="glyphicon glyphicon-cog"></i> 权限管理</a>
</li>
</ul></div>
<div class="left-drager">
<div class="left-drager-op">
<div class="left-drager-sub"></div>
</div>
</div>
<div class="bs-main-container">
<div class="main-header clearfix">
<ul class="nav navbar-nav nav-pills-bottomguide">

<li <?php if($group=='0' && !$org) { ?>class="active"<?php } ?>>
<a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&op=default&group=0">通用应用</a>
</li>
<li <?php if($group=='-1' && !$org) { ?>class="active"<?php } ?>>
<a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&op=default&group=-1">游客应用</a>
</li>

<li <?php if($group=='1') { ?>class="active"<?php } ?>>
<a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&op=default&group=1">普通成员应用</a>
</li>
<li <?php if($group=='3' && !$org) { ?>class="active"<?php } ?>>
<a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&op=default&group=3">系统管理员应用</a>
</li>
<li <?php if($group=='2' && !$org) { ?>class="active"<?php } ?>>
<a href="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&op=default&group=2">部门管理员应用</a>
</li>
</ul>
</div> 


<div class="main-content clearfix" style="border-top:1px solid #FFF;padding:0">
<form id="appform" name="appform" class="form-horizontal" action="<?php echo BASESCRIPT;?>?mod=<?php echo MOD_NAME;?>&op=default" method="post">
<input type="hidden" name="appsubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<table class="table table-hover">
<thead>
<th width="50">排序</th>
<th>应用名称</th>
<th>默认位置</th>
<?php if($group==1) { ?><th>允许使用部门<small style="display:block;font-size:12px;color:#999">可点击应用名称编辑</small></th><?php } ?>
<th>强制安装<small style="display:block;font-size:12px;color:#999">强制用户安装且无法卸载</small></th>
<th>清除<small style="display:block;font-size:12px;color:#999">从所有用户中清除</small></th>
</thead><?php if(is_array($list)) foreach($list as $value) { ?><tr>
<!-- <td width="20"><input type="checkbox" name="appids[]" value="<?php echo $value['appid'];?>"  /></td>-->
<td width="40"><input type="text" class="form-control input-sm" name="disp[<?php echo $value['appid'];?>]" value="<?php echo $value['disp'];?>" style="width:45px;" /></td>
<td>
<a href="<?php echo $value['appurl'];?>"><img src="<?php echo $value['appico'];?>" /><?php echo $value['appname'];?></a>
</td>
<td>
<select name="position[<?php echo $value['appid'];?>]" class="form-control input-sm" style="width:120px"><?php if(is_array($positionarr)) foreach($positionarr as $key => $value1) { ?><option value="<?php echo $key;?>" <?php if($value['position']==$key) { ?>selected="selected"<?php } ?>><?php echo $value1;?></option>
<?php } ?>
</select>
</td>
<?php if($group==1) { ?>
<td><?php if(is_array($value['orgs'])) foreach($value['orgs'] as $value1) { ?><span class=" btn-sorg"><?php echo avatar_group($value1['orgid']);?> 
</span>
<?php } ?>

</td>
<?php } ?>
<td>
<input type="checkbox" class="js-switch" name="notdelete[<?php echo $value['appid'];?>]" value="1" <?php if($value['notdelete']>0) { ?>checked<?php } ?> />
         </td>
    <td><button id="clear_<?php echo $value['appid'];?>" style="width:100px;" class="btn btn-default" data-loading-text="清除中..." type="button" title="从所有用户中清除" onclick="clearAppFromUser('<?php echo $value['appid'];?>');return false">清除</button>
</td>
</tr>
<?php } ?>
<tr>
<th valign="middle" style="border-bottom:none"><input type="submit" class="btn btn-primary" value="保存设置" /></th>
<th colspan="5" style="border-bottom:none"> <?php echo $multi;?></th>
</tr>
</table>
</form>
<div class="tip" style="margin:10px;color:#333;line-height:1.8">
<div class="alert alert-warning">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<h5>提示信息</h5>
<ul class="help-block">
<li>排序：值越大越靠后</li>
                        <li>可以通过默认位置设置应用默认安装在用户的开始菜单上</li>
                        <li>默认位置设置为无的应用，默认不安装</li>
                        <li>机构部门应用只列出此机构或部门的专有应用，成员应用内不列出机构或部门的专有应用</li>
                        <li>通用应用是指全部用户都可以使用的应用，游客应用、管理员应用和成员应用中不列出通用应用</li>
                        <li>用户只有删除开始菜单里的应用才会真正卸载此应用</li>
                        <li>对于隐藏的应用（应用编辑页“显示图标项”设置为隐藏时），这里也必须设置默认位置，才能默认给用户安装（虽然用户的相应位置并没有显示此应用）</li>
                        <li>清除：从所有已经安装此应用的用户中清除此应用。对于不允许删除的应用，用户登录会再次添加</li>
</ul>
</div>
</div>
</div>

</div>
</div>

<script type="text/javascript">
jQuery('.left-drager').leftDrager_layout();
var selorg = {};



function clearAppFromUser(appid, i) {
if(!i) i = 0;
var el = jQuery('#clear_' + appid);
if(i == 0) el.button('loading');
jQuery.getJSON('<?php echo MOD_URL;?>&op=default&do=clear&appid=' + appid + '&i=' + i, function(json) {
if(json.error) {
el.html(json.error);
window.setTimeout(function() {
el.html('清除');
el.button('reset');
}, 1000);
} else if(json.msg == 'continue') {
clearAppFromUser(appid, json.start);
} else if(json.msg == 'success') {
window.setTimeout(function() { el.html('清除成功'); }, 1000);
window.setTimeout(function() {
el.html('清除');
el.button('reset');
}, 2000);
}
});
}
 //开关样式
    jQuery.getScript('static/switchery/switchery.min.js',function(){
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function (html) {
            var switchery = new Switchery(html);
        });
    });
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