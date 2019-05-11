<?php if(!defined('IN_DZZ')) exit('Access Denied'); /*a:9:{s:79:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/share/template/share.htm";i:1536850350;s:101:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_start.htm";i:1536850350;s:99:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_end.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/commer_header.htm";i:1536850350;s:79:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/template/header_left.htm";i:1536850350;s:87:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/share/template/header_search.htm";i:1536850350;s:94:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_right.htm";i:1536850350;s:78:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/share/template/left.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/footer_simple.htm";i:1536850350;}*/?>
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
<script type="text/javascript" src="./data/template/admin_share_share_header_zh-cn.js" ></script><script type="text/javascript" src="static/js/header.js?<?php echo VERHASH;?>" ></script>
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
<link href="static/css/app_manage.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<link href="<?php echo MOD_PATH;?>/images/share.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<script type="text/javascript" src="static/js/jquery.leftDrager.js?<?php echo VERHASH;?>" ></script><script type="text/javascript" src="./data/template/admin_share_share_common_zh-cn.js" ></script><script type="text/javascript" src="static/js/common.js?<?php echo VERHASH;?>" ></script>
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
        <a href="<?php echo MOD_URL;?>">分享管理</a>
    </li> 
</ul>    </div>
    <div class="resNav-item resNav-center"><?php if(empty($_GET['op'])) { ?>
 <div class="input-search">
 <form name="search" action="<?php echo BASESCRIPT;?>" method="get">
        <input type="hidden" name="mod" value="<?php echo MOD_NAME;?>" /> 
        <i class="input-search-icon glyphicon glyphicon-search" aria-hidden="true" onclick="this.parentNode.submit()"></i>
         <input type="text" class="form-control search form-search" name="keyword" value="<?php echo $_GET['keyword'];?>" placeholder="名称" id="searchval">
       
    </form>
</div>
<?php } ?>
<script type="text/javascript">
jQuery('#searchval').focus(function (e) {//头部搜索框变颜色
    jQuery(this).parent().parent().addClass('focus');
});
jQuery('#searchval').blur(function (e) {//失去焦点时
 jQuery(this).parent().parent().removeClass('focus');
})
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
<li <?php if(!$type) { ?>class="active"<?php } ?>>
<a href="<?php echo MOD_URL;?>">全部</a>
</li><?php if(is_array($typearr)) foreach($typearr as $key => $value) { ?><li <?php if($type==$key) { ?>class="active"<?php } ?>>
<a href="<?php echo MOD_URL;?>&type=<?php echo $key;?>"><?php echo $value;?></a>
</li>
<?php } ?>
</ul></div>
<div class="left-drager">
</div>	
<div class="bs-main-container">
<div class="main-header2">
<ul class="nav nav-pills clearfix">	
<li class="pull-right " style="margin:5px 0;">
<form name="search" action="<?php echo ADMINSCRIPT;?>" class="form-inline" method="get">
<input type="hidden" name="mod" value="share" />
<input type="hidden" name="type" value="<?php echo $type;?>" />
<input name="username" type="text" value="<?php echo $username;?>" class="form-control input-sm" style="width:90px ;display:inline-block" placeholder="用户名" />&nbsp;<input name="keyword" type="text" class="form-control input-sm" value="<?php echo $keyword;?>" style="width:90px ;display:inline-block" placeholder="分享标题">
<button class="btn btn-default" onclick="this.parentNode.submit()"><i class="glyphicon glyphicon-search"></i></button>
</form>
</li>
</ul>
</div>
<div class="main-content clearfix">
<?php if(!$count) { ?>
<div node-type="module" class="module-share-empty text-center clearfix">
<div class="no-result-div" style="padding-top:40px;">
<p class="no-result-pic"><em class="shr"></em></p>
<p class="no-result-title">好东西要晒出来，快把你的文件分享给身边的朋友们吧。</p>
</div>
</div>
<?php } else { ?>
<div node-type="module" class="module-list-toolbar" style="display: none;">
<div class="bar clearfix">
<span node-type="chk" class="chk-box"> 
            	<span class="chk"></span>
</span>
<span class="text">已选中<span node-type="num">0</span>个文件/文件夹</span>
<button class="btn btn-sm btn-danger" data-key="unshare"><span>删除分享</span> </button> &nbsp;
<button class="btn btn-sm btn-warning" data-key="forbidden"><span>屏蔽分享</span> </button> &nbsp;
<button class="btn btn-sm btn-success" data-key="allow"><span>取消屏蔽</span> </button>
</div>
</div>
<div node-type="module" class="module-list-view">
<div node-type="wrapper" class="list-view-home">
<div node-type="title" class="title" style="padding-right: 16px;">
<div class="item clearfix">
<!-- 第一列 -->
<div node-type="title-col" data-key="title" class="col c1" style="width: 50%">
<span node-type="chk-all" class="chk"> <span class="chk-ico"></span> </span>
<div class="name"> <span>分享文件</span>
<span node-type="order-status" class="asc <?php if($asc) { ?>desc<?php } ?>" style="visibility: <?php if($order=='title') { ?>visible<?php } else { ?>hidden<?php } ?>;"></span> </div>
</div>
<!-- 其他列 -->
<div node-type="title-col" data-key="dateline" class="col" style="width: 15%;"> 分享时间
<span node-type="order-status" class="asc <?php if($asc) { ?>desc<?php } ?>" style="visibility: <?php if($order=='dateline') { ?>visible<?php } else { ?>hidden<?php } ?>;"></span>
</div>
<div node-type="title-col" data-key="count" class="col" style="width: 8%;"> 浏览次数
<span node-type="order-status" class="asc <?php if($asc) { ?>desc<?php } ?>" style="visibility: <?php if($order=='count') { ?>visible<?php } else { ?>hidden<?php } ?>;"></span>
</div>
<div node-type="title-col" data-key="size" class="col" style="width: 8%;"> 文件大小
<span node-type="order-status" class="asc <?php if($asc) { ?>desc<?php } ?>" style="visibility: <?php if($order=='size') { ?>visible<?php } else { ?>hidden<?php } ?>;"></span>
</div>
<div node-type="title-col" data-key="type" class="col" style="width: 8%;"> 文件类型
<span node-type="order-status" class="asc <?php if($asc) { ?>desc<?php } ?>" style="visibility: <?php if($order=='type') { ?>visible<?php } else { ?>hidden<?php } ?>;"></span>
</div>
<div node-type="title-col" data-key="username" class="col" style="width: 8%; border-right: none;"> 分享用户
<span node-type="order-status" class="asc <?php if($asc) { ?>desc<?php } ?>" style="visibility: <?php if($order=='username') { ?>visible<?php } else { ?>hidden<?php } ?>;"></span>
</div>
</div>

</div>
<div node-type="list" class="list list-share"><?php if(is_array($list)) foreach($list as $value) { ?><div node-type="item" data-sid="<?php echo $value['id'];?>" data-status="<?php echo $value['status'];?>" class="item clearfix">
<!-- 第一列 -->
<div class="col c1 name" style="width: 50%;" data-name="<?php echo $value['title'];?>">
<span node-type="chk" class="chk"> <span class="chk-ico"></span></span>
<!-- 私密分享图标 -->
<?php if($value['password']) { ?><span class="ico-private-share" title="私密分享"></span><?php } ?>

<div node-type="name" class="name" title="<?php echo $value['title'];?>">
<?php if($value['img']) { ?><img class="icon" src="<?php echo $value['img'];?>" />
<?php } if($value['status']<0) { ?><span node-type="name-tip" style="color: red;">(<?php echo $value['fstatus'];?>)</span><?php } ?>
<span class="name-text-wrapper"> <span node-type="name-text"  data-href="<?php echo $value['sharelink'];?>" class="name-text enabled"><?php echo $value['title'];?></span> </span>
</div>

</div>

<!-- 其他列 -->
<div class="col dateline" style="width: 15%" data-dateline="<?php echo $value['dateline'];?>"><?php echo $value['fdateline'];?></div>
<div class="col count" style="width: 8%" data-count="<?php echo $value['count'];?>"><?php echo $value['count'];?>次</div>
<div class="col size" style="width: 8%" data-size="<?php echo $value['size'];?>"><?php echo $value['fsize'];?></div>
<div class="col type" style="width: 8%" data-type="<?php echo $value['ftype'];?>"><?php echo $value['ftype'];?></div>
<div class="col username" style="width: 8%" data-type="<?php echo $value['username'];?>">
<a href="user.php?uid=<?php echo $value['uid'];?>"><?php echo $value['username'];?></a>
</div>
<!-- 复制 -->
<div node-type="copy-bar" class="copy-bar">
<?php if($value['qrcode']) { ?>
<a href="javascript:;" class="qrcode glyphicon glyphicon-qrcode" title="扫描二维码,发送到手机" data-container="body" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="right" data-content="<p class='text-center'><img src='<?php echo $value['qrcode'];?>'></p>"></a><?php } ?>
链接：
<a href="<?php echo $value['sharelink'];?>" target="_dzz"><?php echo $value['sharelink'];?></a>
<?php if($value['password']) { ?>&nbsp;提取密码：<?php echo $value['password'];?><?php } ?>
&nbsp;<button class="btn btn-sm btn-default js_copy" data-clipboard-text="<?php echo $value[password]?(lang('link').':'.$value[sharelink]. lang('password').':'.$value[password]):$value[sharelink];?>" style="position:relative"><i class="glyphicon glyphicon-duplicate"></i> 复制<span class="alert copy-success  alert-success hide ">复制成功,请粘帖到您需要的地方</span></button>
<?php if($value['endtime']) { ?>&nbsp;到期时间：<?php echo $value['fendtime'];?><?php } if($value['times']) { ?>&nbsp;限制次数：<?php echo $value['count'];?> / <?php echo $value['times'];?><?php } ?>
</div>
</div>
<?php } ?>
<div class="page clearfix"><?php echo $multi;?></div>
</div>

</div>
</div>

<?php } ?>
</div>
</div>
</div>
<script type="text/javascript">
jQuery('.left-drager').leftDrager_layout(function() {
jQuery('.list').css('height', jQuery('.bs-main-container').outerHeight(true) - jQuery('.list-view-home .title').outerHeight(true));
});
jQuery(document).ready(function(e) {

jQuery(document).on('mouseenter', 'div[node-type=item]', function() {
jQuery(this).addClass('item-hover');
});
jQuery(document).on('mouseleave', 'div[node-type=item]', function() {
jQuery(this).removeClass('item-hover');
});
jQuery(document).on('click', 'span[node-type=name-text]', function() {
if(top._config) {
top.OpenWindow('url', jQuery(this).data('href'), jQuery(this).html());
} else {
window.open(jQuery(this).data('href'), jQuery(this).html());
}
});
jQuery('.chk[node-type=chk-all]').on('click', function() {
jQuery(this).addClass('chked');
jQuery('.item').each(function() {
jQuery(this).addClass('item-active').find('span[node-type=chk]').addClass('chked');
});
refresh_header();
return false;
});
jQuery(document).on('click', '.item .chk', function() {
jQuery(this).toggleClass('chked');
jQuery(this).closest('.item').toggleClass('item-active');
jQuery('.copy-bar').hide();
refresh_header();
return false;
});
jQuery('.module-list-toolbar .chk').on('click', function() {
if(jQuery(this).hasClass('chked')) {
jQuery(this).removeClass('chked');
jQuery('.chk[node-type=chk-all]').removeClass('chked');
jQuery('.module-list-toolbar').hide();
jQuery('.item.item-active').each(function() {
jQuery(this).removeClass('item-active').find('span[node-type=chk]').removeClass('chked');
jQuery(this).find('.copy-bar').hide();
});
} else {
jQuery(this).addClass('chked');
jQuery('.item:not(.item-active)').each(function() {
jQuery(this).addClass('item-active').find('span[node-type=chk]').addClass('chked');
});
}
});
jQuery(document).on('click', 'div[node-type=item]', function(e) {
e = e ? e : event;

var el = jQuery(this);
var obj = e.srcElement ? e.srcElement : e.target;
if(jQuery(obj).closest('.js_copy').length) return false;
var actives = jQuery('.item-active').length;
if(e.ctrlKey) {
jQuery('.item-active').not(this).find('.copy-bar').hide();
} else {
jQuery('.item-active').not(this).each(function() {
jQuery(this).removeClass('item-active').find('span[node-type=chk]').removeClass('chked')
.end().find('.copy-bar').hide();
});
}
if(el.hasClass('item-active') && (actives == 1 || e.ctrlKey)) {
el.removeClass('item-active').find('span[node-type=chk]').removeClass('chked');
el.find('.copy-bar').hide();
} else {
el.addClass('item-active').find('span[node-type=chk]').addClass('chked');
if(parseInt(el.data('status')) > -1) el.find('.copy-bar').show();
}
refresh_header();
});

var client = new Clipboard('.js_copy');
client.on("success", function(e) {
var self = e.trigger;
jQuery(self).find('.copy-success').removeClass('hide');
window.setTimeout(function() {
jQuery(self).find('.copy-success').addClass('hide');
}, 1000);
});

jQuery('.title .item .col[node-type=title-col]').on('click', function() {
var el = jQuery(this);
el.find('.asc').css('visibility', 'visible').toggleClass('desc');
el.siblings().find('.asc').css('visibility', 'hidden');
item_sort(el.data('key'), el.find('.asc').hasClass('desc') ? 'desc' : 'asc');
});
jQuery('button[data-key=unshare]').on('click', function() {
var msg = '<p class="text-center">取消分享后，该条分享记录将被删除，将无法再访问此分享链接。</p><p class="text-center">你确认要取消分享吗？</p>';
showDialog(msg, 'confirm', '确定取消分享', share_delete, 1)
});
jQuery('button[data-key=forbidden]').on('click', function() {
var msg = '<p class="text-center">该条分享记录将被屏蔽，将无法再访问此分享链接。</p><p class="text-center">你确认要屏蔽该条分享吗？</p>';
showDialog(msg, 'confirm', '确定屏蔽分享', share_forbidden, 1)
});
jQuery('button[data-key=allow]').on('click', function() {
var msg = '<p class="text-center">该条分享记录将被恢复访问。</p><p class="text-center">你确认要取消屏蔽该条分享吗？</p>';
showDialog(msg, 'confirm', '确定取消屏蔽', share_allow, 1)
});
jQuery('[data-toggle="popover"]').popover();
});

