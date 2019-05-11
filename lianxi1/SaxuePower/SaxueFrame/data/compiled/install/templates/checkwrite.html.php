<?php
echo '<div class="block-title">检测读写权限</div>
<div class="block-summary">检测系统安装所必须的文件目录读写权限是否符合要求，如果权限不够，可能影响您的正常使用，请立即设置相关权限。<br>如: 通过FTP软件更改文件属性(CHMOD)为0777</div>
<div class="block-content">
	<table cellpadding="0" cellspacing="1">
		<tr class="font-bold">
			<td width="80%">目录/文件名称</td>
			<td width="20%">可写状态</td>
		</tr>
		';
if (empty($this->_tpl_vars['filepath'])) $this->_tpl_vars['filepath'] = array();
elseif (!is_array($this->_tpl_vars['filepath'])) $this->_tpl_vars['filepath'] = (array)$this->_tpl_vars['filepath'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['filepath']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['filepath']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['filepath']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['filepath']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['filepath']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
		<tr>
			<td>'.$this->_tpl_vars['filepath'][$this->_tpl_vars['i']['key']]['path'].'</td>
			<td>';
if($this->_tpl_vars['filepath'][$this->_tpl_vars['i']['key']]['status']==1){
echo '<span class="span-green">可写</span>';
}elseif($this->_tpl_vars['filepath'][$this->_tpl_vars['i']['key']]['status']==2){
echo '<span class="span-blue">目录不存在</span>';
}else{
echo '<span class="span-red">不可写</span>';
}
echo '</td>
		</tr>
		';
}
echo '
	</table>
</div>
<div class="block-menu">
	<input type="button" name="bt0" value="返回安装首页" class="button" onclick="window.location=\'index.php\';"><span class="span-space"></span>
	<input type="button" name="bt1" value="重新测试" class="button" onclick="location.reload();">
	<input type="button" name="bt2" value="下一步" onclick="window.location=\'?step=configs\';" ';
if($this->_tpl_vars['check_status'] == 0){
echo 'class="button-off" disabled';
}else{
echo 'class="button"';
}
echo '>
</div>';
?>