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
class table_discuss_post_tableid extends dzz_table
{
	public function __construct() {

		$this->_table = 'discuss_post_tableid';
		$this->_pk    = 'pid';

		parent::__construct();
	}

	public function alter_auto_increment($auto_increment) {
		return DB::query("ALTER TABLE %t AUTO_INCREMENT=%d", array($this->_table, $auto_increment));
	}

	public function delete_by_lesspid($pid) {
		return DB::query("DELETE FROM %t WHERE pid<%d", array($this->_table, $pid));
	}

	public function fetch_max_id() {
		return DB::result_first('SELECT MAX(pid) FROM '.DB::table($this->_table));
	}
}

?>
