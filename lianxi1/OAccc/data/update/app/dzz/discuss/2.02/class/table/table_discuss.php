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
class table_discuss extends dzz_table
{
	public function __construct() {

		$this->_table = 'discuss';
		$this->_pk    = 'fid';

		parent::__construct();
	}

	public function checkMaxBoard($uid){
		$maxboard=C::t('discuss_setting')->fetch('maxboard');
		
		$sum=DB::result_first("select COUNT(*) from %t where uid=%d and deletetime<1",array($this->_table,$uid));
		if($maxboard==0){
			return lang('unlimited');
		}elseif($sum<$maxboard) return $maxboard-$sum;
		else return false;
	}
	public function getDiscussSetting(){
		global $_G;
		loadcache('discuss_setting');
		if(!$_G['cache']['discuss_setting']){
			$setting=C::t('discuss_setting')->fetch_all();
		}else{
			$setting=$_G['cache']['discuss_setting'];
		}
		if($setting['postnocustom']) {
			$temp = str_replace(array("\r\n", "\r"), array("\n", "\n"), $setting['postnocustom']);
			$temp = explode("\n", trim($temp));
			$temp1=array();
			foreach($temp as $key=>$value){
				$temp1[$key+2]=$value;
			}
			$setting['postnocustom']=$temp1;
		}else{
			$setting['postnocustom']=array();
		}
		$setting['topperm']=C::t('discuss_setting')->fetch('topperm',true);
		$setting['hotlevels']=$setting['hotlevels']?explode(',',$setting['hotlevels']):array();
		return $setting;
	}
	public function fetch_by_fid($fid,$uid = 0){
		global $_G;
		$data=array();
		
		if($data=parent::fetch($fid)){
			$data['name'] = emoji_decode($data['name']);
			$data['viewperm']=$data['perm'];//讨论版的查看权限使用viewperm；
			$data['users']=C::t('discuss_user')->fetch_all_by_fid($fid);
			if($_G['adminid']==1) $data['perm']=4;
			elseif($uid>0) $data['perm']=isset($data['users'][$uid])?$data['users'][$uid]['perm']:0;
			else $data['perm']=0;
			$field=C::t('discuss_field')->fetch($fid);
			$field['threadtypes']=unserialize($field['threadtypes']);
			
			//根据用户判断发贴权限
			$data['fpostperm']=1;
			if($_G['adminid']==1){
				$data['fpostperm']=1;
			}elseif($field['postperm']==1 ){
				if($data['perm']<2){
					$data['fpostperm']=0;
				}
			}elseif($field['postperm']==2){
				if($data['perm']<3){
					$data['fpostperm']=0;
				}
			}else{
				if($data['viewperm']>0 && $data['perm']<2){
					$data['fpostperm']=0;
				}
			}
			//根据用户判断回复权限
			$data['freplyperm']=1;
			if($_G['adminid']==1){
				$data['freplyperm']=1;
			}elseif($field['replyperm']==1 ){
				if($data['perm']<2){
					$data['freplyperm']=0;
				}
			}elseif($field['replyperm']==2){
				if($data['perm']<3){
					$data['freplyperm']=0;
				}
			}else{
				if($data['viewperm']>0 && $data['perm']<2){
					$data['replyperm']=0;
				}
			}
			
			$data['ppp']=20;
			$data['ppp2']=10;
			$data=array_merge($data,$field);
		}
		$data['setting']=self::getDiscussSetting();
		$data['isfav'] = C::t('discuss_favorite')->check_fav_by_id_idtype_uid($fid, 'forum', $_G['uid']);
		// $data['todayposts'] = C::t('discuss_post')->get_todays_by_fid($fid);
		return $data;
	}
	public function fetch_all_fids_by_uid($uid){//获取所有用户有权限的论坛
	 global $_G;
		$data=array();
		$user=getuserbyuid($uid);
		foreach(self::fetch_all_fids(0,500) as $value){
			$value['name'] = emoji_decode($value['name']);
			if($user['adminid']==1 || $value['perm']<1) $data[$value['fid']]=$value;
			else{//隐私论坛，判断用户权限
				$perm=C::t('discuss_user')->fetch_perm_by_uid($uid,$value['fid']);
				if($perm>1){
					$data[$value['fid']]=$value;
				}
			}
			// if ($data[$value['fid']]) $data[$value['fid']]['todayposts'] = C::t('discuss_post')->get_todays_by_fid($value['fid']);
		}
		return $data;
	}

