<?php if(!defined('IN_DZZ')) exit('Access Denied'); /*a:8:{s:83:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/filemanage/template/list.htm";i:1536850350;s:101:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_start.htm";i:1536850350;s:99:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_end.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/commer_header.htm";i:1536850350;s:79:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/template/header_left.htm";i:1536850350;s:0:"";b:0;s:94:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_right.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/footer_simple.htm";i:1536850350;}*/?>
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
<script type="text/javascript" src="./data/template/admin_filemanage_list_header_zh-cn.js" ></script><script type="text/javascript" src="static/js/header.js?<?php echo VERHASH;?>" ></script>
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
<link rel="stylesheet" href="static/css/checkbox.css">
<link href="static/css/common.css?<?php echo VERHASH;?>" rel="stylesheet" media="all"> 
<link href="<?php echo MOD_PATH;?>/images/folder.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<link href="static/dzzthumb/jquery.dzzthumb.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<link href="dzz/styles/icoblock/default/style.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<script type="text/javascript" src="static/js/jquery.leftDrager.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript" src="./data/template/admin_filemanage_list_jquery_dzzthumb_zh-cn.js" ></script><script type="text/javascript" src="static/dzzthumb/jquery.dzzthumb.js?<?php echo VERHASH;?>" ></script>
<style type="text/css">
#orgid__Menu{
border: 1px solid #4c89fb;
background: #fff;
border-radius: 2px;
color: #4c89fb;
height: 34px;
padding: 6px 12px;
font-size: 14px;
font-weight: normal;
}
.module-list-view .item-block.item{
    border-bottom:1px solid #eee; 
}
.module-list-view .item-block{
    background:none;
}
.module-list-view .item-block .col{
color:#333;
}
#filem_search .iconFirstWord{
width: 18px;
height: 18px;
border-radius: 50%;
display: inline-block;
line-height: 16px;
font-size: 14px;
margin-left: 0;
}
</style><script type="text/javascript" src="./data/template/admin_filemanage_list_common_zh-cn.js" ></script><script type="text/javascript" src="static/js/common.js?<?php echo VERHASH;?>" ></script>
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
        <a href="<?php echo MOD_URL;?>">文件管理</a>
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
</script><script type="text/javascript">
var selorg={};
selorg.add=function(ctrlid,vals){
if(vals[0].orgid=='other') vals[0].path='请选择机构或部门';
jQuery('#'+ctrlid+'_Menu').html(vals[0].path+' <span class="caret"></span>');
jQuery('#sel_'+ctrlid).val(vals[0].orgid);
//jQuery('#orgid_<?php echo $org['orgid'];?>_Menu').dropdown('toggle');
}
</script>

