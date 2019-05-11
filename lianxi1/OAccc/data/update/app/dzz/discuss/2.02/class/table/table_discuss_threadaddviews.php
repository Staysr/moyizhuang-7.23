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

class table_discuss_threadaddviews extends dzz_table {

	public function __construct() {
		$this->_table = 'discuss_threadaddviews';
		$this->_pk    = 'tid';
		parent::__construct();
	}

	public function update_by_tid($tid) {
		return DB::query('UPDATE %t SET `addviews`=`addviews`+1 WHERE tid=%d', array($this->_table, $tid));
	}
	public function fetch_all_order_by_tid($start = 0, $limit = 0) {
		return DB::fetch_all('SELECT * FROM %t ORDER BY tid'.DB::limit($start, $limit), array($this->_table), $this->_pk);
	}
}

?>
