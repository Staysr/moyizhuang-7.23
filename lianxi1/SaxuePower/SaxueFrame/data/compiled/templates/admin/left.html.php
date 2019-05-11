<?php
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>'.$this->_tpl_vars['saxue_pagetitle'].'</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="'.$this->_tpl_vars['saxue_skin_server'].'/admin/css/left.css" />
<script type="text/javascript" src="'.$this->_tpl_vars['saxue_skin_server'].'/lib/jquery.min.js"></script>
<script language="javascript">
function showsubmenu(id){
	var smenu=document.getElementById(id);
	if (smenu.style.display == \'none\'){
		smenu.style.display = \'\';
		document.getElementById(id+\'_title\').className=\'on\';
	}else{
		smenu.style.display = \'none\';
		document.getElementById(id+\'_title\').className=\'\';
	}
}
$(function(){
	$(\'.menu_a\').click(function(){
		$(\'.menu_a\').removeClass("on");
		$(this).addClass("on");
	});
})
</script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div id="leftmenu">
	';
if (empty($this->_tpl_vars['adminmenus'])) $this->_tpl_vars['adminmenus'] = array();
elseif (!is_array($this->_tpl_vars['adminmenus'])) $this->_tpl_vars['adminmenus'] = (array)$this->_tpl_vars['adminmenus'];
$this->_tpl_vars['g']=array();
$this->_tpl_vars['g']['columns'] = 1;
$this->_tpl_vars['g']['count'] = count($this->_tpl_vars['adminmenus']);
$this->_tpl_vars['g']['addrows'] = count($this->_tpl_vars['adminmenus']) % $this->_tpl_vars['g']['columns'] == 0 ? 0 : $this->_tpl_vars['g']['columns'] - count($this->_tpl_vars['adminmenus']) % $this->_tpl_vars['g']['columns'];
$this->_tpl_vars['g']['loops'] = $this->_tpl_vars['g']['count'] + $this->_tpl_vars['g']['addrows'];
reset($this->_tpl_vars['adminmenus']);
for($this->_tpl_vars['g']['index'] = 0; $this->_tpl_vars['g']['index'] < $this->_tpl_vars['g']['loops']; $this->_tpl_vars['g']['index']++){
	$this->_tpl_vars['g']['order'] = $this->_tpl_vars['g']['index'] + 1;
	$this->_tpl_vars['g']['row'] = ceil($this->_tpl_vars['g']['order'] / $this->_tpl_vars['g']['columns']);
	$this->_tpl_vars['g']['column'] = $this->_tpl_vars['g']['order'] % $this->_tpl_vars['g']['columns'];
	if($this->_tpl_vars['g']['column'] == 0) $this->_tpl_vars['g']['column'] = $this->_tpl_vars['g']['columns'];
	if($this->_tpl_vars['g']['index'] < $this->_tpl_vars['g']['count']){
		list($this->_tpl_vars['g']['key'], $this->_tpl_vars['g']['value']) = each($this->_tpl_vars['adminmenus']);
		$this->_tpl_vars['g']['append'] = 0;
	}else{
		$this->_tpl_vars['g']['key'] = '';
		$this->_tpl_vars['g']['value'] = '';
		$this->_tpl_vars['g']['append'] = 1;
	}
	echo '
	';
if (empty($this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']])) $this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']] = array();
elseif (!is_array($this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']])) $this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']] = (array)$this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']]);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']]) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']]) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']]);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']]);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
	<div id="'.$this->_tpl_vars['g']['key'].'_'.$this->_tpl_vars['i']['key'].'" name="system_'.$this->_tpl_vars['i']['key'].'" class="block';
if($this->_tpl_vars['g']['order'] > 1){
echo ' hd';
}
echo '">
		<div class="content_w">
			<div class="blocktitle in" onClick="showsubmenu(\'sm_'.$this->_tpl_vars['i']['key'].'\')"><span id="sm_'.$this->_tpl_vars['i']['key'].'_title" class="on"></span>'.$this->_tpl_vars['groupmenus'][$this->_tpl_vars['g']['key']]['subs'][$this->_tpl_vars['i']['key']].'</div>
			<div id="sm_'.$this->_tpl_vars['i']['key'].'" name="sm_'.$this->_tpl_vars['i']['key'].'" class="blockcontent">
				<ul class="menulist">
					';
if (empty($this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']][$this->_tpl_vars['i']['key']])) $this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']][$this->_tpl_vars['i']['key']] = array();
elseif (!is_array($this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']][$this->_tpl_vars['i']['key']])) $this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']][$this->_tpl_vars['i']['key']] = (array)$this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']][$this->_tpl_vars['i']['key']];
$this->_tpl_vars['j']=array();
$this->_tpl_vars['j']['columns'] = 1;
$this->_tpl_vars['j']['count'] = count($this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']][$this->_tpl_vars['i']['key']]);
$this->_tpl_vars['j']['addrows'] = count($this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']][$this->_tpl_vars['i']['key']]) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - count($this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']][$this->_tpl_vars['i']['key']]) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']][$this->_tpl_vars['i']['key']]);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = each($this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']][$this->_tpl_vars['i']['key']]);
		$this->_tpl_vars['j']['append'] = 0;
	}else{
		$this->_tpl_vars['j']['key'] = '';
		$this->_tpl_vars['j']['value'] = '';
		$this->_tpl_vars['j']['append'] = 1;
	}
	echo '
					<li><a href="'.$this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']][$this->_tpl_vars['i']['key']][$this->_tpl_vars['j']['key']]['command'].'" target="mainframe" class="menu_a">'.$this->_tpl_vars['adminmenus'][$this->_tpl_vars['g']['key']][$this->_tpl_vars['i']['key']][$this->_tpl_vars['j']['key']]['caption'].'</a></li>
					';
}
echo '
				</ul>
			</div>
		</div>
	</div>
	';
}
echo '
	';
}
echo '
</div>
</body>
</html>';
?>