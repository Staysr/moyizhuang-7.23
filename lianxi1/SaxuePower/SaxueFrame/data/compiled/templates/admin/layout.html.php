<?php
echo '<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="'.$this->_tpl_vars['saxue_skin_server'].'/admin/css/style.css" />
<script type="text/javascript" src="'.$this->_tpl_vars['saxue_skin_server'].'/lib/jquery.min.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['saxue_skin_server'].'/lib/jquery.form.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['saxue_skin_server'].'/lib/formvalidator.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['saxue_skin_server'].'/lib/formvalidatorregex.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['saxue_skin_server'].'/admin/js/admin.js"></script>
<script language="javascript" type="text/javascript">
if (self.location === parent.location) {
	self.location = "'.$this->_tpl_vars['saxue_admin_url'].'";
}
</script>
<title>'.$this->_tpl_vars['saxue_pagetitle'].'</title>
</head>
<body >
<table width="100%" cellspacing="0" align="center"><tr><td>
<div class="content">'.$this->_tpl_vars['saxue_contents'].'</div>
</td></tr></table>
<script language="JavaScript">
<!--
	';
if($this->_tpl_vars['admincenter']==1){
echo '
	window.top.$(\'#admincenter\').css(\'display\',\'\');
	window.top.$(\'#adminline\').css(\'display\',\'\');
	';
}else{
echo '
	window.top.$(\'#admincenter\').css(\'display\',\'none\');
	window.top.$(\'#adminline\').css(\'display\',\'none\');
	';
}
echo '
//-->
</script>
</body>
</html>';
?>