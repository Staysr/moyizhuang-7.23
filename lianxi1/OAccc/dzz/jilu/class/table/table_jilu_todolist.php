<?php
/*
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */

if(!defined('IN_DZZ')) {
	exit('Access Denied');
}

class table_jilu_todolist extends dzz_table
{
	public function __construct() {

		$this->_table = 'jilu_todolist';
		$this->_pk    = 'todoid';
		$this->_pre_cache_key = 'jilu_todolist_';
		$this->_cache_ttl = 0;
		parent::__construct();
	}
	
   
	public function fetch_all_by_rid($rid){
		if(DB::result_first('select count(*) from %t where rid = %d', array('jilu_item',$rid))){
			return DB::fetch_all("select * from %t where rid=%d order by rid",array($this->_table,$rid));
		}
	}
	  public function update_by_rid($rid,$todo){
		$ret=0;
		$todoids=array();
		foreach(DB::fetch_all("select todoid from %t where rid=%d",array($this->_table,$rid)) as $value){
			$todoids['todoid_'.$value['todoid']]=$value['todoid'];
		}
		foreach($todo['content'] as $key=> $value){
			if(empty($value)) continue;
			$value = censor($value);
			$todoid=intval($todo['todoid'][$key]);
			if($todoid>0){
				parent::update($todoid,array('content'=>getstr($value,255), 'checked' => $todo['checked'][$key]));
				unset($todoids['todoid_'.$todoid]);
			}else{
				
				$setarr=array('rid'=>$rid,
							  'checked'=>$todo['checked'][$key],
							  'dateline'=>TIMESTAMP,
							  'content'=>getstr($value,255)
							 );
				$ret+=parent::insert($setarr);
			}
		}
		if($todoids) $ret+=self::delete($todoids);
		return $ret;
	}
	
	public function delete_by_rid($rids){
		$rids=(array)$rids;
		return DB::query("delete from %t where rid IN(%n)",array($this->_table,$rids));
	}
}
?>
