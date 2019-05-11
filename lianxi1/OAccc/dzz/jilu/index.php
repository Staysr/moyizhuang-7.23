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
require_once 'conf.php';
$ismobile=helper_browser::ismobile();
if($_GET['id']){
	$_GET['jid']=trim($_GET['id']);
	$op='view';
	require BASEDIR.'/view.php';
	exit();
}elseif($_G['uid']){
	$op='my';
	require BASEDIR.'/my.php';
	exit();
}else{
	//判断游客,弹出登录框
	Hook::listen('check_login');
	exit();
}

?>
