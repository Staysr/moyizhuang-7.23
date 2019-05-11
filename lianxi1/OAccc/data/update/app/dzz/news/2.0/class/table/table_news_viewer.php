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

class table_news_viewer extends dzz_table
{
	public function __construct() {

		$this->_table = 'news_viewer';
		$this->_pk    = 'id';

		parent::__construct();
	}
	public function fetch_all_by_newid($newid,$limit,$iscount=0){
		$limitsql='';
		if($limit){
			$limit=explode('-',$limit);
			if(count($limit)>1){
				$limitsql.=" limit ".intval($limit[0]).",".intval($limit[1]);
			}else{
				$limitsql.=" limit ".intval($limit[0]);
			}
		}
		if($iscount) return DB::result_first("select  COUNT(*) from %t where newid=%d",array($this->_table,$newid));
		return DB::fetch_all("select * from %t where newid=%d order by dateline DESC $limitsql ",array($this->_table,$newid),'uid') ;
	}
	public function delete_by_newid($newids){
		$newids=(array)$newids;
		return DB::delete($this->_table,"newid IN (".dimplode($newids).")");
	}
}

?>
