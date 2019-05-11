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
class table_discuss_recycle extends dzz_table
{
	public function __construct() {

		$this->_table = 'discuss_recycle';
		$this->_pk    = 'rid';

		parent::__construct();
	}
	
	public function insert($setarr)
	{
		return parent::insert($setarr, 1);
	}

	public function delete_by_fid($fid)
	{
		return DB::delete($this->_table, array('fid' => $fid));
	}

	public function delete($type, $id)
	{//从回收站恢复/删除
		if ($return = DB::delete($this->_table, array('type' => $type, 'id' => $id))){
			if ($type == 'thread') {
				C::t('discuss_thread')->update($id, array('isdelete' => 0, 'deletetime' => 0, 'deleteuid' => 0));
			} elseif ($type == 'field') {
				C::t('discuss')->update($id, array('isdelete' => 0, 'deletetime' => 0, 'deleteuid' => 0));
			}
		}
		return $return;
	}

	public function thgdel($type, $id)
	{
		if ($return = DB::delete($this->_table, array('type' => $type, 'id' => $id))){
			if ($type == 'thread') {
				C::t('discuss_comment')->delete_cmt_by_tid($id);
				C::t('discuss_favorite')->delete_by_id_idtype($id, 'thread');
			} elseif ($type == 'field') {
				C::t('discuss')->delete_by_fid($id);
			}
		}
		return $return;
	}

	public function thgdelall()
	{
		global $_G;
		require_once libfile('function/discuss');
		$tids = array();
		foreach ($this->my_all_recycle(0, 0, 0) as $k => $v) {
			if ($v['type'] == 'thread') {
				$this->thgdel('thread', $v['id']);
				$tids[] = $v['id'];
			} elseif ('field') {
				C::t('discuss')->delete_by_fid($v['id']);
			}
		}
		deletethread($tids);
		return true;
	}

	public function fetch_thread_by_recycle($iscount = 0, $start = 0, $size = 20)
	{
		global $_G;
		$limit = ' limit '.$start.','.$size;
		if ($_G['adminid']) {
			if ($iscount) {
				return DB::result_first("select count(*) from %t where type = 'thread'", array($this->_table));
			}
			return DB::fetch_all("select * from %t where type = 'thread' order by deletetime desc".$limit, array($this->_table), 'id');
		} else {
			if ($iscount) {
				return DB::result_first("select count(*) from %t r left join %t u on r.fid = u.fid where type = 'thread' and (r.authorid = %d or (u.uid = %d and u.perm > 2)) group by r.rid", array($this->_table, 'discuss_user', $_G['uid'], $_G['uid']));
			}
			return DB::fetch_all("select r.* from %t r left join %t u on r.fid = u.fid where type = 'thread' and (r.authorid = %d or (u.uid = %d and u.perm > 2)) group by r.rid order by r.deletetime desc".$limit, array($this->_table, 'discuss_user', $_G['uid'], $_G['uid']), 'id');
		}
	}

	public function fetch_discuss_by_recycle($iscount = 0, $start = 0, $size = 20)
	{
		global $_G;
		$limit = ' limit '.$start.','.$size;
		if ($_G['adminid']) {
			if ($iscount) {
				return DB::result_first("select count(*) from %t where type = 'field'", array($this->_table));
			}
			return DB::fetch_all("select * from %t where type = 'field' order by deletetime desc".$limit, array($this->_table), 'id');
		} else {
			if ($iscount) {
				return DB::result_first("select count(*) from %t r left join %t u on r.fid = u.fid where type = 'field' and (r.authorid = %d or (u.uid = %d and u.perm > 2)) group by r.rid", array($this->_table, 'discuss_user', $_G['uid'], $_G['uid']));
			}
			return DB::fetch_all("select r.* from %t r left join %t u on r.fid = u.fid where type = 'field' and (r.authorid = %d or (u.uid = %d and u.perm > 2)) group by r.rid order by r.deletetime desc".$limit, array($this->_table, 'discuss_user', $_G['uid'], $_G['uid']), 'id');
		}
	}

	public function my_all_recycle($iscount = 0, $start = 0, $size = 20)
	{
		global $_G;
		if ($size) {
			$limit = ' limit '.$start.','.$size;
		} else {
			$limit = '';
		}
		if ($_G['adminid']) {
			if ($iscount) {
				return DB::result_first("select count(*) from %t", array($this->_table));
			}
			return DB::fetch_all("select * from %t order by deletetime desc".$limit, array($this->_table), 'rid');
		} else {
			if ($iscount) {
				return DB::result_first("select count(*) from %t r left join %t u on r.fid = u.fid where (r.authorid = %d or (u.uid = %d and u.perm > 2)) group by r.rid", array($this->_table, 'discuss_user', $_G['uid'], $_G['uid']));
			}
			return DB::fetch_all("select r.* from %t r left join %t u on r.fid = u.fid where (r.authorid = %d or (u.uid = %d and u.perm > 2)) group by r.rid order by r.deletetime desc".$limit, array($this->_table, 'discuss_user', $_G['uid'], $_G['uid']), 'rid');
		}
	}

}

?>
