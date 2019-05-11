<?php if(!defined('IN_DZZ')) exit('Access Denied'); /*a:9:{s:83:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/appmarket/template/index.htm";i:1536850350;s:101:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_start.htm";i:1536850350;s:99:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_end.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/commer_header.htm";i:1536850350;s:79:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/template/header_left.htm";i:1536850350;s:91:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/appmarket/template/header_search.htm";i:1536850350;s:94:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_right.htm";i:1536850350;s:82:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/appmarket/template/left.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/footer_simple.htm";i:1536850350;}*/?>
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
<script type="text/javascript" src="./data/template/admin_appmarket_index_header_zh-cn.js" ></script><script type="text/javascript" src="static/js/header.js?<?php echo VERHASH;?>" ></script>
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
<link href="<?php echo MOD_PATH;?>/images/market.css?<?php echo VERHASH;?>" rel="stylesheet" media="all"> 
<script type="text/javascript" src="static/js/jquery.leftDrager.js?<?php echo VERHASH;?>" ></script>
<style>
.app-name-wrapper {
    padding-left: 55px;
    position: relative;
max-width:250px;
min-height:50px;
}
.app-name-wrapper .appicon {
    position: absolute;
    left: 0;
    top: 2px;
}.app-name-wrapper .appicon img {
    max-width: 45px;
    max-height: 45px;
    margin: 0;
}
.app-name-wrapper .appname{
margin:0;
line-height:30px;

}
.app-name-wrapper .appname a{
color:#000;
font-weight:500;
font-size:14px;
}
.app-name-wrapper .appdesc{
white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
color:#999;
font-size:13px;
cursor:default;
}
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{
white-space:nowrap;
}
.group-td-wrapper{
max-width:120px;
white-space:normal;
overflow: hidden;
    text-overflow: ellipsis;
}
.group-td-wrapper>span {
white-space:nowrap;
overflow: hidden;
    text-overflow: ellipsis;
}
.group-td-wrapper>span>img {
margin:0;
vertical-align: text-bottom;
}
.tag-td-wrapper{
max-width:120px;
white-space:normal;
overflow: hidden;
    text-overflow: ellipsis;
}
.tag-td-wrapper a{
color:#333;
display:inline-block;
padding:0 2px;
white-space:nowrap;
overflow: hidden;
    text-overflow: ellipsis;
}
.app-info a{
color:#999;
}
.app-info .select-info{
position:absolute;
left:0;
top:10px;
display:none;
} 
.main-header{
padding:5px
}
.main-header>div{
line-height:34px;
/*margin:0 5px;*/
}
.checkbox-custom{
margin-bottom:0;	
}
.table td img {
    max-width: 45px; 
    max-height: 45px; 
}
</style><script type="text/javascript" src="./data/template/admin_appmarket_index_common_zh-cn.js" ></script><script type="text/javascript" src="static/js/common.js?<?php echo VERHASH;?>" ></script>
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
</div>	
<div class="bs-main-container">
<div class="all-center-top clearfix">
<div class="app-info pull-left">
                	<a href="<?php echo MOD_URL;?>">共<span class="num"><?php echo $count;?></span>个应用</a>
                    <span class="select-info">已选择<span class="num"><?php echo $count;?></span>个应用</span>
                </div>
               
<div class="tag-filter dropdown pull-right">

                    <a href="javascript:;" data-toggle="dropdown" role="button" id="tag-drop"  class="dropdown-toggle btn btn-link"><?php echo $tagid?$tags[$tagid][tagname]:lang('label');?><b class="caret"></b></a>
<ul aria-labelledby="tag-drop" role="menu" class="dropdown-menu" id="tag-drop-menu">
                        <li>
<a href="javascript:;"  onclick="screen_app('0','<?php echo $_GET['group'];?>')";>全部</a>
</li><?php if(is_array($tags)) foreach($tags as $value) { ?><li>
<a href="javascript:;"  onclick="screen_app('<?php echo $value['tagid'];?>','<?php echo $_GET['group'];?>')";><?php echo $value['tagname'];?></a>
</li>
<?php } ?>
</ul>
</div>

                <div class="group-filter dropdown pull-right">
