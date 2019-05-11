<?php if(!defined('IN_DZZ')) exit('Access Denied'); /*a:9:{s:92:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/appmarket/template/cloudappmarket.htm";i:1536850350;s:101:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_start.htm";i:1536850350;s:99:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_end.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/commer_header.htm";i:1536850350;s:79:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/template/header_left.htm";i:1536850350;s:91:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/appmarket/template/header_search.htm";i:1536850350;s:94:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_right.htm";i:1536850350;s:82:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/appmarket/template/left.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/footer_simple.htm";i:1536850350;}*/?>
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
<script type="text/javascript" src="./data/template/admin_appmarket_cloudappmarket_header_zh-cn.js" ></script><script type="text/javascript" src="static/js/header.js?<?php echo VERHASH;?>" ></script>
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
.app_upgradelist {
margin: auto;
padding: 8px;
border-bottom: 1px solid #f2f2f2;
position: relative;
}
.app_upgradelist .progess {
position: absolute;
top: 0;
left: 0;
height: 30px;
width: 0%;
height: 100%;
width: 100%;
}
.app_upgradelist .progess .upgrade_progess {
background-color: #dff0d8;
position: absolute;
width: 0%;
height: 100%;
}
.app-name-wrapper {
padding-left: 55px;
position: relative;
max-width: 350px;
min-height: 50px;
}
.app-name-wrapper .appicon {
position: absolute;
left: 0;
top: 2px;
}
.app-name-wrapper .appicon img {
max-width: 45px;
max-height: 45px;
margin: 0;
}
.app-name-wrapper .appname {
margin: 0;
line-height: 25px;
}
.app-name-wrapper .appname a {
color: #000;
font-weight: 500;
font-size: 14px;
}
.app-name-wrapper .appdesc {
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis;
color: #999;
font-size: 13px;
cursor: default;
}
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
white-space: nowrap;
}
.group-td-wrapper {
max-width: 320px;
white-space: normal;
overflow: hidden;
text-overflow: ellipsis;
}
.group-td-wrapper>span {
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis;
}
.group-td-wrapper>span>img {
margin: 0;
vertical-align: text-bottom;
}
.app-info a {
color: #999;
}
.app-info .select-info {
position: absolute;
left: 30px;
top: 0;
display: none;
background-color: #FFF;
padding: 5px 10px;
}
.main-header {
padding: 5px
}
.main-header>div {
line-height: 34px;
margin: 0 5px;
}
#update_selected {
margin-left: 20px;
}
.checkbox-custom {
margin-bottom: 0;
}
</style><script type="text/javascript" src="./data/template/admin_appmarket_cloudappmarket_common_zh-cn.js" ></script><script type="text/javascript" src="static/js/common.js?<?php echo VERHASH;?>" ></script>
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
  <div class="bs-left-container  clearfix"> 
    <ul class="nav-stacked">
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
</ul> 
  </div>
  <div class="left-drager"></div>
  <div class="bs-main-container">
    <div class="all-center-top clearfix">
      <div class="app-info pull-left"> <a href="<?php echo BASESCRIPT;?>?mod=appmarket">共<span class="num"><?php echo $total;?></span>个应用</a> 
 
      </div>
       <div class="pull-right" style="color:#999;line-height: 34px;">注：如不能在线安装，请通过 <a class="num" href="http://www.dzzoffice.com/index.php?mod=dzzmarket" target="_blank">官方应用市场</a> 下载应用安装包手动下载</div>
    </div>
    <div class="main-content clearfix" >
      <div class="market-container" id="loopcontent" style="min-width:510px;"> 
        <?php if(is_array($list)) foreach($list as $value) { ?>        <div id="app_div_<?php echo $value['mid'];?>" class="row app_upgradelist" >
          <div id="progess_<?php echo $value['mid'];?>" class="progess"> <span id="upgrade_progess_<?php echo $value['mid'];?>" class="upgrade_progess"></span> </div>
          <div class="col-md-5  col-sm-5 col-xs-5" style="padding-left: 4px;">
            <div class="app-name-wrapper" > <a href="javascript:;" data-href="<?php echo $cloudurl;?>?mod=dzzmarket&op=ajax&do=view&mid=<?php echo $value['mid'];?>&refer=<?php echo $refer;?>"  class="appicon view-detail" title="<?php echo $value['name'];?>"><img src="<?php echo $value['coverimg'];?>" style="margin:0" /></a>
              <p class="appname"> <a href="javascript:;" data-href="<?php echo $cloudurl;?>?mod=dzzmarket&op=ajax&do=view&mid=<?php echo $value['mid'];?>&refer=<?php echo $refer;?>" target="_blank" class="view-detail" title="<?php echo $value['name'];?>"><?php echo $value['name'];?></a> <small class="text-muted" title="版本"><?php echo $value['version'];?></small></p>
              <div class="appdesc" title="<?php echo $value['appdesc'];?>"><?php echo $value[desc_short]?$value[desc_short]:lang('none');?></div>
            </div>
          </div>
          <div class="col-md-2 col-sm-2 col-xs-2">
            <div class="group-td-wrapper"><?php echo $value['classid_name'];?></div>
          </div>
          <div class="col-md-2 col-sm-2 col-xs-2"> <?php echo formatsize($value[packagesize]);?> </div>
          <div class="col-md-3  col-sm-3 col-xs-3"> 
            <?php if($value['price']>0) { ?>
            <button class="btn btn-danger"  onclick="showBuyInfo(this,'<?php echo $value['mid'];?>')" data-href="<?php echo $cloudurl;?>?mod=dzzmarket&op=ajax&do=getBuyInfo&mid=<?php echo $value['mid'];?>" title="联系购买">购买</button>
            <?php } else { ?> 
<?php if($value['package']) { ?> 
<?php if($value["local_appinfo"]) { ?>
<btn  class="btn btn-default" disabled style="color: #333;" data-mid="<?php echo $value['mid'];?>" title="已安装">
已安装
</button>
<?php } else { ?>
<button class="btn btn-success-outline" style="white-space: inherit;" onclick="start_check_install('<?php echo MOD_URL;?>&op=install_app_ajax&operation=check_install&appid=<?php echo $value['identifier'];?>','<?php echo $value['mid'];?>','<?php echo $value['baseinfo'];?>');" id="upgrade_info_<?php echo $value['mid'];?>">一键安装</button>
<?php } ?> 
<?php } else { ?> 
<a class="btn btn-success-outline view-detail" title="<?php echo $value['name'];?>" href="javascript:;" data-href="<?php echo $cloudurl;?>?mod=dzzmarket&op=ajax&do=view&mid=<?php echo $value['mid'];?>" >查看详细</a> 
<?php } ?> 
            <?php } ?> 
          </div>
        </div>
        <?php } ?> 
      </div>
    </div>
    <div id="pageinfo" style="text-align:center;padding:10px;"><?php echo $multi;?></div>
  </div>
