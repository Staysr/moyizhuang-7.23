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

class table_discuss_favorite extends dzz_table
{
	public function __construct() {

		$this->_table = 'discuss_favorite';
		$this->_pk    = 'favid';

		parent::__construct();
	}
	 public function delete_by_favid($favid){
	   $fav=parent::fetch($favid);
	   if($fav['idtype']=='forum'){
		   C::t('discuss')->update_forum_counter($fav['id'],0,0,0,-1);
	   }elseif($fav['idtype']=='thread'){
		    C::t('discuss_thread')->increase($fav['id'],array('favtimes'=>-1));
	   }
	   return parent::delete($favid);
   }
	public function fetch_all_by_uid_idtype($uid, $idtype, $favid = 0, $start = 0, $limit = 0, $orderby = 'favtime') {
		if ($idtype == 'thread') {
			$parameter = array($this->_table, 'discuss_thread', 'discuss');
		} elseif ($idtype == 'forum') {
			$parameter = array($this->_table, 'discuss');
		}
		
		$wherearr = array();
		if($favid) {
			$parameter[] = dintval($favid, is_array($favid) ? true : false);
			$wherearr[] = is_array($favid) ? 'f.favid IN(%n)' : 'f.favid=%d';
		}
		$parameter[] = $uid;
		$wherearr[] = "f.uid=%d";
		if(!empty($idtype)) {
			$parameter[] = $idtype;
			$wherearr[] = "f.idtype=%s";
		}
		if ($idtype == 'thread') {
			$wherearr[] = 't.isdelete = 0';
			$wherearr[] = 'd.isdelete = 0';
			$wheresql = ' WHERE '.implode(' AND ', $wherearr);
			$order = $orderby == 'dateline' ? 't.dateline' : 'f.dateline';
			return DB::fetch_all("SELECT * FROM %t f LEFT JOIN %t t ON f.id = t.tid LEFT JOIN %t d ON t.fid = d.fid $wheresql ORDER BY $order ".DB::limit($start, $limit), $parameter, $this->_pk);
		} elseif ($idtype == 'forum') {
			$wherearr[] = 'd.isdelete = 0';
			$wheresql = ' WHERE '.implode(' AND ', $wherearr);
			$order = $orderby == 'dateline' ? 'd.dateline' : 'f.dateline';
			return DB::fetch_all("SELECT * FROM %t f LEFT JOIN %t d ON f.id = d.fid $wheresql ORDER BY $order DESC ".DB::limit($start, $limit), $parameter, $this->_pk);
		}

		return DB::fetch_all("SELECT * FROM %t $wheresql ORDER BY dateline DESC ".DB::limit($start, $limit), $parameter, $this->_pk);
	}

	public function count_by_uid_idtype($uid, $idtype, $favid = 0) {
		if ($idtype == 'thread') {
			$parameter = array($this->_table, 'discuss_thread', 'discuss');
		} elseif ($idtype == 'forum') {
			$parameter = array($this->_table, 'discuss');
		}
		$wherearr = array();
		if($favid) {
			$parameter[] = dintval($favid, is_array($favid) ? true : false);
			$wherearr[] = is_array($favid) ? 'favid IN(%n)' : 'favid=%d';
		}
		$parameter[] = $uid;
		$wherearr[] = "f.uid=%d";
		if(!empty($idtype)) {
			$parameter[] = $idtype;
			$wherearr[] = "f.idtype=%s";
		}
		if ($idtype == 'thread') {
			$wherearr[] = "t.isdelete = 0";
			$wherearr[] = "d.isdelete = 0";
			return DB::result_first('SELECT COUNT(*) FROM %t f LEFT JOIN %t t ON f.id = t.tid LEFT JOIN %t d ON t.fid = d.fid WHERE '.implode(' AND ', $wherearr), $parameter);
		} elseif ($idtype == 'forum') {
			$wherearr[] = "d.isdelete = 0";
			return DB::result_first('SELECT COUNT(*) FROM %t f LEFT JOIN %t d ON f.id = d.fid WHERE '.implode(' AND ', $wherearr), $parameter);
		}

	}

	public function fetch_by_id_idtype($id, $idtype, $uid = 0) {
		if($uid) {
			$uidsql = ' AND f.uid = '.$uid;
		}
		if ($idtype == 'thread') {
			$parameter = array($this->_table, 'discuss_thread', 'discuss', $id, $idtype);
			return DB::fetch_first("SELECT f.* FROM %t f LEFT JOIN %t t ON f.id = t.tid LEFT JOIN %t d ON t.fid = d.fid WHERE t.isdelete = 0 AND d.isdelete = 0 AND f.id=%d AND f.idtype=%s $uidsql", $parameter);
		} elseif ($idtype == 'forum') {
			$parameter = array($this->_table, 'discuss', $id, $idtype);
			return DB::fetch_first("SELECT f.* FROM %t f LEFT JOIN %t d ON f.id = d.fid WHERE d.isdelete = 0 AND f.id=%d AND f.idtype=%s $uidsql", $parameter);
		}
	}

	public function count_by_id_idtype($id, $idtype) {
		return DB::result_first("SELECT COUNT(*) FROM %t WHERE id=%d AND idtype=%s", array($this->_table, $id, $idtype));
	}

	public function delete_by_id_idtype($id, $idtype) {
		return DB::delete($this->_table, DB::field('id', $id) .' AND '.DB::field('idtype', $idtype));
	}

	public function delete_by_fid($fid) {
		foreach (DB::fetch_all('SELECT tid FROM %t WHERE fid = %d', array('discuss_thread', $fid)) as $k => $v) {
			$this->delete_by_id_idtype($v['tid'], 'thread');
		}
		$this->delete_by_id_idtype($fid, 'forum');
	}

	public function delete($val, $unbuffered = false, $uid = 0) {
		$val = dintval($val, is_array($val) ? true : false);
		if($val) {
			if($uid) {
				$uid = dintval($uid, is_array($uid) ? true : false);
			}
			return DB::delete($this->_table, DB::field($this->_pk, $val).($uid ? ' AND '.DB::field('uid', $uid) : ''), null, $unbuffered);
		}
		return !$unbuffered ? 0 : false;
	}

	public function check_fav_by_id_idtype_uid($id, $idtype, $uid) {
		return DB::result_first('select count(*) from %t where id = %d and idtype = %s and uid = %d', array($this->_table, $id, $idtype, $uid));
	}
  
}

?>
