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

class table_task_organization_user extends dzz_table
{
	public function __construct() {

		$this->_table = 'task_organization_user';
		$this->_pk    = 'id';

		parent::__construct();
	}
	public function fetch_all_by_uid($uid,$perm=array(1,2,3)){
		$perm=(array)$perm;
		return DB::fetch_all("select * from %t where uid=%d and perm IN (%n) ",array($this->_table,$uid,$perm)) ;
	}
	public function fetch_orgids_by_uid($uid,$perm=array(1,2,3)){
		$perm=(array)$perm;
		$orgids=array();
		foreach(DB::fetch_all("select orgid from %t where uid=%d and perm IN (%n) ",array($this->_table,$uid,$perm)) as $value){
			$orgids[]=$value['orgid'];
		}
		return $orgids;
	}
	public function fetch_all_by_orgid($orgid){
		return DB::fetch_all("select * from %t where orgid=%d order by perm DESC,dateline DESC",array($this->_table,$orgid,$perm),'uid') ;
	}
	public function fetch_uids_by_orgid($orgid){
		$uids=array();
		foreach(DB::fetch_all("select uid from %t where orgid=%d ",array($this->_table,$orgid)) as $value){
			$uids[]=$value['uid'];
		}
		return $uids;
	}
	public function fetch_perm_by_uid($uid,$orgid){
		$user=getuserbyuid($uid);
		if($user['adminid']==1) return 4;
		if(DB::result_first("select COUNT(*) from %t where orgid=%d and uid=%d",array($this->_table,$orgid,$uid))){
			return DB::result_first("select `perm` from %t where orgid=%d and uid=%d",array($this->_table,$orgid,$uid));
		 }else{
			 return 0;
		 }
	}
	public function insert($orgid,$uid,$perm){
		$ret=0;
		$setarr=array('orgid'=>$orgid,'uid'=>$uid,'perm'=>$perm,'dateline'=>TIMESTAMP);
		if($ret=parent::insert($setarr,1,1)){
			if($uid!=getglobal('uid')){
				//发送通知
				$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=task',1);
				$org=C::t('task_organization')->fetch($orgid);
				$permtitle=array('1'=>'观察员','2'=>'协作成员','3'=>'管理员');
				if($uid!=getglobal('uid')){
					//发送通知
					$notevars=array(
									'from_id'=>$appid,
									'from_idtype'=>'app',
									'url'=>DZZSCRIPT.'?mod=taskboard&op=org&orgid='.$orgid,
									'author'=>getglobal('username'),
									'authorid'=>getglobal('uid'),
									'dataline'=>dgmdate(TIMESTAMP),
									'name'=>getstr($org['name']),
									'permtitle'=>$permtitle[$perm],
									);
				
					$action='task_organization_user_add';
					$type='task_organization_user_add_'.$orgid;
					
					dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/taskboard');
				}
			}
		}
		return $ret;
	}
	public function insert_uids_by_orgid($orgid,$uids,$perm,$reset=false){
		$ouids=array();
		foreach(DB::fetch_all("select * from %t where orgid=%d",array($this->_table,$orgid)) as $value){
			//if(in_array($value['uid'],$uids))	parent::update($value['id'],array('perm'=>max($perm,$value['perm'])));
			$ouids[]=$value['uid'];
		}
		if($reset) $deluids=array_diff($ouids,$uids);
		$uids=array_diff($uids,$ouids);
		
		
		$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=taskboard',1);
		$org=C::t('task_organization')->fetch($orgid);
		$permtitle=array('1'=>'观察员','2'=>'协作成员','3'=>'管理员');
		foreach($uids as $uid){
			$userarr=array('uid'=>$uid,
						  
						   'perm'=>$perm,
						   'dateline'=>TIMESTAMP,
						   'orgid'=>$orgid,
						   );
		    if(parent::insert($userarr)){
			
				if($uid!=getglobal('uid')){
					//发送通知
					
					$notevars=array(
									'from_id'=>$appid,
									'from_idtype'=>'app',
									'url'=>DZZSCRIPT.'?mod=taskboard&op=org&orgid='.$orgid,
									'author'=>getglobal('username'),
									'authorid'=>getglobal('uid'),
									'dataline'=>dgmdate(TIMESTAMP),
									'name'=>getstr($org['name']),
									'permtitle'=>$permtitle[$perm],
									);
					
						$action='task_organization_user_add';
						$type='task_organization_user_add_'.$orgid;
					
					dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/taskboard');
				}
			}
		}
		if($reset){
			foreach($deluids as $uid){
				self::remove_uid_by_orgid($orgid,$uid);
			}
		}
		
		return true;
	}
	public function remove_uid_by_orgid($orgid,$uid){
		//管理员必须留一人
		$data=DB::fetch_first("select * from %t where orgid=%d and uid=%d",array($this->_table,$orgid,$uid));
		if($data['perm']>2 && DB::result_first("select COUNT(*) from %t where orgid=%d and perm>2",array($this->_table,$orgid))<2){
			return array('error'=>'至少需要一名管理员');
		}
		if($uid!=getglobal('uid')){
			//发送通知
			$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=taskboard',1);
			$org=C::t('task_organization')->fetch($orgid);
			$notevars=array(
							'from_id'=>$appid,
							'from_idtype'=>'app',
							'url'=>DZZSCRIPT.'?mod=taskboard&op=org&orgid='.$orgid.'#members',
							'author'=>getglobal('username'),
							'authorid'=>getglobal('uid'),
							'dataline'=>dgmdate(TIMESTAMP),
							'name'=>getstr($org['name']),

							);

				$action='task_organization_user_remove';
				$type='task_organization_user_remove_'.$orgid;

			dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/taskboard');
		}
		return parent::delete($data['id']);
	}
	public function change_perm_by_uid($orgid,$uid,$perm){
		//管理员必须留一人
		$data=DB::fetch_first("select * from %t where orgid=%d and uid=%d",array($this->_table,$orgid,$uid));
		if($data['perm']>2 && $perm<3 && DB::result_first("select COUNT(*) from %t where orgid=%d and perm>2",array($this->_table,$orgid))<2){
			return array('error'=>'至少需要一名管理员');
		}
		parent::update($data['id'],array('perm'=>$perm));
		if($data['perm']!=$perm){//权限改变
			$permtitle=array('1'=>'观察员','2'=>'协作成员','3'=>'管理员');
			if($uid!=getglobal('uid')){
				//发送通知
				$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=taskboard',1);
				$org=C::t('task_organization')->fetch($orgid);
				$notevars=array(
								'from_id'=>$appid,
								'from_idtype'=>'app',
								'url'=>DZZSCRIPT.'?mod=taskboard&op=org&orgid='.$orgid.'#members',
								'author'=>getglobal('username'),
								'authorid'=>getglobal('uid'),
								'dataline'=>dgmdate(TIMESTAMP),
								'name'=>getstr($org['name']),
								'permtitle'=>$permtitle[$perm],
								);
				
					$action='task_organization_user_change';
					$type='task_organization_user_change_'.$orgid;
				
				dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/taskboard');
			}
		}
		return true;
	}
	public function fetch_all_by_perm($orgid,$perm,$limit,$iscount){
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
		if($iscount) return DB::result_first("select COUNT(*) from %t where orgid=%d and perm in(%n)",array($this->_table,$orgid,$perm));
		else return  DB::fetch_all("select * from %t where orgid=%d and perm in(%n) order by perm DESC,dateline ASC $limitsql ",array($this->_table,$orgid,$perm));
	}
	public function getUserPermByorgid($orgid,$uid){//获取用户的权限，没有的话用户权限为0
	     if(DB::result_first("select COUNT(*) from %t where orgid=%d and uid=%d",array($this->_table,$orgid,$uid))){
			return DB::result_first("select `perm` from %t where orgid=%d and uid=%d",array($this->_table,$orgid,$uid));
		 }else{
			 return 0;
		 }
	}
	public function delete_by_orgid($orgid){
		return DB::query("delete from %t where orgid=%d",array($this->_table,$orgid));
	}
}

?>
