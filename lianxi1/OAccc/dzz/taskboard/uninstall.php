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

	
//删除任务板所有附件
	try{
		foreach(DB::fetch_all("select logo,cover from %t where 1",array('task_organization')) as $value){
			if($value['logo']>0) C::t('attachment')->addcopy_by_aid($value['logo'],-1);
			if($value['cover']>0) C::t('attachment')->addcopy_by_aid($value['cover'],-1);
		}
		foreach(DB::fetch_all("select id,aid from %t where 1",array('task_attach')) as $value){
			if($value['aid']>0) C::t('attachment')->delete_by_aid($value['aid']);
		}
		foreach(DB::fetch_all("select id,aid from %t where 1",array('task_attach_archive')) as $value){
			if($value['aid']>0) C::t('attachment')->delete_by_aid($value['aid']);
		}
	}catch(Exception $e){};
	
	
//删除任务板所有评论
	try{
		foreach(DB::fetch_all("select cid from %t where  idtype='task'",array('comment','task')) as $value){
			$dels[]=$value['cid'];
		}
		if($dels){
			C::t('comment')->delete($dels);
			C::t('comment_at')->delete_by_cid($dels); //删除@
			C::t('comment_attach')->delete_by_cid($dels);//删除附件
		}
   }catch(Exception $e){};	
$sql = <<<EOF

DROP TABLE IF EXISTS `dzz_task`;
DROP TABLE IF EXISTS `dzz_task_archive`;
DROP TABLE IF EXISTS `dzz_task_attach`;
DROP TABLE IF EXISTS `dzz_task_attach_archive`;
DROP TABLE IF EXISTS `dzz_task_board`;
DROP TABLE IF EXISTS `dzz_task_board_user`;
DROP TABLE IF EXISTS `dzz_task_cat`;
DROP TABLE IF EXISTS `dzz_task_cat_archive`;
DROP TABLE IF EXISTS `dzz_task_event`;
DROP TABLE IF EXISTS `dzz_task_event_archive`;
DROP TABLE IF EXISTS `dzz_task_field`;
DROP TABLE IF EXISTS `dzz_task_field_archive`;
DROP TABLE IF EXISTS `dzz_task_organization`;
DROP TABLE IF EXISTS `dzz_task_organization_user`;
DROP TABLE IF EXISTS `dzz_task_setting`;
DROP TABLE IF EXISTS `dzz_task_sub`;
DROP TABLE IF EXISTS `dzz_task_sub_archive`;
DROP TABLE IF EXISTS `dzz_task_user`;
DROP TABLE IF EXISTS `dzz_task_user_archive`;


EOF;

	runquery($sql);

	$finish = true;
}else{
	header("Location: $confirm_uninstall_url");
	exit();
}
