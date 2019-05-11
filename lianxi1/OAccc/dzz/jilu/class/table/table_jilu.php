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

class table_jilu extends dzz_table
{
	public function __construct() {

		$this->_table = 'jilu';
		$this->_pk    = 'jid';
		$this->_pre_cache_key = 'jilu_';
		$this->_cache_ttl = 60*60;
		parent::__construct();
	}
	public function getSid() {
		 $jid=random(10);
		 if(DB::result_first("select COUNT(*) from %t where jid=%s",array($this->_table,$jid))){
			return self::getSid(); 
		 }else{
			 if(parent::insert(array('jid'=>$jid))){
				 return $jid;
			 }
			 return $jid;
		 }
	}
	public function insert($setarr){
		$jid=self::getSid();
		if($ret=parent::update($jid,$setarr)){
			if($setarr['cover']) C::t('attachment')->addcopy_by_aid($setarr['cover']);
			//生成二维码
			self::getQRcodeByjid($ret);
			return $jid;
		}else{
			return false;
		}
		
	}
	public function fetch($jid,$force_from_db=false){
		if($force_from_db || ($data = $this->fetch_cache($jid)) === false) {
			$data=array();
			if($data=DB::fetch_first("select * from %t where jid=%s",array($this->_table,$jid))){
				$data['shareurl']=getglobal('siteurl').DZZSCRIPT.'?mod=chuti&id='.$jid;
			}
			if(!empty($data)) $this->store_cache($jid, $data);
		}
		return $data;
	}
	public function update_by_jid($jid,$setarr){
		$data=parent::fetch($jid);
		if($ret=parent::update($jid,$setarr)){
			if(isset($setarr['cover']) && $data['cover']!=$setarr['cover']){
				C::t('attachment')->delete_by_aid($data['cover']);
				if($setarr['cover']) C::t('attachment')->addcopy_by_aid($setarr['cover']);
			}
		}
		return $ret;
	}
	
	public function getQRcodeByjid($jid){
		
		$target='./qrcode/'.$jid[0].$jid[1].'/'.$jid.'.png';
		if(@getimagesize(getglobal('setting/attachdir').$target)){
			return getglobal('setting/attachurl').$target;
		}else{//生成二维码
			$targetpath = dirname(getglobal('setting/attachdir').$target);
			dmkdir($targetpath);
			QRcode::png(getglobal('siteurl').MOD_URL.'&id='.$jid,getglobal('setting/attachdir').$target,'M',4,2);
			return getglobal('setting/attachurl').$target;
		}
	}
	public function archive_by_jid($jid){
		if($ret=parent::update($jid,array('inarchive'=>1,'archivetime'=>TIMESTAMP))){
		
			//产生事件
			$jilu=parent::fetch($jid);
			
			
			//通知所有参与者
				$users=C::t('jilu_user')->fetch_all_by_perm($jid,array('1','2','3'));
				$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=jilu',1);
				foreach($users as $value){
					if($value['uid']!=getglobal('uid')){
						//发送通知
						$notevars=array(
										'from_id'=>$appid,
										'from_idtype'=>'app',
										'url'=>MOD_URL.'&id='.$jilu['jid'],
										'author'=>getglobal('username'),
										'authorid'=>getglobal('uid'),
										'dataline'=>dgmdate(TIMESTAMP),
										'corpusname'=>getstr($jilu['title'],30),
										'jiluname' => getstr($jilu['title'],30),
										);
						
							$action='archived';
							$type='archived_'.$jid;
						dzz_notification::notification_add($value['uid'], $type, $action, $notevars, 0, MOD_PATH);
					}
				}
		}
		return $ret;
	}
	public function active_by_jid($jid){
		$jilu=parent::fetch($jid);
		if($ret=parent::update($jid,array('inarchive'=>0,'archivetime'=>0))){
		//通知所有参与者
				$users=C::t('jilu_user')->fetch_all_by_perm($jid,array('1','2','3'));
				$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=jilu',1);
				foreach($users as $value){
					if($value['uid']!=getglobal('uid')){
						//发送通知
						$notevars=array(
										'from_id'=>$appid,
										'from_idtype'=>'app',
										'url'=>MOD_URL.'&id='.$jilu['jid'],
										'author'=>getglobal('username'),
										'authorid'=>getglobal('uid'),
										'dataline'=>dgmdate(TIMESTAMP),
										'corpusname'=>getstr($jilu['title'],30),
										'jiluname' => getstr($jilu['title'],30),
										);
						
							$action='restore';
							$type='restore_'.$jid;
						
						dzz_notification::notification_add($value['uid'], $type, $action, $notevars, 0, MOD_PATH);
					}
				}
		}
	}
	public function delete_by_jid($jid,$force=false){
		$jilu=parent::fetch($jid);
		if(!$force && $jilu['inarchive']) return false;
		if($ret=parent::delete($jid)){
			if($jilu['cover']) C::t('attachment')->delete_by_aid($jilu['cover']);
			//删除记录
			C::t('jilu_item')->delete_by_jid($jid);
			return true;
		}
		return false;
	}
	public function increase($jids, $fieldarr) {
		$jids = (array)$jids;
		$sql = array();
		$num = 0;
		$allowkey = array('views', 'num' ,'updatetime','lastactive');
		foreach($fieldarr as $key => $value) {
			if(in_array($key, $allowkey)) {
				if(is_array($value)) {
					$sql[] = DB::field($key, $value[0]);
				} else {
					$value = dintval($value);
					$sql[] = "`$key`=`$key`+'$value'";
				}
			} else {
				unset($fieldarr[$key]);
			}
		}
		
		if(!empty($sql)){
			$cmd = "UPDATE " ;
			$num = DB::query($cmd.DB::table($this->_table)." SET ".implode(',', $sql)." WHERE jid IN (".dimplode($jids).")", 'UNBUFFERED');
			$this->clear_cache($jids);
		}
		return $num;
	}

