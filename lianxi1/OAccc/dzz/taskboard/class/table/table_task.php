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

class table_task extends dzz_table_archive
{
	public function __construct() {

		$this->_table = 'task';
		$this->_pk    = 'taskid';
	   /* $this->_pre_cache_key = 'task_';
		$this->_cache_ttl = 0;*/

		parent::__construct();
	}
	public function insert($setarr,$field){
		$setarr['dateline']=TIMESTAMP;
		$setarr['disp']=DB::result_first("select max(disp) from %t where catid=%d ",array($this->_table,$setarr['catid']))+1;
		if($taskid=parent::insert($setarr,1)){
			C::t('task_board')->increase($setarr['tbid'],array('tasks'=>1));
			$field['taskid']=$taskid;
			C::t('task_field')->insert($field,0,1);
			//添加事件
				$event =array('uid'=>getglobal('uid'),
							  'username'=>getglobal('username'),
							  'tbid'=>$setarr['tbid'],
							  'body_template'=>'task_create',
							  'body_data'=>serialize(array('tbid'=>$arr['tbid'],'taskid'=>$taskid,'taskname'=>$field['name'])),
							  'dateline'=>TIMESTAMP,
							  'bz'=>'task_'.$taskid,
							  );
				C::t('task_event')->insert($event);
				return $taskid;
		}
	
		return false;
	}
	public function delete_by_taskid($taskid,$force=false){
		
		if($force ){
			return self::delete_permanent_by_taskid($taskid);
		}else{
			
			if(!$task=self::fetch_by_taskid($taskid)) return 0;
			$setarr=array('deleteuid'=>getglobal('uid'),'deletetime'=>TIMESTAMP);
			
			if($return=parent::update($taskid,$setarr)){
				
				//添加事件
				$event =array('uid'=>getglobal('uid'),
							  'username'=>getglobal('username'),
							  'tbid'=>$task['tbid'],
							  'body_template'=>'task_delete',
							  'body_data'=>serialize(array('tbid'=>$task['tbid'],'taskid'=>$taskid,'taskname'=>$task['name'])),
							  'dateline'=>TIMESTAMP,
							  'bz'=>'task_'.$taskid,
							  );
				C::t('task_event')->insert($event);
				return $return;
			}
		}
		return 0;
	}
	public function restore_by_taskid($taskid,$catid){
		if(!$task=self::fetch_by_taskid($taskid)) return 0;
		$setarr=array('deleteuid'=>getglobal('uid'),'deletetime'=>0);
		$setarr['catid']=$catid;
		$setarr['disp']=DB::result_first("select max(disp) from %t where catid=%d ",array($this->_table,$catid))+1;
		if($return=parent::update($taskid,$setarr)){
		//添加事件
			$event =array('uid'=>getglobal('uid'),
						  'username'=>getglobal('username'),
						  'tbid'=>$task['tbid'],
						  'body_template'=>'task_restore',
						  'body_data'=>serialize(array('tbid'=>$task['tbid'],'taskid'=>$taskid,'taskname'=>$task['name'])),
						  'dateline'=>TIMESTAMP,
						  'bz'=>'task_'.$taskid,
						  );
			C::t('task_event')->insert($event);
			return $return;
		}
		return 0;
	}
	public function delete_permanent_by_taskid($taskid){//彻底删除任务
		
		//删除任务子项
		C::t('task_sub')->delete_by_taskid($taskid);
		
		//删除相关事件
		C::t('task_event')->delete_by_bz('task_'.$taskid);
		
		//删除人员
		C::t('task_user')->delete_by_id_idtype($taskid,'task');
		
		//删除任务附件
		C::t('task_attach')->delete_by_taskid($taskid);
		
		//删除评论
		C::t('comment')->delete_by_id_idtype($taskid,'task');
		
		//更新任务版统计
		if($data=parent::fetch($taskid)){
			$updatearr=array(
							 'money'=>-$data['money'],
							 'money_u'=>-$data['money_u'],
							 'worktime_u'=>-$data['worktime_u'],
							 'worktime'=>-$data['worktime'],
							 'tasks'=>-1,
							 'tasks_c'=>($data['status']==2)?-1:0
							 );
			
			C::t('task_board')->increase($data['tbid'],$updatearr);
		}
		C::t('task_field')->delete($taskid,1,1);
		return parent::delete($taskid,1,1);
	}
	public function recycle_empty_by_tbid($tbid){
		 $ret=0;
		 foreach(DB::fetch_all("select taskid from %t where deletetime>0 and tbid=%d",array($this->_table,$tbid)) as $value){
			$ret+=self::delete_permanent_by_taskid($value['taskid']);
		 }
		 return $ret;
	 }
	public function increase($taskids,$fieldarr){
		$taskids=(array)$taskids;
		$sql = array();
		$num = 0;
		$allowkey = array('subs', 'subs_c',  'worktime', 'worktime_u', 'money', 'money_u','attachs','replys','imageaid');
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
		return  DB::query("UPDATE ".DB::table($this->_table)." SET ".implode(',', $sql)." WHERE taskid IN (".dimplode($taskids).")", 'UNBUFFERED');
	}
	
