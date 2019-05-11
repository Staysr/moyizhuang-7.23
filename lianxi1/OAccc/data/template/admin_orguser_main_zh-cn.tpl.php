<?php if(!defined('IN_DZZ')) exit('Access Denied'); /*a:9:{s:80:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/orguser/template/main.htm";i:1536850350;s:101:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_start.htm";i:1536850350;s:99:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_end.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/commer_header.htm";i:1536850350;s:87:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/orguser/template/header_left.htm";i:1536850350;s:89:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/orguser/template/header_search.htm";i:1536850350;s:94:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_right.htm";i:1536850350;s:80:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./admin/orguser/template/tree.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/footer_simple.htm";i:1536850350;}*/?>
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
<script type="text/javascript" src="./data/template/admin_orguser_main_header_zh-cn.js" ></script><script type="text/javascript" src="static/js/header.js?<?php echo VERHASH;?>" ></script>
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
<link href="static/jstree/themes/default/style.min.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<link href="static/css/common.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<link href="static/css/checkbox.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<link href="admin/orguser/images/orguser.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<script type="text/javascript" src="static/js/jquery.leftDrager.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript" src="./data/template/admin_orguser_main_orguser_zh-cn.js" ></script><script src="admin/orguser/scripts/orguser.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript">
var selorg={};
<?php if($openarr) { ?>
selorg.openarr=<?php echo $openarr;?>;
<?php } ?>
selorg.add=function(ctrlid,vals){
if(vals[0].orgid=='other') vals[0].path='请选择机构或部门';
jQuery('#'+ctrlid+'_Menu').html(vals[0].path+' <span class="caret"></span>');
jQuery('#sel_'+ctrlid).val(vals[0].orgid).trigger('change');
}
</script>
<style>
.selorg-container li.dropdown {
/*min-width:150px;*/
margin: 0 10px 10px 0;
}

.selorg-container .job .dropdown-menu {
max-height: 300px;
overflow-y: auto;
padding: 10px;
}

.selorg-container li a {
padding: 5px 10px;
}

.selorg-container li.dropdown a .caret {
margin-left: 5px;
}

.btn-simple.disabled,
.btn-simple[disabled],
fieldset[disabled] .btn-simple {
pointer-events: none;
cursor: not-allowed;
opacity: 1;
box-shadow: none;
background: none repeat scroll 0% 0% #EEE;
}
.bs-main-container{
margin-left:215px;
}
.bs-left-container{
width:215px;
}
</style><script type="text/javascript" src="./data/template/admin_orguser_main_common_zh-cn.js" ></script><script type="text/javascript" src="static/js/common.js?<?php echo VERHASH;?>" ></script>
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
        <a href="<?php echo MOD_URL;?>">机构用户</a>
    </li> 
</ul>    </div>
    <div class="resNav-item resNav-center"> <?php if(empty($_GET['op'])) { ?>
 <div class="input-search">
 <form name="search" action="<?php echo BASESCRIPT;?>"  onsubmit="return false">
    <i class="input-search-icon glyphicon glyphicon-search" aria-hidden="true" onclick="jstree_search(jQuery('#searchval').val())"></i>
    <input type="text"  class="form-control search  form-search"  value="" placeholder="搜索" id="searchval" onkeyup="if(this.value!=''){jQuery('#emptysearchcondition').show();}if(event.keyCode==13){jstree_search(jQuery('#searchval').val())}">
    <span aria-hidden="true" id="emptysearchcondition" class="header-closebutton">×</span>
 </form>
</div>

<script type="text/javascript">
jQuery('#searchval').focus(function (e) {//头部搜索框变颜色
    jQuery(this).closest('.input-search').addClass('focus');
if(this.value!='') jQuery('#emptysearchcondition').show();
});
jQuery('#searchval').blur(function (e) {//失去焦点时
 jQuery(this).closest('.input-search').removeClass('focus');
 if(this.value=='') jQuery('#emptysearchcondition').hide();
});
jQuery('#emptysearchcondition').on('click',function(){
jstree_search('stop');
jQuery('#emptysearchcondition').hide();
return false;
});
</script>
<?php } ?>    </div>
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
<div class="bs-left-container  clearfix"><div id="classtree_top" class="classtree-topbar">
<a class="newdir" href="javascript:;" onclick="jstree_create_organization();return false;" title="新建机构"></a>
<a class="newdir_1" href="javascript:;" onclick="jstree_create_dir();return false;" title="新建下级部门"></a>
<a class="newdoc" href="javascript:;" onclick="jstree_create_user();return false;" title="添加用户"></a>
<?php if($_G['adminid']==1) { ?>
<a class="import " href="<?php echo ADMINSCRIPT;?>?mod=orguser&op=import" title="导入用户"></a>
<?php } ?>

