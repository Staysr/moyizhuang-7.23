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

class table_task_sub extends dzz_table_archive
{
	public function __construct() {

		$this->_table = 'task_sub';
		$this->_pk    = 'subid';

		parent::__construct();
	}
	public function delete_by_subid($subid){
		$ret=false;
		if(!$data=parent::fetch($subid)) return 0;
		$updatearr=array('subs'=>-1);
		if($data['completed']>0){
			$updatearr['subs_c']=-1;
		}
		if($ret=parent::delete($subid)){
			//更新任务完成度
			C::t('task')->increase($data['taskid'],$updatearr);
			//产生事件
				$task=C::t('task_field')->fetch($data['taskid']);
				$event =array(    'uid'=>getglobal('uid'),
								  'username'=>getglobal('username'),
								  'tbid'=>$data['tbid'],
								  'body_template'=>'task_sub_delete',
								  'body_data'=>serialize(array('tbid'=>$data['tbid'],'taskid'=>$data['taskid'],'taskname'=>$task['name'],'subname'=>$data['subname'])),
								  'dateline'=>TIMESTAMP,
								  'bz'=>'task_'.$data['taskid'],
								  );
					C::t('task_event')->insert($event);
		}
		return $ret;
	}
	public function rename_by_subid($subid,$val){
		$data=parent::fetch($subid);
		if($ret=parent::update($subid,array('subname'=>trim($val)))){
			
			//产生事件
			    $task=C::t('task_field')->fetch($data['taskid']);
				$event =array(    'uid'=>getglobal('uid'),
								  'username'=>getglobal('username'),
								  'tbid'=>$data['tbid'],
								  'body_template'=>'task_sub_rename',
								  'body_data'=>serialize(array('tbid'=>$data['tbid'],'taskid'=>$data['taskid'],'taskname'=>$task['name'],'subname'=>$val,'osubname'=>$data['subname'])),
								  'dateline'=>TIMESTAMP,
								  'bz'=>'task_'.$data['taskid'],
								  );
					C::t('task_event')->insert($event);
			return $ret;
		}else return false;
	}
	public function insert($arr){
		$subid=0;
		$arr['disp']=DB::result_first("select max(disp) from %t where taskid=%d",array($this->_table,$arr['taskid']))+1;
		if($subid=parent::insert($arr,1)){
			//更新任务完成度
			C::t('task')->increase($arr['taskid'],array('subs'=>1));
			//产生事件
			if($task=C::t('task_field')->fetch($arr['taskid'])){
			 	$event =array('uid'=>getglobal('uid'),
							  'username'=>getglobal('username'),
							  'tbid'=>$arr['tbid'],
							  'body_template'=>'task_sub_add',
							  'body_data'=>serialize(array('tbid'=>$arr['tbid'],'taskid'=>$task['taskid'],'taskname'=>$task['name'],'subname'=>$arr['subname'])),
							  'dateline'=>TIMESTAMP,
							  'bz'=>'task_'.$task['taskid'],
							  );
				C::t('task_event')->insert($event);
			}
		}
		return $subid;
	}
	public function setDispBySubid($subid,$bsubid,$taskid,$forward=1){ 
		//设置任务的显示顺序；
		if($bsub=parent::fetch($bsubid)){
			$disp=$bsub['disp'];
			if(DB::result_first("select COUNT(*) from %t where disp=%d and  taskid=%d ",array($this->_table,$disp,$taskid))){
				DB::query("update %t set disp=disp+1 where disp>%d  and  taskid=%d ",array($this->_table,$disp,$taskid));
				$disp=$bsub['disp']+1;
			}
		}else{
			if($forward){
				$disp=DB::result_first("select min(disp) from %t where taskid=%d ",array($this->_table,$taskid))-1;
			}else{
				$disp=DB::result_first("select max(disp) from %t where taskid=%d ",array($this->_table,$taskid))+1;
			}
		}
		
		return parent::update($subid,array('disp'=>$disp));
	}
  	public function setStatusBySubid($subid,$val){
		$data=parent::fetch($subid);
		
		if($ret=parent::update($subid,array('completed'=>intval($val),'completeuid'=>getglobal('uid')))){
			$action='';
			$ceof=0;
			if($data['completed']>0 && $val==0){
				$action='task_sub_uncomplete';
				$ceof=-1;
			}else{
				$action='task_sub_complete';
				$ceof=1;
			}
			//更新任务完成度
			C::t('task')->increase($data['taskid'],array('subs_c'=>$ceof));
			//C::t('task_board')->increase($data['tbid'],array('subs_c'=>$ceof));
			
			//产生事件
			    $task=C::t('task_field')->fetch($data['taskid']);
				$event =array(    'uid'=>getglobal('uid'),
								  'username'=>getglobal('username'),
								  'tbid'=>$data['tbid'],
								  'body_template'=>$action,
								  'body_data'=>serialize(array('tbid'=>$data['tbid'],'taskid'=>$data['taskid'],'taskname'=>$task['name'],'subname'=>$data['subname'])),
								  'dateline'=>TIMESTAMP,
								  'bz'=>'task_'.$data['taskid'],
								  );
					C::t('task_event')->insert($event);
			return $ret;
		}else return false;
	}
	 public function delete_by_taskid($taskids,$fetch_archive=1){
		$taskids=(array)$taskids;
		$ret=false;
		if($fetch_archive<2){
			$ret=DB::delete($this->_table,"taskid IN (".dimplode($taskids).")");
			if($fetch_archive){
				 $_ret=DB::delete($this->_table.'_archive',"taskid IN (".dimplode($taskids).")");
				 $ret+=$_ret;
			}
		}else{
			$ret=DB::delete($this->_table.'_archive',"taskid IN (".dimplode($taskids).")");
		}
		return $ret;
	}
	
