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
class table_discuss_statlog extends dzz_table
{
	public function __construct() {

		$this->_table = 'discuss_statlog';
		$this->_pk    = 'logdate';

		parent::__construct();
	}

	public function fetch_all_by_logdate($start, $end, $fid) {
		return DB::fetch_all('SELECT * FROM %t WHERE logdate>=%s AND logdate<=%s AND type=1 AND fid=%d ORDER BY logdate ASC', array($this->_table, $start, $end, $fid));
	}

	public function fetch_all_rank_by_logdate($date) {
		return DB::fetch_all('SELECT * FROM %t WHERE logdate=%s AND type=1 ORDER BY value DESC', array($this->_table, $date));
	}

	public function fetch_all_by_fid_type($fid, $type=1) {
		return DB::fetch_all("SELECT * FROM %t WHERE fid=%d AND type=%d", array($this->_table, $fid, $type));
	}

	public function fetch_min_logdate_by_fid($fid) {
		return DB::result_first("SELECT MIN(logdate) FROM %t WHERE fid=%d", array($this->_table, $fid));
	}

	public function insert_stat_log($date) {
		return DB::query("REPLACE INTO %t (logdate, fid, `type`, `value`) SELECT %s, fid, 1, todayposts FROM %t WHERE 1", array($this->_table, $date, 'discuss'));
	}


}

?>
