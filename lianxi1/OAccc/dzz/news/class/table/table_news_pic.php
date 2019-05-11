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

class table_news_pic extends dzz_table
{
	public function __construct() {

		$this->_table = 'news_pic';
		$this->_pk    = 'picid';

		parent::__construct();
	}
	
	public function fetch_by_picid($picid){
		global $_G;
		if(!$data=self::fetch($picid)) return false;
		if($data['aid']>0){
				$data['img']=C::t('attachment')->getThumbByAid($data['aid'],240,160);
		}
		return $data;
	}
	public function insert($arr){
		$ret=0;
		if($ret=parent::insert($arr,1)){
			if($arr['aid']) C::t('attachment')->addcopy_by_aid($arr['aid'],1);
		}
		return $ret;
	}
	public function insert_by_newid($newid,$newpics,$pics){
		//先删除不在pics中的图片
		
		$picids=array_keys($pics);
		foreach(DB::fetch_all("select * from %t where picid NOT IN (%n) and newid=%d ",array($this->_table,$picids,$newid)) as $value){
			self::delete_by_picid($value['picid']);
		}
		//插入新的图片
		foreach($newpics as $value){
			$setarr=array('newid'=>$newid,
						  'title'=>$value['title'],
						  'aid'=>$value['aid'],
						  'dateline'=>TIMESTAMP);
			self::insert($setarr);
		}
		
		return true;
	}
	public function delete_by_picid($picid){
		
		if(!$data=parent::fetch($picid)) return 0;
		$ret=0;
		if($ret=parent::delete($picid)){
			if($data['aid']) C::t('attachment')->delete_by_aid($data['aid']);
		}
		return $ret;
	}
	
	public function delete_by_newid($newids){
		$newids=(array)$newids;
		$ret=0; 
		$aids=array();
		$picids=array();
		foreach(DB::fetch_all("select picid,aid from %t where newid in (%n)",array($this->_table,$newids)) as $value){
			$picids[]=$value['picid'];
			$aids[]=$value['aid'];
		}
		if($aids){
			C::t('attachment')->addcopy_by_aid($aids,-1);
		}
		return DB::delete($this->_table,"picid IN (".dimplode($picids).")");
	}
	public function fetch_all_by_newid($newids){
		$newids=(array)$newids;
		$data=array();
		foreach(DB::fetch_all("select * from %t where newid IN(%n) order by dateline DESC",array($this->_table,$newids)) as $value){
			$value['img']=C::t('attachment')->getThumbByAid($value['aid'],240,160);
			$value['url']=C::t('attachment')->getThumbByAid($value['aid'],0,0,1);
			$value['filesize']=formatsize($value['filesize']);
			$data[$value['picid']]=$value;
		}
		return $data;
	}
	
	
	
}

?>
