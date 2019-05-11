<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>'.$this->_tpl_vars['saxue_seo']['meta_title'].'</title>
<meta http-equiv="keywords" content="'.$this->_tpl_vars['saxue_seo']['meta_keywords'].'" />
<meta name="description" content="'.$this->_tpl_vars['saxue_seo']['meta_description'].'" />
<link href="'.$this->_tpl_vars['saxue_skin_url'].'/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="'.$this->_tpl_vars['saxue_skin_server'].'/lib/jquery1.7.2.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['saxue_skin_url'].'/js/jquery-ui-1.10.3.custom.min.js"></script>
</head>
<body>
';
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'header.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);
echo '
'.saxue_banner('1').'
<div style="width:1000px; height:30px; margin:auto; position:relative; z-index:6;">
	<div style="width:1000px; height:400px; top:-430px; position:absolute; z-index:6; overflow:hidden;">
		<div style="width:150px; height:45px; background:#0067AC; position:absolute; z-index:7; color:#FFF; text-align:center; font-size:14px; line-height:42px; font-weight:bold; top:355px;">Solution<img src="'.$this->_tpl_vars['saxue_skin_url'].'/images/arr.gif" style="margin-left:8px; margin-top:-2px;" /></div>
		<div class="solution" style="left:150px;">
			<p style="line-height:42px; padding-left:16px;"><img src="'.$this->_tpl_vars['saxue_skin_url'].'/images/icon/icon_1.png" height="28" style="margin-right:5px; margin-top:7px; float:left;" />Enterprise Portal</p>
			<p style="padding:10px 26px; line-height:180%;">The Internet information has access to every corner of the globe, and the route of transmission of the fastest and most effective way is to promote the enterprise website.</p>
		</div>
		<div class="solution" style="left:360px;">
			<p style="line-height:42px; padding-left:16px;"><img src="'.$this->_tpl_vars['saxue_skin_url'].'/images/icon/icon_2.png" height="28" style="margin-right:10px; margin-top:7px; float:left;" />Foreign Trade</p>
			<p style="padding:10px 26px; line-height:180%;"></p>
		</div>
		<div class="solution" style="left:570px;">
			<p style="line-height:42px; padding-left:16px;"><img src="'.$this->_tpl_vars['saxue_skin_url'].'/images/icon/icon_3.png" height="28" style="margin-right:10px; margin-top:7px; float:left;" />Mobile Internet</p>
			<p style="padding:10px 26px; line-height:180%;"></p>
		</div>
		<div class="solution" style="left:780px;">
			<p style="line-height:42px; padding-left:16px;"><img src="'.$this->_tpl_vars['saxue_skin_url'].'/images/icon/icon_4.png" height="28" style="margin-right:10px; margin-top:7px; float:left;" />E-commerce</p>
			<P style="padding:10px 26px; line-height:180%;">The strategic target of enterprise electronic commerce is how to transform the traditional business operation mode and channel through the Internet platform.</P>
		</div>
	</div>
