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

class table_task_cat extends dzz_table_archive
{
	public function __construct() {

		$this->_table = 'task_cat';
		$this->_pk    = 'catid';
	   /* $this->_pre_cache_key = 'task_';
		$this->_cache_ttl = 0;*/

		parent::__construct();
	}
	public function insert($arr){
		$arr['dateline']=TIMESTAMP;
		//$arr['disp']=DB::result_first("select max(disp) from %t where status=0",array($this->_table))+1;
		if($catid=parent::insert($arr,1)){
			//添加事件
			$event =array('uid'=>$arr['uid'],
						  'username'=>$arr['username'],
						  'tbid'=>$arr['tbid'],
						  'body_template'=>'task_cat_create',
						  'body_data'=>serialize(array('tbid'=>$arr['tbid'],'catid'=>$catid,'catname'=>$arr['catname'])),
						  'dateline'=>TIMESTAMP,
						  'bz'=>'task_cat_'.$catid,
						  );
			C::t('task_event')->insert($event);
			return $catid;
		}
		return false;
	}
	public function update_by_catid($catid,$arr){
		$cat=parent::fetch($catid);
		if($ret=parent::update($catid,$arr)){
			 if($arr['catname'] && $cat['catname']!=$arr['catname']){
				//添加事件
				$event =array('uid'=>getglobal('uid'),
							  'username'=>getglobal('username'),
							  'tbid'=>$cat['tbid'],
							  'body_template'=>'task_cat_rename',
							  'body_data'=>serialize(array('tbid'=>$cat['tbid'],'catid'=>$catid,'catname'=>$arr['catname'],'oldcatname'=>$cat['catname'])),
							  'dateline'=>TIMESTAMP,
							  'bz'=>'task_cat_'.$catid,
							  );
				C::t('task_event')->insert($event);
			}
			
			return $ret;
		}
		return false;
	}
	public function copy_by_catid($catid,$catname){
		if(!$cat=self::fetch($catid)){
			return array('error'=>'任务列表不存在');
		}
		$setarr=array('tbid'=>$cat['tbid'],
					  'catname'=>$catname?$catname:$cat['catname'],
					  'uid'=>getglobal('uid'),
					  'username'=>getglobal('username'),
					  'dateline'=>TIMESTAMP,
					  'status'=>0,
					  'statusuid'=>0,
					  'statustime'=>0
					  );
		if($setarr['catid']=self::insert($setarr)){
			//拷贝任务列表内的所有任务(删除的和归档的不拷贝）
			C::t('task')->copy_by_catid($catid,$setarr['catid']);
			return $setarr;
		}
		return false;
	}
	/*public function setDispByCatid($catid,$bcatid){
		//设置任务列表的显示顺序；
		if($bcat=parent::fetch($bcatid)){
			$disp=$bcat['disp']-1;
			if(DB::result_first("select COUNT(*) from %t where disp=%d and  status=0",array($this->_table,$disp))){
				DB::query("update %t set disp=disp+1 where disp>%d  and status=0",array($this->_table,$disp));
				$disp=$bcat['disp'];
			}
		}else{
			$disp=DB::result_first("select max(disp) from %t where status=0",array($this->_table))+1;
		}
		return parent::update($catid,array('disp'=>$disp));
	}*/
    public function delete_by_catid($catid,$force=false){
		$cat=self::fetch($catid);
		//如果没有任务，彻底删除
		if($force || $cat['status']==4){
			self::delete_permanent_by_catid($catid);
		}else{
			if($return=parent::update($catid,array('statustime'=>TIMESTAMP,'statusuid'=>getglobal('uid'),'status'=>4))){
				//添加事件
				$event =array('uid'=>getglobal('uid'),
							  'username'=>getglobal('username'),
							  'tbid'=>$cat['tbid'],
							  'body_template'=>'task_cat_delete',
							  'body_data'=>serialize(array('tbid'=>$cat['tbid'],'catid'=>$catid,'catname'=>$cat['catname'])),
							  'dateline'=>TIMESTAMP,
							  'bz'=>'task_cat_'.$catid,
							  );
				C::t('task_event')->insert($event);
				return $return;
			}
		}
		return false;
	}
	public function restore_by_catid($catid){
		$cat=self::fetch($catid);
		if($return=parent::update($catid,array('statustime'=>0,'statusuid'=>getglobal('uid'),'status'=>0))){
			//添加事件
			$event =array('uid'=>getglobal('uid'),
						  'username'=>getglobal('username'),
						  'tbid'=>$cat['tbid'],
						  'body_template'=>'task_cat_restore',
						  'body_data'=>serialize(array('tbid'=>$cat['tbid'],'catid'=>$catid,'catname'=>$cat['catname'])),
						  'dateline'=>TIMESTAMP,
						  'bz'=>'task_cat_'.$catid,
						  );
			C::t('task_event')->insert($event);
			return $return;
		}
		return false;
	}
	public function delete_permanent_by_catid($catid){ //彻底删除
		
		//删除相关事件
		 C::t('task_event')->delete_by_bz('task_cat_'.$catid);
		 
		 //删除人员
		C::t('task_user')->delete_by_id_idtype($catid,'task_cat');
		
		 //删除分类下所有任务
		 C::t('task')->delete_by_catid($catid);
		 
		 return parent::delete($catid,false,1);
	}
	 public function recycle_empty_by_tbid($tbid){
		 $ret=0;
		 foreach(DB::fetch_all("select catid from %t where status>1 and tbid=%d",array($this->_table,$tbid)) as $value){
			$ret+=self::delete_permanent_by_catid($value['catid']);
		 }
		 return $ret;
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
		$param=array($this->_table.'_archive',$tbid);
		$searchsql=" and status<1";
		if(!empty($keyword)){
			$param[]='%'.$keyword.'%';
			$searchsql=' and ( catname like %s )';
		}
		if(!empty($starttime)){
			$param[]=$starttime;
			$searchsql.=' and ( archivetime > %d )';
		}
		if(!empty($endtime)){
			$param[]=$endtime;
			$searchsql.=' and ( archivetime < %d )';
		}
		
		$orderby=" order by archivetime DESC";
		
		if($iscount) return DB::result_first("select COUNT(*) from %t where tbid=%d $searchsql",$param,$this->_pk);
	    $data= DB::fetch_all("select * from %t where tbid=%d $searchsql $orderby $limitsql",$param,$this->_pk);
		foreach($data as $key =>$value){
			$value['date']=dgmdate($value['archivetime'],'Y-m');
			$darr=explode('-',$value['date']);
			$value['fdate']=$darr[0].'年'.$darr[1].'月';
			if(!isset($datemin[$value['date']])){
				$arr=array();
				$arr[]=strtotime($value['date']);
				$arr[]=strtotime('+1 month',strtotime($value['date']));
				$datemin[$value['date']]=DB::result_first("select max(archivetime) from %t  where tbid=%d $searchsql and archivetime>=%d and archivetime<%d",array_merge($param,$arr));
			}
			if($value['archivetime']==$datemin[$value['date']]){
				$value['showdate']=1;
				$datemin[$value['date']].='_';
			}
			$data[$key]=$value;
		}
		return $data;
	}
	public function fetch_all_delete_by_tbid($tbid,$limit,$keyword,$starttime=0,$endtime=0,$iscount){
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
		$param=array($this->_table,$tbid);
		$searchsql=" and status>1";
		if(!empty($keyword)){
			$param[]='%'.$keyword.'%';
			$searchsql=' and ( catname like %s )';
		}
		if(!empty($starttime)){
			$param[]=$starttime;
			$searchsql.=' and ( statustime > %d )';
		}
		if(!empty($endtime)){
			$param[]=$endtime;
			$searchsql.=' and ( statustime < %d )';
		}
		
		$orderby=" order by statustime DESC";
		
		if($iscount) return DB::result_first("select COUNT(*) from %t where tbid=%d $searchsql",$param,$this->_pk);
	    $data= DB::fetch_all("select * from %t where tbid=%d $searchsql $orderby $limitsql",$param,$this->_pk);
		foreach($data as $key =>$value){
			$value['date']=dgmdate($value['statustime'],'Y-m');
			$darr=explode('-',$value['date']);
			$value['fdate']=$darr[0].'年'.$darr[1].'月';
			if(!isset($datemin[$value['date']])){
				$arr=array();
				$arr[]=strtotime($value['date']);
				$arr[]=strtotime('+1 month',strtotime($value['date']));
				$datemin[$value['date']]=DB::result_first("select max(statustime) from %t  where tbid=%d $searchsql and statustime>=%d and statustime<%d",array_merge($param,$arr));
			}
			if($value['statustime']==$datemin[$value['date']]){
				$value['showdate']=1;
				$datemin[$value['date']].='_';
			}
			$data[$key]=$value;
		}
		return $data;
	}
	public function fetch_all_by_tbid($tbid,$fetch_archive=0){
		$data=array();
		if($fetch_archive<2){
			$data=DB::fetch_all("select * from %t where tbid=%d and status<1 ",array($this->_table,$tbid),$this->_pk);
			if($fetch_archive ){
				if($data1=DB::fetch_all("select * from %t where tbid=%d and status<1 ",array($this->_table.'_archive',$tbid),$this->_pk)){
				$data=array_merge($data,$data1);
				}
			}
		}else{
			$data=DB::fetch_all("select * from %t where tbid=%d and status<1 ",array($this->_table.'_archive',$tbid),$this->_pk);
		}
		return $data;
	}
	 public function get_catids_by_tbid($tbid,$fetch_archive=0){
		 $catids=array();
		 if($fetch_archive<2){
			 foreach(DB::fetch_all("select catid from %t where tbid=%d ",array($this->_table,$tbid)) as $value){
				$catids[]=$value['catid'];
			 }
			 if($fetch_archive){
				 foreach(DB::fetch_all("select catid from %t where tbid=%d ",array($this->_table.'_archive',$tbid)) as $value){
					$catids[]=$value['catid'];
				 }
			 }
		 }else{
			 foreach(DB::fetch_all("select catid from %t where tbid=%d ",array($this->_table.'_archive',$tbid)) as $value){
				$catids[]=$value['catid'];
			 }
		 }
		 return $catids;
	 }
	 