	public function fetch_all_post_fids_by_uid($uid){//获取所有用户有权限发主题的论坛
		$data=array();
		$user=getuserbyuid($uid);
		foreach(self::fetch_all_fids(0,500) as $value){
			$value['name'] = emoji_decode($value['name']);
			if($user['adminid']==1 || $value['perm']<1) $data[$value['fid']]=$value;
			else{//隐私论坛，判断用户权限
				$discuss=$this->fetch_by_fid($value['fid'],$uid);
				if($discuss['fpostperm']){
					$data[$value['fid']]=$value;
				}
			}
		}
		return $data;
	}

	public function archive_by_fid($fid)//归档讨论版
	{
		$data=parent::fetch($fid);
		$setarr=array('inarchive'=>1,
					  'archivetime'=>TIMESTAMP,
					  );
		if ($return = parent::update($fid,$setarr)) {
			//取消板块下主题的置顶，精华，高亮
			C::t('discuss_thread')->clean_thread_modopt_by_fid($fid);
			//通知所有版主
			$uids= C::t('discuss_user')->fetch_uids_by_fid($fid,3);
			$appid=C::t('app_market')->fetch_appid_by_mod('discuss',0);
			foreach ($uids as $uid) {
				if ($uid != getglobal('uid')) {
					//发送通知
					$notevars = array(
										'from_id'=>$appid,
										'from_idtype'=>'app',
										'url'=>DZZSCRIPT.'?mod=discuss&op=list&fid='.$fid,
										'author'=>getglobal('username'),
										'authorid'=>getglobal('uid'),
										'dataline'=>dgmdate(TIMESTAMP),
										'discussname'=>getstr($data['name'],30),
									);
					$action='discuss_archive';
					$type='discuss_archive_'.$fid;
					dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/discuss');
				}
			}
		}
		return $return;
	}

	public function restore_by_fid($fid){//恢复归档
		//删除的讨论版也可以归档，归档后删除属性清除
		$data=parent::fetch($fid);
		$setarr=array('inarchive'=>0,
					  'archivetime'=>0,
					  );
		if($return=parent::update($fid,$setarr)){
			//通知所有版主
				
				$uids= C::t('discuss_user')->fetch_uids_by_fid($fid,3);
				$appid=C::t('app_market')->fetch_appid_by_mod('discuss',0);
				foreach($uids as $uid){
					if($uid!=getglobal('uid')){
						//发送通知
						$notevars=array(
										'from_id'=>$appid,
										'from_idtype'=>'app',
										'url'=>DZZSCRIPT.'?mod=discuss&op=list&fid='.$fid,
										'author'=>getglobal('username'),
										'authorid'=>getglobal('uid'),
										'dataline'=>dgmdate(TIMESTAMP),
										'discussname'=>getstr($data['name'],30),
										
										);
						
							$action='discuss_restore';
							$type='discuss_restore_'.$fid;
						
						dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/discuss');
					}
				}
		}
		return $return;
	}

