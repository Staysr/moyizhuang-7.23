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

class table_jilu_item extends dzz_table
{
	public function __construct() {

		$this->_table = 'jilu_item';
		$this->_pk    = 'rid';
		$this->_pre_cache_key = 'jilu_item_';
		$this->_cache_ttl = 60*60;
		parent::__construct();
	}
	public function fetch_uids_by_rid($rid,$comments=1,$zans=1){//获取相关的用户
		$uids=array();
		$item=parent::fetch($rid);
		$uids[$item['authorid']]=$item['authorid'];//记录作者
		if($comments){
			foreach(DB::fetch_all("select authorid from %t where rid=%d ",array('jilu_comment',$rid)) as $value){
				$uids[$value['authorid']]=$value['authorid'];
			}
		}
		if($zans){
			foreach(DB::fetch_all("select uid from %t where rid=%d ",array('jilu_zan',$rid)) as $value){
				$uids[$value['uid']]=$value['uid'];
			}
		}
		return $uids;
	}
	public function increase($rids, $fieldarr) {
		$rids = dintval((array)$rids, true);
		$sql = array();
		$num = 0;
		$allowkey = array('zan', 'comments');
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
			$num = DB::query($cmd.DB::table($this->_table)." SET ".implode(',', $sql)." WHERE rid IN (".dimplode($rids).")", 'UNBUFFERED');
			$this->clear_cache($rids);
		}
		return $num;
	}
	public function delete_by_rid($rid,$force=false){//彻底删除
	
		if(!$item=parent::fetch($rid)) return false;
		if(parent::delete($rid)){
			C::t('jilu')->increase($item['jid'],array('num'=>-1));
			//删除附件
			C::t('jilu_attach')->delete_by_rid($rid);
			//删除赞
			C::t('jilu_zan')->delete_by_rid($rid);
			//删除todolist
			C::t('jilu_todolist')->delete_by_rid($rid);
			//删除评论
			C::t('jilu_comment')->delete_by_rid($rid);
			return true;
		}
		return false;
	}
	public function delete_by_jid($jid,$force=false){
		$rids=array();
		foreach(DB::fetch_all("select rid from %t where jid=%s",array($this->_table,$jid)) as $value){
			$rids[]=$value['rid'];
		}
		if(parent::delete($rids)){
			//删除附件
			C::t('jilu_attach')->delete_by_rid($rids);
			//删除赞
			C::t('jilu_zan')->delete_by_rid($rids);
			//删除todolist
			C::t('jilu_todolist')->delete_by_rid($rid);
			//删除评论
			C::t('jilu_comment')->delete_by_rid($rids);
			return true;
		}
		return false;
	}
	public function setLabel($rid,$pow,$isadd=1){
		include_once libfile('function/common');
		$item=parent::fetch($rid);
		if(!$jilu=C::t('jilu')->fetch($item['jid'])) return false;
		if($jilu['inarchive']) return false;
		$perm=getVPermByUid($item['jid']);
		if($item['authorid']!=getglobal('uid') && $perm<2) return false;
		$alllabels=getLabelsByjid($item['jid']);
		if(!isset($alllabels[$pow])) return false;
		$labels=getLabels($item['labels'],$item['jid']);
		if(!$isadd){
			unset($labels[$pow]);
		}else{
			$labels[$pow]=$alllabels[$pow];
		}
		$label=0;
		foreach($labels as $key =>$value){
			$label+=$value['pow'];
		}
		return parent::update($rid,array('labels'=>$label));
	}
	public function publish_wx($arr,$type,$uid,$wx){
		/*文字 和位置 默认和其他类型消息合并
		  连续发送的文字不合并
		  小视频不合并
		  图片自动合并，数量超过9张后不合并
		  所有合并操作都限制在一定时间内，暂定1小时；
		*/
		//获取用户最后发布的一条记录信息
		$limittime=TIMESTAMP-60*10;
		$item=DB::fetch_first("select * from %t where authorid=%d and jid='' and dateline>%d order by dateline DESC limit 1",array($this->_table,$uid,$limittime));
		
		switch($type){
			case 'text':
				if($item && empty($item['content'])){
					if(parent::update($item['rid'],array('content'=>getstr($arr)))){
						return array('rid'=>$item['rid'],'combined'=>1);
					}
				}else{//创建新记录
					$user=getuserbyuid($uid);
					$setarr=array('jid'=>'',
								  'authorid'=>$uid,
								  'author'=>$user['username'],
								  'dateline'=>TIMESTAMP,
								  'type'=>$type,
								  'content'=>getstr($arr),
								);
					if($rid=C::t('jilu_item')->insert($setarr,1)){
						return array('rid'=>$rid,'combined'=>0);
					}
				}
				break;
			case 'location':
				if($item && !$item['location']){
					if(parent::update($item['rid'],array('location'=>$arr['label'],'location_x'=>$arr['x'],'location_y'=>$arr['y']))){
						return array('rid'=>$item['rid'],'combined'=>1);
					}
				}else{//创建新记录
					$user=getuserbyuid($uid);
					$setarr=array('jid'=>'',
								  'authorid'=>$uid,
								  'author'=>$user['username'],
								  'dateline'=>TIMESTAMP,
								  'type'=>'text',
								  'content'=>'',
								  'location'=>$arr['label'],
								  'location_x'=>$arr['x'],
								  'location_y'=>$arr['y']
								);
					if($rid=C::t('jilu_item')->insert($setarr,1)){
						return array('rid'=>$rid,'combined'=>0);
					}
				}
				break;
			case 'image':
					if($return=C::t('jilu_attach')->getAidByMediaId($arr['mediaid'],$wx)){
						if($item && ($item['type']=='text' || ($item['type']=='image' && ($num=DB::result_first("select COUNT(*) from %t where rid=%d ",array('jilu_attach',$item['rid'])))<9))){
					
							$setarr=array('rid'=>$item['rid'],
										  'dateline'=>TIMESTAMP,
										  'aid'=>intval($return['aid']),
										  'title'=>$return['filename'],
										  'type'=>'image',
										  'img'=>'',
										  'url'=>'',
										  'ext'=>$return['filetype']
										 );
						
							if(C::t('jilu_attach')->insert($setarr,1)){
								C::t('attachment')->addcopy_by_aid($setarr['aid']);
								parent::update($item['rid'],array('type'=>'image'));
								return array('rid'=>$item['rid'],'combined'=>1,'imagesum'=>$num+1);
							}
					
						}else{//创建新记录
							$user=getuserbyuid($uid);
							$setarr=array('jid'=>'',
										  'authorid'=>$uid,
										  'author'=>$user['username'],
										  'dateline'=>TIMESTAMP,
										  'type'=>$type,
										  
										);
							if($rid=C::t('jilu_item')->insert($setarr,1)){
								$setarr=array('rid'=>$rid,
											  'dateline'=>TIMESTAMP,
											  'aid'=>intval($return['aid']),
											  'title'=>$return['filename'],
											  'type'=>'image',
											  'img'=>'',
											  'url'=>'',
											  'ext'=>$return['filetype']
											 );
						
								if(C::t('jilu_attach')->insert($setarr,1)){
									C::t('attachment')->addcopy_by_aid($setarr['aid']);
									return array('rid'=>$rid,'combined'=>0);
								}
								
							}
						}
					}
				break;
			case 'video':
					if($return=C::t('jilu_attach')->getAidByMediaId($arr['mediaid'],$wx,'mp4')){
						if($item && ($item['type']=='text' /*|| $item['type']=='video'*/)){
							$setarr=array('rid'=>$item['rid'],
										  'dateline'=>TIMESTAMP,
										  'aid'=>intval($return['aid']),
										  'title'=>$return['filename'],
										  'type'=>'video',
										  'img'=>'',
										  'url'=>'',
										  'ext'=>$return['filetype'],
										 );
						
							if(C::t('jilu_attach')->insert($setarr,1)){
								C::t('attachment')->addcopy_by_aid($setarr['aid']);
								parent::update($item['rid'],array('type'=>'video'));
								return array('rid'=>$item['rid'],'combined'=>1);
							}
					
						}else{//创建新记录
							$user=getuserbyuid($uid);
							$setarr=array('jid'=>'',
										  'authorid'=>$uid,
										  'author'=>$user['username'],
										  'dateline'=>TIMESTAMP,
										  'type'=>$type,
										  
										);
							if($rid=C::t('jilu_item')->insert($setarr,1)){
								$setarr=array('rid'=>$rid,
									  'dateline'=>TIMESTAMP,
									  'aid'=>intval($return['aid']),
									  'title'=>$return['filename'],
									  'type'=>'video',
									  'img'=>'',
									  'url'=>'',
									  'ext'=>$return['filetype'],
									 );
					
								if(C::t('jilu_attach')->insert($setarr,1)){
									C::t('attachment')->addcopy_by_aid($setarr['aid']);
									return array('rid'=>$rid,'combined'=>0);
								}
							}
						}
					}
				break;
			case 'voice':
					if($return=C::t('jilu_attach')->getAidByMediaId($arr['mediaid'],$wx,'arr[format]')){
						if($item && ($item['type']=='text' || $item['type']=='voice')){
							$setarr=array('rid'=>$item['rid'],
										  'dateline'=>TIMESTAMP,
										  'aid'=>intval($return['aid']),
										  'title'=>$return['filename'],
										  'type'=>'voice',
										  'img'=>'',
										  'url'=>'',
										  'ext'=>$return['filetype'],
										 );
						
							if(C::t('jilu_attach')->insert($setarr,1)){
								C::t('attachment')->addcopy_by_aid($setarr['aid']);
								parent::update($item['rid'],array('type'=>'voice'));
								return array('rid'=>$item['rid'],'combined'=>1);
							}
					
						}else{//创建新记录
							$user=getuserbyuid($uid);
							$setarr=array('jid'=>'',
										  'authorid'=>$uid,
										  'author'=>$user['username'],
										  'dateline'=>TIMESTAMP,
										  'type'=>$type,
										  
										);
							if($rid=C::t('jilu_item')->insert($setarr,1)){
								$setarr=array('rid'=>$rid,
									  'dateline'=>TIMESTAMP,
									  'aid'=>intval($return['aid']),
									  'title'=>$return['filename'],
									  'type'=>'voice',
									  'img'=>'',
									  'url'=>'',
									  'ext'=>$return['filetype'],
									 );
					
								if(C::t('jilu_attach')->insert($setarr,1)){
									C::t('attachment')->addcopy_by_aid($setarr['aid']);
									return array('rid'=>$rid,'combined'=>0);
								}
							}
						}
					}
				break;	
		}
		return false;
	}

	public function getDelJiluItem($limit, $keyword, $iscount,$date,$uids,$jids){
		include_once libfile('function/code');
		include_once libfile('function/common');
		$limitarr = explode('-', $limit);
		$parms = array('jilu_item', 'jilu', 'jilu_attach', 'jilu_todolist');
		if(count($limitarr) > 1){
			$limit = ' limit '.$limitarr[0].','.$limitarr[1];
		} else {
			$limit = ' limit '.$limitarr[0];
		}
		if(!empty($keyword)){
			$searchsql = ' and (i.content like %s or j.title like %s or a.title LIKE %s or a.url LIKE %s or t.content LIKE %s)';
			$parms[] = '%'.$keyword.'%';
			$parms[] = '%'.$keyword.'%';
			$parms[] = '%'.$keyword.'%';
			$parms[] = '%'.$keyword.'%';
			$parms[] = '%'.$keyword.'%';
		}
		if(!empty($date)){
			$searchsql .= ' and i.deletetime >= %d and i.deletetime <= %d';
			$parms[] = $date[0];
			$parms[] = $date[1];
		}
		$perm = getPermByUid(getglobal('uid'));
		if($perm < 2){
			$searchsql .= ' and i.recycledel < 1 and i.authorid = %d';
			$parms[] = getglobal('uid');
		}
		if(!empty($uids)){
			$searchsql .= ' and i.authorid IN(%n)';
			$parms[] = $uids;
		}
		if(!empty($jids)){
			$searchsql .= ' and j.jid IN(%n)';
			$parms[] = $jids;
		}
		if($iscount) return count(DB::fetch_all("select i.rid from %t i left join %t j on i.jid = j.jid left join %t a on i.rid = a.rid left join %t t on i.rid = t.rid where i.deletetime > 0 and (j.deletetime <= 0 or j.jid is null)".$searchsql.' group by i.rid', $parms));
		$result = array();
		foreach(DB::fetch_all("select i.*,j.title from %t i left join %t j on i.jid = j.jid left join %t a on i.rid = a.rid left join %t t on i.rid = t.rid where i.deletetime > 0 and (j.deletetime <= 0 or j.jid is null)".$searchsql.' group by i.rid order by i.deletetime DESC'.$limit, $parms) as $value){
			$author = getuserbyuid($value['deleteuid']);
			$value['deleteauthor'] = $author['username'];
			if($value['location']){
				$location=explode(' ',$value['location']);
				$value['location']=$location[0];
				if($location[1]) $value['location_title']=$location[1];
			}
			$value['content']=dzzcode($value['content']);
			if($value['labels']) $value['labels']=getLabels($value['labels'],$value['jid']);
			if($value['type']=='list'){
				$value['todos']=C::t('jilu_todolist')->fetch_all_by_rid($value['rid']);
			}else{
				$value['attachs']=C::t('jilu_attach')->fetch_all_by_rid($value['rid']); 
			}
			$result[] = $value;
		};
		return $result;
	}

}

?>
