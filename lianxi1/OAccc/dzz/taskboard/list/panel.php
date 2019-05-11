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

$list=array();
$users=C::t('task_board_user')->fetch_all_by_perm($tbid,array('2','3'),50);
$uid=intval($_GET['uid']);
$list=C::t('task_event')->fetch_all_by_tbid_date($tbid,3,$uid);
if($ismobile){
	include template('mobile/board_panel');
	dexit();
}else{
	include template('list/board_panel');	
}