	public function recovery_by_fid($fid)//恢复回收站中的讨论版
	{
		$data=parent::fetch($fid);
		if (!$data) return false;
		if (DB::delete('discuss_recycle', array('id' => $fid, 'type' => 'field'))) {
			$setarr = array('isdelete' => 0, 'deleteuid' => 0, 'deletetime' => 0);
			if ($return = parent::update($fid, $setarr)) {
				//通知所有版主
				$uids= C::t('discuss_user')->fetch_uids_by_fid($fid,3);
				$appid=C::t('app_market')->fetch_appid_by_mod('discuss',0);
				foreach($uids as $uid){
					if($uid!=getglobal('uid')){
						//发送通知
						$notevars=array(
										'from_id'=>$appid,
										'from_idtype'=>'app',
										'url'=>DZZSCRIPT.'?mod=discuss&op=list&fid='.$fid,
										'author'=>getglobal('username'),
										'authorid'=>getglobal('uid'),
										'dataline'=>dgmdate(TIMESTAMP),
										'discussname'=>getstr($data['name'],30),
										
										);
						
							$action='discuss_recovery';
							$type='discuss_recovery_'.$fid;
						
						dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/discuss');
					}
				}
			}
		}
	}
	
	public function delete_by_fid($fid,$force=false){//彻底删除讨论版；
		//删除讨论版
		$data=parent::fetch($fid);
		if($force || $data['deletetime']>0){
			return self::delete_permanent_by_fid($fid);
		}else{
			$setarr=array(
						  'deletetime'=>TIMESTAMP,
						  'deleteuid'=>getglobal('uid')
						  );
			if($return =parent::update($fid,$setarr)){
				//通知所有版主
				
				$uids= C::t('discuss_user')->fetch_uids_by_fid($fid,3);
				$appid=C::t('app_market')->fetch_appid_by_mod('discuss',0);
				foreach($uids as $uid){
					if($uid!=getglobal('uid')){
						//发送通知
						$notevars=array(
										'from_id'=>$appid,
										'from_idtype'=>'app',
										'author'=>getglobal('username'),
										'authorid'=>getglobal('uid'),
										'dataline'=>dgmdate(TIMESTAMP),
										'discussname'=>getstr($data['name'],30),
										);
						
							$action='discuss_thorough_delete';
							$type='discuss_thorough_delete_'.$fid;
						
						dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/discuss');
					}
				}
			}
			return $return;
		}
	}
	public function delete_permanent_by_fid($fid){
		C::t('discuss_user')->delete_by_fid($fid);//删除讨论版用户
		C::t('discuss_favorite')->delete_by_fid($fid);//删除收藏
		C::t('discuss_threadmod')->delete_by_fid($fid);//删除主题操作
		C::t('discuss_thread')->delete_by_fid($fid);//删除主题
		C::t('discuss_post')->delete_by_fid('tid:0', $fid);//删除帖子
		C::t('discuss_post_attach')->delete_by_fid($fid);//删除附件
		C::t('discuss_comment')->delete_cmt_by_fid($fid);//删除评论
		C::t('discuss_recycle')->delete_by_fid($fid);//删除回收站
		C::t('discuss_threadclass')->delete_by_fid($fid);
		DB::query("DELETE FROM ".DB::table('discuss_field')." WHERE %i", array(DB::field('fid', $fid)));
		return parent::delete($fid);
	}
	public function insert_by_fid($arr,$field = 0){
		if($fid=parent::insert($arr,1)){
			if($field['icon']) C::t('attachment')->addcopy_by_aid($field['icon']);//copys+1
			if($field){
				 $field['fid']=$fid;
				 C::t('discuss_field')->insert($field);//创建field表
			}
			$userarr=array('uid'=>$arr['uid'],
						   'username'=>$arr['username'],
						   'perm'=>3,//管理员
						   'dateline'=>TIMESTAMP,
						   'fid'=>$fid,
						   );
		    C::t('discuss_user')->insert($userarr);//创建用户
			
		}
		return $fid;
	}
	public function update_by_fid($fid,$arr,$field = 0){
		if($arr) parent::update($fid,$arr);
		if($field){
			if($field['icon']){
				$data=C::t('discuss_field')->fetch($fid);
				if($filed['icon']!=$data['icon']){
					C::t('attachment')->addcopy_by_aid($field['icon']);
					$aids=C::t('discuss_setting')->getCoversAids();
					if(!in_array($data['icon'],$aids)){//用户自定义的封面删除
						C::t('attachment')->delete_by_aid($data['icon']);
					}
				}
			}
			C::t('discuss_field')->update($fid,$field);
		}
		return true;
	}
	public function getMyDiscuss($uid,$keyword,$mycreate = 0, $order = 'lastpost', $inarchive = 0, $iscount = 0, $limit = ''){
		$param = array($this->_table);
		$searchsql='1';
		if(!empty($keyword)){
			$param[]='%'.$keyword.'%';
			$param[]='%'.$keyword.'%';
			$searchsql=' and ( name like %s or username=%s )';
		}
		switch ($order) {
			case 'lastpost':
				$orderby = ' order by lastposttime desc';
				break;
			case 'dateline':
				$orderby = ' order by dateline desc';
				break;
			case 'heats':
				$orderby = ' order by heats';
				break;
			
			default:
				$orderby = ' order by lastposttime desc';
				break;
		}
		//删除和归档的不列出来
		if ($inarchive === 'all') {
			$searchsql.=' and isdelete = 0';
		} else {
			$searchsql.=' and isdelete = 0 and inarchive = '.$inarchive;
		}
		$user = C::t('user')->fetch($uid);
		if (!$user['adminid'] || $mycreate) {
			$fids=array();
			if ($mycreate) {
				$users = C::t('discuss_user')->fetch_create_by_uid($uid);
			} else {
				$users = C::t('discuss_user')->fetch_all_by_uid($uid);
			}
			foreach($users as $value){
				$fids[$value['fid']]=$value['fid'];
			}
			$searchsql .= ' and fid in(%n)';
			$param[] = $fids;
		}
		if ($iscount) {
			return DB::result_first('select count(*) from %t where '.$searchsql, $param);
		} else {
			$list = DB::fetch_all('select * from %t where '.$searchsql.$orderby.$limit, $param);
		}

		if($list){	
			foreach ($list as $k => $v) {
				foreach(self::fetch_all_info_by_fids($v['fid']) as $value){
					if($value['icon']) $value['img']=C::t('attachment')->getThumbByAid($value['icon'],65,65,1);
					if($value['lastpost']) $value['lastpost']=explode("\t",$value['lastpost']);
					else $value['lastpost']=array();
					$value['userperm']=C::t('discuss_user')->fetch_perm_by_uid($uid,$value['fid']);
					if(isset($favids[$value['fid']])) $value['favid']=$favids[$value['fid']];
					$data[$value['fid']]=$value;
					$data[$value['fid']]['name']=emoji_decode($value['name']);
				}
			}
			return $data;
		}else{
			return array();
		}
	}
	public function getOpenedDiscuss($limit = 0,$keyword = '',$iscount = 0,$order='dateline'){
		$param=array($this->_table,'discuss_field');
		$searchsql.='and d.deletetime<1';
		if(!empty($keyword)){
			$param[]='%'.$keyword.'%';
			$param[]='%'.$keyword.'%';
			$searchsql=' and ( d.name like %s or d.username=%s )';
		}
		if($iscount){
			return DB::result_first("select COUNT(*) from %t d LEFT JOIN %t f ON d.fid=f.fid  where d.perm<1   $searchsql ",$param);
		}
		$limitsql='';
		if($limit){
			$limit=explode('-',$limit);
			if(count($limit)>1){
				$limitsql.=" limit ".intval($limit[0]).",".intval($limit[1]);
			}else{
				$limitsql.=" limit ".intval($limit[0]);
			}
		}
		$data=array();
		foreach(DB::fetch_all("select d.*,f.icon from %t d LEFT JOIN %t f ON d.fid=f.fid where d.perm<1 and  d.isdelete<1  $searchsql order by d.".$order." DESC $limitsql",$param,'fid') as $value){
			if($value['icon']) $value['img']=C::t('attachment')->getThumbByAid($value['icon'],65,65,1);
			if($value['lastpost']) $value['lastpost']=explode("\t",$value['lastpost']);
			$data[$value['fid']]=$value;
		}
		return $data;
	}
	
