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

class table_task_organization extends dzz_table
{
	public function __construct() {

		$this->_table = 'task_organization';
		$this->_pk    = 'orgid';

		parent::__construct();
	}
	public function insert($arr){
		if($orgid=parent::insert($arr,1)){
			if(C::t('task_organization_user')->insert($orgid,getglobal('uid'),3)){
				return $orgid;
			}else{
				parent::delete($orgid);
				return false;
			}
		}
		return false;
	}
	public function fetch_all_by_uid($uid,$perm=array(1,2,3)){
		$perm=(array)$perm;
		$data=array();
		foreach(DB::fetch_all("select o.*,u.perm from %t u LEFT JOIN %t o on o.orgid=u.orgid where u.uid=%d and u.perm IN (%n)",array('task_organization_user',$this->_table,$uid,$perm)) as $value){
			$data[$value['orgid']]=$value;
		}
		return $data;
	}
	public function delete_by_orgid($orgid){//删除机构
		$org=C::t('task_organization')->fetch($orgid);
		if($ret=parent::delete($orgid)){
			if($org['cover']) C::t('attachment')->delete_by_aid($org['cover']);
			if($org['logo']) C::t('attachment')->delete_by_aid($org['logo']);
			C::t('task_organization_user')->delete_by_orgid($orgid);
			C::t('task_board')->remove_orgid($orgid);
		}
		return $ret;
	}
}

?>
