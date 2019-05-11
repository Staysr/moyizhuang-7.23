<?php
/*
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */

if(!defined('IN_DZZ')) {
	exit('Access Denied');
}

class table_discuss_post_at extends dzz_table
{
	public function __construct() {

		$this->_table = 'discuss_post_at';
		$this->_pk    = 'id';

		parent::__construct();
	}
	public function fetch_all_uids_by_pid($pid){
		$uids=array();
		foreach(DB::fetch_all("select uid from %t where pid=%d",array($this->_table,$pid)) as $value){
			$uids[]=$value['uid'];
		}
		return array_unique($uids);
	}
   
	public function insert_by_pid($pid,$tid,$fid,$uids){
		if(!$pid || !$uids) return false;
		$ouids=self::fetch_all_uids_by_pid($pid);
		$inserts=array_diff($uids,$ouids);
		$dels=array_diff($ouid,$uids);
		if($dels){
			self::delete_by_uid($dels,$pid);
		}
		if($inserts){
			foreach($inserts as $uid){
				parent::insert(array('pid'=>$pid,'tid'=>$tid,'uid'=>$uid,'fid'=>$fid),0,1);
			}
		}
		return $inserts;
	}
	public function delete_by_uid($uids ,$pid){
	   if(!$uids) return false;
	   if(!is_array($uids)){
		   $pids=array($uids);
	   }
	   return DB::delete($this->_table,"pid='{$pid}' and  uid IN (".dimplode($pids).")");
	}
	public function delete_by_pid($pids){
	   if(!$pids) return false;
	   if(!is_array($pids)){
		   $pids=array($pids);
	   }
	   return DB::delete($this->_table,"pid IN (".dimplode($pids).")");
	}
	public function delete_by_tid($tids){
	   if(!$tids) return false;
	   if(!is_array($tids)){
		   $tids=array($tids);
	   }
	   return DB::delete($this->_table,"tid IN (".dimplode($tids).")");
	}
	public function delete_by_fid($fids){
	   if(!$tids) return false;
	   if(!is_array($fids)){
		   $tids=array($fids);
	   }
	   return DB::delete($this->_table,"tid IN (".dimplode($fids).")");
	}
	
}

?>
