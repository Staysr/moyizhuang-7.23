<?php if(!defined('IN_DZZ')) exit('Access Denied'); /*a:9:{s:81:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./user/profile/template/avatar.htm";i:1536850350;s:101:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_start.htm";i:1536850350;s:99:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_end.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/commer_header.htm";i:1536850350;s:93:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_left.htm";i:1536850350;s:0:"";b:0;s:94:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_right.htm";i:1536850350;s:79:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./user/profile/template/left.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/footer_simple.htm";i:1536850350;}*/?>
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
<script type="text/javascript" src="./data/template/user_profile_avatar_header_zh-cn.js" ></script><script type="text/javascript" src="static/js/header.js?<?php echo VERHASH;?>" ></script>
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
<link href="user/scripts/jquery.cropbox.css?<?php echo VERHASH;?>" rel="stylesheet" media="all">
<script type="text/javascript" src="user/scripts/hammer.js" ></script>
<script type="text/javascript" src="user/scripts/jquery.mousewheel.js" ></script>
<script type="text/javascript" src="user/scripts/jquery.cropbox.js" ></script>
<script type="text/javascript" src="static/js/jquery.leftDrager.js?<?php echo VERHASH;?>" ></script><script type="text/javascript" src="./data/template/user_profile_avatar_common_zh-cn.js" ></script><script type="text/javascript" src="static/js/common.js?<?php echo VERHASH;?>" ></script>
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
    <!-- 左边部分 -->
    <div class="bs-left-container affix-top clearfix">
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

    <!-- 左边拖动部分 -->
    <div class="left-drager">
        <div class="left-drager-op">
            <div class="left-drager-sub"></div>
        </div>
    </div>  
    <!-- 结束 -->
    <!-- 右边部分 -->
    <div class="bs-main-container clearfix"> 
        <div class="main-content" style="padding:20px;">
            <script type="text/javascript">
                function updateavatar() {
                    window.location.href = document.location.href.replace('&reload=1', '') + '&reload=1';
                }
            </script>
            <form id="avatar_form" method="post" autocomplete="off" action="user.php?mod=avatar">
                <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
                <input id="imagedata" type="hidden" name="imagedata" value="" />
                <input id="aid" type="hidden" name="aid" value="0" />
                <input type="hidden" name="avatarsubmit" value="true" />
            </form>
            <h4>设置头像</h4>
            <p>如果您还没有设置自己的头像，系统会显示为默认头像，您需要自己上传一张新照片来作为自己的个人头像 </p>
            <p>拖动下面的图片来需要头像位置，点击保存头像按钮保存当前头像</p>

            <div class="crop-container clearfix" style="margin-bottom:10px;">
                <img class="cropimage" src="avatar.php?uid=<?php echo $_G['uid'];?>&amp;size=big&amp;ramdom=1" />
            </div>
            <div class=" clearfix">
                <div class="pull-left" style="position:relative;padding:5px;overflow:hidden">
                    <button class="btn btn-success">上传图片</button>
                    <input id="upload" name="files[]" tabIndex="-1" style="position: absolute;outline:none; filter: alpha(opacity=0); PADDING-BOTTOM: 0px; margin: 0px; padding-left: 0px; padding-right: 0px; font-family: Arial; font-size: 180px;height:40px;width:86px;display:inline-block;top: 0px; cursor: pointer; right: 0px; padding-top: 0px; opacity: 0;direction:ltr;background-image:none" type="file" accept="image/png,image/gif,image/jpeg">
                </div>
                <div class="pull-left ml20" style="padding:5px;"><button type="button" id="avatar_form_btn" data-loading-text="正在上传..." class="btn btn-danger" onclick="return validate()" disabled="disabled">保存头像</button></div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery('.left-drager').leftDrager_layout();
    jQuery(document).ready(function(e) {
        var corp = jQuery('.cropimage').cropbox({ width: 200, height: 200, showControls: 'auto', label: '拖动移动位置' })
                .on('cropbox', function(event, results, img) {
                    //jQuery('.myavatar img').attr('src',img.getDataURL());
                });
        if(window.FileReader) {
            jQuery('#upload').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    jQuery('.cropimage').attr('src', e.target.result);
                    jQuery('#avatar_form_btn').prop('disabled',false);
                    jQuery('.cropimage').cropbox({ width: 300, height: 300, showControls: 'auto', label: '拖动移动位置' })
                }
                reader.readAsDataURL(this.files[0]);
                this.files = null;
            })
        } else {
            jQuery('#upload').fileupload({
                url: 'user.php?mod=profile&op=avatar&do=imageupload',
                dataType: 'json',
                autoUpload: true,
                maxChunkSize: 2000000, //2M
                maxFileSize: 5000000, // 5 MB
                acceptFileTypes: new RegExp("(\.|\/)([jpeg|jpg|gif|png|bmp])$", 'i'),
                dropZone: jQuery('.crop-container'),
                pasteZone: jQuery('.crop-container'),
                sequentialUploads: true

            }).on('fileuploadfail', function(e, data) {
                jQuery.each(data.result.files, function(index, file) {
                    if(file.error) {
                        showmessage(json.error, 'danger', 3000, 1);
                    }
                });
            }).on('fileuploaddone', function(e, data) {
                jQuery.each(data.result.files, function(index, file) {
                    if(file.error) {
                        showmessage(json.error, 'danger', 3000, 1);
                    } else {
                        jQuery('#aid').val(file.data.aid);
                        jQuery('.cropimage').attr('src', file.data.img);
                        jQuery('#avatar_form_btn').prop('disabled',false);
                        jQuery('.cropimage').cropbox({ width: 300, height: 300, showControls: 'auto', label: '拖动移动位置' })
                    }
                });
            });
        }
    });

    function validate() {
        var inst = jQuery('.cropimage').data('cropbox');
        jQuery('#imagedata').val(inst.getDataURL());
        jQuery('#avatar_form_btn').button('loading');
        jQuery.post('user.php?mod=profile&op=avatar', jQuery('#avatar_form').serialize(), function(json) {
            if(json.msg == 'success') {
                showmessage('头像上传成功,由于缓存问题，可能新头像需要过段时间才能显示', 'success', 3000, 1);
                window.setTimeout(function() { window.location.href = 'user.php?mod=profile&op=avatar&t=' + new Date().getTime(); }, 3000);
            } else {
                showmessage(json.error, 'success', 3, 1);
            }
            jQuery('#avatar_form_btn').button('reset');
        }, 'json');
        return false;
    }
</script>
<script src="static/bootstrap/js/bootstrap.min.js?<?php echo VERHASH;?>" ></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script type="text/javascript" src="static/jquery_file_upload/jquery.ui.widget.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript" src="static/jquery_file_upload/jquery.iframe-transport.js?<?php echo VERHASH;?>" ></script>
<!-- The basic File Upload plugin -->
<script type="text/javascript" src="static/jquery_file_upload/jquery.fileupload.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript" src="static/jquery_file_upload/jquery.fileupload-process.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript" src="./data/template/user_profile_avatar_jquery_fileupload-validate_zh-cn.js" ></script><script type="text/javascript" src="static/jquery_file_upload/jquery.fileupload-validate.js?<?php echo VERHASH;?>" ></script><?php output();?><?php updatesession();?><?php if(debuginfo()) { ?>
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