<a href="<?php echo MOD_URL;?>&group=<?php echo $group;?>" data-toggle="dropdown" role="button" id="drop-group" class="dropdown-toggle btn btn-link"><?php echo $group?$grouptitle[$group]:lang('group_permissions');?><b class="caret"></b></a>
<ul aria-labelledby="drop-group" role="menu" class="dropdown-menu" id="drop-group-menu"><?php if(is_array($grouptitle)) foreach($grouptitle as $key => $value) { ?><li role="presentation"> 
<a href="javascript:;" onclick="screen_app('<?php echo $_GET['tagid'];?>','<?php echo $key;?>')"; tabindex="-1" role="menuitem"><?php echo $value;?></a>
</li>
<?php } ?>
</ul>
</div>

<div  class="button_add_content">
<a href="<?php echo MOD_URL;?>&op=edit&do=add&refer=<?php echo $refer;?>" id="button_add1" title="添加应用" class="hide">+</a>				
<a href="<?php echo MOD_URL;?>&op=import&refer=<?php echo $refer;?>" id="button_add2" class="hide" title="导入应用" style="font-size:20px ;"><i  class="glyphicon glyphicon-download-alt"></i></a>				
<a href="javascript:;" id="button_add" style="z-index: 10;">+</a>				
</div>	
</div> 

<div class="main-content clearfix" style="border-top:1px solid #FFF;padding:0;">
<form id="appform" name="appform" class="form-horizontal" action="<?php echo MOD_URL;?>" method="post">
<input type="hidden" name="appsubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<table class="table table-hover">
<thead> 
<th >应用名称</th>
<th >供应商</th>
<th >标签</th>
<th >组权限</th>

