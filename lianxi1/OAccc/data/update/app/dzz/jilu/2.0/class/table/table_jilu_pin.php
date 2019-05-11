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

class table_jilu_pin extends dzz_table
{
	public function __construct() {

		$this->_table = 'jilu_pin';
		$this->_pk    = 'pin_id';
		parent::__construct();
	}
	
	public function addPin($type, $pin_type, $data_id) {
		global $_G;
		$pinid = DB::result_first('select pin_id from %t where type = %d and pin_type = %d and data_id = %s', array($this->_table, $type, $pin_type, $data_id));
		if ($pinid) {
			$res = DB::update($this->_table, array('uid' => $_G['uid'], 'dateline' => TIMESTAMP), array('pin_id' => $pinid));
		} else {
			$res = DB::insert($this->_table, array('uid' => $_G['uid'], 'type' => $type, 'pin_type' => $pin_type, 'data_id' => $data_id, 'dateline' => TIMESTAMP), 1);
		}
		if ($res) {
			return true;
		} else {
			return false;
		}
	}

	public function cancelPin($type, $pin_type, $data_id) {
		$pinid = DB::result_first('select pin_id from %t where type = %d and pin_type = %d and data_id = %s', array($this->_table, $type, $pin_type, $data_id));
		if ($pinid) {
			return DB::delete($this->_table, array('pin_id' => $pinid));
		} else {
			return true;
		}
	}

	public function deletePin($type, $data_id) {
		return DB::delete($this->_table, array('type' => $type, 'data_id' => $data_id));
	}

}

?>