function item_sort(key, order) {
location.href = '<?php echo $theurl;?>&order=' + key + '&asc=' + (order == 'desc' ? 1 : 0);
return; 
}

function share_delete() {
var sids = new Array();
jQuery('.list .item-active').each(function() {
sids.push(jQuery(this).data('sid'));
});
jQuery.post('<?php echo MOD_URL;?>&op=ajax&do=delete', { "sids": sids }, function(json) {
    for(var o in json.msg){
if(json.msg[o]['success']){
                    jQuery('.list div[data-sid="'+o+'"]').remove();
}
}
            refresh_header();
}, 'json');
}

function share_forbidden() {
var sids = new Array();
jQuery('.list .item-active').each(function() {
sids.push(jQuery(this).data('sid'));
});
jQuery.post('<?php echo ADMINSCRIPT;?>?mod=share&op=ajax&do=forbidden', { "sids": sids, "flag": 'forbidden' }, function(json) {
if(json.msg == 'success') {
showmessage('分享屏蔽成功', 'success', 2000, 1);
jQuery('.list .item-active').each(function() {
jQuery(this).attr('data-status', '-4');
if(jQuery(this).find('span[node-type=name-tip]').length) {
jQuery(this).find('span[node-type=name-tip]').html('(已屏蔽)');
} else {
jQuery('<span node-type="name-tip" style="color: red;">(已屏蔽)</span>').insertBefore('.list .item-active .name-text-wrapper');
}
});
refresh_header();
} else {
showmessage('屏蔽失败', 'danger', 3000, 1);
}
}, 'json');
}

