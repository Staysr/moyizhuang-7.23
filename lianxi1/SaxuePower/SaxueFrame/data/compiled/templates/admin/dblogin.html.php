<?php
echo '<br />
<div class="tc">
<form name="frmdblogin" method="post" action="'.$this->_tpl_vars['url_dblogin'].'">
<table class="grid" width="500" align="center">
   <caption>数据库账号验证</caption>
   <tr>
     <td class="odd" align="right">说明：</td>
	 <td class="even">数据库管理相关功能需要验证本站的数据库用户名和密码！</td>
   </tr>
   <tr>
     <td class="odd" align="right">数据库用户名：</td>
	 <td class="even"><input type="text" class="text" size="20" maxlength="50" style="width:120px" name="dbuser"></td>
   </tr>
   <tr>
     <td class="odd" align="right">数据库密码：</td>
	 <td class="even"><input type="password" class="text" size="20" maxlength="50" style="width:120px" name="dbpass"></td>
   </tr>
   <tr>
     <td class="odd">&nbsp;<input type="hidden" name="action" value="login"></td>
	 <td class="even"><input type="submit" class="button" value="&nbsp;提&nbsp;交&nbsp;" name="submit"></td>
   </tr>
  </table>
</form>
</div>
<br /><br />';
?>