<?php if(!defined('IN_DZZ')) exit('Access Denied'); /*a:9:{s:82:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./user/profile/template/profile.htm";i:1536850350;s:101:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_start.htm";i:1536850350;s:99:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_simple_end.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/commer_header.htm";i:1536850350;s:93:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_left.htm";i:1536850350;s:0:"";b:0;s:94:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/header_right.htm";i:1536850350;s:79:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./user/profile/template/left.htm";i:1536850350;s:95:"/Applications/MAMP/htdocs/18031/lianxi1/OAccc//./core/template/default/common/footer_simple.htm";i:1536850350;}*/?>
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
<script type="text/javascript" src="./data/template/user_profile_profile_header_zh-cn.js" ></script><script type="text/javascript" src="static/js/header.js?<?php echo VERHASH;?>" ></script>
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
<script type="text/javascript" src="static/js/jquery.leftDrager.js?<?php echo VERHASH;?>" ></script>
<script type="text/javascript" src="static/js/jquery.textareaexplander.js?<?php echo VERHASH;?>" ></script>
<style>
html,body{
overflow:hidden;
background:#FBFBFB;
}
.bs-left-container{
width:150px;
}
.bs-main-container{
margin-left:120px;
overflow:auto;
}
.form-horizontal-left .form-group .controls{
width:70%;
padding:0 5px;
}
.form-horizontal-left .form-group .controls-container{
width:320px;
float:left;
}
@media (max-width: 605px){
.form-horizontal-left .control-label {
 text-align: left; 
width: 120px;
}
}
@media (max-width: 480px){
.form-horizontal-left .form-group .controls-container {
width:100%;
}
.form-horizontal-left .form-group .controls{
width:100%;
padding:0 5px;
}
}

@media (max-width: 420px){
.form-horizontal-left .form-group .controls {
min-width: 100%;
}
}
.form-horizontal-left label{
padding:7px 10px 0 0;
}
.form-horizontal-left .help-inline{
padding:5px;
}

.form-horizontal-left .form-control{
width:100%;
}
.has-error .form-control.privacy{
border-color:#e1e1e1;
}
.has-error .form-control.privacy:focus{
border-color:#66afe9;
}
.rq{
color:red;
}
.progress-relative{
position:relative;
height:26px;
line-height:24px;
background-color: #e6e6e6;

}
.progress-relative .progress-cover{
position:absolute;
text-align:center;
width:100%;
font-size:75%;
height:24px;
line-height:24px;
color:#FFF;
text-shadow:1px 1px 1px #000;
font-weight:700;
}