	public function fetch_all_for_manage($limit = 0,$keyword = '',$delete = 0,$count = 0, $inarchive = 0){
		$param=array($this->_table,'discuss_field');
		if(!empty($keyword)){
			$param[]='%'.$keyword.'%';
			$param[]='%'.$keyword.'%';
			$searchsql=' and ( d.name like %s or d.username=%s )';
		}
		if(!empty($delete)){
			$searchsql.=' and d.isdelete>0';
		}else{
			$searchsql.=' and d.isdelete<1';
		}
		if ($inarchive) $searchsql .= ' and d.inarchive = 1';
		
		if($count){
			return DB::result_first("select COUNT(*) from %t d LEFT JOIN %t f ON d.fid=f.fid  where 1 $searchsql ",$param);
		}
		$limitsql='';
		if($limit){
			$limit=explode('-',$limit);
			if(count($limit)>1){
				$limitsql.=" limit ".intval($limit[0]).",".intval($limit[1]);
			}else{
				$limitsql.=" limit ".intval($limit[0]);
			}
		}
		$data=array();
		foreach(DB::fetch_all("select d.*,f.iconcolor from %t d LEFT JOIN %t f ON d.fid=f.fid where 1 $searchsql order by d.dateline DESC $limitsql",$param,'fid') as $value){
			if($value['icon']) $value['img']=C::t('attachment')->getThumbByAid($value['icon'],65,65,1);
			if($value['lastpost']) $value['lastpost']=explode("\t",$value['lastpost']);
			$value['name'] = emoji_decode($value['name']);
			$data[$value['fid']]=$value;
		}
		
		return $data;
	}
	/*public function update_count_by_fid($fid){
		$arr=array();
		$arr['posts']=DB::result_first("select COUNT(*) from %t where fid=%d and type='file' and deletetime<1 ",array('discuss_class',$fid));
		$arr['follows']=DB::result_first("select COUNT(*) from %t where fid=%d and perm=1",array('discuss_user',$fid));
		$arr['members']=DB::result_first("select COUNT(*) from %t where fid=%d and perm>1",array('discuss_user',$fid));
		parent::update($fid,$arr);
		return $arr;
	}*/
	
