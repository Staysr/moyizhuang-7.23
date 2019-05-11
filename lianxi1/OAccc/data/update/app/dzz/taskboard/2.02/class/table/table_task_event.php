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

class table_task_event extends dzz_table
{
	public function __construct() {

		$this->_table = 'task_event';
		$this->_pk    = 'eid';

		parent::__construct();
	}
	
	public function fetch_all_by_bz($bz,$fetch_archive=1){
		$ret=array();
		$ret=DB::fetch_all("select * from %t where bz=%s order by dateline DESC",array($this->_table,$bz));
		if($fetch_archive){
			$ret1=DB::fetch_all("select * from %t where bz=%s order by dateline DESC",array($this->_table.'_archive',$bz));
			$ret=array_merge($ret,$ret1);
		}
		return $ret;
	}
  	 public function delete_by_bz($bz,$fetch_archive=1){
		$ret1=0;
		$ret= DB::delete($this->_table,"bz IN (".dimplode($bz).")");
		if($fetch_archive) $ret1= DB::delete($this->_table.'_archive',"bz IN (".dimplode($bz).")");
		return $ret+$ret1;
	 }
	 public function delete_by_taskid($taskids,$fetch_archive=1){
		$where=array();
		foreach((array)$taskids as $taskid){
			$where[]='task_'.intval($taskid);
		}
		$ret1=0;
		$ret= DB::delete($this->_table,"bz IN (".dimplode($where).")");
		if($fetch_archive) $ret1= DB::delete($this->_table.'_archive',"bz IN (".dimplode($where).")");
		return 	$ret+$ret1;
	}
	 public function delete_by_tbid($tbids,$fetch_archive=1){
		$tbids=(array)$tbids;
		$ret1=0;
		$ret=DB::delete($this->_table,"tbid IN (".dimplode($tbids).")");
		if($fetch_archive) $ret1=DB::delete($this->_table.'_archive',"tbid IN (".dimplode($tbids).")");
		return  $ret+$ret1;
	}
	public function fetch_all_by_taskid($taskids,$fetch_archive=1){
		$where=array();
		foreach((array)$taskids as $taskid){
			$where[]='task_'.intval($taskid);
		}
		
		$ret=DB::fetch_all("select * from %t where bz IN(%n)",array($this->_table,$where));
		if($fetch_archive){
			$ret1=DB::fetch_all("select * from %t where bz IN(%n)",array($this->_table.'_archive',$where));
			$ret=array_merge($ret,$ret1);
		}
		return 	$ret;
	}
	public function fetch_all_by_tbid($tbid,$fetch_archive=1){
		$ret= DB::fetch_all("select * from %t where tbid=%d",array($this->_table,$tbid));
		if($fetch_archive){
			$ret1=DB::fetch_all("select * from %t where tbid=%d",array($this->_table.'_archive',$tbid));
			$ret=array_merge($ret,$ret1);
		}
		return 	$ret+$ret1;
	}
	
