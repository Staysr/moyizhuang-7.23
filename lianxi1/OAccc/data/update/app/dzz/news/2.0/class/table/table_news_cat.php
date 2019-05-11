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
class table_news_cat extends dzz_table
{
	public function __construct() {

		$this->_table = 'news_cat';
		$this->_pk    = 'catid';

		parent::__construct();
	}
	
	
	public function insert_by_catid($setarr){
		$setarr['disp']=DB::result_first("select max(disp) from %t where pid=%d",array($this->_table,$setarr['pid']))+1;
		return parent::insert($setarr,1);
	}
	public function update_by_catid($catid,$arr){
		if(!$data=parent::fetch($catid)) return false;
		if(isset($arr['pid']) && $data['pid']!=$arr['pid']){
			$arr['disp']=DB::result_first("select max(disp) from %t where pid=%d",array($this->_table,$arr['pid']))+1;
		}
		return parent::update($catid,$arr);
	}
	public function fetch_all_by_pid($pid){
		return DB::fetch_all("select * from %t where  pid=%d   order by disp",array($this->_table,$pid));
	}
	
	public function catmove_by_catid($catid,$up=0){ //移动分类
		$cat=self::fetch($catid);
		$disparr=array();$i=0;$cur=0;
		foreach(self::fetch_all_by_pid($cat['pid']) as  $value){
			$disparr[]=$value;
			if($value['catid']==$catid) $cur=$i;
			$i++;
		}
		if($up){
			$disp=$disparr[(($cur-1<0)?0:($cur-1))]['disp']-1;
		}else{
			$disp=$disparr[(($cur+1>$i-1)?$i-1:($cur+1))]['disp']+1;
		}
		foreach($disparr as $value){
			if($value['catid']==$catid) continue;
			if(!$up){
				if($value['disp']>=$disp) parent::update($value['catid'],array('disp'=>$value['disp']+1));
			}else{
				if($value['disp']<=$disp) parent::update($value['catid'],array('disp'=>$value['disp']-1));
			}
		}
		return parent::update($catid,array('disp'=>$disp));
	}
	public function delete_by_catid($catid){ //同时删除所有下级分类，分类下的信息失去分类,如果是唯一的顶级分类，不允许删除
		//判断是否为唯一的顶级分类；
		if($data=parent::fetch($catid) && $data['pid']==0){
			if(DB::result_first("select COUNT(*) from %t where pid='0'",array($this->_table))<2){
				return 0;
			}
		}
		$catids=self::getSonByCatid($catid);
		$ret=0;
		if($catids){
			$ret=parent::delete($catids);
			DB::update('news',array('catid'=>0),"catid IN (".dimplode($catids).")");
		}
		return $ret;
	}
	public function getSonByCatid($catid){
		static $catids=array();
		$catids[]=$catid;
		foreach(self::fetch_all_by_pid($catid) as $value){
			self::getSonByCatid($value['catid']);
		}
		
		return $catids;
	}
}

?>