<a class="guide" href="javascript:;" onclick="show_guide();return false;" title="操作说明"></a>
</div>
<div class="classtree-search">
<a href="javascript:;" class="search" onclick="jstree_search(jQuery('#jstree_search_input').val());return false" title="搜索"><i class="glyphicon glyphicon-search"></i></a>
<a href="javascript:;" class="delete" onclick="jstree_search('stop');return false" title="关闭搜索框"><i class="glyphicon glyphicon-remove"></i></a>
<input id="jstree_search_input" type="text" class="form-control" placeholder="按回车搜索" onkeyup="if(event.keyCode==13){jstree_search(jQuery('#jstree_search_input').val())}" />
</div>
<div id="classtree" class="classtree-container" style="padding:5px 0;overflow:auto;border-top:1px solid #FFF;"></div>

<script type="text/javascript">
var orgtree = <?php echo $orgtree;?>;
var ajaxurl = '<?php echo ADMINSCRIPT;?>?mod=orguser&op=ajax&';
var baseurl = '<?php echo ADMINSCRIPT;?>?mod=orguser&';
jQuery(document).ready(function(e) {

jQuery("#classtree").jstree({
"core": {
"multiple": true,
'check_callback': function(operation, node, node_parent, node_position, more) {
// operation can be 'create_node', 'rename_node', 'delete_node', 'move_node' or 'copy_node'
// in case of 'rename_node' node_position is filled with the new node name
if(node.id == 'other') return false;
if(node_parent.id == 'other' && node.type != 'user') return false;
return operation === 'copy_node' && node.type == 'organization' ? false : true;
},
"themes": { "responsive": false, "variant": 'large' },
"data": {
dataType: 'json',
url: '<?php echo ADMINSCRIPT;?>?mod=orguser&op=ajax&do=getchildren&t=' + new Date().getTime(),
data: function(node) {
return { 'id': node.id };
}
}
},
"dnd": {
"copy": true,
"open_timeout": 500,
"is_draggable": function(node) {
var inst = jQuery("#classtree").jstree(true);
for(var i in node) {
if(inst.is_disabled(node[i])) return false;
}
return true;
}
},

"types": {
"#": {
"max_children": -1,
"max_depth": -1,
"valid_children": -1
},
"organization": {
"valid_children": ['user', 'organization']
},
"group": {
"icon":"dzz dzz-group",
"valid_children": ['user']
},
"default": {
"valid_children": ['user']
},
"disabled": {
//  "icon" : "jstree-icon-file",
"valid_children": []
},
"user": {
//  "icon" : "jstree-icon-file",
"valid_children": []
}
},
'contextmenu': {
'select_node': false,
'show_at_node': false,
'items': {
"create_sibing": {
"separator_before": false,
"separator_after": false,
"_disabled": function(data) {
var inst = jQuery.jstree.reference(data.reference);
var node = inst.get_node(data.reference);
if(node.type == 'default') return true;
//if(node.type == 'user') return true;
if(inst.is_disabled(node)) {
return true;
}
var parent = inst.get_node(node.parent);
if(inst.is_disabled(parent)) {
return true;
}
return false;
},
"label": "新建同级部门",
"icon": "glyphicon glyphicon-tag",
"action": function(data) {
var inst = jQuery.jstree.reference(data.reference),
obj = inst.get_node(data.reference),
obj1 = inst.get_node(obj.parent);

var position = jQuery.inArray(obj.id, obj1.children) + 1;
jQuery.post('<?php echo ADMINSCRIPT;?>?mod=orguser&op=ajax&do=create', { 'forgid': obj.parent, 'orgid': obj.id, 't': new Date().getTime() }, function(json) {

if(!json || json.error) {
showmessage(json.error, 'danger', 3000, 1);
} else if(json.orgid > 0) {
var arr = { "id": json.orgid, "text": json.orgname, "type": "organization", "icon": (json.forgid > 0) ? 'dzz/system/images/department.png' : 'dzz/system/images/organization.png' }
inst.create_node(obj1, arr, position, function(new_node) {
setTimeout(function() { inst.edit(new_node); }, 0);
});
}
}, 'json');
}
},

"create": {
"separator_before": false,
"separator_after": false,
"_disabled": function(data) {
var inst = jQuery.jstree.reference(data.reference);
var node = inst.get_node(data.reference);
var parent = inst.get_node(node.parent);
if(node.type == 'group') return true;
if(node.type == 'default') return true;
if(node.type == 'user') return true;
if(inst.is_disabled(node)) {
return true;
}
return false;
},
"label": "新建下级部门",
"icon": "glyphicon glyphicon-tags",
"action": function(data) {
var inst = jQuery.jstree.reference(data.reference),
obj = inst.get_node(data.reference);
jQuery.post('<?php echo ADMINSCRIPT;?>?mod=orguser&op=ajax&do=create', { 'forgid': obj.id, 't': new Date().getTime() }, function(json) {
if(!json || json.error) {
showmessage(json.error, 'danger', 3000, 1);
} else if(json.orgid > 0) {
var arr = { "id": json.orgid, "text": json.orgname, "type": "organization", "icon": (json.forgid > 0) ? 'dzz/system/images/department.png' : 'dzz/system/images/organization.png' };

inst.create_node(obj, arr, "first", function(new_node) {
setTimeout(function() { inst.edit(new_node); }, 0);
});
}
}, 'json');
}
},

"rename": {
"separator_before": false,
"separator_after": false,
"_disabled": function(data) {
var inst = jQuery.jstree.reference(data.reference);
var node = inst.get_node(data.reference);
if(node.type == 'default') return true;
if(inst.is_disabled(node)) {
return true;
}
if(node.type == 'user') return true;

return false;
},
"label": "重命名",

"shortcut"			: 113,
"shortcut_label"	: 'F2',
"icon": "glyphicon glyphicon-leaf",

"action": function(data) {

var inst = jQuery.jstree.reference(data.reference),
obj = inst.get_node(data.reference);
console.log('aaaaaaa');
inst.edit(obj);

}
},
"remove": {
"separator_before": false,
"icon": false,
"separator_after": false,
"_disabled": function(data) {
var inst = jQuery.jstree.reference(data.reference);
var node = inst.get_node(data.reference);
if(node.type == 'default') return true;
if(inst.is_disabled(node)) {
return true;
}
var parent = inst.get_node(node.parent);
if(inst.is_disabled(parent)) {
return true;
}

return false;
},
"label": "删除",
"icon": "glyphicon glyphicon-remove",
"action": function(data) {
var inst = jQuery.jstree.reference(data.reference),
obj = inst.get_node(data.reference);

//判断是否为相同类型的多选和相同部门的
var msg = '';
var nodes = [];
if(inst.is_selected(obj)) {
var nodes = inst.get_selected(true);
var type = null;
var parent = null;
for(var i in nodes) {
if(!type) type = nodes[i].type;
else if(type != nodes[i].type) {
msg = '请选择相同类型的节点';
break;
}
if(!parent) parent = nodes[i].parent;
else if(parent != nodes[i].parent) {
msg = '请选择相同部门的节点';
break;
}
}
} else {
var nodes = [obj];
}
if(msg) {
showmessage(msg, 'danger', 3000, 1);
return;
}
if(obj.parent == 'other') {
var uids = [];
for(var i in nodes) {
uids.push(nodes[i].li_attr.uid);
}
var msg = '您确定要彻底删除此用户(用户的所有数据和文件都会彻底删除）吗？';

var data = { 'uids': uids, 'forgid': obj.parent, 'type': 'user', 'realdelete': '1' };
} else {
if(obj.type == 'user') {
var uids = [];
for(var i in nodes) {
uids.push(nodes[i].li_attr.uid);
}

var msg = '此处删除，仅从部门中移除此用户，移除后您可能没有操作此用户的权限，您确定要移除此用户吗？';
var data = { 'uids': uids, 'forgid': obj.parent, 'type': 'user' };

} else {
if(nodes.length > 1) {
showmessage('机构或部门不支持批量删除', 'danger', 3000, 1);
return;
}
var msg = '删除部门前，必须先删除此部门的所有下级部门，并且删除共享目录中的文件，您确定要删除此部门吗？';
var data = { 'orgid': obj.id, 'forgid': obj.parent }
}
}
Confirm(msg,function(){
jQuery.post('<?php echo ADMINSCRIPT;?>?mod=orguser&op=ajax&do=delete&t=' + new Date().getTime(), data, function(json) {
if(json.error) {
showmessage(json.error, 'danger', 3000, 1);
} else {
if(inst.is_selected(obj)) {
inst.delete_node(inst.get_selected(true));
} else {
inst.delete_node(obj);
}
if(obj.type == 'user') {
var parent = inst.get_node('other');
inst.refresh_node(parent);
}
}

}, 'json');
});

}
}
}
},
"search": {
"show_only_matches": true,
"fuzzy": false,
"ajax": { 'url': '<?php echo ADMINSCRIPT;?>?mod=orguser&op=ajax&do=search', 'dataType': 'json' }
},
"plugins": ["unique", "contextmenu", "dnd", "types", "search",'wholerow']
// List of active plugins

});

jQuery("#classtree").on('ready.jstree', function(e) {
var inst = jQuery("#classtree").jstree(true);
for(var i in orgtree) {
if(document.getElementById(orgtree[i][0])) open_node_dg(inst, document.getElementById(orgtree[i][0]), orgtree[i]);
}
});
jQuery(document).on('touchend', '#classtree .jstree-anchor', function() {
var inst = jQuery("#classtree").jstree(true);
var node = jQuery(this).closest('.jstree-node');
inst.select_node(node);
return false;
});
jQuery("#classtree").on('select_node.jstree', function(e, data) {
var inst = jQuery("#classtree").jstree(true);
inst.open_node(data.node);
if(data.selected.length > 1) return;
if(data.node.id == "other") return;
if(data.node.type == 'user') {
showDetail(data.node.li_attr.uid, 'user');
} else {
showDetail(data.node.id, 'organization');
}
});

jQuery("#classtree").on('load_node.jstree', function(e, data) { //设置空节点为leaf
var inst = jQuery("#classtree").jstree(true);
if(data.node.children.length < 1) {
jQuery('#' + data.node.id).removeClass('jstree-closed').addClass('jstree-leaf');;
}
});

jQuery(document).on('dnd_move.vakata', function(e, data) {
if(jQuery(data.event.target).closest('.moderators-acceptor').length) {
jQuery('.moderators-acceptor').addClass('hover').find('img').attr('src', 'avatar.php?uid=' + jQuery(data.element).parent().attr('uid') + '&size=middle');
} else {
jQuery('.moderators-acceptor').removeClass('hover');
}
});
jQuery(document).on('dnd_stop.vakata', function(e, data) {
if(!jQuery(data.event.target).closest('.moderators-acceptor').length) return;
var uid = jQuery(data.element).parent().attr('uid');
var orgid = jQuery('.moderators-acceptor').attr('orgid');
moderator_add(orgid, uid);
});
jQuery("#classtree").on('move_node.jstree', function(e, data) {
if(jQuery(e.target).closest('.moderators-acceptor').length) return;
var inst = jQuery("#classtree").jstree(true);
var node = data.node;
var parent = inst.get_node(data.parent);
var post = {};
var needsave = 0;
if(node.type == 'user' && data.parent != data.old_parent) { //移动用户
post.uid = node.li_attr.uid;
post.forgid = data.old_parent;
post.orgid = data.parent;
post.type = 'user';
needsave = 1;
} else {
post.orgid = node.id;
post.forgid = data.parent;
post.position = data.position;
needsave = 1;
}
if(needsave) {
jQuery.post('<?php echo ADMINSCRIPT;?>?mod=orguser&op=ajax&do=move&t=' + new Date().getTime(), post, function(json) {
if(json.error) {
showmessage(json.error, 'danger', 3000, 1, null, function() {
window.location.reload();
});
}
}, 'json');
}
});
jQuery("#classtree").on('copy_node.jstree', function(e, data) {
if(jQuery(e.target).closest('.moderators-acceptor').length) return;
var inst = jQuery("#classtree").jstree(true);
var node = data.node;
var parent = inst.get_node(data.parent);
var post = {};
var needsave = 0;
if(node.type == 'user' && data.parent != data.old_parent) { //移动用户
post.uid = node.li_attr.uid;
post.forgid = data.old_parent;
post.orgid = data.parent;
post.type = 'user';
post.copy = 1;
needsave = 1;
} else {
return;
}
if(needsave) {
jQuery.post('<?php echo ADMINSCRIPT;?>?mod=orguser&op=ajax&do=move&t=' + new Date().getTime(), post, function(json) {

}, 'json');
}
});
jQuery("#classtree").on('open_node.jstree', function(e, data) {
//jQuery("#"+data.node.id+" .jstree-anchor").addTouch();
});
jQuery("#classtree").on('rename_node.jstree', function(e, data) {
var inst = jQuery("#classtree").jstree(true);
var obj = inst.get_node(data.node);
            var oldtext = data.old.replace(/<(.+?)>(.+?)<\/(.+?)>/,'');
if(data.text == '' || data.text == oldtext) {
inst.set_text(obj, data.old);
return;
}
jQuery.post('<?php echo ADMINSCRIPT;?>?mod=orguser&op=ajax&do=rename&t=' + new Date().getTime(), { 'orgid': data.node.id, text: data.text }, function(json) {
if(!json || json.error) {
obj.text = data.old;
inst.set_text(obj, data.old);
if(json.error) showmessage(json.error, 'danger', 3000, 1);
}else{
jQuery('#title_orgname').html(data.text);
jQuery('#orgname').val(data.text).data('oldname',data.text);
inst.refresh();
}
}, 'json');
});
// jQuery("#classtree").on('create_node.jstree',function(e,data){});

});
</script></div>
<div class="left-drager">
<div class="left-drager-op">
<div class="left-drager-sub"></div>
</div>
</div>
<div class="bs-main-container">
<div class="main-content clearfix" style="padding:0">
<div id="orguser_container" class="orguser-container">

