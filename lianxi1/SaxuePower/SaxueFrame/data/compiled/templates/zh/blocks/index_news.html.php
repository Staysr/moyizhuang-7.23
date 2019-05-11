<?php
if (empty($this->_tpl_vars['rows'])) $this->_tpl_vars['rows'] = array();
elseif (!is_array($this->_tpl_vars['rows'])) $this->_tpl_vars['rows'] = (array)$this->_tpl_vars['rows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['rows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['rows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['rows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['rows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['rows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
';
if($this->_tpl_vars['i']['order']==1){
echo '
<p style="border-top:1px dotted #CCC; margin-top:10px; padding-top:15px;">
	';
if($this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['thumb']!=''){
echo '<a href="'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['url'].'" title="'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['title'].'"><img src="'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['thumb'].'" width="120" height="87" style="float:left; margin-right:10px;" /></a>';
}
echo '
	<span style="display:block; margin-top:2px;"><a href="'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['url'].'" title="'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['title'].'" class="aBlue"><strong>'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['title'].'</strong></a></span><span style="display:block; color:#999; line-height:170%; margin-top:6px;">'.cutstr($this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['intro'],'100').'</span>
</p>
<div id="newslist">
';
}else{
echo '
	<a href="'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['url'].'">'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['title'].'</a>
';
}
echo '
';
}
echo '
';
if($this->_tpl_vars['i']['order']>0){
echo '</div>';
}

?>