#department_Menu span.iconFirstWord{
background: #f35b42;
border-radius: 50%;
display: inline-block;
line-height: 18px;
text-align: center;
margin-right: 2px;
color: #FFFFFF;
width: 18px;
height: 18px
}
</style><script type="text/javascript" src="./data/template/user_profile_profile_common_zh-cn.js" ></script><script type="text/javascript" src="static/js/common.js?<?php echo VERHASH;?>" ></script>
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
</div> 
  </div>
  <div class="left-drager">
  </div>
  <div class="bs-main-container  clearfix" >
    <div class="main-content" style="padding:15px;">
      <?php if($vid) { ?>
          <div class="alert <?php if($showbtn) { ?>alert-warning<?php } else { ?>alert-success<?php } ?>" style="margin-bottom:20px;max-width:750px;line-height:1.8">
              <?php if($showbtn) { ?>
                <p><i class="glyphicon glyphicon-question-sign" ></i> 以下信息通过审核后将不能再次修改，提交后请耐心等待核查 </p> 
                <?php if($_G['setting']['verify'][$vid]['desc']) { ?>
                <?php $desc=dzzcode($_G['setting']['verify'][$vid]['desc']);?>                <p class="ml20"><?php echo $desc;?></p>
                <?php } ?>
              <?php } else { ?>
               <p><i class="glyphicon glyphicon-ok" ></i> 恭喜您，您的认证审核已经通过，下面的资料项已经不允许被修改 </p>
              <?php } ?>
         
</div>
      <?php } else { ?>
      <div class="" style="padding:0 20px 20px 20px;max-width:450px;line-height:1.8">
      	<div class="progress progress-relative" style="margin:0">
          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $userstatus['profileprogress'];?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $userstatus['profileprogress'];?>%">
            <span class="sr-only">资料完成 <?php echo $userstatus['profileprogress'];?>% </span>
          </div>
          <div class="progress-cover">资料完成 <?php echo $userstatus['profileprogress'];?>%</div>
        </div>
      </div>
      <?php } ?>
      <iframe id="frame_profile" name="frame_profile" style="display: none"></iframe>
      <form id="accountform" name="accountform" class="form-horizontal form-horizontal-left" action="user.php?mod=profile" method="post" enctype="multipart/form-data" target="frame_profile" onsubmit="clearErrorInfo();">
        <input type="hidden" name="profilesubmit" value="true" />
        <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
         <input type="hidden" name="vid" value="<?php echo $vid;?>" />
        
        <div class="form-group">
          <label class="control-label">用户名</label>
          <div class="controls-container">
            <p class="form-control-static"><?php echo $_G['username'];?>&nbsp; <?php if($qqlogin['openid'] && $qqlogin['unbind']<1) { ?><img src="user/images/qq.png" height="16" title="QQ已绑定" />&nbsp;&nbsp;<a  href="user.php?mod=profile&amp;action=qq_unbind&amp;openid=<?php echo $qqlogin['openid'];?>">解除绑定！</a><?php } ?></p>
          </div>
        </div>
       
        <?php if(is_array($settings)) foreach($settings as $key => $value) { ?> 
        <?php if($value['available']) { ?>
        <div class="form-group" id="th_<?php echo $key;?>">
          <label class="control-label" for="<?php echo $key;?>" ><?php echo $value['title'];?><?php if($value['required']) { ?><span class="rq" title="必填">*</span><?php } ?></label>
          <div class="controls-container">
          <div class="controls">
            <?php echo $htmls[$key];?>
          </div>
          <div class="pull-left">
                <?php if($vid || $key=='department') { ?>
                <input type="hidden" name="privacy[<?php echo $key;?>]" value="<?php echo $privacy[$key];?>" />
                <?php } else { ?>
                <select name="privacy[<?php echo $key;?>]" class="form-control input-sm ml10 privacy" style="width:80px;">
                    <?php if(is_array($_config['profile']['privacy'])) foreach($_config['profile']['privacy'] as $k => $v) { ?>                    <option value="<?php echo $k;?>" <?php if($privacy[$key] == $k) { ?> selected="selected"<?php } ?>><?php echo $v;?></option>
                    <?php } ?>
                </select>
                <?php } ?>
          </div>
         </div>
        </div>
        <?php } ?> 
        <?php } ?> 
        <?php if(in_array('timeoffset', $allowitems)) { ?>
          <div class="form-group">
              <label class="control-label ">时区</label>
              <div class="controls-container">
                  <?php $timeoffset = array(
		'9999' => '使用系统默认',
		'-12' => '(GMT -12:00) 埃尼威托克岛, 夸贾林环礁',
		'-11' => '(GMT -11:00) 中途岛, 萨摩亚群岛',
		'-10' => '(GMT -10:00) 夏威夷',
		'-9' => '(GMT -09:00) 阿拉斯加',
		'-8' => '(GMT -08:00) 太平洋时间(美国和加拿大), 提华纳',
		'-7' => '(GMT -07:00) 山区时间(美国和加拿大), 亚利桑那',
		'-6' => '(GMT -06:00) 中部时间(美国和加拿大), 墨西哥城',
		'-5' => '(GMT -05:00) 东部时间(美国和加拿大), 波哥大, 利马, 基多',
		'-4' => '(GMT -04:00) 大西洋时间(加拿大), 加拉加斯, 拉巴斯',
		'-3.5' => '(GMT -03:30) 纽芬兰',
		'-3' => '(GMT -03:00) 巴西利亚, 布宜诺斯艾利斯, 乔治敦, 福克兰群岛',
		'-2' => '(GMT -02:00) 中大西洋, 阿森松群岛, 圣赫勒拿岛',
		'-1' => '(GMT -01:00) 亚速群岛, 佛得角群岛 [格林尼治标准时间] 都柏林, 伦敦, 里斯本, 卡萨布兰卡',
		'0' => '(GMT) 卡萨布兰卡，都柏林，爱丁堡，伦敦，里斯本，蒙罗维亚',
		'1' => '(GMT +01:00) 柏林, 布鲁塞尔, 哥本哈根, 马德里, 巴黎, 罗马',
		'2' => '(GMT +02:00) 赫尔辛基, 加里宁格勒, 南非, 华沙',
		'3' => '(GMT +03:00) 巴格达, 利雅得, 莫斯科, 奈洛比',
		'3.5' => '(GMT +03:30) 德黑兰',
		'4' => '(GMT +04:00) 阿布扎比, 巴库, 马斯喀特, 特比利斯',
		'4.5' => '(GMT +04:30) 坎布尔',
		'5' => '(GMT +05:00) 叶卡特琳堡, 伊斯兰堡, 卡拉奇, 塔什干',
		'5.5' => '(GMT +05:30) 孟买, 加尔各答, 马德拉斯, 新德里',
		'5.75' => '(GMT +05:45) 加德满都',
		'6' => '(GMT +06:00) 阿拉木图, 科伦坡, 达卡, 新西伯利亚',
		'6.5' => '(GMT +06:30) 仰光',
		'7' => '(GMT +07:00) 曼谷, 河内, 雅加达',
		'8' => '(GMT +08:00) 北京, 香港, 帕斯, 新加坡, 台北',
		'9' => '(GMT +09:00) 大阪, 札幌, 首尔, 东京, 雅库茨克',
		'9.5' => '(GMT +09:30) 阿德莱德, 达尔文',
		'10' => '(GMT +10:00) 堪培拉, 关岛, 墨尔本, 悉尼, 海参崴',
		'11' => '(GMT +11:00) 马加丹, 新喀里多尼亚, 所罗门群岛',
		'12' => '(GMT +12:00) 奥克兰, 惠灵顿, 斐济, 马绍尔群岛');?>                  <select name="timeoffset" class="form-control">
                      <?php if(is_array($timeoffset)) foreach($timeoffset as $key => $desc) { ?>                      <option value="<?php echo $key;?>" <?php if($key==$space['timeoffset']) { ?> selected="selected" <?php } ?>><?php echo $desc;?></option>
                      <?php } ?>
                  </select>
                  <p class="mt10">当前时间 :
                      <?php echo dgmdate($_G[timestamp]);?>                  </p>
                  <p class="gray">如果发现当前显示的时间与您本地时间相差几个小时，那么您需要更改自己的时区设置 </p>
              </div>
          </div>
          <div class="form-group">
              <label class="control-label language">语言</label>
              <div class="controls-container">
                  <select name="language" class="form-control">
                      <option value="" <?php if($space['language'] == '') { ?>selected="selected"<?php } ?>>自动</option>
                      <?php if(is_array($langList)) foreach($langList as $key => $value) { ?>                      <option value="<?php echo $key;?>" <?php if($space['language'] == $key) { ?>selected="selected"<?php } ?> /> <?php echo $value;?></option>
                      <?php } ?>
                  </select>

              </div>
          </div>
          <?php } ?>
        <?php if(!$vid || $showbtn) { ?>
        <div class="form-group">
             <label class="control-label " ></label>
            <div class="controls">
                <input type="submit" class="btn btn-primary btn-width" <?php if($vid) { ?>value="提交审核"<?php } else { ?>value="保存"<?php } ?>>
            </div>
        </div>
         <?php } ?>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
jQuery('.left-drager').leftDrager_layout();
jQuery(document).ready(function(){
jQuery('textarea').TextAreaExpander(30,999);
})
jQuery(document).on('blur','.has-error .form-control',function(){
if(this.value) jQuery(this).closest('.form-group').removeClass('has-error');
});
function show_error(fieldid, extrainfo) {
var elem = jQuery('#th_'+fieldid);
if(elem) {
elem.addClass('has-error');
elem.title = elem.innerHTML;
extrainfo = (typeof extrainfo == "string") ? extrainfo : "";

document.getElementById('showerror_'+fieldid).innerHTML = "请检查该资料项 " + extrainfo;
$(fieldid).focus();
}
}
function show_success(message) {
message = message == '' ? '资料更新成功' : message;
showDialog(message, 'right', '提示信息', function(){
window.location.href=window.location.href;
}, 0, null, '', '', '', '', 3);
}
function clearErrorInfo() {
jQuery('.has-error').removeClass('has-error');
}
</script>
<script src="static/bootstrap/js/bootstrap.min.js" ></script><?php output();?><?php updatesession();?><?php if(debuginfo()) { ?>
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
