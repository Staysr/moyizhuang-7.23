<?php
echo '<table width="100%" class="topmenu">
	<tr><td>
		<a href="javascript:doDialog(\''.$this->_tpl_vars['saxue_admin_url'].'/language.php?action=add\',\'添加语言\',\'700\',\'550\')"><em>添加语言</em></a><span>|</span>
		<a href="?action=cache"><em>更新设置缓存</em></a>
	</td></tr>
</table>
<table width="100%" class="grid">
	<caption>语言管理</caption>
	<tr>
		<th>排序</th>
		<th>语言</th>
		<th>标识</th>
		<th>网站名称</th>
		<th>模版目录</th>
		<th>风格目录</th>
		<th>颜色风格</th>
		<th>显示</th>
		<th>默认语言</th>
		<th>管理</th>
	</tr>
	<tbody>
	';
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
	<tr>
		<td>'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['listorder'].'</td>
		<td>'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['name'].'</td>
		<td>'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['lang'].'</td>
		<td>'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['sitename'].'</td>
		<td>'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['theme'].'</td>
		<td>'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['skin'].'</td>
		<td>'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['style'].'</td>
		<td>';
if($this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['display']==1){
echo '<a href="?action=display&display=0&id='.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['id'].'">'.saxue_geticon('status','显示').'</a>';
}else{
echo '<a href="?action=display&display=1&id='.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['id'].'">'.saxue_geticon('status','不显示','0').'</a>';
}
echo '</td>
		<td>
			';
if($this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['isdefault']==1){
echo '
			'.saxue_geticon('status','默认').'
			';
}else{
echo '<a href="?action=setdefault&id='.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['id'].'">'.saxue_geticon('status','非默认','0').'</a>';
}
echo '
		</td>
		<td>
			<a href="javascript:doDialog(\''.$this->_tpl_vars['saxue_admin_url'].'/language.php?action=add&id='.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['id'].'\',\'修改语言——'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['name'].'\',\'700\',\'520\')">'.saxue_geticon('edit','修改语言').'</a>
			';
if($this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['issystem']==1){
echo '
			'.saxue_geticon('del','删除语言','0').'
			';
}else{
echo '
			<a href="?action=delete&id='.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['id'].'" onclick="return confirm(\'你确定要删除语言 '.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['name'].' 吗？\')">'.saxue_geticon('del','删除语言').'</a>
			';
}
echo '
		</td>
	</tr>
	';
}
echo '
	</tbody>
</table>';
?>