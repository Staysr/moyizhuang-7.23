<?php
/* @authorcode  codestrings
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */

if(!defined('IN_DZZ') || !defined('IN_ADMIN')) {
	exit('Access Denied');
}

//提示用户删除的严重程度
if($_GET['confirm']=='DELETE'){
	@set_time_limit(0);
	//卸载程序；


	//删除所有附件
		
	foreach(DB::fetch_all("select aid,cid from %t where 1",array('jilu_attach')) as $value){
		if($value['aid']){
			C::t('attachment')->delete_by_aid($value['aid']);
		}
		if($value['cid']){
			C::t('collect')->delete_by_cid($value['cid']);
		}
	}
$sql = <<<EOF
	DROP TABLE IF EXISTS `dzz_jilu`;
	DROP TABLE IF EXISTS `dzz_jilu_attach`;
	DROP TABLE IF EXISTS `dzz_jilu_comment`;
	DROP TABLE IF EXISTS `dzz_jilu_comment_at`;
	DROP TABLE IF EXISTS `dzz_jilu_item`;
	DROP TABLE IF EXISTS `dzz_jilu_todolist`;
	DROP TABLE IF EXISTS `dzz_jilu_user`;
	DROP TABLE IF EXISTS `dzz_jilu_zan`;
	DROP TABLE IF EXISTS `dzz_jilu_setting`;
	DROP TABLE IF EXISTS `dzz_jilu_pin`;
EOF;

	runquery($sql);

	$finish = true;
}else{
	header("Location: $confirm_uninstall_url");
	exit();
}
