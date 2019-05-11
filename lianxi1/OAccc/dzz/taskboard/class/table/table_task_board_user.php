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

class table_task_board_user extends dzz_table
{
	public function __construct() {

		$this->_table = 'task_board_user';
		$this->_pk    = 'id';

		parent::__construct();
	}
	public function fetch_all_by_uid($uid){
		return	DB::fetch_all("select * from %t where uid=%d ",array($this->_table,$uid)) ;
	}
	public function fetch_all_by_tbid($tbid,$perm=array(2,3)){
		$perm=(array)$perm;
		return DB::fetch_all("select * from %t where tbid=%d and perm IN(%n) order by perm DESC,dateline DESC",array($this->_table,$tbid,$perm),'uid') ;
	}
	public function fetch_uids_by_tbid($tbid){
		$uids=array();
		foreach(DB::fetch_all("select uid from %t where tbid=%d ",array($this->_table,$tbid)) as $value){
			$uids[]=$value['uid'];
		}
		return $uids;
	}
	public function fetch_perm_by_uid($uid,$tbid){
		$user=getuserbyuid($uid);
		if($user['adminid']==1) return 3;
		$permarr=DB::fetch_first("select `perm` from %t where tbid=%d and uid=%d",array($this->_table,$tbid,$uid));
		if(!empty($permarr)){
			return $permarr['perm'];
		 }else{
			 return 0;
		 }
	}
	public function insert($arr){
		return parent::insert($arr,1,1);
	}
	public function insert_uids_by_tbid($tbid,$uids,$perm=2){
		static $appid=0;
		$taskboard=C::t('task_board')->fetch($tbid);
		$ouids=array();
		foreach(DB::fetch_all("select uid from %t where tbid=%d and  uid in (%n)",array($this->_table,$tbid,$uids)) as $value){
			/*parent::update($value['id'],array('perm'=>$perm));*/
			$ouids[]=$value['uid'];
		}
		$uids=array_diff($uids,$ouids);
		$user=C::t('user')->fetch_all($uids);
		foreach($uids as $uid){
			$userarr=array('uid'=>$uid,
						   'username'=>$user[$uid]['username'],
						   'perm'=>$perm,
						   'dateline'=>TIMESTAMP,
						   'tbid'=>$tbid,
						   );
		    if(C::t('task_board_user')->insert($userarr,1)){
				if($uid!=getglobal('uid')){
					if(!$appid){
						$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=taskboard',1);
					}
					//发送通知
					$notevars=array(
									'from_id'=>$appid,
									'from_idtype'=>'app',
									'url'=>DZZSCRIPT.'?mod=taskboard&op=list&tbid='.$tbid,
									'author'=>getglobal('username'),
									'authorid'=>getglobal('uid'),
									'dataline'=>dgmdate(TIMESTAMP),
									'boardname'=>getstr($taskboard['name']),
									);
					$note='';
					if($perm==1) $note='taskboard_user_follow';
					elseif($perm==2) $note='taskboard_user_cooperation';
					elseif($perm>2) $note='taskboard_user_admin';
					
					dzz_notification::notification_add($uid, 'taskboard_user', $note, $notevars, 0,'dzz/taskboard');
				}
			}
		}
		return true;
	}
	public function remove_uid_by_tbid($tbid,$uid){
		//管理员必须留一人
		$data=DB::fetch_first("select * from %t where tbid=%d and uid=%d",array($this->_table,$tbid,$uid));
		if($data['perm']>2 && DB::result_first("select COUNT(*) from %t where tbid=%d and perm>2",array($this->_table,$tbid))<2){
			return array('error'=>'至少需要一名管理员');
		}
		if($return=parent::delete($data['id'])){
			
			if($uid!=getglobal('uid')){
				$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=taskboard',1);
				//发送通知
				$taskboard=C::t('task_board')->fetch($tbid);
				$notevars=array(
								'from_id'=>$appid,
								'from_idtype'=>'app',
								'url'=>DZZSCRIPT.'?mod=taskboard&op=list&tbid='.$tbid,
								'author'=>getglobal('username'),
								'authorid'=>getglobal('uid'),
								'dataline'=>dgmdate(TIMESTAMP),
								'boardname'=>getstr($taskboard['name']),
								);
				
				dzz_notification::notification_add($uid, 'taskboard_user', 'taskboard_user_remove', $notevars, 0,'dzz/taskboard');
			}
			return $return ;
		}
		return 0;
	}
	public function change_perm_by_uid($tbid,$uid,$perm){
		
		static $permtitle=array('1'=>'关注成员','2'=>'协作成员','3'=>'管理员');
		//管理员必须留一人
		$data=DB::fetch_first("select * from %t where tbid=%d and uid=%d",array($this->_table,$tbid,$uid));
		if($data['perm']>2 && $perm<3 && DB::result_first("select COUNT(*) from %t where tbid=%d and perm>2",array($this->_table,$tbid))<2){
			return array('error'=>'至少需要一名管理员');
		}
		if(parent::update($data['id'],array('perm'=>$perm))){
			if($uid!=getglobal('uid')){
				$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=taskboard',1);
				//发送通知
				$taskboard=C::t('task_board')->fetch($tbid);
				$notevars=array(
								'from_id'=>$appid,
								'from_idtype'=>'app',
								'url'=>DZZSCRIPT.'?mod=taskboard&op=list&tbid='.$tbid,
								'author'=>getglobal('username'),
								'authorid'=>getglobal('uid'),
								'dataline'=>dgmdate(TIMESTAMP),
								'boardname'=>getstr($taskboard['name']),
								'perm'=>$permtitle[$perm],
								);
				
				dzz_notification::notification_add($uid, 'taskboard_user', 'taskboard_user_change', $notevars, 0,'dzz/taskboard');
			}
		}
		return true;
	}
	public function fetch_all_by_perm($tbid,$perm=array(1,2,3),$limit=0,$iscount=false){
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
		if($iscount){
			return DB::result_first("select COUNT(*) from %t where tbid=%d and perm in(%n)",array($this->_table,$tbid,$perm));
		}else{
			return DB::fetch_all("select * from %t where tbid=%d and perm in(%n) order by perm DESC,dateline DESC $limitsql ",array($this->_table,$tbid,$perm));
		}
	}
	
	public function delete_by_tbid($tbid){
		$ret = false;
		return DB::query("delete from %t where tbid=%d ",array($this->_table,$tbid));
	}
	
}

?>