	public function update_by_taskid($taskid,$setarr){
		$task=self::fetch_by_taskid($taskid);
		if(parent::update($taskid,$setarr)){
			//处理事件
			if(isset($setarr['endtime']) && $task['endtime']!=$setarr['endtime']){//截止时间
				$body_data=array('taskid'=>$taskid,'taskname'=>$task['name']);
				$body_template=(!$task['endtime'])?'task_endtime_add':($setarr['endtime']?'task_endtime_change':'task_endtime_cancel');
				$body_data['oldendtime']=dgmdate($task['endtime'],'Y-m-d');
				$body_data['endtime']=dgmdate($setarr['endtime'],'Y-m-d');
				
				//添加事件
				$event =array('uid'=>getglobal('uid'),
							  'username'=>getglobal('username'),
							  'tbid'=>$task['tbid'],
							  'body_template'=>$body_template,
							  'body_data'=>serialize($body_data),
							  'dateline'=>TIMESTAMP,
							  'bz'=>'task_'.$taskid,
							  );
				C::t('task_event')->insert($event);
			}elseif(isset($setarr['money']) && $task['money']!=$setarr['money']){//预算
				//更新任务板统计
				C::t('task_board')->increase($task['tbid'],array('money'=>$setarr['money']-$task['money']));
				$body_data=array('taskid'=>$taskid,'taskname'=>$task['name']);
				$body_template=(!$task['money'])?'task_money_add':($setarr['money']?'task_money_change':'task_money_cancel');
				$body_data['oldmoney']=$task['money'];
				$body_data['money']=$setarr['money'];
				
				//添加事件
				$event =array('uid'=>getglobal('uid'),
							  'username'=>getglobal('username'),
							  'tbid'=>$task['tbid'],
							  'body_template'=>$body_template,
							  'body_data'=>serialize($body_data),
							  'dateline'=>TIMESTAMP,
							  'bz'=>'task_'.$taskid,
							  );
				C::t('task_event')->insert($event);
			}elseif(isset($setarr['worktime']) && $task['worktime']!=$setarr['worktime']){//预算
				//更新任务板统计
				C::t('task_board')->increase($task['tbid'],array('worktime'=>$setarr['worktime']-$task['worktime']));
				$body_data=array('taskid'=>$taskid,'taskname'=>$task['name']);
				$body_template=(!$task['worktime'])?'task_worktime_add':($setarr['worktime']?'task_worktime_change':'task_worktime_cancel');
				$body_data['oldworktime']=$task['worktime'];
				$body_data['worktime']=$setarr['worktime'];
				
				//添加事件
				$event =array('uid'=>getglobal('uid'),
							  'username'=>getglobal('username'),
							  'tbid'=>$task['tbid'],
							  'body_template'=>$body_template,
							  'body_data'=>serialize($body_data),
							  'dateline'=>TIMESTAMP,
							  'bz'=>'task_'.$taskid,
							  );
				C::t('task_event')->insert($event);
			}
			
			
			return true;
		}
		return false;
	}
	public function setLabel($taskid,$pow,$isadd=1){
		include_once libfile('function/taskboard','taskboard');
		$task=self::fetch_by_taskid($taskid);
		$alllabels=getLabelsBybtid($task['tbid']);
		if(!isset($alllabels[$pow])) return false;
		$labels=getLabels($task['labels'],$task['tbid']);
		if(!$isadd){
			unset($labels[$pow]);
			$action='task_label_remove';
		}else{
			$action='task_label_add';
			$labels[$pow]=$alllabels[$pow];
		}
		$label=0;
		foreach($labels as $key =>$value){
			$label+=$value['pow'];
		}
		if($return=parent::update($taskid,array('labels'=>$label))){
			//添加事件
				$event =array('uid'=>getglobal('uid'),
							  'username'=>getglobal('username'),
							  'tbid'=>$task['tbid'],
							  'body_template'=>$action,
							  'body_data'=>serialize(array('taskid'=>$taskid,'taskname'=>$task['name'],'color'=>$alllabels[$pow]['color'],'title'=>$alllabels[$pow]['title'])),
							  'dateline'=>TIMESTAMP,
							  'bz'=>'task_'.$taskid,
							  );
				C::t('task_event')->insert($event);
		}
		return $return;
		
	}
	
