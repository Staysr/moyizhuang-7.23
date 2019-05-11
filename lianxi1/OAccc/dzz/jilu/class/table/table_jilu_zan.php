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

class table_jilu_zan extends dzz_table
{
	public function __construct() {

		$this->_table = 'jilu_zan';
		$this->_pk    = 'zid';

		parent::__construct();
	}
	public function insert_by_rid($rid){
		if(!$rid) return 0;
		$jilu = C::t('jilu_item')->fetch($rid);
		if($zid=DB::result_first("select zid from %t where rid=%d and uid=%d",array($this->_table,$rid,getglobal('uid')))){
			if(parent::delete($zid)){
				C::t('jilu_item')->increase($rid,array('zan'=>-1)); //更新项目的赞数
				return true;
			}
		}else{
			$setarr=array('rid'=>$rid,
						  'uid'=>getglobal('uid'),
						  'dateline'=>TIMESTAMP
						  );
		   if(parent::insert($setarr,1)){
			 C::t('jilu_item')->increase($rid,array('zan'=>1)); //更新项目的赞数
			 //通知相关人员
			if($ruids=C::t('jilu_item')->fetch_uids_by_rid($rid)){
				$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=jilu',1);
				$item=C::t('jilu_item')->fetch($rid);
				foreach($ruids as $value){
					if($value==getglobal('uid')) continue;
					$notevars=array(
									'from_id'=>$appid,
									'from_idtype'=>'app',
									'url'=>MOD_URL."&id=".$jilu['jid']."&optrid=$rid",
									'author'=>$_G['username'],
									'authorid'=>$_G['uid'],
									'dataline'=>dgmdate(TIMESTAMP)
								   );
					dzz_notification::notification_add($value, 'zan_'.$rid, 'zan', $notevars, 0, MOD_PATH);
				}
			}
			 return true;
		   }
		}
	   return 0;
	}
	public function fetch_all_by_rid($rid){
		return DB::fetch_all("select * from %t where rid=%d order by dateline",array($this->_table,$rid),'uid');
	}
	public function fetch_usernames_by_rid($rid,$limit=10){//获取去最新的10个点赞的用户名
		$usernames=array();
		foreach(DB::fetch_all("select z.uid,u.username from %t z LEFT JOIN %t u ON zuid=u.uid where rid=%d order by dateline DESC limit $limit",array($this->_table,'user',$rid)) as $value){
			if($value['username']) $uesrnames[$value['uid']]=$value['username'];
		}
		return implode(',',$usernames);
	}
	public function delete_by_rid($rids){
		$rids=(array)$rids;
		return DB::query("delete from %t where rid IN(%n)",array($this->_table,$rids));
	}
}

?>
