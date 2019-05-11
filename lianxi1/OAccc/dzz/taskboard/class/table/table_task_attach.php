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

class table_task_attach extends dzz_table_archive
{
	public function __construct() {

		$this->_table = 'task_attach';
		$this->_pk    = 'id';

		parent::__construct();
	}
	
	public function fetch_by_id($id){
		global $_G;
		if(!$data=self::fetch($id)) return false;
		if($data['aid']>0){
			$attach=C::t('attachment')->fetch($data['aid']);
			if(in_array(strtolower($attach['filetype']),array('png','jpeg','jpg','gif'))){
				$attach['img']=C::t('attachment')->getThumbByAid($attach,120,80);
				$attach['isimage']=1;
				$attach['type']='image';
			}else{
				$attach['img']=geticonfromext($attach['filetype'],'');
				$attach['isimage']=0;
			}
			$data['dpath']=dzzencode('attach::'.$data['aid']);
			$attach['url']=getAttachUrl($attach);
			$data = array_merge($data,$attach);
			$data['filesize']=formatsize($data['filesize']);
		}
		return $data;
	}
	public function insert($arr){
		$ret=0;
		if($arr['type']=='attach' && (in_array(strtolower($arr['filetype']),array('png','jpeg','jpg','gif')))){
			$arr['type']='image';
		}
		if($ret=parent::insert($arr,1)){
			if($arr['aid']) C::t('attachment')->addcopy_by_aid($arr['aid'],1);
			$uptask=array('attachs'=>1);
			/*if($arr['type']=='image'){//更新任务最新图片
				$uptask['imageaid']=array($arr['aid']);
			}*/
	
			C::t('task')->increase($arr['taskid'],$uptask);
			//产生事件
			$task=C::t('task_field')->fetch($arr['taskid']);
			$event =array('uid'=>getglobal('uid'),
						  'username'=>getglobal('username'),
						  'tbid'=>$arr['tbid'],
						  'body_template'=>'task_attach_add',
						  'body_data'=>serialize(array('tbid'=>$arr['tbid'],'taskid'=>$task['taskid'],'taskname'=>$task['name'],'aid'=>$arr['aid'],'filename'=>$arr['filename'])),
						  'dateline'=>TIMESTAMP,
						  'bz'=>'task_'.$task['taskid'],
						  );
			C::t('task_event')->insert($event);
		}
		return $ret;
	}
	public function fetch_newest_imageaid_by_taskid($taskid){

		return DB::result_first("select id from %t where taskid=%d and filetype IN(%n) and deletetime<1  ORDER by dateline DESC limit 1",array($this->_table,$taskid,array('png','jpeg','jpg','gif')));
	}
	public function delete_by_id($id,$isevent=1,$force=false){
		if($force){
			return self::delete_permanent_by_id($id);
		}else{
			if(!$data=parent::fetch($id)) return 0;
			$task=C::t('task')->fetch($data['taskid']);
			$setarr=array('deletetime'=>TIMESTAMP,'deleteuid'=>getglobal('uid'));
			if(!$task['imageaid']){
				$task['imageaid']=self::fetch_newest_imageaid_by_taskid($data['taskid']);
			}
			if($return=parent::update($id,$setarr)){
				//更新imageaid
				$ret['msg']='success';
				$uptask=array('attachs'=>-1);
				if($task['imageaid']==$id ){
					$uptask['imageaid']=0;
				}
				if(C::t('task')->increase($data['taskid'],$uptask)){
					if($task['imageaid']==$id){
						if($ret['imageaid']=self::fetch_newest_imageaid_by_taskid($data['taskid'])){
							$attach=self::fetch($ret['imageaid']);
							$ret['dpath']=dzzencode('attach::'.$attach['aid']);
						}else{
							$ret['imageaid']=0;
						}
					}
				}
				if($isevent){
					//产生事件
					$field=C::t('task_field')->fetch($data['taskid']);
					$event =array('uid'=>getglobal('uid'),
								  'username'=>getglobal('username'),
								  'tbid'=>$data['tbid'],
								  'body_template'=>'task_attach_delete',
								  'body_data'=>serialize(array('tbid'=>$data['tbid'],'taskid'=>$data['taskid'],'taskname'=>$field['name'],'aid'=>$data['aid'],'filename'=>$data['filename'])),
								  'dateline'=>TIMESTAMP,
								  'bz'=>'task_'.$data['taskid'],
								  );
					C::t('task_event')->insert($event);
				}
				return $ret;
			}
			return false;
		}
	}
	public function restore_by_id($id,$isevent=1){
			if(!$data=parent::fetch($id)) return 0;
			$setarr=array('deletetime'=>0,'deleteuid'=>getglobal('uid'));
			if($return=parent::update($id,$setarr)){
				$uptask=array('attachs'=>1);
				if($data['type']=='image' ){
					$uptask['imageaid']=array(self::fetch_newest_imageaid_by_taskid($data['taskid']));
				}
				C::t('task')->increase($data['taskid'],$uptask);
				//产生事件
				$field=C::t('task_field')->fetch($data['taskid']);
				$event =array('uid'=>getglobal('uid'),
							  'username'=>getglobal('username'),
							  'tbid'=>$data['tbid'],
							  'body_template'=>'task_attach_restore',
							  'body_data'=>serialize(array('tbid'=>$data['tbid'],'taskid'=>$data['taskid'],'taskname'=>$field['name'],'aid'=>$data['aid'],'filename'=>$data['filename'])),
							  'dateline'=>TIMESTAMP,
							  'bz'=>'task_'.$data['taskid'],
							  );
				C::t('task_event')->insert($event);
			}
	}
	public function delete_permanent_by_id($id){
		if(!$data=parent::fetch($id,1,1)) return 0;
		$ret=0;
		if($ret=parent::delete($id,true,1)){
			if($data['aid']) C::t('attachment')->delete_by_aid($data['aid']);
		}
		return $ret;
	}
	public function recycle_empty_by_tbid($tbid){
		 $ret=0;
		 foreach(DB::fetch_all("select id from %t where deletetime>0 and tbid=%d",array($this->_table,$tbid)) as $value){
			$ret+=self::delete_permanent_by_id($value['id']);
		 }
		 return $ret;
	 }
	public function delete_by_taskid($taskid){
		$ret=0;
		foreach(DB::fetch_all("select id from %t where taskid=%d",array($this->_table,$taskid)) as $value){
			$ret+=self::delete_by_id($value['id'],0,1);
		}
		foreach(DB::fetch_all("select id from %t where taskid=%d",array($this->_table.'_archive',$taskid)) as $value){
			$ret+=self::delete_by_id($value['id'],0,1);
		}
		return $ret;
	}
	public function archive_by_taskid($taskid){
		$data = array();
		$data= DB::fetch_all("select * from %t where taskid=%d",array($this->_table,$taskid));
		$ids=array();
		foreach($data as $value){
			if(DB::query("REPLACE INTO %t SET ".DB::implode($value),array($this->_table.'_archive'),false,true)){
				$ids[]=$value['id'];
			}
		}
		return DB::delete($this->_table,"id IN (".dimplode($ids).")");
	}
	public function active_by_taskid($taskid){
		$data = array();
		$data= DB::fetch_all("select * from %t where taskid=%d",array($this->_table.'_archive',$taskid));
		$ids=array();
		foreach($data as $value){
			if(parent::insert($value,1,1)){
				$ids[]=$value['id'];
			}
		}
		return DB::delete($this->_table.'_archive',"id IN (".dimplode($ids).")");
	}
	
