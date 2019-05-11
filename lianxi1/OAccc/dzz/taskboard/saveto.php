<?php
/* @authorcode  codestrings
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
if(!defined('IN_DZZ')) {
	exit('Access Denied');
}
if(empty($_G['uid'])) {
	include template('common/header_reload');
	echo "<script type=\"text/javascript\">";
	echo "try{top._login.logging();}catch(e){}";
	echo "try{win.Close();}catch(e){}";
	echo "</script>";	
	include template('common/footer_reload');
	exit('<a href="user.php?mod=login&action=login">需要登录</a>');
}
$qid=intval($_GET['qid']);
$attach=C::t('task_attach')->fetch_by_id($qid);
if(!$attach){
	topshowmessage(lang('attachment_nonexistence'));
}
$pfid=DB::result_first("select fid from %t where flag='document' and uid= %d",array('folder',$_G['uid']));
$icoarr=io_dzz::uploadToattachment($attach,$pfid);
if(isset($icoarr['error'])) topshowmessage($icoarr['error']);
 include template('common/header_simple');
	echo "<script type=\"text/javascript\">";
	echo "try{top._ico.createIco(".json_encode($icoarr).");}catch(e){alert('已保存到我的文档!')}";
	echo "top.Alert('”".$attach['filename']."“ 成功添加到桌面“我的文档”中！',3,'','','info');";
	echo "</script>";
include template('common/footer');
exit();
?>
