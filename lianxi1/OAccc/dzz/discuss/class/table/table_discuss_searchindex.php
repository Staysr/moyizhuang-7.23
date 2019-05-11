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

class table_discuss_searchindex extends dzz_table
{
	public function __construct() {

		$this->_table = 'discuss_searchindex';
		$this->_pk    = 'searchid';

		parent::__construct();
	}

	public function fetch_by_searchid($searchid) {
		return DB::fetch_first('SELECT * FROM %t WHERE searchid=%d ', array($this->_table, $searchid));
	}

	public function count_by_dateline($timestamp) {
		return DB::result_first('SELECT COUNT(*) FROM %t WHERE  dateline>%d-60', array($this->_table, $timestamp));
	}

	public function fetch_all_search( $timestamp, $searchstring) {
		if( !$timestamp) {
			return null;
		}
		$timestamp = dintval($timestamp);
		$searchstring = daddslashes($searchstring);

		return DB::fetch_all("SELECT searchid, dateline,
			(searchstring='$searchstring' AND expiration>'$timestamp') AS indexvalid
			FROM ".DB::table($this->_table)."
			WHERE searchstring='$searchstring' AND expiration>'$timestamp'
			");
	}

}
?>