function share_allow() {
var sids = new Array();
jQuery('.list .item-active').each(function() {
if(jQuery(this).data('status') == '-4') sids.push(jQuery(this).data('sid'));
});
if(sids.length) {
jQuery.post('<?php echo ADMINSCRIPT;?>?mod=share&op=ajax&do=forbidden', { "sids": sids, "flag": 'allow' }, function(json) {
if(json.msg == 'success') {
showmessage('取消屏蔽成功', 'success', 2000, 1);
jQuery('.list .item-active').attr('data-status', '0').find('span[node-type=name-tip]').remove();
refresh_header();
} else {
showmessage('取消屏蔽失败', 'danger', 3000, 1);
}
}, 'json');
}
}

function refresh_header() {
var sum = jQuery('.list .item.item-active').length;
var tsum = jQuery('.list .item').length;
var psum = jQuery('.list .item.item-active[data-status=-4]').length;
if(sum > 0) {
jQuery('.module-list-toolbar').find('span[node-type=num]').html(sum).end().show();
if(sum == tsum) {
jQuery('.module-list-toolbar').find('.chk').addClass('chked');
} else {
jQuery('.module-list-toolbar').find('.chk').removeClass('chked');
}
if(psum == sum) {
jQuery('.module-list-toolbar .bar').find('button[data-key=forbidden]').hide();
} else {
jQuery('.module-list-toolbar .bar').find('button[data-key=forbidden]').show();
}
if(psum > 0) {
jQuery('.module-list-toolbar .bar').find('button[data-key=allow]').show();
} else {
jQuery('.module-list-toolbar .bar').find('button[data-key=allow]').hide();
}
} else {
jQuery('.module-list-toolbar').hide();
jQuery('.chk[node-type=chk-all]').removeClass('chked');
}
}
</script><?php output();?><?php updatesession();?><?php if(debuginfo()) { ?>
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
</html><script type="text/javascript" src="static/clipboard/clipboard.min.js?<?php echo VERHASH;?>" ></script>
<script src="static/bootstrap/js/bootstrap.min.js?<?php echo VERHASH;?>" ></script>