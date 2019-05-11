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

class table_discuss_user extends dzz_table
{
	public function __construct() {

		$this->_table = 'discuss_user';
		$this->_pk    = 'id';

		parent::__construct();
	}
	public function fetch_all_by_uid($uid, $perm = 0){
		if ($perm) {
			return DB::fetch_all("select * from %t where uid=%d and perm = %d",array($this->_table, $uid, $perm), 'fid');
		} else {
			return DB::fetch_all("select * from %t where uid=%d ",array($this->_table,$uid), 'fid') ;
		}
	}
	public function fetch_all_by_fid($fid,$perm=0){
		//if(!is_array($perm)) $perm=array($perm);
		$permsql='';
		if($perm) $permsql=' and perm='.intval($perm);
		
		return DB::fetch_all("select * from %t where fid=%d $permsql order by perm DESC,dateline DESC",array($this->_table,$fid),'uid') ;
	}
	public function fetch_uids_by_fid($fid,$perm=0){
		//if(!is_array($perm)) $perm=array($perm);
		$uids=array();
		$permsql='';
		if($perm) $permsql=' and perm='.intval($perm);
		foreach(DB::fetch_all("select uid from %t where fid=%d $permsql ",array($this->_table,$fid)) as $value){
			$uids[]=$value['uid'];
		}
		return $uids;
	}
	public function fetch_perm_by_uid($uid,$fid){
		$user = C::t('user')->get_user_by_uid($uid);
		if ($user['adminid']) return 4;
		if(DB::result_first("select COUNT(*) from %t where fid=%d and uid=%d",array($this->_table,$fid,$uid))){
			return DB::result_first("select `perm` from %t where fid=%d and uid=%d",array($this->_table,$fid,$uid));
		 }else{
			 return 0;
		 }
		//return DB::result_first("select perm from %t where fid=%d and uid=%d",array($this->_table,$fid,$uid));
	}
	public function insert($arr){
		return parent::insert($arr,1,1);
	}
	public function insert_uids_by_fid($fid,$uids,$perm){
		$ouids=array();
		foreach(DB::fetch_all("select * from %t where fid=%d and  uid in (%n)",array($this->_table,$fid,$uids)) as $value){
			if($perm > 2)parent::update($value['id'],array('perm'=>$perm));
			$ouids[]=$value['uid'];
		}
		$uids=array_diff($uids,$ouids);
		$user=C::t('user')->fetch_all($uids);
		$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=discuss',0);
		$discuss=C::t('discuss')->fetch($fid);
		foreach($uids as $uid){
			$userarr=array('uid'=>$uid,
						   'username'=>$user[$uid]['username'],
						   'perm'=>$perm,
						   'dateline'=>TIMESTAMP,
						   'fid'=>$fid,
						   );
		    C::t('discuss_user')->insert($userarr);//创建用户
			//发送通知
			$notevars=array(
							'from_id'=>$appid,
							'from_idtype'=>'app',
							'url'=>DZZSCRIPT.'?mod=discuss&op=list&do=user&fid='.$fid,
							'author'=>getglobal('username'),
							'authorid'=>getglobal('uid'),
							'dataline'=>dgmdate(TIMESTAMP),
							'discussname'=>getstr($discuss['name'],30),
							'member'=>$perm>2?lang('administrator') : lang('member'),
						);
			
				$action='discuss_user_add';
				$type='discuss_user_add_'.$fid;
			
			dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/discuss');
		}
		return true;
	}
	public function remove_uid_by_fid($fid,$uid){
		//管理员必须留一人
		$data=DB::fetch_first("select * from %t where fid=%d and uid=%d",array($this->_table,$fid,$uid));
		if($data['perm']>2 && DB::result_first("select COUNT(*) from %t where fid=%d and perm>2",array($this->_table,$fid))<2){
			return array('error'=>lang('least_a_administrator'));
		}
		//发送通知
		$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=discuss',0);
		$discuss=C::t('discuss')->fetch($fid);
			$notevars=array(
							'from_id'=>$appid,
							'from_idtype'=>'app',
							'url'=>DZZSCRIPT.'?mod=discuss&op=list&do=user&fid='.$fid,
							'author'=>getglobal('username'),
							'authorid'=>getglobal('uid'),
							'dataline'=>dgmdate(TIMESTAMP),
							'discussname'=>getstr($discuss['name'],30),
						);
			
				$action='discuss_user_remove';
				$type='discuss_user_remove_'.$fid;
			
			dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/discuss');
		return parent::delete($data['id']);
	}
	public function change_perm_by_uid($fid,$uid,$perm){
		global $_G;
		//管理员必须留一人
		$data=DB::fetch_first("select * from %t where fid=%d and uid=%d",array($this->_table,$fid,$uid));
		if($data['perm']>2 && $perm<3 && DB::result_first("select COUNT(*) from %t where fid=%d and perm>2",array($this->_table,$fid))<2){
			return array('error'=>lang('least_a_administrator'));
		}
		parent::update($data['id'],array('perm'=>$perm));
		if ($uid != $_G['uid']) {
			//发送通知
			$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=discuss',0);
			$discuss=C::t('discuss')->fetch($fid);
			$notevars=array(
							'from_id'=>$appid,
							'from_idtype'=>'app',
							'url'=>DZZSCRIPT.'?mod=discuss&op=list&do=user&fid='.$fid,
							'author'=>getglobal('username'),
							'authorid'=>getglobal('uid'),
							'dataline'=>dgmdate(TIMESTAMP),
							'discussname'=>getstr($discuss['name'],30),
							'permtitle'=>$perm>2?lang('administrator'):lang('member'),
						);
			
				$action='discuss_user_perm';
				$type='discuss_user_perm_'.$fid;
			
			dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/discuss');
		}
		
		return true;
	}
	public function fetch_all_by_perm($fid,$perm,$limit = 0,$iscount = 0){
		if(!is_array($perm)) $perm=array($perm);
		$limitsql='';
		if($limit){
			$limit=explode('-',$limit);
			if(count($limit)>1){
				$limitsql.=" limit ".intval($limit[0]).",".intval($limit[1]);
			}else{
				$limitsql.=" limit ".intval($limit[0]);
			}
		}
		if($iscount) return DB::result_first("select COUNT(*) from %t where fid=%d and perm in(%n)",array($this->_table,$fid,$perm));
		else return  DB::fetch_all("select du.*,u.email from %t du left join %t u on du.uid = u.uid where du.fid=%d and du.perm in(%n) order by du.perm DESC,du.dateline DESC $limitsql ",array($this->_table, 'user',$fid,$perm), 'uid');
	}
	public function getUserPermByfid($fid,$uid){//获取用户的权限，没有的话用户权限为0
	     if(DB::result_first("select COUNT(*) from %t where fid=%d and uid=%d",array($this->_table,$fid,$uid))){
			return DB::result_first("select `perm` from %t where fid=%d and uid=%d",array($this->_table,$fid,$uid));
		 }else{
			 return 0;
		 }
	}
	public function delete_by_fid($fids){
		if(!is_array($fids)){
			$fids=array($fids);
		}
		return DB::query("delete from %t where fid IN (%n)",array($this->_table,$fids));
	}

	public function fetch_create_by_uid($uid){
		return DB::fetch_all("select u.* from %t u left join %t d on u.fid = d.fid where d.uid=%d and u.uid = %d",array($this->_table, 'discuss', $uid, $uid), 'fid');
	}
}

?>
