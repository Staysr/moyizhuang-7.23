<?php
echo '<br />
<table class="grid" width="580" align="center">
  <tr>
    <td colspan="2" class="title" align="center">系统信息</td>
  </tr>
  <tr>
    <td width="200" align="right">操作系统：</td>
    <td align="left">'.$this->_tpl_vars['sysinfo']['os'].'</td>
  </tr>
  <tr>
    <td align="right">服务器软件：</td>
    <td>'.$this->_tpl_vars['sysinfo']['soft'].'</td>
  </tr>
  <tr>
    <td align="right">PHP版本：</td>
    <td>'.$this->_tpl_vars['sysinfo']['verphp'].'</td>
  </tr>
  <tr>
    <td align="right">MySQL版本：</td>
    <td>'.$this->_tpl_vars['sysinfo']['vermysql'].'</td>
  </tr>
  <tr>
    <td colspan="2" class="title" align="center">网站信息</td>
  </tr>
  <tr>
    <td align="right">网站域名：</td>
    <td>'.$this->_tpl_vars['sysinfo']['domain'].'</td>
  </tr>
  <tr>
    <td align="right">服务器时间：</td>
    <td>'.$this->_tpl_vars['sysinfo']['time'].'</td>
  </tr>
  <tr>
    <td align="right">网站根目录：</td>
    <td>'.$this->_tpl_vars['sysinfo']['webdir'].'</td>
  </tr>
  <tr>
    <td align="right">SaxueFrame目录：</td>
    <td>'.$this->_tpl_vars['sysinfo']['rootdir'].'</td>
  </tr>
  <tr>
    <td colspan="2" class="title" align="center">授权信息</td>
  </tr>
  <tr>
    <td align="right">程序版本：</td>
    <td>'.$this->_tpl_vars['ver']['product'].' V'.$this->_tpl_vars['ver']['edition'].' R'.$this->_tpl_vars['ver']['release'].'</td>
  </tr>
  <tr>
    <td align="right">授权类型：</td>
    <td>';
if(''==$this->_tpl_vars['license']['type']){
echo '未授权（<a href="http://www.saxue.com/buy.html" target="_blank"><span class="red">点击购买</span></a>）';
}else{
echo '<span class="blue">'.$this->_tpl_vars['license']['type'].'</span>';
}
echo '</td>
  </tr>
  <tr>
    <td align="right">授权序列号：</td>
    <td>';
if(''==$this->_tpl_vars['license']['code']){
echo '未授权（<a href="http://www.saxue.com/buy.html" target="_blank"><span class="red">点击购买</span></a>）';
}else{
echo $this->_tpl_vars['license']['code'];
}
echo '</td>
  </tr>
</table>
<br /><br />';
?>