	public function fetch_all_by_opened(){
		return DB::fetch_all('SELECT * FROM '.DB::table($this->_table)."  WHERE perm='0'");
	}

	
	public function fetch_all_by_status($status, $orderby = 1) {
		$status = $status ? 1 : 0;
		$ordersql = $orderby ? 'ORDER BY t.type, t.displayorder' : '';
		return DB::fetch_all('SELECT * FROM '.DB::table($this->_table)." t WHERE t.status='$status' $ordersql");
	}
	
	public function fetch_all_fids($start = 0, $limit = 0, $count = 0) {
		$limitsql = empty($limit) ? '' : ' LIMIT '.$start.', '.$limit;
		if($count) {
			return DB::result_first("SELECT count(*) FROM ".DB::table($this->_table)." WHERE 1 AND isdelete < 1 AND inarchive < 1");
		}
		return DB::fetch_all("SELECT * FROM ".DB::table($this->_table)." WHERE 1 AND isdelete < 1 AND inarchive < 1 $limitsql");
	}
	public function fetch_info_by_fid($fid) {
		return DB::fetch_first("SELECT ff.*, f.* FROM %t f LEFT JOIN %t ff ON ff.fid=f.fid WHERE f.fid=%d", array($this->_table, 'discuss_field', $fid));
	}
	public function fetch_all_name_by_fid($fids) {
		if(empty($fids)) {
			return array();
		}
		return DB::fetch_all('SELECT fid, name FROM '.DB::table($this->_table)." WHERE ".DB::field('fid', $fids), array(), 'fid');
	}
	public function fetch_all_info_by_fids($fids,  $limit = 0, $displayorder = 0,  $noredirect = 0,  $start = 0) {
		$sql = $fids ? "f.".DB::field('fid', $fids) : '';
		$sql .= $noredirect ? ($sql ? ' AND ' : '').'ff.redirect=\'\'' : '';
		$ordersql = $displayorder ? ' ORDER BY f.displayorder' : '';
		$limitsql = $limit ? DB::limit($start, $limit) : '';
		if(!$sql) {
			return array();
		}
		$data = DB::fetch_all("SELECT ff.*, f.* FROM %t f LEFT JOIN %t ff USING (fid) WHERE $sql $ordersql $limitsql", array($this->_table, 'discuss_field'), 'fid');
		foreach ($data as $k => $v) {
			$data[$k]['name'] = emoji_decode($v['name']);
		}
		return $data;
	}
	
