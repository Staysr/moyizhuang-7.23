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

class table_discuss_userinfo extends dzz_table
{
	public function __construct() {

		$this->_table = 'discuss_userinfo';
		$this->_pk    = 'uid';

		parent::__construct();
	}
	
	public function update_counter($uid, $threads = 0, $posts = 0,  $hots = 0) {
		if(!intval($uid)) {
			return false;
		}
		$addsql = array();
		if($threads) {
			$addsql[] = "threads=threads+'".intval($threads)."'";
		}
		if($posts) {
			$addsql[] = "posts=posts+'".intval($posts)."'";
		}
		if($hots) {
			$addsql[] = "hots=hots+'".intval($hots)."'";
		}
		if($addsql) {
			
			if(DB::result_first("select COUNT(*) from %t where uid=%d",array($this->_table,$uid))){
				$addsql[] = "lastpost='".TIMESTAMP."'";
				DB::query("UPDATE ".DB::table($this->_table)." SET ".implode(', ', $addsql)." WHERE ".DB::field('uid', $uid), 'UNBUFFERED');
			}else{
				$setarr=array('uid'=>$uid,
							  'threads'=>$threads>0?$threads:0,
							  'posts'=>$posts>0?$posts:0,
							  'hots'=>$hots>0?$hots:0,
							  'dateline'=>TIMESTAMP,
							  'lastpost'=>TIMESTAMP
							  );
				parent::insert($setarr,0,1);
			}
		}
	}
	public function update_counter_force(){
		foreach(DB::fetch_all("select * from %t where 1",array($this->_table)) as $value){
			$threads=C::t('discuss_thread')->count_by_authorid($value['uid']);
			$posts=C::t('discuss_post')->count_by_authorid(0,$value['uid']);
			$hots=$threads*5+$posts*2;
			parent::update($value['uid'],array('threads'=>$threads,'posts'=>$posts,'hots'=>$hots));
		}
	}
}

?>