	public function setStatus($taskid,$status){
		$task=self::fetch_by_taskid($taskid);
		$setarr=array('statusuid'=>getglobal('uid'),'status'=>$status,'statustime'=>TIMESTAMP);
		$action='';
		if($task['status']=='0'){
			if($status==2){
				$action='task_completed';
				C::t('task_board')->increase($task['tbid'],array('tasks_c'=>1));
			}
		}elseif($task['status']==2){
			if($status=='0'){
				$action='task_uncompleted';
				C::t('task_board')->increase($task['tbid'],array('tasks_c'=>-1));
			}
		
		}
		if($action){ //添加事件
			$event =array('uid'=>getglobal('uid'),
						  'username'=>getglobal('username'),
						  'tbid'=>$task['tbid'],
						  'body_template'=>$action,
						  'body_data'=>serialize(array('tbid'=>$task['tbid'],'taskid'=>$taskid,'taskname'=>$task['name'])),
						  'dateline'=>TIMESTAMP,
						  'bz'=>'task_'.$taskid,
						  );
			C::t('task_event')->insert($event);
			if($ruids=C::t('task_user')->fetch_all_relative_uids_by_taskid($taskid)){
				$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=taskboard',1);
				foreach($ruids as $uid){
					if($uid!=getglobal('uid')){
						//发送通知
						$notevars=array(
										'from_id'=>$appid,
										'from_idtype'=>'app',
										'url'=>DZZSCRIPT.'?mod=taskboard&op=list&tbid='.$task['tbid'].'&taskid='.$taskid,
										'author'=>getglobal('username'),
										'authorid'=>getglobal('uid'),
										'dataline'=>dgmdate(TIMESTAMP),
										'taskname'=>getstr($task['name']),
										);
						
						dzz_notification::notification_add($uid, 'task_completed', $action, $notevars, 0,'dzz/taskboard');
					}
				}
			}
		}
		return parent::update($taskid,$setarr);
	}
	public function setDispByTaskid($taskid,$btaskid,$bcatid,$forward=1){ 
		//设置任务的显示顺序；
		$task=self::fetch_by_taskid($taskid);
		$ocatid=$task['catid'];
		if($btask=parent::fetch($btaskid)){
			$disp=$btask['disp'];
			$bcatid=$btask['catid'];
			if(DB::result_first("select COUNT(*) from %t where disp=%d and  catid=%d ",array($this->_table,$disp,$bcatid))){
				DB::query("update %t set disp=disp+1 where disp>%d  and  catid=%d ",array($this->_table,$disp,$bcatid));
				$disp=$btask['disp']+1;
			}
		}else{
			if(!$bcatid) return false;
			if($forward){
				$disp=DB::result_first("select min(disp) from %t where catid=%d ",array($this->_table,$bcatid))-1;
			}else{
				$disp=DB::result_first("select max(disp) from %t where catid=%d ",array($this->_table,$bcatid))+1;
			}
		}
		//跨任务列表时产生事件
		if($task['catid']!=$bcatid){
			$ocatname=DB::result_first("select catname from %t where catid=%d",array('task_cat',$task['catid']));
			$catname=DB::result_first("select catname from %t where catid=%d",array('task_cat',$bcatid));
			$event =array('uid'=>getglobal('uid'),
						  'username'=>getglobal('username'),
						  'tbid'=>$task['tbid'],
						  'body_template'=>'task_move',
						  'body_data'=>serialize(array('tbid'=>$task['tbid'],'taskid'=>$taskid,'taskname'=>$task['name'],'ocatname'=>$ocatname,'catname'=>$catname)),
						  'dateline'=>TIMESTAMP,
						  'bz'=>'task_'.$taskid,
						  );
			C::t('task_event')->insert($event);
		}
		return parent::update($taskid,array('disp'=>$disp,'catid'=>$bcatid));
	}
	