<div class="bs-container clearfix">
  <div class="bs-main-container" style="overflow:auto">
    <div class="sharepame-bread clearfix">
      <ol class="breadcrumb">
        <li class="home" data-href="<?php echo MOD_URL;?>"><a href="<?php echo MOD_URL;?>" >全部文件<span>></span></a></li>
        <?php if(!empty($foldername)) { ?>
        <?php $i=0;?> <?php if(is_array($foldername)) foreach($foldername as $v) { ?> <?php $i++;?> <?php if($i==count($foldername)) { ?>
 <li class="active"  data-fid="<?php echo $v['fid'];?>"><?php echo $v['fname'];?><span></span></li>
 <?php } else { ?>
  <li class=""  data-fid="<?php echo $v['fid'];?>"><a href="<?php echo MOD_URL;?>&pfid=<?php echo $v['fid'];?>"><?php echo $v['fname'];?><span>></span></a></li>
  <?php } } ?> 
    <?php } ?> 
      </ol>
    </div>
    <div class="main-header" style="border-top:1px solid #FFF;padding:0 10px 20px 5px;">
      <form name="search" action="<?php echo BASESCRIPT;?>" method="get" id="filem_search">
        <input type="hidden" name="mod" value="filemanage" />
        <ul class="nav nav-pills clearfix" style="padding: 5px 0 5px 0;">
          <!--<strong class="pull-left" style="padding-left:0px;padding-top: 5px;">筛选：</strong>-->
          <li>
            <select class="form-control select-option" name="type" value="<?php echo $type;?>">
              <option value="" selected="selected">按文件类型</option>
              <?php if(is_array($typearr)) foreach($typearr as $type1 => $value) { ?> 
              <option value="<?php echo $type1;?>" <?php if($type1==$type) { ?>selected="selected"<?php } ?>><?php echo $value;?>
              </option>
              <?php } ?>
            </select>
          </li>
         <!-- <li>
            <select class="form-control select-option" name="pfid">
              <option value="" selected="selected">文件位置</option>
              <option value="-1" &lt;!&ndash;<?php if($pfid==-1) { ?>&ndash;&gt;selected="selected"&lt;!&ndash;<?php } ?>&ndash;&gt;>在回收站
              </option>
            </select>
          </li>-->
          <?php if(!isset($pfid) || $pfid <= 0) { ?>
          <li class="dropdown org">
            <input id="sel_orgid_<?php echo $org['orgid'];?>" type="hidden" name="orgid"  value="<?php echo $org['orgid'];?>" onchange="selDepart(this)" />
            <button type="button" id="orgid_<?php echo $org['orgid'];?>_Menu" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> <?php echo $org['depart'];?> <span class="caret"></span> </button>
            <div id="orgid_<?php echo $orgid_dropdown_menu;?>" class="dropdown-menu org-sel-box" role="menu" aria-labelledby="orgid_<?php echo $org['orgid'];?>_Menu">
              <iframe name="orgid_<?php echo $org['orgid'];?>_iframe" class="org-sel-box-iframe" src="index.php?mod=system&amp;op=orgtree&amp;ctrlid=orgid_<?php echo $org['orgid'];?>&amp;nouser=1&amp;range=0&amp;moderator=1&amp;zero=<?php echo urlencode('不选择机构或部门');?>" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="100%" allowtransparency="true" ></iframe>
            </div>
          </li>
          <?php } ?>
          
          <li class="pull-left">
            <input name="keyword"  type="text" value="<?php echo $keyword;?>" class="form-control "  placeholder="文件名称或用户名">
          </li>
          <li class="pull-left">
            <input type="hidden" name="pfid" id="pfid" value="<?php echo $pfid;?>"/>
            <button  class="btn btn-primary " type="submit" style="height:34px;">搜索</button>
          </li>
          <li class="pull-left btn-secetlt" style="display: none;">
            <button  class="btn btn-danger " type="submit" value="删除" onclick="delete_file();" style="height:34px;">删除</button>
          </li>
        </ul>
      </form>
    </div>
    <div node-type="module" class="module-list-view" style="display:block">
      <form id="appform" name="appform" class="form-horizontal " action="<?php echo BASESCRIPT;?>?mod=filemanage" method="post" >
        <input type="hidden" name="delsubmit" value="true" />
        <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
        <input type="hidden" name="refer" value="<?php echo $refer;?>" />
        <div node-type="wrapper" class="list-view-home">
          <div node-type="title" class="title" >
            <div class="item clearfix">
              <div node-type="title-col"  class="col" style="width: 3%;text-indent: 0;padding-left: 5px;">
                <div class="checkbox-custom checkbox-primary">
                  <input type="checkbox" name="del[]" id="chkall">
                  <label></label>
                </div>
              </div>
              <!--选中后的效果-->
              <div class="col sharepame-selected" style="display: none;width:27%"><span>已选择<span class="ex-number"></span>项</span> </div>
              <!-- 第一列 -->
              <div node-type="title-col" data-key="name" class="col c1 show_first" style="width: 25%">
                <div class="name"> <span>文件名</span> <span node-type="order-status" class="asc desc" style="visibility: hidden;"></span> </div>
              </div>
              <!-- 其他列 -->
              <div node-type="title-col" data-key="size" class="col" style="width: 10%;"> 文件大小 <span node-type="order-status" class="asc <?php echo $_GET['size'];?>" style="visibility:<?php if($_GET['size']) { ?>visible<?php } else { ?>hidden<?php } ?>;"></span> </div>
              <div node-type="title-col" data-key="type" class="col" style="width: 10%;border-right: none;"> 文件类型 <span node-type="order-status" class="asc desc" style="visibility: hidden;"></span> </div>
              <div node-type="title-col" data-key="type" class="col" style="width: 20%;border-right: none;"> 文件位置 <span node-type="order-status" class="asc desc" style="visibility: hidden;"></span> </div>
              <div node-type="title-col" data-key="type" class="col" style="width: 10%;border-right: none;"> 所有者<span node-type="order-status" class="asc desc" style="visibility: hidden;"></span> </div>
              <div node-type="title-col" data-key="dateline" class="col" style="width: 15%;"> 添加时间 <span node-type="order-status" class="asc <?php echo $_GET['dateline'];?>" style="visibility: <?php if($_GET['dateline']) { ?>visible<?php } else { ?>hidden<?php } ?>;"></span> </div>
              <div node-type="title-col" data-key="dateline" class="col" style="width: 5%;"> 删除 </div>
            </div>
          </div>
          <div node-type="list" class="list list-share">
            <div class="list-wrapper clearfix"> 
              <?php if(is_array($list)) foreach($list as $value) { ?> 
              <div node-type="item" data-dpath="<?php echo $value['dpath'];?>" data-rid="<?php echo $value['rid'];?>" <?php if($value['type'] == 'folder' && $value['oid']) { ?> data-containpath="<?php echo $value['oid'];?>"<?php } ?> data-type="<?php echo $value['type'];?>" class="item shareblock clearfix"> 
              <!-- 第一列 -->
              <div class="col size" style="width: 3%;text-indent: 0;padding-left: 5px;" >
                <div class="checkbox-custom checkbox-primary">
                  <input type="checkbox" name="del[]" value="<?php echo $value['rid'];?>" data-rid="<?php echo $value['rid'];?>">
                  <label></label>
                </div>
              </div>
              <div class="col c1 name" style="width: 27%;" data-name="<?php echo $value['name'];?>">
                <div node-type="name" class="name" title="<?php echo $value['name'];?>"> 
                  <?php if($value['img']) { ?><img class="icon" title="<?php echo $value['name'];?>" src="<?php echo $value['img'];?>" <?php if($value['type']=='image' ) { ?> data-original="<?php echo $value['url'];?>" data-dpath="<?php echo $value['dpath'];?>" 
                  <?php } ?>/> 
                  <?php } ?> 
                  <span class="name-text-wrapper"> <span node-type="name-text"  data-href="<?php echo $value['shareurl'];?>" class="name-text enabled"><?php echo $value['name'];?></span> </span> </div>
                
                	<div class="btns">
<a node-type="btn-item" data-key="download" class="glyphicon glyphicon-download-alt" href="javascript:void(0);"></a>
</div>
                
              </div>
              <!-- 其他列 -->
              <div class="col size" style="width: 10%" data-size="<?php echo $value['size'];?>"><?php echo $value['fsize'];?></div>
              <div class="col type" style="width:10%" data-type="<?php echo $value['ftype'];?>"><?php echo $value['ftype'];?></div>
              <div class="col type" style="width:20%" data-type="<?php echo $value['relpath'];?>"><?php echo $value['relpath'];?></div>
              <div class="col type" style="width:10%" data-type="<?php echo $value['username'];?>"><?php echo $value['username'];?></div>
              <div class="col dateline" style="width: 15%" data-dateline="<?php echo $value['dateline'];?>"><?php echo $value['fdateline'];?></div>
              <div class="col delete" style="width: 5%" > <a class="" href="<?php echo BASESCRIPT;?>?mod=filemanage&do=delete&icoid=<?php echo $value['rid'];?>&refer=<?php echo urlencode($refer);?>" title="删除" style="color:rgb(85, 85, 85);font-size:20px;" onclick="if(confirm('确定要彻底删除（此操作不可恢复）此文件吗？')){return true}else{return false}"><i class="dzz dzz-delete"></i></a> </div>
            </div>
            <?php } ?> 
            <?php if($nextpage) { ?>
            <div class="more text-center clearfix" onclick="getMore(this,'<?php echo BASESCRIPT;?>?mod=filemanage&op=ajax&type=<?php echo $type;?>&orgid=<?php echo $orgid;?>&keyword=<?php echo $keyword;?>&pfid=<?php echo $pfid;?>&page=<?php echo $nextpage;?>')">加载更多</div>
            <?php } ?> 
          </div>
        </div>
      </form>
    </div>