</div>
</div>
</div>
<div id="loading_info" style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;margin:0;padding:0;overflow:hidden; z-index: 11000;background:transparent;display:none;">
<table height="100%" width="100%">
<tbody>
<tr>
<td align="center" valign="middle">
<div class="loading_img">
<div class="loading_process"></div>
</div>
</td>
</tr>
</tbody>
</table>
</div>
</div>

<script type="text/javascript">
jQuery('.left-drager').leftDrager_layout(function() {
jQuery('#classtree').css('height', jQuery('.bs-left-container').outerHeight(true) - jQuery('#classtree_top').outerHeight(true));
});
var currentHash = '';
jQuery(document).ready(function(e) {

jQuery(document).on('mouseenter', '.moderators-container .user-item', function() {
jQuery(this).addClass('hover');
});
jQuery(document).on('mouseleave', '.moderators-container .user-item', function() {
jQuery(this).removeClass('hover');
});
var hash = window.location.hash.replace('#', '');
if(hash) {
var hasharr = hash.split('_');
showDetail(hasharr[1], hasharr[0], hasharr[2], hasharr[3]);
} else {
show_guide();
}
});
window.onhashchange = function() { //调转到指定的页面
var hash = window.location.hash.replace('#', '');
if(hash && hash != currentHash) {
var hasharr = hash.split('_');
showDetail(hasharr[1], hasharr[0], hasharr[2], hasharr[3]);
}
}
</script>
<script type="text/javascript" src="static/js/jstree.min.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript" src="static/js/jquery.textareaexplander.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript" src="static/jquery_file_upload/jquery.ui.widget.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript" src="static/jquery_file_upload/jquery.iframe-transport.js?<?php echo VERHASH;?>" ></script>
<!-- The basic File Upload plugin -->
<script type="text/javascript" src="static/jquery_file_upload/jquery.fileupload.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript" src="static/jquery_file_upload/jquery.fileupload-process.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript" src="./data/template/admin_orguser_main_jquery_fileupload-validate_zh-cn.js" ></script><script type="text/javascript" src="static/jquery_file_upload/jquery.fileupload-validate.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript" src="static/bootstrap/js/bootstrap.min.js?<?php echo VERHASH;?>" ></script><?php output();?><?php updatesession();?><?php if(debuginfo()) { ?>
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