	public function fetch_by_taskid($taskid,$fetch_archive=0){
		 $data=array();
		 if($fetch_archive<2){
			 $data=DB::fetch_first("select t.* ,f.name ,f.description from %t t LEFT JOIN %t f ON t.taskid=f.taskid   where t.taskid=%d",array($this->_table,'task_field',$taskid));
			 if($fetch_archive && empty($data)){
				$data=DB::fetch_first("select t.* ,f.name ,f.description from %t t LEFT JOIN %t f ON t.taskid=f.taskid   where t.taskid=%d",array($this->_table.'_archive','task_field_archive',$taskid));
			 }
		 }else{
			 $data=DB::fetch_first("select t.* ,f.name ,f.description from %t t LEFT JOIN %t f ON t.taskid=f.taskid   where t.taskid=%d",array($this->_table.'_archive','task_field_archive',$taskid));
		 }
		
		 return $data;
	 }
	 public function copy_by_catid($ocatid,$catid){
		  foreach(DB::fetch_all("select taskid from %t where catid=%d and deletetime<1",array($this->_table,$ocatid)) as $value){
			  self::copy_by_taskid($value['taskid'],$catid,'',0);
		  }
		  return 0;
	 } 
	 public function copy_by_taskid($taskid,$catid,$name='',$event=1,$options=array('sub'=>1,'money'=>1,'worktime'=>1,'reply'=>1,'label'=>1,'attach'=>1,'assign'=>1,'follow'=>1)){
		 if(!$task=parent::fetch($taskid)){
			 return array('error'=>'任务不存在');
		 }
		 unset($task['taskid']);
		 $task['uid']=getglobal('uid');
		 $task['username']=getglobal('username');
		 if($catid) $task['catid']=$catid;
		 $task['dateline']=TIMESTAMP;
		 //是否copy标签
		 if($options['label']<1){
			$task['labels']=0; 
		 }
		 if($options['reply']<1){
			$task['replys']=0;
		 }
		 
		 if($options['money']<1){
			$task['money']=0;
		 }
		 
		 if($options['worktime']<1){
			$task['worktime']=0;
		 }
		 
		 //以下参数由分库添加；
		 $task['money_u']=0;
		 $task['worktime_u']=0;
		 $task['attachs']=0;
		 $task['subs']=0;
		 $task['subs_c']=0;
		 $oimageaid=$task['imageaid'];
		 $task['imageaid']=0;
		 if($task['taskid']=parent::insert($task,1)){
			 //拷贝field
			 if($field=C::t('task_field')->fetch($taskid)){
				$task['name']=$field['name']=$name?$name:$field['name'];
				$field['taskid']=$task['taskid'];
			 	C::t('task_field')->insert($field);
			 }
			 
			 //更新任务版统计
			 $fieldarr=array('tasks'=>1);
			 if($task['status']==2) $fieldarr['task_c']=1;
			 if($options['money'] && $task['money']) $fieldarr['money']=$task['money'];
			 if($options['worktime'] && $task['worktime']) $fieldarr['worktime']=$task['worktime'];
			 C::t('task_board')->increase($task['tbid'],$fieldarr);
			
			 //产生事件
			 if($event){
				$earr =array('uid'=>getglobal('uid'),
							  'username'=>getglobal('username'),
							  'tbid'=>$task['tbid'],
							  'body_template'=>'task_create',
							  'body_data'=>serialize(array('tbid'=>$task['tbid'],'taskid'=>$task['taskid'],'taskname'=>$field['name'])),
							  'dateline'=>TIMESTAMP,
							  'bz'=>'task_'.$task['taskid'],
							  );
				C::t('task_event')->insert($earr);
			 }
			 
			 //拷贝子库项目
			 
			 //copy分配用户
			 if($options['assign']>0){
				 C::t('task_user')->copy_by_taskid($taskid,$task['taskid'],2);
			 }
			 //copy关注用户
			 if($options['follow']>0){
				 C::t('task_user')->copy_by_taskid($taskid,$task['taskid'],1);
			 }
			 //copy检查项
			 if($options['sub']>0){
				 C::t('task_sub')->copy_by_taskid($taskid,$task['taskid']);
			 }
			/* //copy工时
			 if($options['worktime']>0){
				 C::t('task_worktime')->copy_by_taskid($taskid,$task['taskid']);
			 }
			 
			 //copy开销
			 if($options['money']>0){
				 C::t('task_money')->copy_by_taskid($taskid,$task['taskid']);
			 }*/
			 
			 //copy附件
			 if($options['attach']>0){
				 C::t('task_attach')->copy_by_taskid($taskid,$task['taskid'],$imageaid);
			 }
			 //copy评论
			 if($options['reply']>0){
				 C::t('comment')->copy_by_id_idtype($taskid,$task['taskid'],'task');
			 }
			 
			 return self::fetch_by_taskid($task['taskid']);
		 }
		return 0;
	 }
	 public function fetch_all_by_catid($catids,$status=array(0,1,2),$fetch_archive=0){
		 $catids=(array)$catids;
		
		 $sql=' and deletetime<1';
		 if($status){
			 $sql.=" and status IN (".dimplode($status).")";
		 }
		 $data=array();
		 if($fetch_archive<2){
			 $data= DB::fetch_all("select t.*,f.name from %t t LEFT JOIN %t f ON t.taskid=f.taskid  where t.catid IN(%n)  $sql order by t.disp $limitsql",array($this->_table,'task_field',$catids),$this->_pk);
			 if($fetch_archive){
				  $data1=DB::fetch_all("select t.*,f.name from %t t LEFT JOIN %t f ON t.taskid=f.taskid  where t.catid IN(%n)  $sql order by t.disp $limitsql",array($this->_table.'_archive','task_field_archive',$catids),$this->_pk);
				  $data=array_merge($data,$data1);
			 }
		 }else{
			 $data= DB::fetch_all("select t.*,f.name from %t t LEFT JOIN %t f ON t.taskid=f.taskid  where t.catid IN(%n)  $sql order by t.disp $limitsql",array($this->_table.'_archive','task_field_archive',$catids),$this->_pk);
		 }
		
		 return $data;
	}
    public function fetch_taskids_by_catid($catid,$fetch_archive=0){
		$data=array();
		if($fetch_archive<2){
			$data=DB::fetch_all("select taskid from %t where catid = %d ",array($this->_table,$catid));
			if($fetch_archive){
				 $data1=DB::fetch_all("select taskid from %t where catid = %d ",array($this->_table.'_archive',$catid));
				 $data=array_merge($data,$data1);
			}
		}else{
			$data=DB::fetch_all("select taskid from %t where catid = %d ",array($this->_table.'_archive',$catid));
		}
		$taskids=array();
		foreach($data as $value){
			$taskids[]=$value['taskid'];
		}
		return $taskids;
	}
	public function delete_by_catid($catid){//彻底删除分类下的所有任务；
		$taskids=self::fetch_taskids_by_catid($catid,1);
		$ret=false;
		foreach($taskids as $taskid){
			$ret+=self::delete_by_taskid($taskid,true);
		}
		return $ret;
	}
	
