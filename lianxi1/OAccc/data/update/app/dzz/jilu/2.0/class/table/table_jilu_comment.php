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

class table_jilu_comment extends dzz_table
{
	public function __construct() {

		$this->_table = 'jilu_comment';
		$this->_pk    = 'cid';
		$this->_pre_cache_key = 'jilu_comment_';
		$this->_cache_ttl = 60*60;
		parent::__construct();
	}
	 public function insert_by_rid($arr,$ats){
		if($arr['cid']=parent::insert($arr,1)){
			if(!$arr['pcid']) C::t('jilu_item')->increase($arr['rid'],array('comments'=>1));
			if($ats){
				C::t('jilu_comment_at')->insert_by_cid($arr['cid'],($ats));
			}
			//发送通知
			
		   $this->clear_cache('five_'.$arr['rid']);
		}
		return $arr['cid'];
	}
	public function delete_by_rid($rid){
		$delcids=array();
		foreach(DB::fetch_all("select cid from %t where rid=%d ",array($this->_table,$rid)) as $value){
			$delcids[]=$value['cid'];
		}
		if($return=parent::delete($delcids)){
			$this->clear_cache('five_'.$arr['rid']);
			 //删除@
	 	    C::t('jilu_comment_at')->delete_by_cid($delcids);
			return $return;
		}else{
			return false;
		}
	}
	
	public function fetch_cmt_by_rid($rid,$limit=5){
		$limarr = explode('-',$limit);
		if(count($limarr) > 1){
			$limit = intval($limarr[0]).','.intval($limarr[1]);
		}
		if($limit !== 5 || ($data = $this->fetch_cache('five_'.$rid)) === false) {
			$data=array();
			$cids = array();
			include_once libfile('function/code');
			$sql = "select * from %t where rid=%d and pcid=0 order by dateline DESC";
			$parms = array($this->_table,$rid);
			if($limit){
				$sql .= " limit ".$limit;
			}
			foreach(DB::fetch_all($sql,$parms) as $value){
				$value['message']=dzzcode($value['message']);
				$data[$value['cid']]=$value;
				$cids[] = intval($value['cid']);
			}
			//取得回复
			if(!empty($cids)){
				// $replys = DB::fetch_all("select * from %t where rid=%d and pcid in (%n) order by dateline DESC", array($this->_table,$rid,$cids));
				$replys = array();
				if($cids){
					foreach ($cids as $k => $v) {
						$replys = array_merge($replys, $this->fetch_reply_by_cid($v));
					}
				}
				foreach ($replys as $k => $v) {
					$v['pauthor'] = $data[$v['pcid']]['author'];
					if($v['pauthorid']){
						$author = getuserbyuid($v['pauthorid']);
						$v['pauthor'] = $author['username'];
					}
					$v['message'] = dzzcode($v['message']);
					$data[$v['pcid']]['reply'][$v['cid']] = $v;
				}
			}
			
			if(!empty($data) && $limit === 5) $this->store_cache('five_'.$rid, $data);
		}
		return $data;
	}
	
	public function fetch_reply_by_cid($cid,$limit=5){//获取回复。limit = '2-5':limit 2 5
		$limarr = explode('-',$limit);
		if(count($limarr) > 1){
			$limit = $limarr[0].','.$limarr[1];
		}
		return DB::fetch_all("select * from %t where pcid = $cid order by dateline DESC limit ".$limit, array($this->_table,$cid));
	}

	public function delete_by_cid($cid,$rid){
		$this->clear_cache('five_'.$rid);
		if(!DB::result_first('select count(*) from %t where cid = %d', array($this->_table, $cid))) return true;
		return DB::delete($this->_table, array('cid' => $cid));
	}
}

?>
