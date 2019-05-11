<?php
echo '<div id="head">
	<div id="headmenu">';
if (empty($this->_tpl_vars['saxue_langs'])) $this->_tpl_vars['saxue_langs'] = array();
elseif (!is_array($this->_tpl_vars['saxue_langs'])) $this->_tpl_vars['saxue_langs'] = (array)$this->_tpl_vars['saxue_langs'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['saxue_langs']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['saxue_langs']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['saxue_langs']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['saxue_langs']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['saxue_langs']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '<a href="'.$this->_tpl_vars['saxue_langs'][$this->_tpl_vars['i']['key']]['url'].'">'.$this->_tpl_vars['saxue_langs'][$this->_tpl_vars['i']['key']]['name'].'</a>';
}
echo '</div>
</div>
<div id="top">
	<div id="logo"><a href="/"><img src="'.$this->_tpl_vars['saxue_skin_url'].'/images/logo.png" /></a></div>
	<ul id="menu">
		<li bg="none"><a href="/">Home</a></li>
		';
if (empty($this->_tpl_vars['saxue_menu'])) $this->_tpl_vars['saxue_menu'] = array();
elseif (!is_array($this->_tpl_vars['saxue_menu'])) $this->_tpl_vars['saxue_menu'] = (array)$this->_tpl_vars['saxue_menu'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['saxue_menu']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['saxue_menu']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['saxue_menu']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['saxue_menu']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['saxue_menu']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
		';
if($this->_tpl_vars['saxue_menu'][$this->_tpl_vars['i']['key']]['pid']==0){
echo '
		<li class="split"><img src="'.$this->_tpl_vars['saxue_skin_url'].'/images/menu_split.gif" /></li>
		<li>
			<a href="'.$this->_tpl_vars['saxue_menu'][$this->_tpl_vars['i']['key']]['url'].'">'.$this->_tpl_vars['saxue_menu'][$this->_tpl_vars['i']['key']]['name'].'</a>
			<div>';
if (empty($this->_tpl_vars['saxue_menu'][$this->_tpl_vars['i']['key']]['subcat'])) $this->_tpl_vars['saxue_menu'][$this->_tpl_vars['i']['key']]['subcat'] = array();
elseif (!is_array($this->_tpl_vars['saxue_menu'][$this->_tpl_vars['i']['key']]['subcat'])) $this->_tpl_vars['saxue_menu'][$this->_tpl_vars['i']['key']]['subcat'] = (array)$this->_tpl_vars['saxue_menu'][$this->_tpl_vars['i']['key']]['subcat'];
$this->_tpl_vars['j']=array();
$this->_tpl_vars['j']['columns'] = 1;
$this->_tpl_vars['j']['count'] = count($this->_tpl_vars['saxue_menu'][$this->_tpl_vars['i']['key']]['subcat']);
$this->_tpl_vars['j']['addrows'] = count($this->_tpl_vars['saxue_menu'][$this->_tpl_vars['i']['key']]['subcat']) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - count($this->_tpl_vars['saxue_menu'][$this->_tpl_vars['i']['key']]['subcat']) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['saxue_menu'][$this->_tpl_vars['i']['key']]['subcat']);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = each($this->_tpl_vars['saxue_menu'][$this->_tpl_vars['i']['key']]['subcat']);
		$this->_tpl_vars['j']['append'] = 0;
	}else{
		$this->_tpl_vars['j']['key'] = '';
		$this->_tpl_vars['j']['value'] = '';
		$this->_tpl_vars['j']['append'] = 1;
	}
	echo '<a href="'.$this->_tpl_vars['saxue_menu'][$this->_tpl_vars['j']['key']]['url'].'">'.$this->_tpl_vars['saxue_menu'][$this->_tpl_vars['j']['key']]['name'].'</a>';
}
echo '</div>
		</li>
		';
}
echo '
		';
}
echo '
	</ul>
</div>
<script type="text/javascript">
$("#menu li").hover(function(){
	if($(this).attr("bg")=="none"){
		$(this).find("a").css("background","none");
	}
	$(this).find("a").eq(0).addClass("A");
	$(this).find("div").stop().slideDown(350);
},function(){
	if($(this).attr("bg")=="none"){
		$(this).find("a").css("background","none");
	}
	$(this).find("a").eq(0).removeClass("A");
	$(this).find("div").stop().slideUp(200);
});
</script>';
?>