	public function fetch_all_forum($status = 0) {
		return DB::fetch_all("SELECT ff.*, f.*, a.uid FROM ".DB::table($this->_table)." f LEFT JOIN ".DB::table('discuss_field')." ff ON ff.fid=f.fid  WHERE $statusql ORDER BY  f.displayorder");
	}
	
	public function fetch_all_by_recyclebin($recyclebin) {
		return DB::fetch_all('SELECT fid, name FROM %t WHERE status<3 AND type IN (\'forum\', \'sub\') AND recyclebin=%d', array($this->_table, $recyclebin));
	}
	
	public function fetch_forum_num() {
		return DB::result_first("SELECT COUNT(*) FROM ".DB::table($this->_table)." WHERE 1");
	}
	public function check_forum_exists($fids) {
		if(empty($fids)) {
			return false;
		}
		return DB::result_first("SELECT COUNT(*) FROM ".DB::table($this->_table)." WHERE fid IN(%n)", array( $fids));
	}
	public function fetch_sum_todaypost() {
		return DB::result_first("SELECT sum(todayposts) FROM ".DB::table($this->_table));
	}
	
	
	

	public function fetch_all_for_search($conditions, $start = 0, $limit = 20) {
		if(empty($conditions)) {
			return array();
		}
		if($start == -1) {
			return DB::result_first("SELECT count(*) FROM ".DB::table($this->_table)." f LEFT JOIN ".DB::table('discuss_field')." ff ON f.fid=ff.fid
			WHERE %i", array($conditions));
		}
		return DB::fetch_all("SELECT f.fid, f.name, f.posts, f.threads, ff.membernum, ff.lastupdate, ff.dateline FROM ".DB::table($this->_table)." f LEFT JOIN ".DB::table('discuss_field')." ff ON f.fid=ff.fid
			WHERE %i ".DB::limit($start, $limit), array($conditions));
	}
	public function clear_todayposts() {
		DB::query("UPDATE ".DB::table($this->_table)." SET todayposts='0'");
	}
	
	public function update_forum_counter($fid, $threads = 0, $posts = 0, $todayposts = 0,  $favtimes = 0, $opt = 1) {
		if(!dintval($fid)) {
			return false;
		}
		$addsql = array();
		if($threads) {
			if ($opt) {
				$addsql[] = "threads=threads+'".intval($threads)."'";
			} else {
				$addsql[] = "threads=threads-'".intval($threads)."'";
			}
		}
		if($posts) {
			if ($opt) {
				$addsql[] = "posts=posts+'".intval($posts)."'";
			} else {
				$addsql[] = "posts=posts-'".intval($posts)."'";
			}
		}
		if($todayposts) {
			if ($opt) {
				$addsql[] = "todayposts=todayposts+'".intval($todayposts)."'";
			} else {
				$addsql[] = "todayposts=todayposts-'".intval($todayposts)."'";
			}
		}
		
		if($favtimes) {
			if ($opt) {
				$addsql[] = "favtimes=favtimes+'".intval($favtimes)."'";
			} else {
				$addsql[] = "favtimes=favtimes-'".intval($favtimes)."'";
			}
		}
		if($addsql) {
			DB::query("UPDATE ".DB::table($this->_table)." SET ".implode(', ', $addsql)." WHERE ".DB::field('fid', $fid), 'UNBUFFERED');
		}
	}
	
	public function update_oldrank_and_yesterdayposts() {
		DB::query("UPDATE ".DB::table($this->_table).' SET oldrank=rank,yesterdayposts=todayposts');
	}

	
	public function fetch_all_for_ranklist( $orderfield, $start = 0, $limit = 0, $ignorefids = array()) {
		if(empty($orderfield)) {
			return array();
		}
		$ignoresql = $ignorefids ? ' AND f.fid NOT IN('.dimplode($ignorefids).')' : '';
		if($orderfield == 'membernum') {
			$fields = ', ff.membernum';
			$jointable = ' LEFT JOIN '.DB::table('discuss_field').' ff ON ff.fid=f.fid';
			$orderfield = 'ff.'.$orderfield;
		}
		return DB::fetch_all("SELECT f.* $fields FROM %t f $jointable WHERE 1 $ignoresql ORDER BY %i DESC ".DB::limit($start, $limit), array($this->_table, $status, $orderfield));
	}
	public function fetch_fid_by_name($name) {
		return DB::result_first("SELECT fid FROM %t WHERE name=%s", array($this->_table, $name));
	}
	
	public function fetch_all_by_fid($fids) {
		return DB::fetch_all("SELECT * FROM %t WHERE fid IN(%n)", array($this->_table, (array)$fids), $this->_pk);
	}
	
	
	
	public function update_archive($fids) {
		return DB::update('disucss_forum', array('archive' => '0'), "fid NOT IN (".dimplode($fids).")");
	}
	
	function fetch_table_struct($tablename, $result = 'FIELD') {
		if(empty($tablename)) {
			return array();
		}
		$datas = array();
		$query = DB::query("DESCRIBE ".DB::table($tablename));
		while($data = DB::fetch($query)) {
			$datas[$data['Field']] = $result == 'FIELD' ? $data['Field'] : $data;
		}
		return $datas;
	}

	function get_forum_by_fid($fid, $field = '', $table = '') {
		static $forumlist = array('forum' => array(), 'forumfield' => array());
		$table = $table != '' ? 'discuss_field' : 'discuss';
		$return = array();
		if(!array_key_exists($fid, $forumlist[$table])) {
			$forumlist[$table][$fid] = DB::fetch_first("SELECT * FROM ".DB::table($table)." WHERE fid=%d", array($fid));
			if(!is_array($forumlist[$table][$fid])) {
				$forumlist[$table][$fid] = array();
			}
		}

		if(!empty($field)) {
			$return = isset($forumlist[$table][$fid][$field]) ? $forumlist[$table][$fid][$field] : null;
		} else {
			$return = $forumlist[$table][$fid];
		}
		return $return;
	}

	function getQRcodeByfid($fid) {
		$target='./qrcode/discuss/'.$fid.'.png';
		if(@getimagesize(getglobal('setting/attachdir').$target)){
			return getglobal('setting/attachurl').$target;
		}else{//生成二维码
			$targetpath = dirname(getglobal('setting/attachdir').$target);
			dmkdir($targetpath);
			QRcode::png(getglobal('siteurl').MOD_URL.'&op=list&fid='.$fid,getglobal('setting/attachdir').$target,'M',4,2);
			return getglobal('setting/attachurl').$target;
		}
	}

	function fetch_archive($iscount = 0, $start = 0, $size = 20, $orderby = 'arhtime') {
		global $_G;
		$param = array($this->_table);
		if (!$_G['adminid']) {
			$fids = array_keys(C::t('discuss_user')->fetch_all_by_uid($_G['uid']));
			$where = ' and fid in(%n)';
			$param[] = $fids;
		}
		if ($iscount) {
			return DB::result_first('select count(*) from %t where inarchive > 0'.$where, $param);
		}
		$limit = ' limit '.$start.','.$size;
		$order = $orderby == 'arhtime' ? ' order by archivetime desc' : ' order by dateline desc';
		$fids = DB::fetch_all('select fid from %t where inarchive > 0'.$where.$order.$limit, $param, 'fid');
		return $this->fetch_all_info_by_fids(array_keys($fids));
	}

}

?>