	public function fetch_all_by_taskid($taskids,$fetch_archive=1){
		$taskids=(array)$taskids;
		
		$data=array();
		if($fetch_archive<2){
			$data= DB::fetch_all("select * from %t where taskid IN(%n) and deletetime<1",array($this->_table,$taskids));
			if($fetch_archive && empty($data)) $data= DB::fetch_all("select * from %t where taskid IN(%n) and deletetime<1",array($this->_table.'_archive',$taskids));
		}else{
			$data= DB::fetch_all("select * from %t where taskid IN(%n) and deletetime<1",array($this->_table.'_archive',$taskid));
		}
		foreach($data as $key=>$value){
			if($value['aid']>0){
				if(in_array(strtolower($value['filetype']),array('png','jpeg','jpg','gif','bmp'))){
					$value['img']=C::t('attachment')->getThumbByAid($value['aid'],120,80);
					$value['url']=C::t('attachment')->getThumbByAid($value['aid'],0,0,1);
					$value['isimage']=1;
					$value['type']='image';
				}else{
					$value['img']=geticonfromext($value['filetype']);
					$value['isimage']=0;
					$value['type']='attach';
				}
				$value['dpath']=dzzencode('attach::'.$value['aid']);
				$value['filesize']=formatsize($value['filesize']);
			}
			$data[$key]=$value;
		}
		return $data;
	}
	public function fetch_all_delete_by_tbid($tbid,$limit='',$keyword='',$starttime=0,$endtime=0,$iscount=false){
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
		$searchsql=" and deletetime>0";
		if(!empty($keyword)){
			$param[]='%'.$keyword.'%';
			$searchsql=' and ( filename like %s )';
		}
		if(!empty($starttime)){
			$param[]=$starttime;
			$searchsql.=' and ( deletetime > %d )';
		}
		if(!empty($endtime)){
			$param[]=$endtime;
			$searchsql.=' and ( deletetime < %d )';
		}
		$ordersql=" order by deletetime DESC";
		if($iscount) return DB::result_first("select COUNT(*) from %t where tbid=%d $searchsql",$param);
		$data=array();
		foreach(DB::fetch_all("select * from %t where tbid=%d $searchsql $ordersql $limitsql",$param) as $value){
			if($user=getuserbyuid($value['deleteuid'])) $value['deleteusername']=$user['username'];
			$value['ffilesize']=formatsize($value['filesize']);
			if($value['aid']>0){
				if(in_array(strtolower($value['filetype']),array('png','jpeg','jpg','gif','bmp'))){
					$value['img']=C::t('attachment')->getThumbByAid($value['aid'],120,80);
					$value['url']=C::t('attachment')->getThumbByAid($value['aid'],0,0,1);
					$value['isimage']=1;
					$value['type']='image';
				}else{
					$value['img']=geticonfromext(strtolower($value['filetype']));
					$value['url']=DZZSCRIPT.'?mod=io&op=getStream&path='.rawurlencode('attach::'.$value['aid']);
					$value['isimage']=0;
					$value['type']='attach';
				}
			}
			$value['task']=C::t('task_field')->fetch($value['taskid']);
			$data[]=$value;
		}
		return $data;
	}
	
	public function copy_by_taskid($otaskid,$taskid,$oimageaid=0){
		$return=0;
		$fieldarr=array('attachs'=>0);
		foreach(self::fetch_all_by_taskid($otaskid,0) as $value){
			$setarr=array('tbid'=>$value['tbid'],
						  'taskid'=>$taskid,
						  'aid'=>$value['aid'],
						  'uid'=>$value['uid'],
						  'filename'=>$value['filename'],
						  'filesize'=>$value['filesize'],
						  'filetype'=>$value['filetype'],
						  'dateline'=>TIMESTAMP
						 );
			if($id=parent::insert($setarr)){
				//更新任务和任务版统计
				if(oimageid==$value['id']){
					$fieldarr['imageaid']=$id;
				}
				$return +=1;
				$fieldarr['attachs']+=1;
				C::t('attachment')->addcopy_by_aid($value['aid']);
			}
		}
		C::t('task')->increase($taskid,$fieldarr);
		return $return;
	}
	
}

?>