<th >操作</th>
</thead><?php if(is_array($list)) foreach($list as $value) { ?><tr> 
<td>
                             <a href="<?php echo $value['appurl'];?>" target="_blank" class="appicon" style="float: left;padding-right: 5px;"><img src="<?php echo $value['appico'];?>" style="margin:0" /></a>
                            <p class="appname">
                            <?php if($value['appadminurl']) { ?>
                            	<a href="<?php echo $value['appadminurl'];?>" target="_blank" ><?php echo $value['appname'];?></a>
                            <?php } else { ?>
                            	<a href="<?php echo $value['appurl'];?>" target="_blank" ><?php echo $value['appname'];?></a>
                            <?php } ?> 
                            <small class="text-muted" title="版本"><?php echo $value['version'];?></small>    
                            </p>
<div class="appdesc" title="<?php echo $value['appdesc'];?>"> <?php echo $value['appdesc']?$value['appdesc']:lang('none');?></div>
                            <!-- </div> -->
</td>
<td><?php echo $value['vendor'];?></td>
<td>
                         <div class="tag-td-wrapper"><?php if(is_array($value['tags'])) foreach($value['tags'] as $key => $value1) { ?><a href="<?php echo MOD_URL;?>&tagid=<?php echo $value1['tagid'];?>"><?php echo $value1['tagname'];?></a>
<?php } ?>
                          </div>
</td>
<td>
                        <?php if($value['department']) { ?>
                        <div class="group-td-wrapper">
                        <?php if(is_array($value['department'])) foreach($value['department'] as $key => $value1) { ?><span appid="<?php echo $value['appid'];?>" orgid="<?php echo $key;?>" class="label label-default " style="display:inline-block"> <img src="dzz/system/images/organization.png" >
                            <?php $i=0;?><?php if(is_array($value1)) foreach($value1 as $value2) { if($i>0) { ?>-<?php } ?><?php echo $value2['orgname'];?> 
                                <?php $i++;?><?php } ?>
</span>
<?php } ?>
                        </div>
                        <?php } else { ?>
                       		 <?php echo $value['grouptitle'];?>
                        <?php } ?>
                        </td>

<td>
<?php if($value['appadminurl']) { ?>
<a class="btn btn-small btn-info-outline"  href="<?php echo $value['appadminurl'];?>">设置</a>
<?php } ?>
<a class="btn btn-primary-outline btn-small" href="<?php echo MOD_URL;?>&op=edit&do=edit&appid=<?php echo $value['appid'];?>&refer=<?php echo $refer;?>" title="编辑">编辑</a>


<?php if($value["system"]!=2) { if($value["available"]==1) { ?>
<a class="btn btn-warning-outline btn-small" href="<?php echo MOD_URL;?>&op=cp&do=disable&appid=<?php echo $value['appid'];?>&refer=<?php echo $refer;?>" title="关闭">关闭</a>
<?php } else { ?>
<a class="btn btn-success-outline btn-small" href="<?php echo MOD_URL;?>&op=cp&do=enable&appid=<?php echo $value['appid'];?>&refer=<?php echo $refer;?>" title="启用">启用</a>
<a class="btn btn-danger-outline btn-small" href="<?php echo MOD_URL;?>&op=cp&do=uninstall&appid=<?php echo $value['appid'];?>&refer=<?php echo $refer;?>" title="卸载" onclick="if(confirm('确定要卸载此应用（应用的所有数据都将被删除，包括应用内部的数据，并且不可恢复）？'))return true;else return false">卸载</a>
<?php } } else { if($value["available"]!=1) { ?> 
<a class="btn btn-small btn-success-outline" href="<?php echo MOD_URL;?>&op=cp&do=enable&appid=<?php echo $value['appid'];?>&refer=<?php echo $refer;?>" title="启用">启用</a>
<?php } } ?>
<a class="btn btn-primary-outline btn-small" href="<?php echo MOD_URL;?>&op=cp&do=export&appid=<?php echo $value['appid'];?>&refer=<?php echo $refer;?>" title="导出" target="_blank">导出</a>
</td>
</tr>
<?php } if($multi) { ?>
<tr>
<td colspan="20" align="center" style="border:none"><?php echo $multi;?> </td>
</tr>
<?php } ?>
</table>
</form>
</div>
</div>
</div>
<script type="text/javascript">
jQuery('.left-drager').leftDrager_layout();
function screen_app(tagid,group){
var url = MOD_URL;
if(tagid){
url += '&tagid='+tagid;
}
if(group){
url += '&group='+group;
}
var inputval = jQuery('#screen_keyword').val();
if(inputval){
url += '&keyword='+inputval;
}
console.log(url);
//		return false;
window.location.href =url;	 
}<?php if(is_array($list)) foreach($list as $value) { ?>//start_check_upgrade( '<?php echo $value['appid'];?>' );
<?php } ?>
function start_check_upgrade(appid){
jQuery.post({
type:'post',
async: true, 
url:'<?php echo MOD_URL;?>&op=upgrade_app_ajax&operation=check_upgrade&appid='+appid+'&t='+new Date().getTime(),
data:{},
success:function(json){ 
if(json.status==0){
jQuery('#upgrade_info_'+mid).show().text(json.msg);  
}else{ 
jQuery("#"+appid+"_update").removeClass("hidden"); 
}
} 
});
}

jQuery('#button_add').click(function(){
if(jQuery("#button_add1").hasClass('hide')){
jQuery("#button_add").html("×");
jQuery("#button_add1").removeClass("hide");
jQuery("#button_add2").removeClass("hide");
jQuery("#button_add1").stop().animate({top:"-124px"},500);
jQuery("#button_add2").stop().animate({top:"-62px"},500);
}else{
jQuery("#button_add").html("＋");
jQuery("#button_add1").stop().animate({top:"0px"},500);
jQuery("#button_add2").stop().animate({top:"0px"},500);
setTimeout(function(){
jQuery("#button_add1").addClass("hide");
jQuery("#button_add2").addClass("hide");
},500)

}
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