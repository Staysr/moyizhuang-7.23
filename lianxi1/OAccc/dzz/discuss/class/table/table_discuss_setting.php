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

class table_discuss_setting extends dzz_table
{
	public function __construct() {

		$this->_table = 'discuss_setting';
			$this->_pk    = 'skey';

		parent::__construct();
	}
	//获取封面数组
	public function getCovers($width=128,$height=128) {
		if($cover=self::fetch('cover')){
			$aids=explode(',',$cover);
		}
		$return=$data=array();
		if($aids){
			foreach(C::t('attachment')->fetch_all($aids) as $value){
				$value['img']=C::t('attachment')->getThumbByAid($value,$width,$height,1);
				$data[$value['aid']]=$value;
			}
			//按原aids排序
			
			foreach($aids as $aid){
				$return[]=$data[$aid];
			}
		}
		return $return;
	}
	public function getCoversAids(){
		$aids=array();
		if($cover=self::fetch('cover')){
			$aids=explode(',',$cover);
		}
		return $aids;
	}
	//更新封面数组
	public function updateCovers($aids) {
		if($cover=self::fetch('cover')){
			$oaids=explode(',',$cover);
		}else{
			$oaids=array();
		}
		$delaids=array_diff($oaids,$aids);
		$newaids=array_diff($aids,$oaids);
		if($delaids){
			foreach($delaids as $aid){
			 C::t('attachment')->delete_by_aid($aid);
			}
		}
		if($newaids) C::t('attachment')->addcopy_by_aid($newaids,1);
		return self::update('cover',implode(',',$aids));
	}
	public function fetch($skey, $auto_unserialize = false) {
		$data = DB::result_first('SELECT svalue FROM '.DB::table($this->_table).' WHERE '.DB::field($this->_pk, $skey));
		return $auto_unserialize ? (array)unserialize($data) : $data;
	}

	public function fetch_all($skeys = array(), $auto_unserialize = false){
		$data = array();
		$where = !empty($skeys) ? ' WHERE '.DB::field($this->_pk, $skeys) : '';
		$query = DB::query('SELECT * FROM '.DB::table($this->_table).$where);
		while($value = DB::fetch($query)) {
			$data[$value['skey']] = $auto_unserialize ? (array)unserialize($value['svalue']) : $value['svalue'];
		}
		return $data;
	}

	public function update($skey, $svalue){
		return DB::insert($this->_table, array($this->_pk => $skey, 'svalue' => is_array($svalue) ? serialize($svalue) : $svalue), false, true);
	}

	public function update_batch($array) {
		$settings = array();
		foreach($array as $key => $value) {
			$key = addslashes($key);
			$value = addslashes(is_array($value) ? serialize($value) : $value);
			$settings[] = "('$key', '$value')";
		}
		if($settings) {
			return DB::query("REPLACE INTO ".DB::table($this->_table)." (`skey`, `svalue`) VALUES ".implode(',', $settings));
		}
		return false;
	}

	public function skey_exists($skey) {
		return DB::result_first('SELECT skey FROM %t WHERE skey=%s LIMIT 1', array($this->_table, $skey)) ? true : false;
	}

	public function fetch_all_not_key($skey) {
		return DB::fetch_all('SELECT * FROM '.DB::table($this->_table).' WHERE skey NOT IN('.dimplode($skey).')');
	}

	public function fetch_all_table_status() {
		return DB::fetch_all('SHOW TABLE STATUS');
	}

	public function get_tablepre() {
		return DB::object()->tablepre;
	}

	public function update_count($skey, $num) {
		return DB::query("UPDATE %t SET svalue = svalue + %d WHERE skey = %s", array($this->_table, $num, $skey), false, true);
	}
}
?>