	public function getDelJilu($limit,$keyword,$iscount = false,$date,$uids,$jids){//获取回收站的记录
		include_once libfile('function/code');
		include_once libfile('function/common');
		$limitarr = explode('-', $limit);
		$searchsql = '';
		$parms = array('jilu');
		$perm = getPermByUid(getglobal('uid'));
		if($perm < 2){
			$searchsql .= ' and recycledel < 1 and authorid = %d';
			$parms[] = getglobal('uid');
		}
		if(count($limitarr) > 1){
			$limit = ' limit '.$limitarr[0].','.$limitarr[1];
		}else{
			$limit = ' limit '.$limit[0];
		}
		if(!empty($keyword)){
			$searchsql .= ' and title like %s';
			$parms[] = '%'.$keyword.'%';
		}
		if(!empty($date)){
			if ($date[0]) {
				$searchsql .= ' and deletetime >= %d';
				$parms[] = $date[0];
			}
			if ($date[1]) {
				$searchsql .= ' and deletetime <= %d';
				$parms[] = $date[1];
			}
		}
		if(!empty($uids)){
			$searchsql .= ' and authorid IN(%n)';
			$parms[] = $uids;
		}
		if(!empty($jids)){
			$searchsql .= ' and jid IN(%n)';
			$parms[] = $jids;
		}
		if($iscount) return DB::result_first('select count(*) from %t where deletetime > 0'.$searchsql, $parms);
		$result = array();
		foreach(DB::fetch_all('select * from %t where deletetime > 0'.$searchsql.' order by deletetime DESC'.$limit, $parms) as $value) {
			//取得最后一条
			$lastactive = DB::fetch_first('select authorid,author,content,type from %t where jid = %s and deletetime <= 0 order by dateline desc limit 1', array('jilu_item', $value['jid']));
			unset($value['lastactive']);
			if($lastactive){
				 $value['lastactive']['username'] = $lastactive['author'];
				 $value['lastactive']['uid'] = $lastactive['authorid'];
				 $value['lastactive']['type'] = $lastactive['type'];
				 $value['lastactive']['content'] = $lastactive['content'];
				 // $value['lastactive']=unserialize($value['lastactive']);
				 // $value['lastactive']['content']=dzzcode($value['lastactive']['content']);
			}
			if($value['dateline']) $value['fdateline']=dgmdate($value['dateline'],'u');
			if($value['lastvisit'] && $value['updatetime']>$value['lastvisit']) $value['new']=DB::result_first("select COUNT(*) from %t where jid=%s and dateline>%d",array('jilu_item',$value['jid'],$value['lastvisit']));
			$value['cover_uids']=C::t('jilu_user')->fetch_cover_uids_by_jid($value['jid']);
			$author = getuserbyuid($value['deleteuid']);
			$value['deleteauthor'] = $author['username'];
			$result[] = $value;
		}
		return $result;
	}
}

?>