	public function archive_by_taskid($taskid,$event=1){
		 if($data=parent::fetch($taskid)){
			$data['archivetime']=TIMESTAMP;
			if($return=DB::query("REPLACE INTO %t SET ".DB::implode($data),array($this->_table.'_archive'),false,true)){
				parent::delete($taskid);
				//归档field附表
				if($field=C::t('task_field')->fetch($taskid)){
					if(DB::query("REPLACE INTO %t SET ".DB::implode($field),array('task_field_archive'),false,true)){
						C::t('task_field')->delete($taskid);
					}
				}
				//归档任务的相关附件
				C::t('task_attach')->archive_by_taskid($taskid);
				//归档任务子项
				C::t('task_sub')->archive_by_taskid($taskid);
				
				//归档任务用户表
				C::t('task_user')->archive_by_id_idtype($taskid,'task');
			
			//产生事件
				if($event){
					$earr =array('uid'=>getglobal('uid'),
								  'username'=>getglobal('username'),
								  'tbid'=>$data['tbid'],
								  'body_template'=>'task_archive',
								  'body_data'=>serialize(array('tbid'=>$data['tbid'],'taskid'=>$taskid,'taskname'=>$field['name'])),
								  'dateline'=>TIMESTAMP,
								  'bz'=>'task_'.$taskid,
								  );
					C::t('task_event')->insert($earr);
				}
				
			}
		}
		return $return;
	}
	
