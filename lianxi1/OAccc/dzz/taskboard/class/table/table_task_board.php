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
class table_task_board extends dzz_table
{
	public function __construct() {

		$this->_table = 'task_board';
		$this->_pk    = 'tbid';

		parent::__construct();
	}
	public function checkmaxorganization($uid){
		$maxorganization=C::t('task_setting')->fetch('maxorganization');
		if($maxorganization==0){
			return '无限制';
		}else{
			$sum=DB::result_first("select COUNT(*) from %t where uid=%d ",array('task_organization',$uid));
			if($sum<$maxorganization) return $maxorganization-$sum;
		}
		 return false;
	}
	public function checkMaxBoard($uid){
		$maxboard=C::t('task_setting')->fetch('maxboard');
		if($maxboard==0){
			return '无限制';
		}else{
			$sum=DB::result_first("select COUNT(*) from %t where uid=%d and status<2",array($this->_table,$uid));
			if($sum<$maxboard) return $maxboard-$sum;
		}
		 return false;
	}
	public function fetch_by_tbid($tbid,$uid=0){
		global $_G;
		$data=array();
		if($data=parent::fetch($tbid,0,$fetch_archive)){
			$data['users']=C::t('task_board_user')->fetch_all_by_tbid($tbid,array(1,2,3));
			if($_G['adminid']==1) $data['perm']=4;
			elseif($uid>0) $data['perm']=isset($data['users'][$uid])?$data['users'][$uid]['perm']:0;
			else $data['perm']=0;
			require_once libfile('function/code');
			
			$desc='';
			if($data['desc_status']){
				$desc.='<span class="desc-title">状态：</span>';
				if($data['desc_status_color']){
					$desc.='<span class="desc-body" style="color:'.$data['desc_status_color'].'">'.$data['desc_status'].'</span>';
				}else{
					$desc.='<span class="desc-body">'.$data['desc_status'].'</span>';
				}
			}
			if($data['desc_date']){
				$desc.='<span class="desc-title">时间：</span><span class="desc-body">'.$data['desc_date'].'</span>';
			}
			if($data['desc_money']){
				$desc.='<span class="desc-title">预算：</span><span class="desc-body">'.$data['desc_money'].'</span>';
			}
			if($data['desc']){
				$desc.='<span class="desc-title">简介：</span><span class="desc-body">'.dzzcode($data['desc']).'</span>';
			}
			$data['fdesc']=$desc;
		}
		return $data;
	}
	
	public function delete_by_tbid($tbid,$force=false){//删除任务版；
		//删除任务版
		if(!$data=parent::fetch($tbid)){
			return false;
		}
		if($force || $data['deletetime']>0){
			return self::delete_permanent_by_tbid($tbid);
		}else{
			$setarr=array(
					  'status'=>2,
					  'statustime'=>TIMESTAMP,
					  'statusuid'=>getglobal('uid')
					  );
			if($return=parent::update($tbid,$setarr)){
				//产生删除事件；
				$event =array(    'uid'=>getglobal('uid'),
								  'username'=>getglobal('username'),
								  'tbid'=>$tbid,
								  'body_template'=>'taskboard_delete',
								  'body_data'=>serialize(array('tbid'=>$tbid,'boardname'=>$data['name'])),
								  'dateline'=>TIMESTAMP,
								  'bz'=>'taskboard_'.$tbid,
								  );
					C::t('task_event')->insert($event);
				return $return;
			}
			return false;
		}
	}
	public function restore_by_tbid($tbid){//恢复任务版；
		//删除任务版
		if(!$data=parent::fetch($tbid)){
			return false;
		}
		
		$setarr=array(
					  'status'=>0,
					  'statustime'=>TIMESTAMP,
					  'statusuid'=>getglobal('uid')
					  );
		if($return=parent::update($tbid,$setarr)){
			//产生删除事件；
			$event =array(    'uid'=>getglobal('uid'),
							  'username'=>getglobal('username'),
							  'tbid'=>$tbid,
							  'body_template'=>'taskboard_restore',
							  'body_data'=>serialize(array('tbid'=>$tbid,'boardname'=>$data['name'])),
							  'dateline'=>TIMESTAMP,
							  'bz'=>'taskboard_'.$tbid,
							  );
				C::t('task_event')->insert($event);
			return $return;
		}
		return false;
	}
	public function delete_permanent_by_tbid($tbid){
		if(!$data=parent::fetch($tbid)){
			return false;
		}
		//删除分类布局
		C::t('task_setting')->delete('catlist_'.$tbid);
		//删除labels
		C::t('task_setting')->delete('labels_'.$tbid);
		
		
		//删除任务版用户
		C::t('task_board_user')->delete_by_tbid($tbid);
		
		//删除任务版相关事件
		C::t('task_event')->delete_by_tbid($tbid);
		
		//删除任务版分类
		C::t('task_cat')->delete_by_tbid($tbid);
		
		if($return=parent::delete($tbid)){
			if($data['status']==1){
				self::setArchiveMonthTree($data['statustime']);
			}
		}
		return $return;
	}
	public function insert_by_tbid($arr){
		if($tbid=parent::insert($arr,1)){
			$userarr=array('uid'=>$arr['uid'],
						   'username'=>$arr['username'],
						   'perm'=>3,//管理员
						   'dateline'=>TIMESTAMP,
						   'tbid'=>$tbid,
						   );
		    C::t('task_board_user')->insert($userarr);//创建用户
			//产生事件
			$event =array(    'uid'=>getglobal('uid'),
							  'username'=>getglobal('username'),
							  'tbid'=>$tbid,
							  'body_template'=>'taskboard_create',
							  'body_data'=>serialize(array('tbid'=>$arr['tbid'],'boardname'=>$arr['name'])),
							  'dateline'=>TIMESTAMP,
							  'bz'=>'taskboard_'.$tbid,
							  );
				C::t('task_event')->insert($event);
		}
		return $tbid;
	}
	public function update_by_tbid($tbid,$arr){
		return parent::update($tbid,$arr);
	}
	
