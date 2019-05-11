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

class table_jilu_user extends dzz_table
{
	public function __construct() {

		$this->_table = 'jilu_user';
		$this->_pk    = 'id';
		$this->_pre_cache_key = 'jilu_user_';
		$this->_cache_ttl = 60*60;
		parent::__construct();
	}
	public function setLastvisit($jid,$uid){//设置用户最后访问时间
		if($id=DB::fetch_first("select id from %t where jid=%s and uid=%d",array($this->_table,$jid,$uid))){
			return parent::update($id,array('lastvisit'=>TIMESTAMP));
		}
		return false;
	}
	public function fetch_all_by_uid($uid){
		return DB::fetch_all("select * from %t where uid=%d ",array($this->_table,$uid,$perm)) ;
	}
	public function fetch_all_by_jid($jid){
		//if(!is_array($perm)) $perm=array($perm);
		return DB::fetch_all("select * from %t where jid=%s order by perm DESC,dateline DESC",array($this->_table,$jid,$perm)) ;
	}
	public function fetch_cover_uids_by_jid($jid,$force_from_db=false){
		if($force_from_db || ($data = $this->fetch_cache('cover_uids_'.$jid)) === false) {
			$data=array();
			foreach(DB::fetch_all("select ju.* from %t ju LEFT JOIN %t u ON ju.uid=u.uid where ju.jid=%s order by u.avatarstatus DESC limit 9",array($this->_table,'user',$jid)) as $value){
				$data[$value['uid']]=$value['uid'];
			}
			if(!empty($data)) $this->store_cache('cover_uids_'.$jid, $data);
		}
		return $data;
	}
	public function fetch_uids_by_jid($jid){
		//if(!is_array($perm)) $perm=array($perm);
		$uids=array();
		foreach(DB::fetch_all("select uid from %t where jid=%s ",array($this->_table,$jid)) as $value){
			$uids[]=$value['uid'];
		}
		return $uids;
	}
	public function fetch_perm_by_uid($uid,$jid){
		if(DB::result_first("select COUNT(*) from %t where jid=%s and uid=%d",array($this->_table,$jid,$uid))){
			return DB::result_first("select `perm` from %t where jid=%s and uid=%d",array($this->_table,$jid,$uid));
		 }else{
			 return 0;
		 }
		return DB::result_first("select perm from %t where jid=%s and uid=%d",array($this->_table,$jid,$uid));
	}
	public function insert($arr){
		if($id=DB::result_first("select id from %t where jid=%s and uid=%d",array($this->_table,$arr['jid'],$arr['uid']))){
			parent::update($id,$arr);
			return $id;
		}else	return parent::insert($arr,1);
	}
	public function insert_uids_by_jid($jid,$uids,$perm=0){
		$ouids=array();
		foreach(DB::fetch_all("select * from %t where jid=%s and  uid in (%n)",array($this->_table,$jid,$uids)) as $value){
			if($value['perm']<$perm) parent::update($value['id'],array('perm'=>$perm));
			$ouids[]=$value['uid'];
		}
		$uids=array_diff($uids,$ouids);
		$user=C::t('user')->fetch_all($uids);
		
		$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=jilu',1);
		$jilu=C::t('jilu')->fetch($jid);
		$permtitle=array('1'=>lang('follow_member'),'2'=>lang('cooper_member'),'3'=>lang('administrator'));
		foreach($uids as $uid){
			$userarr=array('uid'=>$uid,
						   'username'=>$user[$uid]['username'],
						   'perm'=>$perm,
						   'dateline'=>TIMESTAMP,
						   'jid'=>$jid,
						   );
		    if(parent::insert($userarr)){
			
				if($uid!=getglobal('uid')){
					//发送通知
					
					$notevars=array(
									'from_id'=>$appid,
									'from_idtype'=>'app',
									'url'=>MOD_URL.'&op=user&jid='.$jilu['jid'],
									'author'=>getglobal('username'),
									'authorid'=>getglobal('uid'),
									'dataline'=>dgmdate(TIMESTAMP),
									'jiluname'=>getstr($jilu['title'],30),
									'permtitle'=>$permtitle[$perm],
									);
					
						$action='user_add';
						$type='user_add_'.$jid;
					
					dzz_notification::notification_add($uid, $type, $action, $notevars, 0, MOD_PATH);
				}
			}
		}
		return true;
	}
	public function remove_uid_by_jid($jid,$uid){
		//管理员必须留一人
		$data=DB::fetch_first("select * from %t where jid=%s and uid=%d",array($this->_table,$jid,$uid));
		if($data['perm']>2 && DB::result_first("select COUNT(*) from %t where jid=%s and perm>2",array($this->_table,$jid))<2){
			return array('error'=>lang('must_one_admin'));
		}
		$permtitle=array('1'=>lang('follow_member'),'2'=>lang('cooper_member'),'3'=>lang('administrator'));
			if($uid!=getglobal('uid')){
				//发送通知
				$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=jilu',1);
				$jilu=C::t('jilu')->fetch($jid);
				$notevars=array(
								'from_id'=>$appid,
								'from_idtype'=>'app',
								'url'=>MOD_URL.'&op=user&jid='.$jilu['jid'],
								'author'=>getglobal('username'),
								'authorid'=>getglobal('uid'),
								'dataline'=>dgmdate(TIMESTAMP),
								'jiluname'=>getstr($jilu['title'],30),
								'permtitle'=>$permtitle[$data['perm']],
								);
				
					$action='user_remove';
					$type='user_remove_'.$jid;
				
				dzz_notification::notification_add($uid, $type, $action, $notevars, 0, MOD_PATH);
			}
		return parent::delete($data['id']);
	}
	public function change_perm_by_uid($jid,$uid,$perm=0){
		//管理员必须留一人
		$data=DB::fetch_first("select * from %t where jid=%s and uid=%d",array($this->_table,$jid,$uid));
		if($data['perm']>2 && $perm<3 && DB::result_first("select COUNT(*) from %t where jid=%s and perm>2",array($this->_table,$jid))<2){
			return array('error'=>lang('must_one_admin'));
		}
		parent::update($data['id'],array('perm'=>$perm,'dateline'=>TIMESTAMP));
		if($data['perm']!=$perm){//权限改变
			$permtitle=array('1'=>lang('follow_member'),'2'=>lang('cooper_member'),'3'=>lang('administrator'));
			if($uid!=getglobal('uid')){
				//发送通知
				$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=jilu',1);
				$jilu=C::t('jilu')->fetch($jid);
				$notevars=array(
								'from_id'=>$appid,
								'from_idtype'=>'app',
								'url'=>MOD_URL.'&op=user&jid='.$jilu['jid'],
								'author'=>getglobal('username'),
								'authorid'=>getglobal('uid'),
								'dataline'=>dgmdate(TIMESTAMP),
								'jiluname'=>getstr($jilu['title'],30),
								'permtitle'=>$permtitle[$perm],
								);
				
					$action='user_change';
					$type='user_change_'.$jid;
				
				dzz_notification::notification_add($uid, $type, $action, $notevars, 0, MOD_PATH);
			}
		}
		return true;
	}
	public function fetch_all_by_perm($jid,$perm=0,$limit=0,$iscount=false){
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
		if($iscount) return DB::result_first("select COUNT(*) from %t where jid=%s and perm in(%n)",array($this->_table,$jid,$perm));
		else return  DB::fetch_all("select * from %t where jid=%s and perm in(%n) order by perm DESC,dateline ASC $limitsql ",array($this->_table,$jid,$perm), 'uid');
	}
	public function getUserPermByJid($jid,$uid){//获取用户的权限，没有的话用户权限为0
		include_once libfile('function/common');
		$perm = getPermByUid($uid);
		if($perm > 1) return 3;//能够操作记录本
	     if(DB::result_first("select COUNT(*) from %t where jid=%s and uid=%d",array($this->_table,$jid,$uid))){
			return DB::result_first("select `perm` from %t where jid=%s and uid=%d",array($this->_table,$jid,$uid));
		 }else{
			 return 0;
		 }
	}
}

?>