	public function fetch_all_by_taskid($taskids,$fetch_archive=1){
		$taskids=(array)$taskids;
		
		$data=array();
		if($fetch_archive<2){
			$data= DB::fetch_all("select * from %t where taskid IN(%n) order by disp",array($this->_table,$taskids));
			if($fetch_archive && empty($data)) $data= DB::fetch_all("select * from %t where taskid IN(%n) order by disp",array($this->_table.'_archive',$taskids));
		}else{
			$data= DB::fetch_all("select * from %t where taskid IN(%n) order by disp",array($this->_table.'_archive',$taskid));
		}
		return $data;
	}
	
	public function archive_by_taskid($taskids){
		$taskids=(array)$taskids;
		$data=array();
		$data= DB::fetch_all("select * from %t where taskid IN(%n)",array($this->_table,$taskids));
		$subids=array();
		foreach($data as $value){
			if(DB::query("REPLACE INTO %t SET ".DB::implode($value),array($this->_table.'_archive'),false,true)){
				$subids[]=$value['subid'];
			}
		}
		return DB::delete($this->_table,"subid IN (".dimplode($subids).")");
	}
	public function active_by_taskid($taskids){
		$taskids=(array)$taskids;
		$data=array();
		$data= DB::fetch_all("select * from %t where taskid IN(%n)",array($this->_table.'_archive',$taskids));
		$subids=array();
		foreach($data as $value){
			if(DB::query("REPLACE INTO %t SET ".DB::implode($value),array($this->_table),false,true)){
				$subids[]=$value['subid'];
			}
		}
		return DB::delete($this->_table.'_archive',"subid IN (".dimplode($subids).")");
	}
	
	public function copy_by_taskid($otaskid,$taskid){
		foreach(self::fetch_all_by_taskid($otaskid,0) as $value){
			$setarr=array('tbid'=>$value['tbid'],
						  'taskid'=>$taskid,
						  'subname'=>$value['subname'],
						  'uid'=>$value['uid'],
						  'completed'=>$value['completed'],
						  'disp'=>$value['disp'],
						  'completeuid'=>$value['completeuid'],
						  'dateline'=>TIMESTAMP
						 );
			if(parent::insert($setarr)){
				//更新任务和任务版统计
				C::t('task')->increase($taskid,array('subs'=>1,'subs_c'=>$setarr['completed']>0?1:0));
			}
		}
	}
}

?>
