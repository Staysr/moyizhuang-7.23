<?php
echo '<table width="100%" class="topmenu">
	<tr><td>
		<a href="javascript:doDialog(\''.$this->_tpl_vars['saxue_admin_url'].'/admins.php?action=add\',\'添加管理员\',\'550\',\'220\')"><em>添加管理员</em></a>
	</td></tr>
</table>
<table width="100%" class="grid">
	<caption>管理员管理</caption>
	<tr>
		<th>ID</th>
		<th>账号</th>
		<th>状态</th>
		<th>角色</th>
		<th>最后登录时间</th>
		<th>最后登录IP</th>
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
		<td>'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['id'].'</td>
		<td>'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['account'].'</td>
		<td>'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['str_status'].'</td>
		<td>';
if($this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['isfounder']==1){
echo '<span class="blue">创始人</span>';
}else{
echo $this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['rolename'];
}
echo '</td>
		<td>'.date('Y-m-d H:i:s',$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['lasttime']).'</td>
		<td>'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['lastip'].'</td>
		<td>
			';
if($this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['isfounder']==1){
echo '
			'.saxue_geticon('edit','修改管理员','0').'
			'.saxue_geticon('del','删除管理员','0').'
			';
}else{
echo '
			<a href="javascript:doDialog(\''.$this->_tpl_vars['saxue_admin_url'].'/admins.php?action=add&id='.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['id'].'\',\'修改管理员——'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['account'].'\',\'550\',\'220\')">'.saxue_geticon('edit','修改管理员').'</a>
			<a href="?action=delete&id='.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['id'].'" onclick="return confirm(\'你确定要删除管理员 '.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['account'].' 吗？\')">'.saxue_geticon('del','删除管理员').'</a>
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