	public function getMyTaskboard($uid,$keyword=''){
		$users=C::t('task_board_user')->fetch_all_by_uid($uid);
		$tbids=array();
		foreach($users as $value){
			$tbids[$value['tbid']]=$value['tbid'];
		}
			$temp=$data=array();
			$param=array($this->_table,$tbids);
			
			$searchsql='';
			if(!empty($keyword)){
				$param[]='%'.$keyword.'%';
				$param[]='%'.$keyword.'%';
				$searchsql=' and ( name like %s or username=%s )';
			}
			
			
			//删除的列出来
			$searchsql.=" and status IN('0','2')";
			$forceindex=array();
			foreach(DB::fetch_all("select * from %t where tbid IN(%n) $searchsql order by dateline DESC",$param,'tbid') as $value){
				if($value['forceindex']) $forceindex[]=$value['tbid'];
				$data[$value['tbid']]=$value;
			}
			foreach(self::fetch_all_for_manage(0,'',0,1) as $value){
				if(!in_array($value['tbid'],$forceindex)){
					if($value['viewperm']>0) continue; //隐私的不列出
					$data[$value['tbid']]=$value;
				}
			}
			$paixu=C::t('task_setting')->fetch('paixu_'.$uid);
			if($paixu) $paixu=explode(',',$paixu);
			foreach($paixu as $tbid){
				if(isset($data[$tbid])){
					 $temp[]=$data[$tbid];
					 unset($data[$tbid]);
				}
			}
			return array_merge($data,$temp);
	}
	public function getOpenedTaskboard($limit,$keyword='',$iscount=false){
		$param=array($this->_table);
		$searchsql='';
		if(!empty($keyword)){
			$param[]='%'.$keyword.'%';
			$param[]='%'.$keyword.'%';
			$searchsql=' and ( name like %s or username=%s )';
		}
		if($iscount){
			return DB::result_first("select COUNT(*) from %t where  viewperm<1 $searchsql ",$param);
		}
		$limitsql='';
		if($limit){
			$limit=explode('-',$limit);
			if(count($limit)>1){
				$limitsql.=" limit ".intval($limit[0]).",".intval($limit[1]);
			}else{
				$limitsql.=" limit ".intval($limit[0]);
			}
		}
		foreach(DB::fetch_all("select * from %t where viewperm<1 and status<1  $searchsql order by dateline DESC $limitsql",$param,'tbid') as $value){
			$data[$value['tbid']]=$value;
		}
		return $data;
	}
	public function getArchivedTaskboard($month=0,$keyword='',$iscount=false){
		$param=array($this->_table);
		$searchsql='';
		if(!empty($keyword)){
			$param[]='%'.$keyword.'%';
			$param[]='%'.$keyword.'%';
			$searchsql=' and ( name like %s or username=%s )';
		}
		if(!empty($month)){
			$dateline_low=strtotime($month);
			$dateline_up=strtotime('+1 month',strtotime($month));
			$param[]=$dateline_low;
			$param[]=$dateline_up;
			$searchsql='and  `status`=1 and statustime>=%d and statustime<=%d';
		}else{
			$searchsql='and  `status`=1';
		}
		
		if($iscount){
			return DB::result_first("select COUNT(*) from %t where 1 $searchsql ",$param);
		}
		foreach(DB::fetch_all("select * from %t where 1  $searchsql order by dateline DESC",$param,'tbid') as $value){
			$value['userperm']=C::t('task_board_user')->fetch_perm_by_uid(getglobal('uid'),$value['tbid']);
			$data[$value['tbid']]=$value;
		}
		return $data;
	}
	public function fetch_all_for_manage($limit,$keyword='',$status=0,$forceindex=0,$count=false){
		$param=array($this->_table);
		$searchsql='';
		if(!empty($keyword)){
			$param[]='%'.$keyword.'%';
			$param[]='%'.$keyword.'%';
			$searchsql=' and ( name like %s or username=%s )';
		}
		if(!empty($forceindex)){
			$searchsql.=' and forceindex>0';
		}
		if(!empty($status)){
			$searchsql.=" and status='{$status}'";
		}
		
		if($count){
			return DB::result_first("select COUNT(*) from %t where 1 $searchsql ",$param);
		}
		$limitsql='';
		if($limit){
			$limit=explode('-',$limit);
			if(count($limit)>1){
				$limitsql.=" limit ".intval($limit[0]).",".intval($limit[1]);
			}else{
				$limitsql.=" limit ".intval($limit[0]);
			}
		}
		foreach(DB::fetch_all("select * from %t where 1 $searchsql order by dateline DESC $limitsql",$param,'tbid') as $value){
			$data[$value['tbid']]=$value;
		}
		return $data;
	}
	/*public function fetch_all_archive_for_manage($limit,$keyword,$count){
		$param=array($this->_table);
		$searchsql='';
		if(!empty($keyword)){
			$param[]='%'.$keyword.'%';
			$param[]='%'.$keyword.'%';
			$searchsql=' and ( name like %s or username=%s )';
		}
		if($count){
			return DB::result_first("select COUNT(*) from %t where 1 $searchsql ",$param);
		}
		$limitsql='';
		if($limit){
			$limit=explode('-',$limit);
			if(count($limit)>1){
				$limitsql.=" limit ".intval($limit[0]).",".intval($limit[1]);
			}else{
				$limitsql.=" limit ".intval($limit[0]);
			}
		}
		foreach(DB::fetch_all("select * from %t where 1 $searchsql order by dateline DESC $limitsql",$param,'tbid') as $value){
			if($value['aid']) $value['img']=C::t('attachment')->getThumbByAid($value['aid'],171,225);
			$data[$value['tbid']]=$value;
		}
		return $data;
	}*/
	public function update_count_by_tbid($tbid){
		$arr=array();
		/*$arr['tasks']=DB::result_first("select COUNT(*) from %t where tbid=%d and perm=1",array('task_board_user',$tbid));
		$arr['members']=DB::result_first("select COUNT(*) from %t where tbid=%d and perm>1",array('task_board_user',$tbid));
		parent::update($tbid,$arr);*/
		return $arr;
	}
	public function setArchiveMonthTree($dateline){
		if(!$dateline) $dateline=time();
		if(!$archivetree=C::t('task_setting')->fetch('archivetree',true)){
			$archivetree=array();
		}
		$montharr=getdate($dateline);
		$monkey=$montharr['year'].'-'.$montharr['mon'];
		
		if($sum=self::getArchivedTaskboard($monthkey,'',true)){
			$archivetree[$monkey]=$sum;
		}else{
			if(isset($archivetree[$monkey])) unset($archivetree[$monkey]);
		}
		krsort($archivetree);
		C::t('task_setting')->update('archivetree',$archivetree);
	}
	public function resetArchiveMonthTree(){
		$tree=array();
		foreach(self::getArchivedTaskboard() as $value){
			$key=dgmdate($value['archivetime'],'Y-m');
			if($tree[$key]) $tree[$key]+=1;
			else{
				$tree[$key]=1;
			}
		}
		krsort($tree);
		C::t('task_setting')->update('archivetree',$tree);
	}
	public function increase($tbids,$fieldarr){
		$tbids=(array)$tbids;
		$sql = array();
		$num = 0;
		$allowkey = array('tasks', 'tasks_c',  'worktime', 'worktime_u', 'money', 'money_u');
		foreach($fieldarr as $key => $value) {
			if(in_array($key, $allowkey)) {
				if(is_array($value)) {
					$sql[] = DB::field($key, $value[0]);
				} else {
					$value = dintval($value);
					$sql[] = "`$key`=`$key`+'$value'";
				}
			} else {
				unset($fieldarr[$key]);
			}
		}
		return  DB::query("UPDATE ".DB::table($this->_table)." SET ".implode(',', $sql)." WHERE tbid IN (".dimplode($tbids).")", 'UNBUFFERED');
	}
	public function archive_by_tbid($tbid){
		if(!$data=parent::fetch($tbid)) return 0;
		//归档任务版
		$setarr=array(
					  'status'=>1,
					  'statustime'=>TIMESTAMP,
					  'statusuid'=>getglobal('uid')
					  );
		if($return=parent::update($tbid,$setarr)){
			//产生删除事件；
			$event =array(    'uid'=>getglobal('uid'),
							  'username'=>getglobal('username'),
							  'tbid'=>$tbid,
							  'body_template'=>'taskboard_archive',
							  'body_data'=>serialize(array('tbid'=>$tbid,'boardname'=>$data['name'])),
							  'dateline'=>TIMESTAMP,
							  'bz'=>'taskboard_'.$tbid,
							  );
				C::t('task_event')->insert($event);
				//归档此任务板的事件；
				C::t('task_event')->archive_by_tbid($tbid);
				//self::setArchiveMonthTree();
			return $return;
		}
		return 0;
	}
	public function active_by_tbid($tbid){
		//激活任务版
		if(!$data=parent::fetch($tbid)) return 0;
		//归档任务版
		$setarr=array(
					  'status'=>0,
					  'statustime'=>TIMESTAMP,
					  'statusuid'=>getglobal('uid')
					  );
		if($return=parent::update($tbid,$setarr)){
			//产生删除事件；
			$event =array(    'uid'=>getglobal('uid'),
							  'username'=>getglobal('username'),
							  'tbid'=>$tbid,
							  'body_template'=>'taskboard_active',
							  'body_data'=>serialize(array('tbid'=>$tbid,'boardname'=>$data['name'])),
							  'dateline'=>TIMESTAMP,
							  'bz'=>'taskboard_'.$tbid,
							  );
				C::t('task_event')->insert($event);
				//归档此任务板的事件；
				C::t('task_event')->active_by_tbid($tbid);
				self::setArchiveMonthTree($data['statustime']);
			return $return;
		}
		return 0;
	}
	public function fetch_user_stats_by_tbid($tbid,$time='',$date=''){
		//获取所有的任务完成数和过期数
		$param=array('task',$tbid);
		
		$timesql='tbid=%d and deletetime<1';
		if(!empty($time)){
			switch($time){
				case 'month':
					$stamp=strtotime($date);
					$arr=getdate($stamp);
					$low=strtotime($arr['year'].'-'.$arr['mon']);
					$up=strtotime('+1 month',$low);
					$timesql_c=$timesql.' and `status`=2 and statustime<%d and statustime>=%d';
					$param_c=array('task',$tbid,$up,$low);
					
					$timesql_un=$timesql.' and `status`=0 and endtime>0 and endtime<%d and endtime>=%d';
					$param_un=array('task',$tbid,$up,$low);
					
					break;
				case 'week':
					$stamp=strtotime($date);
					$arr=getdate($stamp);
					$low=strtotime('+'.(1-$arr['wday']).' day',$stamp);
					$up=strtotime('+1 week',$low);
					$timesql_c=$timesql.' and `status`=2 and statustime<%d and statustime>=%d';
					$param_c=array('task',$tbid,$up,$low);
					
					$timesql_un=$timesql.' and `status`=0 and endtime>0 and endtime<%d and endtime>=%d';
					$param_un=array('task',$tbid,$up,$low);
					
					break;
				case 'day':
					$stamp=strtotime($date);
					$arr=getdate($stamp);
					$low=strtotime('+'.(1-$arr['hours']).' day',$stamp);
					$up=strtotime('+1 day',$low);
					$timesql_c=$timesql.' and `status`=2 and statustime<%d and statustime>=%d';
					$param_c=array('task',$tbid,$up,$low);
					
					$timesql_un=$timesql.' and `status`=0 and endtime>0 and endtime<%d and endtime>=%d';
					$param_un=array('task',$tbid,$up,$low);
					
					
					break;
			}
		}else{
			$stamp=strtotime('now');
			$timesql_c=$timesql.' and `status`=2';
			$param_c=array('task',$tbid);
			
			$timesql_un=$timesql.' and `status`=0 and endtime>0 and endtime<%d';
			$param_un=array('task',$tbid,$stamp);
		}
		
		$taskids_c=array();
		$taskids_un=array();
		$tasks_c=$tasks_un=array();
		foreach(DB::fetch_all("select taskid,worktime,money,statusuid from %t where $timesql_c ",$param_c) as $value){
			$taskids_c[$value['taskid']]=$value['taskid'];
			$tasks_c[$value['taskid']]=$value;
		}
		$param_c[0]=$param[0].'_archive';
		foreach(DB::fetch_all("select taskid,worktime,money,statusuid from %t where $timesql_c ",$param_c) as $value){
			$taskids_c[$value['taskid']]=$value['taskid'];
			$tasks_c[$value['taskid']]=$value;
		}
		
		foreach(DB::fetch_all("select taskid,worktime,money,statusuid from %t where $timesql_un ",$param_un) as $value){
			$taskids_un[$value['taskid']]=$value['taskid'];
			$tasks_un[$value['taskid']]=$value;
		}
		$param_c[0]=$param[0].'_archive';
		foreach(DB::fetch_all("select taskid,worktime,money,statusuid from %t where $timesql_un ",$param_un) as $value){
			$$taskids_un[$value['taskid']]=$value['taskid'];
			$tasks_un[$value['taskid']]=$value;
		}
		$ids=array_merge($taskids_un,$taskids_c);
		//获用户
		$users=array();
		$users_worktime=array();
		$users_money=array();
		$uids=array();
		$uid_taskids=array();
		foreach(C::t('task_user')->fetch_all_by_id_idtype($ids,'task',2,1) as $value){
			$uids[]=$value['uid'];
			$uid_taskids[]=$value['id'];
			if(in_array($value['id'],$taskids_un)){
				$users[$value['uid']]['uncompleted']+=1;
				$users[$value['uid']]['username']=$value['username'];
				if($tasks_un[$value['id']]['worktime']>0){
					$users_worktime[$value['uid']]['uncompleted']+=$tasks_un[$value['id']]['worktime'];
					$users_worktime[$value['uid']]['username']=$value['username'];
				}
				if($tasks_un[$value['id']]['money']>0){
					$users_money[$value['uid']]['uncompleted']+=$tasks_un[$value['id']]['money'];
					$users_money[$value['uid']]['username']=$value['username'];
				}
			}
			if(in_array($value['id'],$taskids_c)){
				$users[$value['uid']]['completed']+=1;
				$users[$value['uid']]['username']=$value['username'];
				if($tasks_c[$value['id']]['worktime']>0){
					$users_worktime[$value['uid']]['completed']+=$tasks_c[$value['id']]['worktime'];
					$users_worktime[$value['uid']]['username']=$value['username'];
				}
				if($tasks_c[$value['id']]['money']>0){
					$users_money[$value['uid']]['completed']+=$tasks_c[$value['id']]['money'];
					$users_money[$value['uid']]['username']=$value['username'];
				}
			}
		}
		foreach($tasks_c as $value){
			if(!in_array($value['taskid'],$uid_taskids)){
				$uarr=getuserbyuid($value['statusuid']);
				$users[$value['statusuid']]['completed']+=1;
				$users[$value['statusuid']]['username']=$uarr['username'];
				if($value['worktime']>0){
					$users_worktime[$value['statusuid']]['completed']+=$value['worktime'];
					$users_worktime[$value['statusuid']]['username']=$uarr['username'];
				}
				if($value['money']>0){
					$users_money[$value['statusuid']]['completed']+=$value['money'];
					$users_money[$value['statusuid']]['username']=$uarr['username'];
				}
			}
		}
		foreach($tasks_un as $value){
			if(!in_array($value['taskid'],$uid_taskids)){
				$users['noassign']['uncompleted']+=1;
				$users['noassign']['username']='未分配';
				if($value['worktime']>0){
					$users_worktime['noassign']['uncompleted']+=$value['worktime'];
					$users_worktime['noassign']['username']='未分配';
				}
				if($value['money']>0){
					$users_money['noassign']['uncompleted']+=$value['money'];
					$users_money['noassign']['username']='未分配';
				}
			}
		}
		$data=array('category'=>array(),'uncompleted'=>array(),'completed'=>array());
		foreach($users as $value){
			$data['category'][]=$value['username'];
			$data['uncompleted'][]=$value['uncompleted']?$value['uncompleted']:0;
			$data['completed'][]=$value['completed']?$value['completed']:0;
		}
		$data['category']=dimplode($data['category']);
		$data['uncompleted']=implode(',',$data['uncompleted']);
		$data['completed']=implode(',',$data['completed']);
		
		//工时
		$data_worktime=array('category'=>array(),'uncompleted'=>array(),'completed'=>array());
		foreach($users_worktime as $value){
			$data_worktime['category'][]=$value['username'];
			$data_worktime['uncompleted'][]=$value['uncompleted']?$value['uncompleted']:0;
			$data_worktime['completed'][]=$value['completed']?$value['completed']:0;
		}
		$data_worktime['category']=dimplode($data_worktime['category']);
		$data_worktime['uncompleted']=implode(',',$data_worktime['uncompleted']);
		$data_worktime['completed']=implode(',',$data_worktime['completed']);
		
		//预算
		$data_money=array('category'=>array(),'uncompleted'=>array(),'completed'=>array());
		foreach($users_money as $value){
			$data_money['category'][]=$value['username'];
			$data_money['uncompleted'][]=$value['uncompleted']?$value['uncompleted']:0;
			$data_money['completed'][]=$value['completed']?$value['completed']:0;
		}
		$data_money['category']=dimplode($data_money['category']);
		$data_money['uncompleted']=implode(',',$data_money['uncompleted']);
		$data_money['completed']=implode(',',$data_money['completed']);
		
		return array('complete'=>$data,'worktime'=>$data_worktime,'money'=>$data_money);
	}
	public function fetch_cat_stats_by_tbid($tbid,$time='',$date=''){
		//获取所有的任务完成数和过期数
		$param=array('task',$tbid);
		$timesql='tbid=%d and deletetime<1';
		if(!empty($time)){
			switch($time){
				case 'month':
					$stamp=strtotime($date);
					$arr=getdate($stamp);
					$low=strtotime($arr['year'].'-'.$arr['mon']);
					$up=strtotime('+1 month',$low);
					$timesql_c=$timesql.' and `status`=2 and statustime<%d and statustime>=%d';
					$param_c=array('task',$tbid,$up,$low);
					
					$timesql_un=$timesql.' and `status`=0 and endtime>0 and endtime<%d and endtime>=%d';
					$param_un=array('task',$tbid,$up,$low);
					
					break;
				case 'week':
					$stamp=strtotime($date);
					$arr=getdate($stamp);
					$low=strtotime('+'.(1-$arr['wday']).' day',$stamp);
					$up=strtotime('+1 week',$low);
					$timesql_c=$timesql.' and `status`=2 and statustime<%d and statustime>=%d';
					$param_c=array('task',$tbid,$up,$low);
					
					$timesql_un=$timesql.' and `status`=0 and endtime>0 and endtime<%d and endtime>=%d';
					$param_un=array('task',$tbid,$up,$low);
					
					break;
				case 'day':
					$stamp=strtotime($date);
					$arr=getdate($stamp);
					$low=strtotime('+'.(1-$arr['hours']).' day',$stamp);
					$up=strtotime('+1 day',$low);
					$timesql_c=$timesql.' and `status`=2 and statustime<%d and statustime>=%d';
					$param_c=array('task',$tbid,$up,$low);
					
					$timesql_un=$timesql.' and `status`=0 and endtime>0 and endtime<%d and endtime>=%d';
					$param_un=array('task',$tbid,$up,$low);
					
					
					break;
			}
		}else{
			$stamp=strtotime('now');
			$timesql_c=$timesql.' and `status`=2';
			$param_c=array('task',$tbid);
			
			$timesql_un=$timesql.' and `status`=0 and endtime>0 and endtime<%d';
			$param_un=array('task',$tbid,$stamp);
		}
		$taskids_c=array();
		$taskids_un=array();
		$tasks_c=$tasks_un=array();
		$data=array();
		$data_worktime=array();
		$data_money=array();
		foreach(DB::fetch_all("select catid,taskid,worktime,money from %t where $timesql_c ",$param_c) as $value){
			$taskids_c[$value['taskid']]=$value['taskid'];
			$tasks_c[$value['taskid']]=$value;
			$data[$value['catid']]['completed']+=1;
			if($value['worktime']>0){
				$data_worktime[$value['catid']]['completed']+=$value['worktime'];
			}
			if($value['money']>0){
				$data_money[$value['catid']]['completed']+=$value['money'];
			}
		}
		$param_c[0]=$param[0].'_archive';
		foreach(DB::fetch_all("select catid,taskid,worktime,money from %t where $timesql_c ",$param_c) as $value){
			$taskids_c[$value['taskid']]=$value['taskid'];
			$tasks_c[$value['taskid']]=$value;
			$data[$value['catid']]['completed']+=1;
			if($value['worktime']>0){
				$data_worktime[$value['catid']]['completed']+=$value['worktime'];
			}
			if($value['money']>0){
				$data_money[$value['catid']]['completed']+=$value['money'];
			}
		}
		
		foreach(DB::fetch_all("select catid,taskid,worktime,money from %t where $timesql_un ",$param_un) as $value){
			$taskids_un[$value['taskid']]=$value['taskid'];
			$tasks_un[$value['taskid']]=$value;
			$data[$value['catid']]['uncompleted']+=1;
			if($value['worktime']>0){
				$data_worktime[$value['catid']]['uncompleted']+=$value['worktime'];
			}
			if($value['money']>0){
				$data_money[$value['catid']]['uncompleted']+=$value['money'];
			}
		}
		$param_c[0]=$param[0].'_archive';
		foreach(DB::fetch_all("select catid,taskid,worktime,money from %t where $timesql_un ",$param_un) as $value){
			$$taskids_un[$value['taskid']]=$value['taskid'];
			$tasks_un[$value['taskid']]=$value;
			$data[$value['catid']]['uncompleted']+=1;
			if($value['worktime']>0){
				$data_worktime[$value['catid']]['uncompleted']+=$value['worktime'];
			}
			if($value['money']>0){
				$data_money[$value['catid']]['uncompleted']+=$value['money'];
			}
		}
		
		//获取分类列表
		$cats=array();
		$cats_worktime=array();
		$cats_money=array();
		$catarr=C::t('task_cat')->fetch_all_by_tbid($tbid,1);
		$cats=array('category'=>array(),'uncompleted'=>array(),'completed'=>array());
		foreach($data as $catid=> $value){
			if(!$catarr[$catid]) continue;
			$cats['category'][]=$catarr[$catid]['catname'];
			$cats['uncompleted'][]=$value['uncompleted']?$value['uncompleted']:0;
			$cats['completed'][]=$value['completed']?$value['completed']:0;
		}
		$cats['category']=dimplode($cats['category']);
		$cats['uncompleted']=implode(',',$cats['uncompleted']);
		$cats['completed']=implode(',',$cats['completed']);
		
		//工时
		$cats_worktime=array('category'=>array(),'uncompleted'=>array(),'completed'=>array());
		foreach($data_worktime as $catid=> $value){
			if(!$catarr[$catid]) continue;
			$cats_worktime['category'][]=$catarr[$catid]['catname'];
			$cats_worktime['uncompleted'][]=$value['uncompleted']?$value['uncompleted']:0;
			$cats_worktime['completed'][]=$value['completed']?$value['completed']:0;
		}
		$cats_worktime['category']=dimplode($cats_worktime['category']);
		$cats_worktime['uncompleted']=implode(',',$cats_worktime['uncompleted']);
		$cats_worktime['completed']=implode(',',$cats_worktime['completed']);
		
		//预算
		$cats_money=array('category'=>array(),'uncompleted'=>array(),'completed'=>array());
		foreach($data_money as $catid =>$value){
			if(!$catarr[$catid]) continue;
			$cats_money['category'][]=$catarr[$catid]['catname'];
			$cats_money['uncompleted'][]=$value['uncompleted']?$value['uncompleted']:0;
			$cats_money['completed'][]=$value['completed']?$value['completed']:0;
		}
		$cats_money['category']=dimplode($cats_money['category']);
		$cats_money['uncompleted']=implode(',',$cats_money['uncompleted']);
		$cats_money['completed']=implode(',',$cats_money['completed']);
		return array('complete'=>$cats,'worktime'=>$cats_worktime,'money'=>$cats_money);
	}
	public function fetch_label_stats_by_tbid($tbid,$time='',$date=''){
		//获取所有的任务完成数和过期数
		$param=array('task',$tbid);
		$timesql='tbid=%d and deletetime<1';
		if(!empty($time)){
			switch($time){
				case 'month':
					$stamp=strtotime($date);
					$arr=getdate($stamp);
					$low=strtotime($arr['year'].'-'.$arr['mon']);
					$up=strtotime('+1 month',$low);
					$timesql_c=$timesql.' and `status`=2 and statustime<%d and statustime>=%d';
					$param_c=array('task',$tbid,$up,$low);
					
					$timesql_un=$timesql.' and `status`=0 and endtime>0 and endtime<%d and endtime>=%d';
					$param_un=array('task',$tbid,$up,$low);
					
					break;
				case 'week':
					$stamp=strtotime($date);
					$arr=getdate($stamp);
					$low=strtotime('+'.(1-$arr['wday']).' day',$stamp);
					$up=strtotime('+1 week',$low);
					$timesql_c=$timesql.' and `status`=2 and statustime<%d and statustime>=%d';
					$param_c=array('task',$tbid,$up,$low);
					
					$timesql_un=$timesql.' and `status`=0 and endtime>0 and endtime<%d and endtime>=%d';
					$param_un=array('task',$tbid,$up,$low);
					
					break;
				case 'day':
					$stamp=strtotime($date);
					$arr=getdate($stamp);
					$low=strtotime('+'.(1-$arr['hours']).' day',$stamp);
					$up=strtotime('+1 day',$low);
					$timesql_c=$timesql.' and `status`=2 and statustime<%d and statustime>=%d';
					$param_c=array('task',$tbid,$up,$low);
					
					$timesql_un=$timesql.' and `status`=0 and endtime>0 and endtime<%d and endtime>=%d';
					$param_un=array('task',$tbid,$up,$low);
					
					
					break;
			}
		}else{
			$stamp=strtotime('now');
			$timesql_c=$timesql.' and `status`=2';
			$param_c=array('task',$tbid);
			
			$timesql_un=$timesql.' and `status`=0 and endtime>0 and endtime<%d';
			$param_un=array('task',$tbid,$stamp);
		}
		$taskids_c=array();
		$taskids_un=array();
		$tasks_c=$tasks_un=array();
		$labels=$labels_worktime=$labels_money=array();
		include_once libfile('function/taskboard');
		foreach(DB::fetch_all("select taskid,worktime,money,labels from %t where $timesql_c ",$param_c) as $value){
			$labelarr=getLabels($value['labels'],$tbid);
			foreach($labelarr as $label){
				$labels[$label['pow']]['title']=$label['title'];
				$labels[$label['pow']]['completed']+=1;
				if($value['worktime']>0){
					$labels_worktime[$label['pow']]['title']=$label['title'];
					$labels_worktime[$label['pow']]['completed']+=$value['worktime'];
				}
				if($value['money']>0){
					$labels_money[$label['pow']]['title']=$label['title'];
					$labels_money[$label['pow']]['completed']+=$value['money'];
				}
			}
		}
		$param_c[0]=$param[0].'_archive';
		foreach(DB::fetch_all("select taskid,worktime,money,labels from %t where $timesql_c ",$param_c) as $value){
			$labelarr=getLabels($value['labels'],$tbid);
			foreach($labelarr as $label){
				$labels[$label['pow']]['title']=$label['title'];
				$labels[$label['pow']]['completed']+=1;
				if($value['worktime']>0){
					$labels_worktime[$label['pow']]['title']=$label['title'];
					$labels_worktime[$label['pow']]['completed']+=$value['worktime'];
				}
				if($value['money']>0){
					$labels_money[$label['pow']]['title']=$label['title'];
					$labels_money[$label['pow']]['completed']+=$value['money'];
				}
			}
		}
		
		foreach(DB::fetch_all("select taskid,worktime,money,labels from %t where $timesql_un ",$param_un) as $value){
			$labelarr=getLabels($value['labels'],$tbid);
			foreach($labelarr as $label){
				$labels[$label['pow']]['title']=$label['title'];
				$labels[$label['pow']]['uncompleted']+=1;
				if($value['worktime']>0){
					$labels_worktime[$label['pow']]['title']=$label['title'];
					$labels_worktime[$label['pow']]['uncompleted']+=$value['worktime'];
				}
				if($value['money']>0){
					$labels_money[$label['pow']]['title']=$label['title'];
					$labels_money[$label['pow']]['uncompleted']+=$value['money'];
				}
			}
		}
		$param_c[0]=$param[0].'_archive';
		foreach(DB::fetch_all("select taskid,worktime,money,labels from %t where $timesql_un ",$param_un) as $value){
			$labelarr=getLabels($value['labels'],$tbid);
			foreach($labelarr as $label){
				$labels[$label['pow']]['title']=$label['title'];
				$labels[$label['pow']]['uncompleted']+=1;
				if($value['worktime']>0){
					$labels_worktime[$label['pow']]['title']=$label['title'];
					$labels_worktime[$label['pow']]['uncompleted']+=$value['worktime'];
				}
				if($value['money']>0){
					$labels_money[$label['pow']]['title']=$label['title'];
					$labels_money[$label['pow']]['uncompleted']+=$value['money'];
				}
			}
		}
		//获取分类列表
		$data=array();
		$data_worktime=array();
		$data_money=array();
		
		$data=array('category'=>array(),'uncompleted'=>array(),'completed'=>array());
		foreach($labels as $value){
			$data['category'][]=$value['title'];
			$data['uncompleted'][]=$value['uncompleted']?$value['uncompleted']:0;
			$data['completed'][]=$value['completed']?$value['completed']:0;
		}
		$data['category']=dimplode($data['category']);
		$data['uncompleted']=implode(',',$data['uncompleted']);
		$data['completed']=implode(',',$data['completed']);
		
		//工时
		$data_worktime=array('category'=>array(),'uncompleted'=>array(),'completed'=>array());
		foreach($labels_worktime as $value){
			$data_worktime['category'][]=$value['title'];
			$data_worktime['uncompleted'][]=$value['uncompleted']?$value['uncompleted']:0;
			$data_worktime['completed'][]=$value['completed']?$value['completed']:0;
		}
		$data_worktime['category']=dimplode($data_worktime['category']);
		$data_worktime['uncompleted']=implode(',',$data_worktime['uncompleted']);
		$data_worktime['completed']=implode(',',$data_worktime['completed']);
		
		//预算
		$data_money=array('category'=>array(),'uncompleted'=>array(),'completed'=>array());
		foreach($labels_money as $value){
			$data_money['category'][]=$value['title'];
			$data_money['uncompleted'][]=$value['uncompleted']?$value['uncompleted']:0;
			$data_money['completed'][]=$value['completed']?$value['completed']:0;
		}
		$data_money['category']=dimplode($data_money['category']);
		$data_money['uncompleted']=implode(',',$data_money['uncompleted']);
		$data_money['completed']=implode(',',$data_money['completed']);
		
		
		return array('complete'=>$data,'worktime'=>$data_worktime,'money'=>$data_money);
	}
	
	public function remove_orgid($orgid){
		return DB::query("update %t set orgid='0' where orgid=%d",array($this->_table,$orgid));
	}
}

?>
