<?php
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>'.$this->_tpl_vars['saxue_pagetitle'].'</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="'.$this->_tpl_vars['saxue_skin_server'].'/admin/css/frame.css" />
<link rel="stylesheet" type="text/css" media="all" href="'.$this->_tpl_vars['saxue_skin_server'].'/dialog/dialog.css" />
<script type="text/javascript" src="'.$this->_tpl_vars['saxue_skin_server'].'/dialog/dialog.js"></script>
<script language="javascript" type="text/javascript">
var leftmenus = new Array();
var topbarmenus = new Array();
';
if (empty($this->_tpl_vars['groupmenus'])) $this->_tpl_vars['groupmenus'] = array();
elseif (!is_array($this->_tpl_vars['groupmenus'])) $this->_tpl_vars['groupmenus'] = (array)$this->_tpl_vars['groupmenus'];
$this->_tpl_vars['g']=array();
$this->_tpl_vars['g']['columns'] = 1;
$this->_tpl_vars['g']['count'] = count($this->_tpl_vars['groupmenus']);
$this->_tpl_vars['g']['addrows'] = count($this->_tpl_vars['groupmenus']) % $this->_tpl_vars['g']['columns'] == 0 ? 0 : $this->_tpl_vars['g']['columns'] - count($this->_tpl_vars['groupmenus']) % $this->_tpl_vars['g']['columns'];
$this->_tpl_vars['g']['loops'] = $this->_tpl_vars['g']['count'] + $this->_tpl_vars['g']['addrows'];
reset($this->_tpl_vars['groupmenus']);
for($this->_tpl_vars['g']['index'] = 0; $this->_tpl_vars['g']['index'] < $this->_tpl_vars['g']['loops']; $this->_tpl_vars['g']['index']++){
	$this->_tpl_vars['g']['order'] = $this->_tpl_vars['g']['index'] + 1;
	$this->_tpl_vars['g']['row'] = ceil($this->_tpl_vars['g']['order'] / $this->_tpl_vars['g']['columns']);
	$this->_tpl_vars['g']['column'] = $this->_tpl_vars['g']['order'] % $this->_tpl_vars['g']['columns'];
	if($this->_tpl_vars['g']['column'] == 0) $this->_tpl_vars['g']['column'] = $this->_tpl_vars['g']['columns'];
	if($this->_tpl_vars['g']['index'] < $this->_tpl_vars['g']['count']){
		list($this->_tpl_vars['g']['key'], $this->_tpl_vars['g']['value']) = each($this->_tpl_vars['groupmenus']);
		$this->_tpl_vars['g']['append'] = 0;
	}else{
		$this->_tpl_vars['g']['key'] = '';
		$this->_tpl_vars['g']['value'] = '';
		$this->_tpl_vars['g']['append'] = 1;
	}
	echo '
topbarmenus['.$this->_tpl_vars['g']["order"].'] = \''.$this->_tpl_vars['g']["key"].'_bar\';
';
if (empty($this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs'])) $this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs'] = array();
elseif (!is_array($this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs'])) $this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs'] = (array)$this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
leftmenus[\''.$this->_tpl_vars['g']["key"].'_'.$this->_tpl_vars['i']["key"].'\'] = \''.$this->_tpl_vars['g']["key"].'_'.$this->_tpl_vars['i']["key"].'\';
';
}
echo '
';
}
echo '
function showleftmenu(id) {
	for(k in leftmenus) {
		if(leftframe.document.getElementById(leftmenus[k])) {
			if(leftmenus[k] == id){
				leftframe.document.getElementById(leftmenus[k]).style.display = \'block\';
				leftframe.document.getElementById(\'sm\' + leftmenus[k].substr(leftmenus[k].indexOf(\'_\'))).style.display = \'block\';
			}else{
				leftframe.document.getElementById(leftmenus[k]).style.display = \'none\';
			}
		}
	}
	settopbar(id.substr(0,id.indexOf(\'_\'))+\'_\');
}
function showmenu(prex){
	var len = prex.length;
	for(k in leftmenus) {
		if(leftframe.document.getElementById(leftmenus[k])) {
			if(leftmenus[k].substr(0,len) == prex){
				leftframe.document.getElementById(leftmenus[k]).style.display = \'block\';
			}else{
				leftframe.document.getElementById(leftmenus[k]).style.display = \'none\';
			}
		}
	}
	settopbar(prex);
}
function switchframe(){
	var am=document.getElementById(\'adminmiddle\');
	var al=document.getElementById("adminleft");
	var side = am.innerHTML;
	if (side.indexOf(\'close\')>0) {
		am.innerHTML=\'<img src="'.$this->_tpl_vars['saxue_skin_server'].'/admin/images/side_open.jpg" style="CURSOR: pointer">\';
		al.style.display=\'none\';
	} else {
		am.innerHTML=\'<img src="'.$this->_tpl_vars['saxue_skin_server'].'/admin/images/side_close.jpg" style="CURSOR: pointer">\';
		al.style.display=\'\';
	}
}
function settopbar(prex) {
	for(var i=1;i<=topbarmenus.length;i++){
		if(document.getElementById(topbarmenus[i])){
			document.getElementById(topbarmenus[i]).className=\'l_ts\';
		}
	}
	if(document.getElementById(prex+\'bar\')){
		document.getElementById(prex+\'bar\').className=\'l_ts on\';
	}
}
function adminmenuFix() {
	var sfEls = document.getElementById("admin_menu").getElementsByTagName("li");
	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() { this.className+=(this.className.length>0? " ": "") + "sfhover"; };
		sfEls[i].onMouseDown=function() { this.className+=(this.className.length>0? " ": "") + "sfhover"; };
		sfEls[i].onMouseUp=function() { this.className+=(this.className.length>0? " ": "") + "sfhover"; };
		sfEls[i].onmouseout=function() { this.className=this.className.replace(new RegExp("( ?|^)sfhover\\\\b"), ""); };
	}
}
function editPass() {
	art.dialog({id:\'editPass\'}).close();
	art.dialog({title:name,id:\'editPass\',iframe:\'editpass.php\',width:500,height:150,padding:0}, function(){var d = art.dialog({id:\'editPass\'}).data.iframe;d.document.getElementById(\'submit\').click();return false;}, function(){art.dialog({id:\'editPass\'}).close()});
}
window.onload=adminmenuFix;
</script>
</head>
<body>
<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
	<tr height="45">
		<td class="topbar">
			<div id="logo"><img src="'.$this->_tpl_vars['saxue_skin_server'].'/admin/images/logo.png"></div>
			<div id="tops">
				<div id="nav_left">
					您好：'.$this->_tpl_vars['account'];
if($this->_tpl_vars['isfounder']==1){
echo ' [创始人]';
}else{
echo ' ['.$this->_tpl_vars['rolename'].']';
}
echo '&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="'.$this->_tpl_vars['saxue_admin_url'].'/logout.php" target="_top">退出系统</a>&nbsp;&nbsp;|&nbsp;&nbsp;
					<a href="javascript:editPass()">修改密码</a>&nbsp;&nbsp;|&nbsp;&nbsp;
					<a class="title_link" href="'.$this->_tpl_vars['saxue_url'].'/" target="_blank">网站首页</a>&nbsp;&nbsp;|&nbsp;&nbsp;
					<a class="title_link" href="'.$this->_tpl_vars['saxue_admin_url'].'/main.php" target="mainframe">后台首页</a>
				</div>
				<div id="nav_right">
					<a href="http://www.saxue.com" target="_blank">官方网站</a>&nbsp;&nbsp;|&nbsp;&nbsp;
					<a href="http://bbs.saxue.com" target="_blank">论坛交流</a>&nbsp;&nbsp;|&nbsp;&nbsp;
					<a href="http://www.saxue.com/license.php" target="_blank">授权查询</a>
				</div><br>
				<div id="top_nav">
					<ul id="admin_menu">
						';
if (empty($this->_tpl_vars['groupmenus'])) $this->_tpl_vars['groupmenus'] = array();
elseif (!is_array($this->_tpl_vars['groupmenus'])) $this->_tpl_vars['groupmenus'] = (array)$this->_tpl_vars['groupmenus'];
$this->_tpl_vars['g']=array();
$this->_tpl_vars['g']['columns'] = 1;
$this->_tpl_vars['g']['count'] = count($this->_tpl_vars['groupmenus']);
$this->_tpl_vars['g']['addrows'] = count($this->_tpl_vars['groupmenus']) % $this->_tpl_vars['g']['columns'] == 0 ? 0 : $this->_tpl_vars['g']['columns'] - count($this->_tpl_vars['groupmenus']) % $this->_tpl_vars['g']['columns'];
$this->_tpl_vars['g']['loops'] = $this->_tpl_vars['g']['count'] + $this->_tpl_vars['g']['addrows'];
reset($this->_tpl_vars['groupmenus']);
for($this->_tpl_vars['g']['index'] = 0; $this->_tpl_vars['g']['index'] < $this->_tpl_vars['g']['loops']; $this->_tpl_vars['g']['index']++){
	$this->_tpl_vars['g']['order'] = $this->_tpl_vars['g']['index'] + 1;
	$this->_tpl_vars['g']['row'] = ceil($this->_tpl_vars['g']['order'] / $this->_tpl_vars['g']['columns']);
	$this->_tpl_vars['g']['column'] = $this->_tpl_vars['g']['order'] % $this->_tpl_vars['g']['columns'];
	if($this->_tpl_vars['g']['column'] == 0) $this->_tpl_vars['g']['column'] = $this->_tpl_vars['g']['columns'];
	if($this->_tpl_vars['g']['index'] < $this->_tpl_vars['g']['count']){
		list($this->_tpl_vars['g']['key'], $this->_tpl_vars['g']['value']) = each($this->_tpl_vars['groupmenus']);
		$this->_tpl_vars['g']['append'] = 0;
	}else{
		$this->_tpl_vars['g']['key'] = '';
		$this->_tpl_vars['g']['value'] = '';
		$this->_tpl_vars['g']['append'] = 1;
	}
	echo '
						<li class="l_ts';
if($this->_tpl_vars['g']['order']==1){
echo ' on';
}
echo '" id="'.$this->_tpl_vars['g']['key'].'_bar">
							<a href="#" onClick="showmenu(\''.$this->_tpl_vars['g']['key'].'_\');">'.$this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['name'].'</a>
							<ul class="l_tu">
							';
if (empty($this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs'])) $this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs'] = array();
elseif (!is_array($this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs'])) $this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs'] = (array)$this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
								<li><a href="#" onClick="showleftmenu(\''.$this->_tpl_vars['g']['key'].'_'.$this->_tpl_vars['i']['key'].'\'); return false;">'.$this->_tpl_vars['i']['value'].'</a></li>
							';
}
echo '
							</ul>
						</li>
						';
}
echo '
					</ul>
				</div>       
			</div>
		</td>
	</tr>
	<tr valign="top">
		<td id="topsplit">
			<table height="100%" width="100%" cellspacing="0" cellpadding="0" border="0" id="adminframe">
				<tr>
					<td valign="top" id="adminleft" name="adminleft">
						<iframe frameborder="0" id="leftframe" name="leftframe" scrolling="no" src="'.$this->_tpl_vars['saxue_adminleft'].'" marginwidth="0" marginheight="0"></iframe>
					</td>
					<td id="adminmiddle" name="adminmiddle" onClick="switchframe()"><img src="'.$this->_tpl_vars['saxue_skin_server'].'/admin/images/side_close.jpg" style="CURSOR: pointer"></td>
					<td valign="top" id="admincenter" name="admincenter" style="display:none;">
						<iframe frameborder="0" id="centerframe" name="centerframe" scrolling="no" src="" marginwidth="0" marginheight="0"></iframe>
					</td>
					<td id="adminline" name="adminline" style="display:none;">&nbsp;&nbsp;</td>
					<td valign="top" id="adminright" name="adminright">
						<iframe frameborder="0" id="mainframe" name="mainframe" scrolling="auto" src="'.$this->_tpl_vars['saxue_adminmain'].'" marginwidth="0" marginheight="0"></iframe>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>';
?>