<div class="clearfix" style="padding:10px;text-align:center"><?php echo $multi;?></div>
  </div>
</div>

<iframe id="hideframe" name="hideframe" src="about:blank" frameBorder="0" marginHeight="0" marginWidth="0" width="0" height="0" allowtransparency="true" style="display:none;z-index:-99999"></iframe>
<div id="dataContainer" class="hide"> 
  <?php if(!empty($foldername)) { ?>
  <div class="hide breadcrumb-data"> <?php if(is_array($foldername)) foreach($foldername as $v) { ?>    <li class="active" data-href="<?php echo BASESCRIPT;?>?mod=filemanage&op=ajax&pfid=<?php echo $v['fid'];?>" data-fid="<?php echo $v['fid'];?>"><?php echo $v['fname'];?><span></span></li>
    <?php } ?> </div>
  <?php } ?> 
</div>
<script type="text/javascript">

var page_loading = false;
jQuery('.left-drager').leftDrager_layout();
function setLoadedNum() {
jQuery('.loaded-num').html(jQuery('.list-share .item').length);
if(!jQuery('.list-share .more').length) {
jQuery('.total-num').html('loading_all');
} else {
jQuery('.total-num').html('');
}
}


var theurl='<?php echo $theurl;?>';
jQuery(document).ready(function(e) {
jQuery(document).on('mouseenter', 'div[node-type=item]', function() {
jQuery(this).addClass('item-hover');
});
jQuery(document).on('mouseleave', 'div[node-type=item]', function() {
jQuery(this).removeClass('item-hover');
});

jQuery(document).on('click', 'span[node-type=name-text],.module-grid-view .item', function() {
var item = jQuery(this).closest('.item');
var type = item.data('type');
if(item.closest('.module-grid-view').length) {
var rander = 'grid';
} else {
var rander = 'list';
}
if(type == 'folder') {
jQuery('#pfid').val(item.data('containpath'));
location.href='<?php echo MOD_URL;?>&pfid=' + item.data('containpath');
return false;
} else {
if(type == 'image' && item.find('img[data-original]').trigger('click.dzzthumb')) {} else {
var preurl = 'share.php?a=view&s=' + item.data('dpath');
if(top._config) {
top.OpenWindow('url', preurl, item.find('img').attr('title'), null, { img: item.find('img').attr('src'), name: item.find('img').attr('title') });
} else {
window.open(preurl, jQuery(this).html());
}
}
}
return false;
});
jQuery('.title .item .col[node-type=title-col][data-key=dateline],.title .item .col[node-type=title-col][data-key=size]').on('click', function() {
var el = jQuery(this);
el.find('.asc').css('visibility', 'visible').toggleClass('desc');
el.siblings().find('.asc').css('visibility', 'hidden');

var param=el.data('key')+'='+ (el.find('.asc').hasClass('desc') ? 'desc' : 'asc');
var regx=new RegExp('&(dateline|size)=(asc|desc)','i');
var url=theurl.replace(regx,'')+'&'+param;
location.href=correcturl(url);
});
jQuery(document).on('click', 'a[data-key=download]', function() {
download(this);
return false;
});
jQuery('img[data-original]').dzzthumb();
});
   function download(obj) {
var li = jQuery(obj).closest('.item');

var url = DZZSCRIPT + '?mod=io&op=download&path=' + li.data('dpath');
if(BROWSER.ie) {
window.open(correcturl(url));
} else {
window.frames['hideframe'].location = correcturl(url);
}
}

