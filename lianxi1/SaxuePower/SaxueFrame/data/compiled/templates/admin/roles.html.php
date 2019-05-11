<?php
echo '<table width="100%" class="topmenu">
	<tr><td>
		<a href="javascript:doDialog(\''.$this->_tpl_vars['saxue_admin_url'].'/roles.php?action=add\',\'添加角色\',\'600\',\'150\')"><em>添加角色</em></a>
	</td></tr>
</table>
<table width="100%" class="grid">
	<caption>角色权限管理</caption>
	<tr>
		<th>角色ID</th>
		<th>角色名称</th>
		<th>状态</th>
		<th>描述</th>
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
		<td>'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['rolename'].'</td>
		<td>'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['str_status'].'</td>
		<td>'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['note'].'</td>
		<td>
			<a href="javascript:doDialog(\''.$this->_tpl_vars['saxue_admin_url'].'/roles.php?action=add&id='.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['id'].'\',\'修改角色——'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['rolename'].'\',\'600\',\'150\')">'.saxue_geticon('edit','修改角色').'</a>
			<a href="?action=delete&id='.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['id'].'" onclick="return confirm(\'你确定要删除角色 '.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['rolename'].' 吗？\')">'.saxue_geticon('del','删除角色').'</a>
			<a href="javascript:doDialog(\''.$this->_tpl_vars['saxue_admin_url'].'/roles.php?action=set&id='.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['id'].'\',\'角色权限设置——'.$this->_tpl_vars['rows'][$this->_tpl_vars['i']['key']]['rolename'].'\',\'400\',\'500\')">'.saxue_geticon('set','角色权限设置').'</a>
		</td>
	</tr>
	';
}
echo '
	</tbody>
</table>';
?>