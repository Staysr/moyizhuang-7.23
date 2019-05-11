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


//删讨论版所有附件

	foreach(DB::fetch_all("select aid from %t where 1",array('discuss_post_attach')) as $value){
		C::t('attachment')->delete_by_aid($value['aid']);
	}
	
		
$sql = <<<EOF

DROP TABLE IF EXISTS `dzz_discuss`;
DROP TABLE IF EXISTS `dzz_discuss_comment`;
DROP TABLE IF EXISTS `dzz_discuss_favorite`;
DROP TABLE IF EXISTS `dzz_discuss_field`;
DROP TABLE IF EXISTS `dzz_discuss_post`;
DROP TABLE IF EXISTS `dzz_discuss_post_at`;
DROP TABLE IF EXISTS `dzz_discuss_post_attach`;
DROP TABLE IF EXISTS `dzz_discuss_post_tableid`;
DROP TABLE IF EXISTS `dzz_discuss_recycle`;
DROP TABLE IF EXISTS `dzz_discuss_searchindex`;
DROP TABLE IF EXISTS `dzz_discuss_setting`;
DROP TABLE IF EXISTS `dzz_discuss_statlog`;
DROP TABLE IF EXISTS `dzz_discuss_thread`;
DROP TABLE IF EXISTS `dzz_discuss_threadaddviews`;
DROP TABLE IF EXISTS `dzz_discuss_threadclass`;
DROP TABLE IF EXISTS `dzz_discuss_threadmod`;
DROP TABLE IF EXISTS `dzz_discuss_user`;
DROP TABLE IF EXISTS `dzz_discuss_userinfo`;

EOF;

runquery($sql);

$finish = true;

}else{
	header("Location: $confirm_uninstall_url");
	exit();
}
