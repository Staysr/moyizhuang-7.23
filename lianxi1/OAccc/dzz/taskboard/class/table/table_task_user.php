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

class table_task_user extends dzz_table_archive
{
	public function __construct() {

		$this->_table = 'task_user';
		$this->_pk    = 'tuid';

		parent::__construct();
	}
	
	public function delete_by_id_idtype($id,$idtype,$fetch_archive=1){
		$ret=false;
		$ret=DB::query("delete  from %t where id=%d and idtype=%s",array($this->_table,$id,$idtype));
		$_ret=DB::query("delete  from %t where id=%d and idtype=%s",array($this->_table.'_archive',$id,$idtype));
		return $ret+$_ret;
	}
	public function fetch_all_by_id_idtype($ids,$idtype,$action=0,$fetch_archive=0){
		$ids=(array)$ids;
		$sql='';
		if($action){
			$sql.=" and `action`='".intval($action)."'";
		}
		$data=array();
		if($fetch_archive<2){
			$data=DB::fetch_all("select * from %t where id IN (%n) and idtype=%s $sql ",array($this->_table,$ids,$idtype));
			if($fetch_archive){
				if($data1=DB::fetch_all("select * from %t where id IN (%n) and idtype=%s $sql ",array($this->_table.'_archive',$ids,$idtype))){
					$data=array_merge($data,$data1);
				}
				
			}
		}else{
			$data=DB::fetch_all("select * from %t where id IN (%n) and idtype=%s $sql ",array($this->_table.'_archive',$ids,$idtype));
		}
		return $data;
	}
	public function insert($arr){
		
		if(DB::result_first("select COUNT(*) from %t where uid=%d and `action`=%d and id=%d and idtype=%s",array($this->_table,$arr['uid'],$arr['action'],$arr['id'],$arr['idtype']))){
			return false;
		}elseif($return=parent::insert($arr,1)){
			$action='';
			if($arr['action']==1){
				$action=$arr['idtype'].'_follow_add';
			}else{
				$action=$arr['idtype'].'_assign_add';
			}
			if($arr['idtype']=='task'){
				$task=C::t('task_field')->fetch($arr['id']);
				$arr['taskname']=$task['name'];
				$arr['taskid']=$task['taskid'];
				
			
			 //添加事件
				$event =array('uid'=>getglobal('uid'),
							  'username'=>getglobal('username'),
							  'tbid'=>$arr['tbid'],
							  'body_template'=>$action,
							  'body_data'=>serialize($arr),
							  'dateline'=>TIMESTAMP,
							  'bz'=>$arr['idtype'].'_'.$arr['id'],
							  );
				C::t('task_event')->insert($event);
				
				//发送通知
				if($arr['uid']!=getglobal('uid')){
						$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=taskboard',1);
						//发送通知
						$taskboard=C::t('task_board')->fetch($tbid);
						$notevars=array(
										'from_id'=>$appid,
										'from_idtype'=>'app',
										'url'=>DZZSCRIPT.'?mod=taskboard&op=list&tbid='.$arr['tbid'].'&taskid='.$arr['taskid'],
										'author'=>getglobal('username'),
										'authorid'=>getglobal('uid'),
										'dataline'=>dgmdate(TIMESTAMP),
										'taskname'=>getstr($task['name']),
										);
						
						dzz_notification::notification_add($arr['uid'], ($arr['action']==1)?'task_follow':'task_assign', $action, $notevars, 0,'dzz/taskboard');
					}
				
			}
		   return $return;
		}
		return false;
	}
	public function delete_by_id_idtype_uid($id,$idtype,$action,$uid){
		foreach(DB::fetch_all("select tuid from %t where id=%d and idtype=%s and action=%d and uid=%d",array($this->_table,$id,$idtype,$action,$uid)) as $value){
			self::delete_by_tuid($value['tuid']);
		}
	}
	public function fetch_followed_by_id_idtype_uid($id,$idtype,$action,$uid){
		return DB::result_first("select COUNT(*) from %t where id=%d and idtype=%s and action=%d and uid=%d",array($this->_table,$id,$idtype,$action,$uid));
	}
	public function delete_by_tuid($tuid){
		if($arr=parent::fetch($tuid)){
			
			if($arr['idtype']=='task'){
				$action='';
				if($arr['action']==1){
					$action='task_follow_remove';
				}elseif($arr['action']==2){
					$action='task_assign_remove';
				}
				
				if($action){
					$field=C::t('task_field')->fetch($arr['id']);
					$arr['taskname']=$field['name'];
					$arr['taskid']=$arr['id'];
					//添加事件
					$event =array('uid'=>getglobal('uid'),
								  'username'=>getglobal('username'),
								  'tbid'=>$arr['tbid'],
								  'body_template'=>$action,
								  'body_data'=>serialize($arr),
								  'dateline'=>TIMESTAMP,
								  'bz'=>'task_'.$arr['id'],
								  );
					C::t('task_event')->insert($event);
					
					if($arr['uid']!=getglobal('uid')){
						$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=taskboard',1);
						//发送通知
						$taskboard=C::t('task_board')->fetch($tbid);
						$notevars=array(
										'from_id'=>$appid,
										'from_idtype'=>'app',
										'url'=>DZZSCRIPT.'?mod=taskboard&op=list&tbid='.$arr['tbid'].'&taskid='.$arr['taskid'],
										'author'=>getglobal('username'),
										'authorid'=>getglobal('uid'),
										'dataline'=>dgmdate(TIMESTAMP),
										'taskname'=>getstr($field['name']),
										);
						
						dzz_notification::notification_add($arr['uid'], ($arr['action']==1)?'task_follow':'task_assign', $action, $notevars, 0,'dzz/taskboard');
					}
				}
			}
		   return parent::delete($tuid);
		}
	}
		
	public function archive_by_id_idtype($id,$idtype){
		$data = array();
		$data= DB::fetch_all("select * from %t where id=%d and idtype=%s",array($this->_table,$id,$idtype));
		$ids=array();
		foreach($data as $value){
			if(DB::query("REPLACE INTO %t SET ".DB::implode($value),array($this->_table.'_archive'),false,true)){
				$ids[]=$value['tuid'];
			}
		}
		return DB::delete($this->_table,"tuid IN (".dimplode($ids).")");
	}
	
	public function active_by_id_idtype($id,$idtype){
		$data = array();
		$data= DB::fetch_all("select * from %t where id=%d and idtype=%s",array($this->_table.'_archive',$id,$idtype));
		$ids=array();
		foreach($data as $value){
			if(DB::query("REPLACE INTO %t SET ".DB::implode($value),array($this->_table),false,true)){
				$ids[]=$value['tuid'];
			}
		}
		return DB::delete($this->_table.'_archive',"tuid IN (".dimplode($ids).")");
	}
	//拷贝用户
	public function copy_by_taskid($otaskid,$taskid,$action){
		foreach(DB::fetch_all("select * from %t where id=%d and idtype='task' and action=%d",array($this->_table,$otaskid,$action)) as $value){
			unset($value['tuid']);
			$value['dateline']=TIMESTAMP;
			$value['id']=$taskid;
			parent::insert($value);
		}
	}
	public function fetch_all_relative_uids_by_taskid($taskid){
		if(!$task=C::t('task')->fetch($taskid)) return array();
		$uids=array();
		foreach(DB::fetch_all("select uid from %t where (idtype=%s and id=%d) or (idtype=%s and id=%d)",array($this->_table,'task',$taskid,'task_cat',$task['catid'])) as $value){
			$uids[$value['uid']]=$value['uid'];
		}
		return $uids;
	}
}

?>