var rids=[];
//复选框选中问题
jQuery(document).off('click.shareclick').on('click.shareclick',".shareblock",function(){
var checkinput = jQuery(this).find("input[name='del[]']");
if(checkinput.prop('checked')){
checkinput.prop('checked',false);
jQuery(this).removeClass('item-active');

var rid=jQuery(this).find('input[name="del[]"]').data('rid');
var index = jQuery.inArray(rid,rids);
if(index != -1){
rids.splice(index,1);
}

}else{
checkinput.prop('checked',true);
jQuery(this).addClass('item-active');
var rid=jQuery(this).data('rid');
if(jQuery.inArray(rid,rids) == -1){
rids.push(rid);
}

}
sharelength();
});
jQuery(document).off('click.inputclick').on('click.inputclick',".shareblock input[name='del[]']",function(){
if($(this).prop('checked')){
jQuery(this).prop('checked',false);
jQuery(this).removeClass('item-active');

}else{
jQuery(this).prop('checked',true);
jQuery(this).addClass('item-active');
}
});
//复选框全选
jQuery(document).off('click.allclick').on('click.allclick','#chkall',function(){
var allchecked=jQuery(this).prop('checked');
jQuery(this).closest('.title').next('.list-share').find('input[name="del[]"]').each(function(){
if(allchecked){
jQuery(this).prop('checked',true);
jQuery(this).closest('.item').addClass('item-block');
var rid=jQuery(this).data('rid');
if(jQuery.inArray(rid,rids) == -1){
rids.push(rid);
}
}else{
jQuery(this).prop('checked',false);
jQuery(this).closest('.item').removeClass('item-block');
var rid=jQuery(this).data('rid');
var index = jQuery.inArray(rid,rids);
if(index != -1){
rids.splice(index,1);
}

}
});
sharelength();
})

function sharelength(){
if(rids.length>0){
jQuery('.sharepame-selected').show().next('.show_first').hide();
jQuery('#chkall').prop('checked',true);
jQuery('.btn-secetlt').show();
}else{
jQuery('.sharepame-selected').hide().next('.show_first').show();
jQuery('#chkall').prop('checked',false);
jQuery('.btn-secetlt').hide();
}
jQuery('.ex-number').html(rids.length);
}
function delete_file(){
var delnums = rids.length;
var icoids = rids.join(',');
if(confirm('您确定要删除这'+delnums+'文件(如果是文件夹将包含其下的子文件都会被删除)吗？删除之后不可恢复！')){
jQuery.post('<?php echo MOD_URL;?>&do=delete',{'icoid':icoids},function(data){
if(data['success']){
location.reload();
}else{

}
})
}
}
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