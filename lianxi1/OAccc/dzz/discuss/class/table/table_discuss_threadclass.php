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
class table_discuss_threadclass extends dzz_table
{
	public function __construct() {

		$this->_table = 'discuss_threadclass';
		$this->_pk    = 'typeid';

		parent::__construct();
	}
	public function fetch_by_fid_name($fid, $name) {
		return DB::fetch_first('SELECT * FROM %t WHERE fid=%d AND name=%s', array($this->_table, $fid, $name));
	}
	public function fetch_all_by_typeid($typeids) {
		$typeids = dintval($typeids, is_array($typeids) ? true : false);
		if($typeids) {
			return DB::fetch_all('SELECT * FROM %t WHERE typeid IN(%n) ORDER BY displayorder', array($this->_table, $typeids), $this->_pk);
		}
		return array();
	}
	public function fetch_all_by_fid($fid,$enable=0) {
		if($enable) $sql=' and enable>0';
		$data=array();
		foreach(DB::fetch_all("SELECT * FROM %t WHERE fid=%d $sql ORDER BY displayorder", array($this->_table, $fid), $this->_pk) as $value){
			$value['num']=C::t('discuss_thread')->count_by_fid_typeid_displayorder($fid,$value['typeid']);
			$data[$value['typeid']]=$value;
		}
		return $data;
	}
	public function fetch_all_by_typeid_fid($typeid, $fid) {
		$typeid = dintval($typeid, is_array($typeid) ? true : false);
		$fid = dintval($fid, is_array($fid) ? true : false);
		$parameter = array($this->_table, $typeid, $fid);
		$wheresql = is_array($typeid) && $typeid ? 'typeid IN(%n)' : 'typeid=%d';
		$wheresql .= ' AND '.(is_array($fid) && $fid ? 'fid IN(%n)' : 'fid=%d');
		return DB::fetch_all('SELECT * FROM %t WHERE '.$wheresql, $parameter, $this->_pk);
	}
	public function update_by_fid($fid, $data) {
		$fid = dintval($fid, is_array($fid) ? true : false);
		if(is_array($fid) && empty($fid)) {
			return 0;
		}
		if(!empty($data) && is_array($data)) {
			return DB::update($this->_table, $data, DB::field('fid', $fid));
		}
		return 0;
	}
	public function update_by_typeid($typeid, $data) {
		$typeid = dintval($typeid, is_array($typeid) ? true : false);
		if(is_array($typeid) && empty($typeid)) {
			return 0;
		}
		if(!empty($data) && is_array($data)) {
			return DB::update($this->_table, $data, DB::field('typeid', $typeid));
		}
		return 0;
	}
	public function update_by_typeid_fid($typeid, $fid, $data) {
		$typeid = dintval($typeid, is_array($typeid) ? true : false);
		$fid = dintval($fid, is_array($fid) ? true : false);
		if(empty($typeid) || empty($fid)) {
			return 0;
		}
		if(!empty($data) && is_array($data)) {
			return DB::update($this->_table, $data, DB::field('typeid', $typeid).' AND '.DB::field('fid', $fid));
		}
		return 0;
	}
	public function delete_by_typeid($typeid) {
		$typeid = dintval($typeid, is_array($typeid) ? true : false);
		if(empty($typeid)) {
			return 0;
		}
		return DB::delete($this->_table, DB::field('typeid', $typeid));
	}
	public function delete_by_typeid_fid($typeid, $fid) {
		$typeid = dintval($typeid, is_array($typeid) ? true : false);
		$fid = dintval($fid, is_array($fid) ? true : false);
		if(empty($typeid) || empty($fid)) {
			return 0;
		}
		return DB::delete($this->_table, DB::field('typeid', $typeid).' AND '.DB::field('fid', $fid));
	}
	public function delete_by_fid($fid){
		return DB::delete($this->_table, DB::field('fid', $fid));
	}
	public function count_by_fid($fid) {
		return DB::result_first('SELECT COUNT(*) FROM %t WHERE fid=%d', array($this->_table, $fid));
	}

}

?>