	 public function delete_by_tbid($tbid){
		 $catids=self::get_catids_by_tbid($tbid,1);
		 foreach($catids as $catid){
			 self::delete_permanent_by_catid($catid);
		 }
	 }
	

	 public function archive_by_catid($catid,$event=1){
		 if($data=parent::fetch($catid)){
			$data['archivetime']=TIMESTAMP;
			if($return=DB::query("REPLACE INTO %t SET ".DB::implode($data),array($this->_table.'_archive'),false,true)){
				parent::delete($catid);
				//分类下面的所有任务都归档
				C::t('task')->archive_by_catid($catid);
				
				//归档关注人员
				C::t('task_user')->archive_by_id_idtype($catid,'task_cat');
				
			
			//产生事件
				if($event){
					$earr =array('uid'=>getglobal('uid'),
								  'username'=>getglobal('username'),
								  'tbid'=>$data['tbid'],
								  'body_template'=>'task_cat_archive',
								  'body_data'=>serialize(array('tbid'=>$data['tbid'],'catname'=>$data['catname'])),
								  'dateline'=>TIMESTAMP,
								  'bz'=>'task_cat_'.$catid,
								  );
					C::t('task_event')->insert($earr);
				}
			}
		}
		return $return;
	 }
	 
	 public function active_by_catid($catid,$event=1){
		 
		 if($data=C::t($this->_table.'_archive')->fetch($catid)){
			 $archivetime=$data['archivetime'];
			 unset($data['archivetime']);
			if($return=parent::insert($data,1,1)){
				C::t($this->_table.'_archive')->delete($catid);
				
				//分类下面的所有任务都激活
				C::t('task')->active_by_catid($catid,$archivetime);
				
				//关注人员
				C::t('task_user')->active_by_id_idtype($catid,'task_cat');
				
				//产生事件
				if($event){
					$earr =array('uid'=>getglobal('uid'),
								  'username'=>getglobal('username'),
								  'tbid'=>$data['tbid'],
								  'body_template'=>'task_cat_active',
								  'body_data'=>serialize(array('tbid'=>$data['tbid'],'catname'=>$data['catname'])),
								  'dateline'=>TIMESTAMP,
								  'bz'=>'task_cat_'.$catid,
								  );
					C::t('task_event')->insert($earr);
				}
			}
		}
		return $return;
	 }
	 
	 public function archive_by_tbid($tbid){
		  foreach(self::get_catids_by_tbid($tbid,0) as $catid){
			  self::archive_by_catid($catid,0);
		  }
		  return 0;
	 }
	  
	 public function active_by_tbid($tbid,$archivetime){
		   foreach(DB::fetch_all("select * from %t tbid=%d and archivetime>%d",array($this->_table.'_archive',$tbid,$archivetime)) as $value){
			  self::active_by_catid($value['catid'],0);
		  }
		  return 0;
	 }
}

?>
