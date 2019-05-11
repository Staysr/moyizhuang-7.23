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
class table_discuss_field extends dzz_table
{
	public function __construct() {

		$this->_table = 'discuss_field';
		$this->_pk    = 'fid';

		parent::__construct();
	}
	public function fetch_all_by_fid($fids) {
		$fids = array_map('intval', (array)$fids);
		if(!empty($fids)) {
			return DB::fetch_all("SELECT * FROM %t WHERE fid IN(%n)", array($this->_table, $fids), $this->_pk);
		} else {
			return array();
		}
	}
	
	
	public function update_membernum($fid, $num = 1) {
		if(!intval($fid) || !intval($num)) {
			return false;
		}
		DB::query("UPDATE %t SET ".DB::field('membernum', $num, '+')." WHERE fid=%d", array('discuss_field', $fid));
	}
	
	
}

?>