</div>
<script type="text/javascript">
$(".solution").hover(function(){
	$(this).stop().animate({"top":"155px","backgroundColor":"#EEE"},400,"easeOutQuad");
	$(this).find("p").eq(0).stop().animate({"paddingTop":"10px","color":"#F70"},400,"easeOutQuad");
	$(this).find("p").eq(0).find("img").stop().animate({"width":"68px","height":"68px"},300,"easeOutQuad");
},function(){
	$(this).stop().animate({"top":"355px","backgroundColor":"#FFF"},300,"easeOutQuad");
	$(this).find("p").eq(0).stop().animate({"paddingTop":"0px","color":"#666666"},300,"easeOutQuad");
	$(this).find("p").eq(0).find("img").stop().animate({"width":"28px","height":"28px"},250,"easeOutQuad");
});
</script>
<div id="main" style="height:306px;">
	<div style="float:left; width:380px;">
		<p style="color:#0066CC; font-size:16px;">News &nbsp;<span style="color:#999; font-size:11px; font-family:Arial;">What\'s New</span></p>
		'.saxue_get_block(array('classname'=>'BlockArticleList', 'filename'=>'block_articlelist', 'vars'=>'5,2', 'template'=>'index_news.html'), 1).'
		<p style="padding-top:8px; padding-left:10px;"><a href="/news/" class="more">More…</a></p>
	</div>
	<div style="float:left; width:260px; margin-left:30px;">
		<div style="width:260px; height:130px; background:#0066AC; position:relative; z-index:1; cursor:pointer;" id="videoblcok" onclick="location.href=\'/job/\';">
			<img src="'.$this->_tpl_vars['saxue_skin_url'].'/images/icon/icon_hr.png" width="80" style="position:absolute; right:22px; top:14px;" />
			<p style="padding-top:40px; padding-left:22px; color:#FFF; font-size:16px;">Human Resources</p>
			<p style="padding-top:4px; padding-left:22px; color:#A8CBE3; font-size:11px;">Human Resources</p>
		</div>
		<div style="width:260px; height:130px; margin-top:10px; background:#DDD; position:relative; z-index:1; cursor:pointer;" id="showblock" onclick="location.href=\'/product/\';">
			<img src="'.$this->_tpl_vars['saxue_skin_url'].'/images/icon/icon_rotation.png" height="76" style="position:absolute; right:22px; top:25px;" />
			<p style="padding-top:40px; padding-left:22px; font-size:16px;">Product Display</p>
			<p style="padding-top:4px; padding-left:22px; color:#AAA; font-size:11px;">Product Display</p>
		</div>
	</div>  
	<div style="float:left; width:300px; margin-left:30px;">
		<p style="color:#0066CC; font-size:16px;">Product &nbsp;<span style="color:#999; font-size:11px; font-family:Arial;">Product Catalog</span></p>
		<ul id="procatalog">
			';
if (empty($this->_tpl_vars['saxue_menu']['3']['subcat'])) $this->_tpl_vars['saxue_menu']['3']['subcat'] = array();
elseif (!is_array($this->_tpl_vars['saxue_menu']['3']['subcat'])) $this->_tpl_vars['saxue_menu']['3']['subcat'] = (array)$this->_tpl_vars['saxue_menu']['3']['subcat'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['saxue_menu']['3']['subcat']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['saxue_menu']['3']['subcat']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['saxue_menu']['3']['subcat']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['saxue_menu']['3']['subcat']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['saxue_menu']['3']['subcat']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '<li><a href="'.$this->_tpl_vars['saxue_menu'][$this->_tpl_vars['i']['key']]['url'].'">'.$this->_tpl_vars['saxue_menu'][$this->_tpl_vars['i']['key']]['name'].'</a></li>';
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
	echo '<li><a href="'.$this->_tpl_vars['saxue_menu'][$this->_tpl_vars['j']['key']]['url'].'">'.$this->_tpl_vars['saxue_menu'][$this->_tpl_vars['j']['key']]['name'].'</a></li>';
}
}
echo '
		</ul>
		<p style="clear:both; padding-top:8px; padding-left:10px;"><a href="/product/" class="more">More…</a></p>
	</div>
</div>
<script type="text/javascript">
$("#videoblcok").hover(function(){
	$(this).stop().animate({\'backgroundColor\':\'#F80\'},450,"easeOutQuad");
	$(this).find("p").eq(1).stop().animate({\'color\':\'#FFCF99\'},450,"easeOutQuad");
},function(){
	$(this).stop().animate({\'backgroundColor\':\'#0066AC\'},400,"easeOutQuad");
	$(this).find("p").eq(1).stop().animate({\'color\':\'#A8CBE3\'},400,"easeOutQuad");
});
$("#showblock").hover(function(){
	$(this).stop().animate({\'backgroundColor\':\'#F80\'},450,"easeOutQuad");
	$(this).find("p").eq(0).stop().animate({\'color\':\'#FFF\'},450,"easeOutQuad");
	$(this).find("p").eq(1).stop().animate({\'color\':\'#FFCF99\'},450,"easeOutQuad");
},function(){
	$(this).stop().animate({\'backgroundColor\':\'#DDD\'},400,"easeOutQuad");
	$(this).find("p").eq(0).stop().animate({\'color\':\'#666\'},450,"easeOutQuad");
	$(this).find("p").eq(1).stop().animate({\'color\':\'#AAA\'},400,"easeOutQuad");
});
</script>
';
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'footer.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);
echo '
</body>
</html>';
?>