	public function active_by_taskid($taskid,$catid,$event=1){
		 if($data=C::t($this->_table.'_archive')->fetch($taskid)){
			unset($data['archivetime']);
			$data['catid']=$catid;
			//放在末尾
			$data['disp']=DB::result_first("select max(disp) from %t where catid=%d ",array($this->_table,$catid))+1;
			if($return=parent::insert($data,1,1)){
				C::t($this->_table.'_archive')->delete($taskid);
				//激活field附表
				if($field=C::t('task_field_archive')->fetch($taskid)){
					if(DB::query("REPLACE INTO %t SET ".DB::implode($field),array('task_field'),false,true)){
						C::t('task_field_archive')->delete($taskid);
					}
				}
				
				//激活任务子项
				C::t('task_sub')->active_by_taskid($taskid);
				
				
				//激活任务的相关附件
				C::t('task_attach')->active_by_taskid($taskid);
				
				//激活任务用户表
				C::t('task_user')->active_by_id_idtype($taskid,'task');
			
			//产生事件
				if($event){
					$earr =array('uid'=>getglobal('uid'),
								  'username'=>getglobal('username'),
								  'tbid'=>$data['tbid'],
								  'body_template'=>'task_active',
								  'body_data'=>serialize(array('tbid'=>$data['tbid'],'taskid'=>$taskid,'taskname'=>$field['name'])),
								  'dateline'=>TIMESTAMP,
								  'bz'=>'task_'.$taskid,
								  );
					C::t('task_event')->insert($earr);
				}
			}
		}
		return $return;
		
	}
	
	public function archive_by_catid($catid){
		 foreach(DB::fetch_all("select taskid from %t where catid = %d  ",array($this->_table,$catid)) as $value){
			   self::archive_by_taskid($value['taskid'],0);
		  }
		  return 0;
	 }
	  
	 public function active_by_catid($catid,$archivetime){ //根据autoarchive参数来判断要不要激活
		  foreach(DB::fetch_all("select taskid from %t where catid = %d and archivetime>=%d ",array($this->_table.'_archive',$catid,$archivetime)) as $value){
			   self::active_by_taskid($value['taskid'],$catid,0);
		  }
		  return 0;
	 }
	
