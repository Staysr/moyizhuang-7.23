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
class table_news extends dzz_table
{
	public function __construct() {

		$this->_table = 'news';
		$this->_pk    = 'newid';

		parent::__construct();
	}
	public function mod_by_newid($newids,$pass,$modreason){ //审核处理
		$pass=$pass?1:2;
		$newids=(array)$newids;
		$ret=DB::query("update %t SET status=%d , modreason=%s,moduid=%d,modtime=%d where newid IN(%n)",array($this->_table,$pass,$modreason,getglobal('uid'),TIMESTAMP,$newids));
			
		//发送通知用户审核情况
		if($ret){
			
			$ruids=array();
			foreach(DB::fetch_all("select authorid from %t where newid IN(%n)",array($this->_table,$newids)) as $value){
				$ruids[$value['authorid']]=$value['authorid'];
			}
			if($ruids){
				
				//通知发布者审核情况
				$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=news',1);
				foreach($ruids as $uid){
					if($uid!=getglobal('uid')){
						//发送通知
						$notevars=array(
										'from_id'=>$appid,
										'from_idtype'=>'app',
										'url'=>DZZSCRIPT.'?mod=news&status='.$pass,
										'author'=>getglobal('username'),
										'authorid'=>getglobal('uid'),
										'dataline'=>dgmdate(TIMESTAMP),
										'modreason'=>getstr($modreason,45),
										
										);
						
							$action='news_moderator_'.$pass;
							$type='news_moderator_'.$uid;
						
						dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/news');
					}
				}
				
			}
			if($pass==1){
				$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=news',0);
				foreach($newids as $newid){
					$arr=parent::fetch($newid);
					$uids=getUidsByOrgid($arr['orgids'],$arr['uids']);
					foreach($uids as $uid){
						if($uid!=getglobal('uid')){
							//发送通知
							$notevars=array(
											'from_id'=>$appid,
											'from_idtype'=>'app',
											'url'=>DZZSCRIPT.'?mod=news&op=view&newid='.$newid,
											'author'=>getglobal('username'),
											'authorid'=>getglobal('uid'),
											'subject'=>$arr['subject'],
											'dataline'=>dgmdate(TIMESTAMP),
											);
							
								$action='news_publish';
								$type='news_publish_'.$uid;
							
							dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/news');
						}
					}
				}

			}
		}
		return $ret;
	}
	
	
	public function delete_by_newid($newid){//删除信息；
		//删除信息
		$data=parent::fetch($newid);
		if($ret=parent::delete($newid)){
			//删除编辑器附件
			if($data['attachs']){
				 $attachs=explode(',',$data['attachs']);
				 C::t('attachment')->addcopy_by_aid($attachs,-1);
			}
			//删除图片内容
			C::t('news_pic')->delete_by_newid($newid);
			
			//删除信息查阅者
			C::t('news_viewer')->delete_by_newid($newid);
			
			//删除投票
			 C::t('vote')->delete_by_id_idtype($newid,'news');
			 
			 //删除评论
			 C::t('comment')->delete_by_id_idtype($newid,'news');
			
		}
		
		return $ret;
	}
	public function batch_delete_by_newid($newids){//删除信息；
		$newids=(array)$newids;
		$aids=array();
		foreach(DB::fetch_all("select * from %t where newid IN (%n)",array($this->_table,$newids)) as $value){
			if($value['attachs']){
				 $attachs=explode(',',$value['attachs']);
				 if($attachs) array_merge($aids,$attachs);
			}
		}
		$ret=0;
		if($ret=DB::delete($this->_table,"newid IN(".dimplode($newids).")")){
			//删除编辑器附件
			if($aids){
				C::t('attachment')->addcopy_by_aid($aids,-1);
			}
			//删除图片内容
			C::t('news_pic')->delete_by_newid($newids);
			
			//删除信息查阅者
			C::t('news_viewer')->delete_by_newid($newids);
			//删除投票
			 C::t('vote')->delete_by_id_idtype($newids,'news');
			 
			 //删除评论
			 C::t('comment')->delete_by_id_idtype($newids,'news');
		}
		return $ret;
	}
	public function insert_by_newid($arr){
		
		if($newid=parent::insert($arr,1)){
			if($arr['attachs']){
				 $attachs=explode(',',$arr['attachs']);
				 C::t('attachment')->addcopy_by_aid($attachs,1);
			}
		
			if($arr['status']==2){ //需要审核时，发送通知给管理员；
				if(!getglobal('cache/news:setting')) loadcache('news:setting');
				$setting=getglobal('cache/news:setting');
				
				if($setting['moderators']){
					
					//通知发布者审核情况
					$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=news',1);
					foreach($setting['moderators'] as $uid){
						if($uid!=getglobal('uid')){
							//发送通知
							$notevars=array(
											'from_id'=>$appid,
											'from_idtype'=>'app',
											'url'=>DZZSCRIPT.'?mod=news&status=2',
											'author'=>getglobal('username'),
											'authorid'=>getglobal('uid'),
											
											'dataline'=>dgmdate(TIMESTAMP),
											);
							
								$action='news_moderate';
								$type='news_moderate';
							
							dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/news');
						}
					}
				}
			}elseif($arr['status']==1){//通知发布范围内人员查看
				$uids=getUidsByOrgid($arr['orgids'],$arr['uids']);
				$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=news',0);
				foreach($uids as $uid){
					if($uid!=getglobal('uid')){
						//发送通知
						$notevars=array(
										'from_id'=>$appid,
										'from_idtype'=>'app',
										'url'=>DZZSCRIPT.'?mod=news&op=view&newid='.$newid,
										'author'=>getglobal('username'),
										'authorid'=>getglobal('uid'),
										'subject'=>$arr['subject'],
										'dataline'=>dgmdate(TIMESTAMP),
										);
						
							$action='news_publish';
							$type='news_publish_'.$uid;
						
						dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/news');
					}
				}
			}
			return $newid;
		}
		return false;
	}
	public function update_by_newid($arr){
		$data=parent::fetch($arr['newid']);
		if($return=parent::update($arr['newid'],$arr)){
			if($data['attachs']){
				 $attachs=explode(',',$data['attachs']);
				 C::t('attachment')->addcopy_by_aid($attachs,-1);
			}
			if(isset($arr['attachs'])){
				 $attachs=explode(',',$arr['attachs']);
				 C::t('attachment')->addcopy_by_aid($attachs,1);
			}
			//新添加的范围重新发送通知
			$orgids=$uids=array();
			if($arr['orgids']!=$data['orgids']){
				$norgids=$arr['orgids']?explode(',',$arr['orgids']):array();
				$oorgids=$data['orgids']?explode(',',$data['orgids']):array();
				$orgids=array_diff($norgids,$oorigids);
			}
			if($arr['uids']!=$data['uids']){
				$nuids=$arr['uids']?explode(',',$arr['uids']):array();
				$ouids=$data['uids']?explode(',',$data['uids']):array();
				$uids=array_diff($nuids,$ouids);
			}
			$new_uids=getUidsByOrgid($orgids,$uids);
			$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=news',0);
			foreach($new_uids as $uid){
				if($uid!=getglobal('uid')){
					//发送通知
					$notevars=array(
									'from_id'=>$appid,
									'from_idtype'=>'app',
									'url'=>DZZSCRIPT.'?mod=news&op=view&newid='.$data['newid'],
									'author'=>getglobal('username'),
									'authorid'=>getglobal('uid'),
									'subject'=>$data['subject'],
									'dataline'=>dgmdate(TIMESTAMP),
									);
					
						$action='news_publish';
						$type='news_publish_'.$uid;
					
					dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/news');
				}
			}
			
		}
		return $return;
	}
	
	
	
	 //评论回调函数
	 public function callback_by_comment($comment,$action='add',$ats=array()){
		 $newid=$comment['id'];
		if($action=='add'){
			if($comment['pcid']==0){
				self::increase($newid,array('comments'=>1));
			}
		}elseif($action=='delete'){
			if($comment['pcid']==0){
				self::increase($newid,array('comments'=>-1));
			}
		}
	 }
	 
	 public function increase($newids, $fieldarr) {
		$newids = dintval((array)$newids, true);
		$sql = array();
		$num = 0;
		$allowkey = array('views', 'comments');
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
			$num = DB::query($cmd.DB::table($this->_table)." SET ".implode(',', $sql)." WHERE newid IN (".dimplode($newids).")", 'UNBUFFERED');
			
		}
		return $num;
	}
}

?>
