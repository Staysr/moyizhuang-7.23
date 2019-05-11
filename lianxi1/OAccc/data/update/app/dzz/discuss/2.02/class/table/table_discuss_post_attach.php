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

class table_discuss_post_attach extends dzz_table {

	public function __construct() {
		$this->_table = 'discuss_post_attach';
		$this->_pk    = 'id';
		parent::__construct();
	}

	public function insert_by_tid_pid($tid,$pid,$attachs,$fid,$uid) {
		$old=self::fetch_all_by_pid($pid);
		$setarr=array('fid'=>$fid,
					  'tid'=>$tid,
					  'pid'=>$pid,
					  'uid'=>$uid
					 );
		if($old){
			$setarr['uid']=$old['uid'];
		}
		$dels=$insertids=$has=array();
		foreach($old as $value){
			if(!in_array($value['aid'],$attachs)){
				$dels[]=$value['aid'];
			}else{
				$has[]=$value['aid'];
			}
		}
		foreach($attachs as $aid){
			if(!in_array($aid,$has)){
				$insertids[]=$aid;
				$setarr['aid']=$aid;
				parent::insert($setarr);
			}
		}
		if($dels){
			C::t('attachment')->addcopy_by_aid($dels,-1);
			parent::delete($dels);
		}
		if($insertids) C::t('attachment')->addcopy_by_aid($insertids);
		
		return true;
	}
	
	public function fetch_all_by_pid($pid) {
		return DB::fetch_all('SELECT * FROM %t where pid=%d', array($this->_table,$pid));
	}
	public function delete_by_pid($pids) {
		if(!is_array($pids)) $tids=array($pids);
		$aids=$ids=array();
		foreach(DB::fetch_all('SELECT * FROM %t where pid=%d', array($this->_table,$pids)) as $value){
			$aids[]=$value['aid'];
			$ids[]=$value['id'];
		}
		if($return=parent::delete($ids)){
			C::t('attachment')->addcopy_by_aid($aids,-1);
		}
		return $return;
	}
	public function delete_by_tid($tids) {
		if(!is_array($tids)) $tids=array($tids);
		$aids=$ids=array();
		foreach(DB::fetch_all('SELECT * FROM %t where tid IN(%n)', array($this->_table,$tids)) as $value){
			$aids[]=$value['aid'];
			$ids[]=$value['id'];
		}
		if($return=parent::delete($ids)){
			C::t('attachment')->addcopy_by_aid($aids,-1);
		}
		return $return;
	}
	public function delete_by_fid($fids) {
		if(!is_array($fids)) $fids=array($fids);
		$aids=$ids=array();
		foreach(DB::fetch_all('SELECT * FROM %t where fid IN(%n)', array($this->_table,$fids)) as $value){
			$aids[]=$value['aid'];
			$ids[]=$value['id'];
		}
		if($return=parent::delete($ids)){
			C::t('attachment')->addcopy_by_aid($aids,-1);
		}
		return $return;
	}
	public function delete_by_uid($uids) {
		if(!is_array($uids)) $uids=array($uids);
		$aids=$ids=array();
		foreach(DB::fetch_all('SELECT * FROM %t where uid IN(%n)', array($this->_table,$uids)) as $value){
			$aids[]=$value['aid'];
			$ids[]=$value['id'];
		}
		if($return=parent::delete($ids)){
			C::t('attachment')->addcopy_by_aid($aids,-1);
		}
		return $return;
	}
}

?>