	 //评论回调函数
	 public function callback_by_comment($comment,$action='add',$ats=array()){
		  include_once libfile('function/code');
		 $taskid=$comment['id'];
		 $replyaction='';
			$rpost=array();
				if($comment['rcid']>0){
					$rpost=C::t('comment')->fetch($comment['rcid']);
					$replyaction='_reply';
				}elseif($comment['pcid']>0){
					$rpost=C::t('comment')->fetch($comment['pcid']);
					$replyaction='_reply';
				}
		if($comment['pcid']==0){
			 //更新任务评论数
			 C::t('task')->increase($taskid,array('replys'=>($action=='add')?1:-1));
		}
		 //产生事件 
		 $task=self::fetch_by_taskid($taskid);
		 $event =array('uid'=>$comment['authorid'],
					  'username'=>$comment['author'],
					  'tbid'=>$task['tbid'],
					  'body_template'=>'task_comment_'.$action.$replyaction,
					  'body_data'=>serialize(array('author'=>$rpost['author'],'tbid'=>$task['tbid'],'taskid'=>$taskid,'taskname'=>$task['name'],'comment'=>($comment['message']))),
					  'dateline'=>TIMESTAMP,
					  'bz'=>'task_'.$taskid,
					  );
		C::t('#taskboard#task_event')->insert($event);
		$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=taskboard',1);
		//$taskboard=C::t('#taskboard#task_board')->fetch($task['tbid']);
		if($action=='add' && $ats){//如果评论中@用户时，给用户发送通知
			foreach($ats as $uid){
				//发送通知
				if($uid!=getglobal('uid')){
						
						//发送通知
						
						$notevars=array(
										'from_id'=>$appid,
										'from_idtype'=>'app',
										'url'=>DZZSCRIPT.'?mod=taskboard&op=list&tbid='.$task['tbid'].'&taskid='.$task['taskid'],
										'author'=>getglobal('username'),
										'authorid'=>getglobal('uid'),
										'dataline'=>dgmdate(TIMESTAMP),
										'taskname'=>getstr($task['name']),
										'comment'=>($comment['message']),
										);
						
						dzz_notification::notification_add($uid, 'task_comment_at', 'task_comment_at', $notevars, 0,'dzz/taskboard');
				}
			}
		}
		if($action=='add'){
			if($comment['pcid']==0){
				//发送通知,通知文档的作者；
				foreach(C::t('#taskboard#task_user')->fetch_all_by_id_idtype($taskid,'task',2) as $value){
					if($value['uid']!=getglobal('uid')){
							
							//发送通知
							$notevars=array(
											'from_id'=>$appid,
											'from_idtype'=>'app',
											'url'=>DZZSCRIPT.'?mod=taskboard&op=list&tbid='.$task['tbid'].'&taskid='.$task['taskid'],
											'author'=>getglobal('username'),
											'authorid'=>getglobal('uid'),
											'dataline'=>dgmdate(TIMESTAMP),
											'taskname'=>getstr($task['name']),
											'comment'=>($comment['message']),
											);
							
							dzz_notification::notification_add($value['uid'], 'task_comment_'.$taskid, 'task_comment', $notevars, 0,'dzz/taskboard');
					}
				}
			}else{
				//通知原评论人	
				if($rpost['uid']!=getglobal('uid')){
						$notevars=array(
										'from_id'=>$appid,
										'from_idtype'=>'app',
										'url'=>DZZSCRIPT.'?mod=taskboard&op=list&tbid='.$task['tbid'].'&taskid='.$task['taskid'],
										'author'=>getglobal('username'),
										'authorid'=>getglobal('uid'),
										'dataline'=>dgmdate(TIMESTAMP),
										'taskname'=>getstr($task['name']),
										'comment'=>($comment['message']),
										);
						
						dzz_notification::notification_add($rpost['authorid'], 'task_comment_reply_'.$class[$cid], 'task_comment_reply', $notevars, 0,'dzz/taskboard');
				}
			}
		}
		
	 }
	 public function fetch_all_by_tbid_from_archive($tbid,$limit='',$keyword='',$starttime=0,$endtime=0,$iscount=false){
		 static $datemin=array();
		$limitsql='';
		if($limit){
			$limit=explode('-',$limit);
			if(count($limit)>1){
				$limitsql.=" limit ".intval($limit[0]).",".intval($limit[1]);
			}else{
				$limitsql.=" limit ".intval($limit[0]);
			}
		}
		$searchsql=' and deletetime<1';
		$param=array($this->_table.'_archive','task_field_archive',$tbid);
		if(!empty($keyword)){
			$param[]='%'.$keyword.'%';
			$searchsql.=' and ( f.name like %s )';
		}
		if(!empty($starttime)){
			$param[]=$starttime;
			$searchsql.=' and ( t.archivetime > %d )';
		}
		if(!empty($endtime)){
			$param[]=$endtime;
			$searchsql.=' and ( t.archivetime < %d )';
		}
		
		$orderby=" order by t.archivetime DESC";
		
		if($iscount) return DB::result_first("select COUNT(*) from %t t LEFT JOIN %t f ON t.taskid=f.taskid  where t.tbid=%d $searchsql",$param,$this->_pk);
	    
		$data=DB::fetch_all("select t.*,f.name from %t t LEFT JOIN %t f ON t.taskid=f.taskid  where t.tbid=%d $searchsql $orderby $limitsql",$param,$this->_pk);
		
		foreach($data as $key =>$value){
			$value['date']=dgmdate($value['archivetime'],'Y-m-d');
			$darr=explode('-',$value['date']);
			$value['fdate']=$darr[0].'年'.$darr[1].'月'.$darr[2].'日';
			if(!isset($datemin[$value['date']])){
				$arr=array();
				$arr[]=strtotime($value['date']);
				$arr[]=strtotime('+24 hours',strtotime($value['date']));
				
				$datemin[$value['date']]=DB::result_first("select max(t.archivetime) from %t t LEFT JOIN %t f ON t.taskid=f.taskid  where t.tbid=%d $searchsql and t.archivetime>=%d and t.archivetime<%d",array_merge($param,$arr));
			}
			if($value['archivetime']==$datemin[$value['date']]){
				$value['showdate']=1;
				$datemin[$value['date']].='_';
			}
			if($value['labels']>0) $value['labels']=getLabels($value['labels'],$value['tbid']);
			if($value['endtime']){
				 $dformat='Y-m-d';
				 if(strtotime(dgmdate(TIMESTAMP,'Y'))==strtotime(dgmdate($value['endtime'],'Y'))){
					 $dformat='m-d';
				 }
				 $value['fendtime']=dgmdate($value['endtime'],$dformat);
			}
			$value['user_assign']=C::t('task_user')->fetch_all_by_id_idtype($value['taskid'],'task',2,1);
			$data[$key]=$value;
		}
		return $data;
	 }
	 public function fetch_all_delete_by_tbid($tbid,$limit='',$keyword='',$starttime=0,$endtime=0,$iscount=false){
		 static $datemin=array();
		$limitsql='';
		if($limit){
			$limit=explode('-',$limit);
			if(count($limit)>1){
				$limitsql.=" limit ".intval($limit[0]).",".intval($limit[1]);
			}else{
				$limitsql.=" limit ".intval($limit[0]);
			}
		}
		$searchsql=' and deletetime>0';
		$param=array($this->_table,'task_field',$tbid);
		if(!empty($keyword)){
			$param[]='%'.$keyword.'%';
			$searchsql=' and ( f.name like %s )';
		}
		if(!empty($starttime)){
			$param[]=$starttime;
			$searchsql.=' and ( t.archivetime > %d )';
		}
		if(!empty($endtime)){
			$param[]=$endtime;
			$searchsql.=' and ( t.archivetime < %d )';
		}
		
		$orderby=" order by t.deletetime DESC";
		
		if($iscount) return DB::result_first("select COUNT(*) from %t t LEFT JOIN %t f ON t.taskid=f.taskid  where t.tbid=%d $searchsql",$param,$this->_pk);
	    
		$data=DB::fetch_all("select t.*,f.name from %t t LEFT JOIN %t f ON t.taskid=f.taskid  where t.tbid=%d $searchsql $orderby $limitsql",$param,$this->_pk);
		
		foreach($data as $key =>$value){
			$value['date']=dgmdate($value['deletetime'],'Y-m-d');
			$darr=explode('-',$value['date']);
			$value['fdate']=$darr[0].'年'.$darr[1].'月'.$darr[2].'日';
			if(!isset($datemin[$value['date']])){
				$arr=array();
				$arr[]=strtotime($value['date']);
				$arr[]=strtotime('+24 hours',strtotime($value['date']));
				
				$datemin[$value['date']]=DB::result_first("select max(t.deletetime) from %t t LEFT JOIN %t f ON t.taskid=f.taskid  where t.tbid=%d $searchsql and t.deletetime>=%d and t.deletetime<%d",array_merge($param,$arr));
			}
			if($value['deletetime']==$datemin[$value['date']]){
				$value['showdate']=1;
				$datemin[$value['date']].='_';
			}
			if($value['labels']>0) $value['labels']=getLabels($value['labels'],$value['tbid']);
			if($value['endtime']){
				 $dformat='Y-m-d';
				 if(strtotime(dgmdate(TIMESTAMP,'Y'))==strtotime(dgmdate($value['endtime'],'Y'))){
					 $dformat='m-d';
				 }
				 $value['fendtime']=dgmdate($value['endtime'],$dformat);
			}
			$value['user_assign']=C::t('task_user')->fetch_all_by_id_idtype($value['taskid'],'task',2,1);
			
			$data[$key]=$value;
		}
		return $data;
	 }
}

?>