</div>
<div class="modal in">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <div class="modal-body"> </div>
      <div class="modal-footer" style="text-align: center">
        <button type="button" class="btn btn-dark" data-dismiss="modal">关闭</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 
<script type="text/javascript">
jQuery('.left-drager').leftDrager_layout();
jQuery('.view-detail').on('click',function(){
showBuyInfo(this,'modal-lg');
return false;
});
var ajaxurl='<?php echo $cloudurl;?>';
function showBuyInfo(obj,size){ 
var url=jQuery(obj).data('href');
var title=jQuery(obj).attr('title');
if(size){
jQuery('.modal .modal-dialog').addClass(size);
}
jQuery.get(url,function(html){
html=html.replace(/src=\"index\.php/ig,'src="<?php echo $cloudurl;?>');
console.log(html);
jQuery('.modal .modal-body').html(html);
});
//jQuery('.modal .modal-title').html(title);
jQuery('.modal').modal('show');
}
function getNext(url){
jQuery.get(url,function(html){
var li=jQuery('.appitem-next');
li.replaceWith(html);
});
}

function start_check_install(url,mid,data){ 
jQuery.ajax({
type:'post',
async: true, 
url:url,
data:{"baseinfo":data },
success:function(json){
//jQuery('#install_button_'+mid).html("&nbsp;");  
if(json.status==0){
jQuery('#upgrade_info_'+mid).show().addClass("btn-warning").html(json.msg); 
}else if(json.status==1){ 
jQuery('#upgrade_info_'+mid).show().text(json.msg);
jQuery('#upgrade_progess_'+mid).show().animate({width:json.percent+"%"},json.second,function(){
startinstsallapp(json.url,mid,data);
});
}else{
window.location.reload();
}
} 
});
}

function startinstsallapp(url,mid,data){
jQuery.ajax({
type:'post',
async: true, 
url:url,
data:{"baseinfo":data},
success:function(json){ 
if(json.status==0){
jQuery('#upgrade_info_'+mid).addClass("btn-warning").html(json.msg);
}else{
jQuery('#upgrade_info_'+mid).text(json.msg);
jQuery('#upgrade_progess_'+mid).animate({width:json.percent+"%"},json.second,function(){
startgetinstallcrossorpatchfile(json.url,mid,data);
});
}
} 
});
}

function startgetinstallcrossorpatchfile(url,mid,data){
jQuery.ajax({
type:'post',
async: true, 
url:url,
data:{"baseinfo":data},
success:function(json){ 
if(json.status==0){ 
jQuery('#upgrade_info_'+mid).addClass("btn-warning").html(json.msg); 
}else{
jQuery('#upgrade_info_'+mid).text(json.msg);
jQuery('#upgrade_progess_'+mid).animate({width:json.percent+"%"},json.second,function(){
if(json.step==2){
startgetinstallcrossorpatchfile(json.url,mid,data);
}else{ 
startinstallfile(json.url,mid,data);
}
}); 
}
} 
});
}

function startinstallfile(url,mid,data){
jQuery.ajax({
type:'post',
async: true, 
url:url,
data:{"baseinfo":data},
success:function(json){ 
if(json.status==0){ 
jQuery('#upgrade_info_'+mid).addClass("btn-warning").html(json.msg); 
}else{
jQuery('#upgrade_info_'+mid).text(json.msg);
jQuery('#upgrade_progess_'+mid).animate({width:json.percent+"%"},json.second,function(){
 if(json.step!=5){
startinstallfile(json.url,mid,data);
}else{ 
installover(json.url,mid,data);
}
}); 
}
} 
});
}

function installover(url,mid,data){
jQuery.ajax({
type:'post',
async: true, 
url:url,
data:{"baseinfo":data},
success:function(json){ 
if(json.status==0){ 
jQuery('#upgrade_info_'+mid).addClass("btn-warning").html(json.msg); 
}else{
jQuery('#upgrade_info_'+mid).text(json.msg);
jQuery('#upgrade_progess_'+mid).css("width","100%");
}
} 
});
}

function start_check_upgrade(url,mid){
jQuery.ajax({
type:'post',
async: true, 
url:url,
data:{},
success:function(json){
jQuery('#upgrade_button_'+mid).html("&nbsp;");  
if(json.status==0){
jQuery('#upgrade_info_'+mid).show().text(json.msg);  
}else{ 
jQuery('#upgrade_info_'+mid).show().text(json.msg);
jQuery('#upgrade_progess_'+mid).show().animate({width:json.percent+"%"},json.second,function(){
startupgrade(json.url,mid);
});
}
} 
});
}

function startupgrade(url,mid){
jQuery.ajax({
type:'post',
async: true, 
url:url,
data:{},
success:function(json){ 
if(json.status==0){
jQuery('#upgrade_info_'+mid).text(json.msg); 
}else{
jQuery('#upgrade_info_'+mid).text(json.msg);
jQuery('#upgrade_progess_'+mid).animate({width:json.percent+"%"},json.second,function(){
startgetcrossorpatchfile(json.url,mid);
});
}
} 
});
}

function startgetcrossorpatchfile(url,mid){
jQuery.ajax({
type:'post',
async: true, 
url:url,
data:{},
success:function(json){ 
if(json.status==0){ 
alert( json.msg);
}else{
jQuery('#upgrade_info_'+mid).text(json.msg);
jQuery('#upgrade_progess_'+mid).animate({width:json.percent+"%"},json.second,function(){
if(json.step==2){
startgetcrossorpatchfile(json.url,mid);
}else{
startupgradefile(json.url,mid);
}
}); 
}
} 
});
}

function startupgradefile(url,mid){
jQuery.ajax({
type:'post',
async: true, 
url:url,
data:{},
success:function(json){ 
if(json.status==0){ 
alert( json.msg);
}else{
jQuery('#upgrade_info_'+mid).text(json.msg);
jQuery('#upgrade_progess_'+mid).animate({width:json.percent+"%"},json.second,function(){
 if(json.step!=5){
startupgradefile(json.url,mid);
}else{
upgradeover(json.url,mid);
}
}); 
}
} 
});
}

function upgradeover(url,mid){
jQuery.ajax({
type:'post',
async: true, 
url:url,
data:{},
success:function(json){
if(json.status==0){ 
alert( json.msg);
}else{
jQuery('#upgrade_progess_'+mid).animate({width:"100%"},300,function(){
jQuery('#upgrade_progess_'+mid).hide().css("width","0");
start_check_upgrade(json.url,mid);
}); 
}
} 
});
} 

</script> 
<script src="static/bootstrap/js/bootstrap.min.js?<?php echo VERHASH;?>" ></script> <?php output();?><?php updatesession();?><?php if(debuginfo()) { ?>
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