	public function fetch_all_by_tbid_date($tbid,$limit='',$uid=0,$iscount=false,$fetch_archive=1){
		global $eventshow;
		static $datemin=array();
		
		
		$uid=intval($uid);
		$uidsql='';
		if($uid){
			$uidsql.=" and uid = '{$uid}'";
		}
		$count= DB::result_first("select COUNT(*) from %t where tbid=%d  $uidsql  ",array($this->_table,$tbid));
		if($fetch_archive) $count1= DB::result_first("select COUNT(*) from %t where tbid=%d  $uidsql  ",array($this->_table.'_archive',$tbid));
		if($iscount) return $count+$count1;
		
		$limitsql='';
		
		if($limit){
			$limit=explode('-',$limit);
			if(count($limit)>1){
				
			}else{
				$limit[1]=$limit[0];
				$limit[0]=0;
			}
			if($fetch_archive){	
				if($limit[0]>$count){//全部在归档表里
					$limitsql=" limit ".(intval($limit[0])-$count).",".intval($limit[1]);
					$data= DB::fetch_all("select * from %t where tbid=%d $uidsql order by dateline DESC $limitsql",array($this->_table.'_archive',$tbid));
				}elseif($limit[0]+$limit[1]<$count){//全部在主表里；
					$limitsql=" limit ".intval($limit[0]).",".intval($limit[1]);
					$data= DB::fetch_all("select * from %t where tbid=%d $uidsql order by dateline DESC $limitsql",array($this->_table,$tbid));
					
				}else{//两边都有
					$limitsql=" limit ".intval($limit[0]).",".intval($limit[1]);
					$data= DB::fetch_all("select * from %t where tbid=%d $uidsql order by dateline DESC $limitsql",array($this->_table,$tbid));
					$limitsql=" limit ".(intval($limit[1])-count($data));
					$data1= DB::fetch_all("select * from %t where tbid=%d $uidsql order by dateline DESC $limitsql",array($this->_table.'_archive',$tbid));
					$data=array_merge($data,$data1);
				}
			}else{
				$limitsql.=" limit ".intval($limit[0]).",".intval($limit[1]);
				$data= DB::fetch_all("select * from %t where tbid=%d $uidsql order by dateline DESC $limitsql",array($this->_table,$tbid));
			}
		}else{
			$data= DB::fetch_all("select * from %t where tbid=%d $uidsql order by dateline DESC",array($this->_table,$tbid));
			if($fetch_archive){
				$data1= DB::fetch_all("select * from %t where tbid=%d $uidsql order by dateline DESC",array($this->_table.'_archive',$tbid));
				$data=array_merge($data,$data1);
			}
		}
		
		foreach($data as $key =>$value){
			$value['date']=dgmdate($value['dateline'],'Y-m-d');
			if(!isset($datemin[$value['date']])){
				$dateline_low=strtotime($value['date']);
				$dateline_up=strtotime('+24 hours',$dateline_low);
				if($fetch_archive){
					$datemin[$value['date']]=max(DB::result_first("select max(dateline) from %t where tbid=%d and dateline>=%d and dateline<%d $uidsql",array($this->_table,$bz,$dateline_low,$dateline_up)),DB::result_first("select max(dateline) from %t where tbid=%d and dateline>=%d and dateline<%d $uidsql",array($this->_table,$tbid,$dateline_low,$dateline_up)));
				}else{
					$datemin[$value['date']]=DB::result_first("select max(dateline) from %t where tbid=%d and dateline>=%d and dateline<%d $uidsql",array($this->_table,$tbid,$dateline_low,$dateline_up));
				}
			
			}
			
			if($value['dateline']==$datemin[$value['date']]){
				$value['showday']=1;
				$datemin[$value['date']].='_';
			}
			$value['body_data']=unserialize($value['body_data']);
			$value['body_data']['dzzscript']=DZZSCRIPT;
			$value['body_data']['tbid']=$value['tbid'];
			$value['body_data']['modurl']=MOD_URL;
			if(!isset($value['body_data']['url'])){
				$value['body_data']['url']=MOD_URL.'&op=list&tbid='.$value['tbid'].'&taskid='.$value['body_data']['taskid'];
			}
			$value['body']=lang($value['body_template'],$value['body_data']);
			$value['body']=preg_replace("/\{intask\}.+?\{\/intask\}/i",'',$value['body']);
			$value['show']=$eventshow[$value['body_template']];
			
			$data[$key]=$value;
		}
		
		return $data;
	}
	public function fetch_all_by_bz_date($bz,$limit=0,$uid=0,$iscount=false,$fetch_archive=1){
		global $eventshow;
		static $datemin=array();
		
		$uid=intval($uid);
		//$dateline=strtotime($date);
		$uidsql='';
		if($uid){
			$uidsql.=" and uid = '{$uid}'";
		}
		
		$count= DB::result_first("select COUNT(*) from %t where bz=%s  $uidsql ",array($this->_table,$bz,$dateline));
		if($iscount) return $count;
		$data= DB::fetch_all("select * from %t where bz=%s $uidsql order by dateline DESC $limitsql ",array($this->_table,$bz));
		
		
		$count= DB::result_first("select COUNT(*) from %t where bz=%s  $uidsql ",array($this->_table,$bz));
		if($fetch_archive) $count1= DB::result_first("select COUNT(*) from %t where bz=%s  $uidsql ",array($this->_table.'_archive',$bz));
		if($iscount) return $count+$count1;
		
		$limitsql='';
		
		if($limit){
			$limit=explode('-',$limit);
			if(count($limit)>1){
				
			}else{
				$limit[1]=$limit[0];
				$limit[0]=0;
			}
			if($fetch_archive){	
				if($limit[0]>$count){//全部在归档表里
					$limitsql=" limit ".(intval($limit[0])-$count).",".intval($limit[1]);
					$data= DB::fetch_all("select * from %t where bz=%s $uidsql order by dateline DESC $limitsql ",array($this->_table.'_archive',$bz));
				}elseif($limit[0]+$limit[1]<$count){//全部在主表里；
					$limitsql=" limit ".intval($limit[0]).",".intval($limit[1]);
					$data= DB::fetch_all("select * from %t where bz=%s $uidsql order by dateline DESC $limitsql ",array($this->_table,$bz));
					
				}else{//两边都有
					$limitsql=" limit ".intval($limit[0]).",".intval($limit[1]);
					$data= DB::fetch_all("select * from %t where bz=%s $uidsql order by dateline DESC $limitsql ",array($this->_table,$bz));
					$limitsql=" limit ".(intval($limit[1])-count($data));
					$data1= DB::fetch_all("select * from %t where bz=%s $uidsql order by dateline DESC $limitsql ",array($this->_table.'_archive',$bz));
					$data=array_merge($data,$data1);
				}
			}else{
				$limitsql=" limit ".intval($limit[0]).",".intval($limit[1]);
				$data= DB::fetch_all("select * from %t where bz=%s $uidsql order by dateline DESC $limitsql ",array($this->_table,$bz));
			}
		}else{
			$data= DB::fetch_all("select * from %t where bz=%s $uidsql order by dateline DESC",array($this->_table,$bz));
			if($fetch_archive){
				$data1= DB::fetch_all("select * from %t where bz=%s $uidsql order by dateline DESC",array($this->_table.'_archive',$bz));
				$data=array_merge($data,$data1);
			}
		}
		
		foreach($data as $key =>$value){
			$value['date']=dgmdate($value['dateline'],'y-m-d');
			if(!isset($datemin[$value['date']])){
				$dateline_low=strtotime($value['date']);
				$dateline_up=strtotime('+24 hours',$dateline_low);
				if($fetch_archive){
					$datemin[$value['date']]=max(DB::result_first("select max(dateline) from %t where bz=%s and dateline>=%d and dateline<%d $uidsql",array($this->_table,$bz,$dateline_low,$dateline_up)),DB::result_first("select max(dateline) from %t where bz=%s and dateline>=%d and dateline<%d $uidsql",array($this->_table.'_archive',$bz,$dateline_low,$dateline_up)));
				}else{
					$datemin[$value['date']]=DB::result_first("select max(dateline) from %t where bz=%s and dateline>=%d and dateline<%d $uidsql",array($this->_table,$bz,$dateline_low,$dateline_up));
				}
			}
			if($value['dateline']==$datemin[$value['date']]){
				$value['showday']=1;
			}
			$value['body_data']=unserialize($value['body_data']);
			$value['body_data']['dzzscript']=DZZSCRIPT;
			$value['body_data']['tbid']=$value['tbid'];
			$value['body_data']['modurl']=MOD_URL;
			if(!isset($value['body_data']['url'])){
				$value['body_data']['url']=MOD_URL.'&op=list&tbid='.$value['tbid'].'&taskid='.$value['body_data']['taskid'];
			}
			$value['body']=lang($value['body_template'],$value['body_data']);
			
			if(preg_match("/\{intask\}(.+?)\{\/intask\}/i",$value['body'],$matches)){
				$value['body']=$matches[1];
			}
			$value['show']=$eventshow[$value['body_template']];
			
			$data[$key]=$value;
		}
		return $data;
	}
	
	
	public function archive_by_tbid($tbid){
		$data = array();
		$data= DB::fetch_all("select * from %t where tbid=%d",array($this->_table,$tbid));
		$eids=array();
		foreach($data as $value){
			if(DB::insert(DB::table($this->_table.'_archive'),$value,false,true,true)){
				$eids[]=$value['eid'];
			}
		}
		return DB::delete($this->_table,"eid IN (".dimplode($eids).")");
	}
	public function active_by_tbid($tbid){
		$data = array();
		$data= DB::fetch_all("select * from %t where tbid=%d",array($this->_table.'_archive',$tbid));
		$eids=array();
		foreach($data as $value){
			
			if(DB::insert(DB::table($this->_table),$value,false,true,true)){
				$eids[]=$value['eid'];
			}
		}
		return DB::delete($this->_table.'_archive',"eid IN (".dimplode($eids).")");
	}
}

?>
