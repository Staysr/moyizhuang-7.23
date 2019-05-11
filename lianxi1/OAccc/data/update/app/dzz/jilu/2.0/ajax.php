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

$publish_type=array('text'=>lang('text'),'image'=>lang('image'),'attach'=>lang('attach'),'link'=>lang('link'),'list'=>lang('list'),'video'=>lang('video'),'voice'=>lang('voice'));
require_once 'conf.php';
$ismobile=helper_browser::ismobile();
$do=trim($_GET['do']);
if($_GET['do']=='imageupload'){
		include libfile('class/uploadhandler');
		$options=array( 'accept_file_types' => '/\.(gif|jpe?g|jpg|png)$/i',
						'upload_dir' =>$_G['setting']['attachdir'].'cache/',
						'upload_url' => $_G['setting']['attachurl'].'cache/',
						'thumbnail'=>array('max-width'=>240,'max-height'=>160)
						);
		$upload_handler = new uploadhandler($options);
		exit();
}elseif($_GET['do']=='imageupload_image'){
		include libfile('class/uploadhandler');
		$options=array( 'accept_file_types' => '/\.(gif|jpe?g|jpg|png)$/i',
						'upload_dir' =>$_G['setting']['attachdir'].'cache/',
						'upload_url' => $_G['setting']['attachurl'].'cache/',
						'thumbnail'=>array('max-width'=>100,'max-height'=>100)
						);
		$upload_handler = new uploadhandler($options);
		exit();
}elseif($_GET['do']=='mp4upload'){
		include libfile('class/uploadhandler');
		$options=array( 'accept_file_types' => '/\.(mp4|ogg)$/i',
						'upload_dir' =>$_G['setting']['attachdir'].'cache/',
						'upload_url' => $_G['setting']['attachurl'].'cache/',
						'thumbnail'=>array('max-width'=>100,'max-height'=>100)
						);
		$upload_handler = new uploadhandler($options);
		exit();
}elseif($_GET['do']=='fileupload'){
		include libfile('class/uploadhandler');
		$options=array( 'accept_file_types' => '/.+?$/i',
						'upload_dir' =>$_G['setting']['attachdir'].'cache/',
						'upload_url' => $_G['setting']['attachurl'].'cache/',
						'thumbnail'=>array('max-width'=>100,'max-height'=>100)
						);
		$upload_handler = new uploadhandler($options);
		exit();
}elseif($_GET['do']=='getLinkInfo'){
	include_once libfile('function/common');
	$link=trim($_GET['link']);
	$data=getLinkInfo($link);
	exit(json_encode($data));
}elseif($do=='setSave'){
	$jid=trim($_GET['jid']);
	include_once libfile('function/common');
	$perm=getVPermByUid($jid);
	$jilu=C::t('jilu')->fetch($jid);
	if($perm<2){
		exit(lang('privilege'));
	}
	if($jilu['deletetime'] > 0) exit(lang('recycle_file_can_not_edit'));
	$setarr=array();
	$setarr[trim($_GET['name'])]=$_GET['val'];
	switch($_GET['name']){
		case 'title':
			if(empty($_GET['val'])) exit(lang('name_not_empty'));
			$setarr[trim($_GET['name'])]=getstr($_GET['val'],255);
			break;
		case 'desc':
			$setarr[trim($_GET['name'])]=getstr($_GET['val'],255);
			break;
		case 'color':
			if(preg_match("/#\w{6}/i",$_GET['val'])){
				$setarr['color']=$_GET['val'];
			}else{
				$setarr['color']='';
			}
		
			break;
			
		case 'privacy':
			$setarr[trim($_GET['name'])]=intval($_GET['val']);
			break;
		case 'titlehidden':
			$setarr[trim($_GET['name'])]=intval($_GET['val']);
			break;
		case 'perm':
			$setarr[trim($_GET['name'])]=intval($_GET['val']);
			break;
		case 'cover':
			if($jilu['cover'] && $jilu['cover']!=intval($_GET['val'])) C::t('attachment')->delete_by_aid($jilu['cover']);
			if(C::t('jilu')->update($jid,array('cover'=>intval($_GET['val'])))){
				C::t('attachment')->addcopy_by_aid(intval($_GET['val']));
				exit('success');
			}
			exit('error');
			break;
			
	}
	C::t('jilu')->update($jid,$setarr);
	exit('success');
}elseif($do=='coverSave'){
	include_once libfile('function/common');
	
	$userdata=DB::fetch_first("select * from %t where jid='' and uid=%d ",array('jilu_user',$_G['uid']));
	$setarr=array();
	$setarr[trim($_GET['name'])]=$_GET['val'];
	switch($_GET['name']){
		case 'color':
			if(preg_match("/#\w{6}/i",$_GET['val'])){
				$setarr['color']=$_GET['val'];
			}else{
				$setarr['color']='';
			}
			C::t('jilu_user')->update($userdata['id'],$setarr);
			exit('success');
			break;
		case 'cover':
			
			if($userdata['cover'] && $userdata['cover']!=intval($_GET['val'])) C::t('attachment')->delete_by_aid($userdata['cover']);
			if(C::t('jilu_user')->update($userdata['id'],array('cover'=>intval($_GET['val'])))){
				C::t('attachment')->addcopy_by_aid(intval($_GET['val']));
				exit('success');
			}
			exit('error');
			break;
			
	}
		
}elseif($do=='create'){
	include_once libfile('function/common');
	$perm=getPermByUid($_G['uid']);
	if($perm<1){
		exit(lang('privilege'));
	}
	// $privacy = intval($_GET['privacy']);
	if(submitcheck('createsubmit')){
		if(empty($_GET['title'])) showmessage(lang('need_name_to_jilu'));
		$setarr=array('title'=>censor(getstr($_GET['title'],255)),
					  'desc'=>censor(getstr($_GET['desc'],255)),
					  'privacy'=>2,
					  'dateline'=>TIMESTAMP,
					  'updatetime'=>TIMESTAMP,
					  'authorid'=>$_G['uid'],
					  'author'=>$_G['username'],
					  'color'=>'#3BAEDA'
					  );
	    if($jid=C::t('jilu')->insert($setarr)){
			//将创建者加到管理组
			$user=array('jid'=>$jid,
						'perm'=>3,
						'uid'=>$_G['uid'],
						'username'=>$_G['username'],
						'dateline'=>TIMESTAMP);
			C::t('jilu_user')->insert($user);
			C::t('jilu_user')->setLastvisit($jid,$_G['uid']);
			showmessage('do_success',dreferer(),array('jid'=>$jid),array('showmsg'=>true));
		}else{
			showmessage(lang('create_failed'));
		}
	}
	
}elseif($do=='getJiluList'){
	$jid=trim($_GET['jid']);
	$data=C::t('jilu')->fetch($jid);
	$data['cover_uids']=C::t('jilu_user')->fetch_cover_uids_by_jid($jid);
	if($data['lastactive']){
		 $data['lastactive']=unserialize($data['lastactive']);
		 $data['lastactive']['content']=dzzcode($data['lastactive']['content']);
	}
	if($data['dateline']) $data['fdateline']=dgmdate($data['dateline'],'u');
	if($data['lastvisit'] && $data['updatetime']>$data['lastvisit']) $data['new']=DB::result_first("select COUNT(*) from %t where jid=%s and dateline>%d",array('jilu_item',$data['jid'],$data['lastvisit']));
}elseif($do=='publish'){
	$json=intval($_GET['json']);
	if(!$_G['uid']) $json?exit(json_encode(array('error'=>lang('privilege')))):showmessage(lang('privilege'));
	$space=dzzgetspace($_G['uid']);
	$space['attachextensions'] = $space['attachextensions']?explode(',',$space['attachextensions']):array();
	$space['maxattachsize'] =intval($space['maxattachsize']);
	$jid=trim($_GET['jid']);
	$type=trim($_GET['type']);
	if(!in_array($type,array('text','image','attach','video','link','list','voice'))) $type='text';
	include_once libfile('function/common');
	
	$perm=getVPermByUid($jid);
	if($jilu=C::t('jilu')->fetch($jid)){
		if($perm<2 || $jilu['inarchive']>0) $json?exit(json_encode(array('error'=>lang('privilege')))):showmessage(lang('privilege'));
		if($jilu['deletetime'] > 0) $json?exit(json_encode(array('error'=>lang('recycle_file_can_not_edit')))):showmessage(lang('recycle_file_can_not_edit'));
	}
	if(submitcheck('publishsubmit')){
		$message=trim($_GET['content']);
		//获得提醒用户
		$at_users = array();
		$message=preg_replace_callback("/@\[(.+?):(.+?)\]/i","atreplacement",$message);
		//内容为链接时
		if($json && preg_match("/^((http|https|ftp|gopher|news|telnet|rtsp|mms|callto|bctp|thunder|qqdl|synacast){1}:\/\/|www\.)[^\[\"']+/i",$message)){
			if(($attach=getLinkInfo($message)) && !$attach['error']){
				$_GET['attach']=array();
				foreach($attach as $key=>$value){
					$_GET['attach'][$key][]=$value;
				}
				
				$message='';
				$type='link';
			}
		}
		$message=censor($message);
		if ($type == 'text') {
			if(empty($message)) exit(json_encode(array('error' => lang('please_enter_content'))));
		} elseif ($type == 'list') {
			if(empty($message) && (count($_GET['todo']['content']) == 1 && empty($_GET['todo']['content'][0]))) exit(json_encode(array('error' => lang('please_enter_content'))));
		} else {
			if(empty($message) && empty($_GET['attach'])) exit(json_encode(array('error' => lang('please_enter_content'))));
		}
		$setarr=array('jid'=>trim($_GET['jid']),
					  'authorid'=>$_G['uid'],
					  'author'=>$_G['username'],
					  'dateline'=>TIMESTAMP,
					  'type'=>$type,
					  'content'=>getstr($message),
					  'style'=>intval($_GET['style']),
					  'location_x'=>floatval($_GET['x']),
					  'location_y'=>floatval($_GET['y']),
					  'location'=>getstr($_GET['location']),
					  'ats'=>$at_users?implode(',',$at_users):''
					);
		if($rid=C::t('jilu_item')->insert($setarr,1)){
			//更新最后更新
			$update=array('num'=>1,
						  'updatetime'=>array($_G['timestamp']),
						  'lastactive'=>array(serialize(array('username'=>$_G['username'],'uid'=>$_G['uid'],'type'=>$type,'content'=>getstr($message,30))))//当删除最近一条更新，就回导致不正确。2.0：记录(没有使用到).
						  );
			if($jid){
				C::t('jilu')->increase($jid,$update);
				DB::update('jilu_user', array('lastvisit' => $_G['timestamp']), array('jid' => $jid, 'uid' => $_G['uid']));
			}
			//插入附件
			if($type=='list'){
				C::t('jilu_todolist')->update_by_rid($rid,$_GET['todo']);
			}else{
				@session_start();
				C::t('jilu_attach')->update_by_rid($rid,$_GET['attach'],$_SESSION['ismp']); 
			}
			if($at_users){//提醒相关人员
				$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=jilu',1);
				
				foreach($at_users as $uid){
					if($uid!=getglobal('uid')){
						//发送通知
						$notevars=array(
										'from_id'=>$appid,
										'from_idtype'=>'app',
										'url'=>MOD_URL.'&id='.$jid.'&optrid='.$rid,
										'author'=>getglobal('username'),
										'authorid'=>getglobal('uid'),
										'dataline'=>dgmdate(TIMESTAMP),
										'content'=>getstr($setarr['content'],30).($type!='text'?('['.($publish_type[$type]).']'):''),
										
										);
						
							$action='jilu_item_at';
							$type='jilu_item_at_'.$rid;
						
						dzz_notification::notification_add($uid, $type, $action, $notevars, 0, MOD_PATH);
					}
				}
			}
			$pamarr = $_GET['ismy'] ? array('rid' => $rid, 'ismy' => 1) : array('rid' => $rid);
			$json?exit(json_encode(array('msg'=>'success', 'type' => $type,'rid'=>$rid, 'ismy' => $_GET['ismy']))):showmessage('do_success',dreferer(),$pamarr,array());
		}
	}
}elseif($do=='loadnewest'){
	include_once libfile('function/common');
	include_once libfile('function/code');
	$time=intval($_GET['t']);
	$jid=trim($_GET['jid']);
	$jilu=C::t('jilu')->fetch($jid);
	if($_G['uid']) C::t('jilu_user')->setLastvisit($jid,$_G['uid']);
	$perm=getVPermByUid($jid);
	$list=array();
	if($jilu['updatetime']>$time){
		foreach(DB::fetch_all("select * from %t where jid=%s and dateline>%d and authorid!=%d  order by dateline DESC ",array('jilu_item',$jid,$time,$_G['uid'])) as $value){
			$value['content']=dzzcode($value['content']);
			if($value['labels']) $value['labels']=getLabels($value['labels'],$value['jid']);
			if($value['type']=='list'){
				$value['todos']=C::t('jilu_todolist')->fetch_all_by_rid($value['rid']);
			}else{
				$value['attachs']=C::t('jilu_attach')->fetch_all_by_rid($value['rid']);
			}
			
			$list[]=$value;
		}
		$count=count($list);
	}
}elseif($do=='loadnewestinfo'){
	$time=intval($_GET['t']);
	$jid=trim($_GET['jid']);
	$jilu=C::t('jilu')->fetch($jid);
	
	$list=array();
	if($jilu['updatetime']>$time){
		$count=DB::result_first("select COUNT(*) from %t where jid=%s and dateline>%d and authorid!=%d",array('jilu_item',$jid,$time,$_G['uid']));
	}else{
		$count=0;
	}
	exit(json_encode(array('count'=>$count,'timeout'=>$count?60*60:60*60*5,'lastvisit'=>TIMESTAMP,'starttime'=>$time)));
}elseif($do=='loadmore'){
	include_once libfile('function/code');
	include_once libfile('function/common');
	if(isset($_GET['jid'])){
		$ismy=0;
		$jid=trim($_GET['jid']);
		$jilu=C::t('jilu')->fetch($jid);
		$perm=getVPermByUid($jid);
	}else{
		$ismy=1;
		// $perm=getPermByUid($_G['uid']);
		$perm = 3;
	}
	$rid=empty($_GET['rid'])?0:intval($_GET['rid']);
	$keyword=getstr($_GET['keyword']);
	$perpage=10;
	if(isset($_GET['jid'])){
		$jilu = C::t('jilu')->fetch($_GET['jid']);
		$param=array('jilu_item', 'jilu_attach', 'jilu_todolist', $jid);
		$sql='deletetime <= 0 and jid=%s';
	}else{
		$param=array('jilu_item', 'jilu', 'jilu_attach', 'jilu_todolist',$_G['uid']);
		$sql='i.deletetime <= 0 and i.authorid=%s and ((j.deletetime <= 0 and j.inarchive < 1) or j.deletetime is null)';
	}
	//处理时间跨度
	//日期筛选
    if(isset($_GET['after']) && $_GET['after']){
        $afterdate = strtotime($_GET['after']);
        $sql .= " and i.dateline>=%d";
        $param[] = $afterdate;
    }

    if(isset($_GET['before']) && $_GET['before']){
        $beforedate = strtotime($_GET['before']);
        $sql .= " and i.dateline<=%d";
        $param[] = $beforedate;
    }
	//处理标签
	if($_GET['labels']){
		$label=0;
		$_GET['labels'] = is_array($_GET['labels']) ? $_GET['labels'] : explode(',',$_GET['labels']);
		foreach($_GET['labels'] as  $pow){
			if(intval($pow)){
				$label+=intval($pow);
				$labels[]=intval($pow);
			}
		}
		if($label){
			$sql.=" and labels & %d";
			$param[]=$label;
		}
	}
	//处理用户
	if($_GET['uids']){
		$_GET['uids'] = is_array($_GET['uids']) ? $_GET['uids'] : explode(',',$_GET['uids']);
		$uids=array();
		foreach($_GET['uids'] as  $uid){
			if(intval($uid)){
				$uids[]=intval($uid);
			}
		}
		if($uids){
			$sql.=" and authorid IN(%n)";
			$param[]=$uids;
		}
	}
	//处理jids
	if($_GET['jids']){
		$_GET['jids'] = is_array($_GET['jids']) ? $_GET['jids'] : explode(',',$_GET['jids']);
		$jids=array();
		foreach($_GET['jids'] as  $val){
			if(!empty($val)){
				if($val=='none') $val='';
				$jids[]=($val);
			}
		}
		if($jids){
			$sql.=" and i.jid IN(%n)";
			$param[]=$jids;
		}
		
	}
	if($keyword){
		if(isset($_GET['jid'])){
			$sql.=" and (i.content LIKE %s or a.title LIKE %s or a.url LIKE %s or t.content LIKE %s)";
		} else {
			$sql.=" and (j.title LIKE %s or i.content LIKE %s or a.title LIKE %s or a.url LIKE %s or t.content LIKE %s)";
			$param[]='%'.$keyword.'%';
		}
		$param[]='%'.$keyword.'%';
		$param[]='%'.$keyword.'%';
		$param[]='%'.$keyword.'%';
		$param[]='%'.$keyword.'%';
	}
	
	$gets = array(
					'mod'=>MOD_NAME,
					'op'=>'ajax',
					'do'=>$do,
					'jid'=>$jid,
					'labels'=>$labels?implode(',',$labels):'',
					'uids'=>$uids?implode(',',$uids):'',
					'keyword'=>$_GET['keyword'],
					'after'=>$_GET['after'],
					'before'=>$_GET['before'],
					'method'=>$optype,
					'jids'=>$jids?implode(',',$jids):'',
					'mytype'=>$_GET['mytype']?implode(',', $_GET['mytype']):'',
				);
	if(isset($_GET['jid'])){
		$orderby="order by p.pin_type DESC,p.dateline,i.dateline DESC";
	}else{
		$orderby="order by i.dateline DESC";
	}
	$theurl = DZZSCRIPT."?".url_implode($gets);
	$list=array();
	if(isset($_GET['jid'])){
		$count = DB::result_first("select COUNT(*) from %t i left join %t a on i.rid = a.rid left join %t t on i.rid = t.rid where $sql group by i.rid",$param);
	}else{
		$count = DB::result_first("select COUNT(*) from %t i left join %t j on j.jid = i.jid left join %t a on i.rid = a.rid left join %t t on i.rid = t.rid where $sql group by i.rid",$param);
	}
	$start = intval($_GET['nextStart']) ? intval($_GET['nextStart']) : 0;
	$nextStart = $start + $perpage;
	if($nextStart >= $count) $nextStart = false;
	$limit = $start.','.$perpage;
	if($count){
		if($rid){
			 $temp=C::t('jilu_item')->fetch($rid);
			 if($temp['jid']!=$jid) unset($temp);
		}
		if(isset($_GET['jid'])){
			array_splice($param, 1, 0, array('jilu_pin', $_G['uid']));
			$data=DB::fetch_all("select i.*,p.pin_type from %t i left join %t p on i.rid = p.data_id and (p.pin_type = 2 or (p.pin_type = 1 and p.uid = %d)) left join %t a on i.rid = a.rid left join %t t on i.rid = t.rid where $sql group by i.rid $orderby limit $limit",$param);
		}else{
			$data=DB::fetch_all("select i.* from %t i left join %t j on j.jid = i.jid left join %t a on i.rid = a.rid left join %t t on i.rid = t.rid where $sql group by i.rid $orderby limit $limit",$param);
		}
		if($temp) $data=array_merge(array($temp),$data);
		$jids = array();
		foreach($data as $value){
			$jids[] = $value['jid'];
			if($value['lastactive']){
				 $value['lastactive']=unserialize($value['lastactive']);
				 $value['lastactive']['content']=stripsAT($value['lastactive']['content']);
			}
			$value['content']=dzzcode($value['content']);
			if($value['labels']) $value['labels']=getLabels($value['labels'],$value['jid']);
			if($value['type']=='list'){
				$value['todos']=C::t('jilu_todolist')->fetch_all_by_rid($value['rid']);
			}else{
				$value['attachs']=C::t('jilu_attach')->fetch_all_by_rid($value['rid']);
			}
			if($ismy){
				$ldate = lang('date');
				if($value['jid']) $value['jilu']=C::t('jilu')->fetch($value['jid']);
				$datearr=getdate($value['dateline']);
				
				$today=strtotime(date("Y-m-d"));
				$cyear=gmdate("Y",TIMESTAMP);
				if($value['dateline']>$today){
					$value['date']['title']=lang('today');
				}elseif($value['dataline']>$today-24*60*60){
					$value['date']['title']=$ldate['yday'];
				}elseif($value['dataline']>$today-24*60*60*2){
					$value['date']['title']=$ldate['byday'];
				}else{
					$value['date']['title']='<span class="day">'.($datearr['mday']<10?('0'.$datearr['mday']):$datearr['mday']).'</span><span class="month">'.$datearr['mon'].'</span><span class="zmonth">'.lang('month').'</span>';
				}
				$value['date']['subtitle']='<span class="hour">'.($datearr['hours']<10?('0'.$datearr['hours']):$datearr['hours']).'</span>:<span class="minute">'.($datearr['minutes']<10?('0'.$datearr['minutes']):$datearr['minutes']).'</span>';
				if($cyear!=$datearr['year']){//不是当年的列出年份
					$value['date']['yeartitle']='<span class="year">'.$datearr['year'].'</span>';
				}
				$value['date']['total']=$datearr['year'].'年'.$datearr['mon'].lang('month').$datearr['mday'].lang('day').' '.$datearr['hours'].':'.$datearr['minutes'].':'.$datearr['seconds'];
			}
			if($value['location']){
				$location=explode(' ',$value['location']);
				$value['location']=$location[0];
				if($location[1]) $value['location_title']=$location[1];
			}
			if($value['comments']) $value['cmts']=C::t('jilu_comment')->fetch_cmt_by_rid($value['rid']);
			if($value['zan']) $value['zans']=C::t('jilu_zan')->fetch_all_by_rid($value['rid']);
			$value['cover_uids']=C::t('jilu_user')->fetch_cover_uids_by_jid($value['jid']);
			$list[]=$value;
		}
	}
}elseif($do=='getItem'){ //获取一条记录
	include_once libfile('function/code');
	include_once libfile('function/common');
	$rid=intval($_GET['rid']);
	if($value=C::t('jilu_item')->fetch($rid)){
		$jid=trim($value['jid']);
		if($jilu=C::t('jilu')->fetch($jid)){
			$pin_type = DB::result_first('select pin_type from %t where data_id = %d and type = 2', array('jilu_pin', $rid));
			$ismy=intval($_GET['ismy']) ? intval($_GET['ismy']) : 0;
			$perm=getVPermByUid($jid);
		}else{
			$ismy=1;
			$perm=3;
		}
		$value['content']=dzzcode($value['content']);
		if($value['labels']) $value['labels']=getLabels($value['labels'],$value['jid']);
		if($value['type']=='list'){
			$value['todos']=C::t('jilu_todolist')->fetch_all_by_rid($value['rid']);
		}else{
			$value['attachs']=C::t('jilu_attach')->fetch_all_by_rid($value['rid']);
		}
		if($ismy){
				$ldate = lang('date');
				if($value['jid']) $value['jilu']=C::t('jilu')->fetch($value['jid']);
				$datearr=getdate($value['dateline']);
				
				$today=strtotime(date("Y-m-d"));
				$cyear=gmdate("Y",TIMESTAMP);
				if($value['dateline']>$today){
					$value['date']['title']=lang('today');
				}elseif($value['dataline']>$today-24*60*60){
					$value['date']['title']=$ldate['yday'];
				}elseif($value['dataline']>$today-24*60*60*2){
					$value['date']['title']=$ldate['byday'];
				}else{
					$value['date']['title']='<span class="day">'.($datearr['mday']<10?('0'.$datearr['mday']):$datearr['mday']).'</span><span class="month">'.$datearr['mon'].'</span><span class="zmonth">'.lang('month').'</span>';
				}
				$value['date']['subtitle']='<span class="hour">'.($datearr['hours']<10?('0'.$datearr['hours']):$datearr['hours']).'</span>:<span class="minute">'.($datearr['minutes']<10?('0'.$datearr['minutes']):$datearr['minutes']).'</span>';
				if($cyear!=$datearr['year']){//不是当年的列出年份
					$value['date']['yeartitle']='<span class="year">'.$datearr['year'].'</span>';
				}
				$value['date']['total']=$datearr['year'].lang('year').$datearr['mon'].lang('month').$datearr['mday'].lang('day').' '.$datearr['hours'].':'.$datearr['minutes'].':'.$datearr['seconds'];
		}
		if($value['location']){
				$location=explode(' ',$value['location']);
				$value['location']=$location[0];
				if($location[1]) $value['location_title']=$location[1];
			}
		if($value['zan']) $value['zans']=C::t('jilu_zan')->fetch_all_by_rid($value['rid']);
		if($value['comments']) $value['cmts']=C::t('jilu_comment')->fetch_cmt_by_rid($value['rid']);
		$value['pin_type'] = $pin_type ? $pin_type : 0;
	}
}elseif($do=='zan'){ //点赞	
    if(!$_G['uid']){
		exit(json_encode(array('error'=>lang('privilege'))));
	}
	$jilu = C::t('jilu')->fetch($_GET['jid']);
	if($jilu['deletetime'] > 0 || $jilu['inarchive']) exit(json_encode(array('error'=>lang('can_not_edit'))));
	if(C::t('jilu_zan')->insert_by_rid(intval($_GET['rid']),intval($_GET['zan']))){
		exit(json_encode(array('msg'=>'success','uid'=>$_G['uid'], 'avatar' => avatar_block($_G['uid']))));
	}
	exit(json_encode(array('error'=>lang('zaned'))));			  
}elseif($do=='attachdel'){//删除附件
	include_once libfile('function/common');
	
	$qid=intval($_GET['qid']);
	if(!$attach=C::t('jilu_attach')->fetch($qid)){
		exit(json_encode(array('error'=>lang('attach_not_exist'))));
	}
	$item=C::t('jilu_item')->fetch($attach['rid']);
	$jilu=C::t('jilu')->fetch($item['jid']);
	$perm=getVPermByUid($item['jid']);
	if($jilu['inarchive']>0 || ($perm<3  && $item['authorid']!=$_G['uid'])) exit(json_encode(array('error'=>lang('privilege'))));
	
	if(C::t('jilu_attach')->delete_by_qid($qid)){
		exit(json_encode(array('msg'=>'success')));
	}else{
		exit(json_encode(array('error'=>lang('delete_error1'))));
	}
}elseif($do=='todocheck'){
	include_once libfile('function/common');
	
	$todoid=intval($_GET['todoid']);
	if(!$todo=C::t('jilu_todolist')->fetch($todoid)){
		exit(json_encode(array('error'=>lang('list_not_exist'))));
	}
	$item=C::t('jilu_item')->fetch($todo['rid']);
	$jilu = C::t("jilu")->fetch($item['jid']);
	if($jilu['inarchive'] > 0){
		exit(json_encode(array('error' => lang('this_jilu_archived'))));
	}
	if($item['jid']){
		$perm = C::t('jilu_user')->fetch_perm_by_uid($_G['uid'], $item['jid']);
		if($perm < 2 && $item['authorid'] != $_G['uid'] && !$_G['adminid']){
			exit(json_encode(array('error'=>lang('privilege'))));
		}
	} elseif($item['authorid'] != $_G['uid']) {
		exit(json_encode(array('error'=>lang('privilege').$_G['adminid'])));
	}
	if(C::t('jilu_todolist')->update($todoid,array('checked'=>intval($_GET['checked'])))){
		exit(json_encode(array('msg'=>'success')));
	}else{
		exit(json_encode(array('error'=>lang('delete_error1'))));
	}	
}elseif($do=='item_delete'){//删除附件(回收站)
	error_reporting(0);
	include_once libfile('function/common');
	
	$rid=intval($_GET['rid']);
	if(!$item=C::t('jilu_item')->fetch($rid)){
		exit(json_encode(array('error'=>lang('attach_not_exist'))));
	}
	$jilu=C::t('jilu')->fetch($item['jid']);
	$perm=getVPermByUid($item['jid']);
	if($jilu['inarchive']>0 || ($perm<2  && $item['authorid']!=$_G['uid'])) exit(json_encode(array('error'=>lang('privilege'))));
	
	if(DB::update('jilu_item',array('deleteuid' => $_G['uid'], 'deletetime' => TIMESTAMP), array('rid' => $rid))){
		C::t('jilu_pin')->deletePin(2, $rid);
		exit(json_encode(array('msg'=>'success')));
	}else{
		exit(json_encode(array('error'=>lang('delete_error1'))));
	}		
}elseif($do=='item_trodelete'){//彻底删除
	error_reporting(0);
	include_once libfile('function/common');
	
	$rid=intval($_GET['rid']);
	if(!$item=C::t('jilu_item')->fetch($rid)){
		exit(json_encode(array('error'=>lang('attach_not_exist'))));
	}
	$jilu=C::t('jilu')->fetch($item['jid']);
	$perm=getVPermByUid($item['jid']);
	if($jilu['inarchive']>0 || ($perm<3  && $item['authorid']!=$_G['uid'])) exit(json_encode(array('error'=>lang('privilege'))));
	
	if(C::t('jilu_item')->delete_by_rid($rid)){
		exit(json_encode(array('msg'=>'success')));
	}else{
		exit(json_encode(array('error'=>lang('delete_error1'))));
	}	
}elseif($do=='item_pin'){//置顶操作
	include_once libfile('function/common');
	$rid=intval($_GET['rid']);
	$pin_type = intval($_GET['pin_type']);
	if(!$item=C::t('jilu_item')->fetch($rid)){
		exit(json_encode(array('error'=>lang('jilu_not_exist'))));
	}
	$jilu=C::t('jilu')->fetch($_GET['jid']);
	if($jilu['deletetime'] > 0 || $jilu['inarchive'] > 0) $json?exit(json_encode(array('error'=>lang('can_not_opt')))):showmessage(lang('can_not_opt'));
	$perm=getVPermByUid($item['jid']);
	if($perm<2) exit(json_encode(array('error'=>lang('privilege'))));
	if ($pin_type == 2) {
		if($perm<3) exit(json_encode(array('error'=>lang('privilege'))));
	}
	if($_GET['display'] > 0){
		if ($pin_type == 2) {
			C::t('jilu_pin')->deletePin(2, $rid);
		}
		C::t('jilu_pin')->addPin(2, $pin_type, $rid);
	} else {
		C::t('jilu_pin')->cancelPin(2, $pin_type, $rid);
	}
	exit(json_encode(array('msg'=>'success')));
}elseif($do=='item_move'){//移动操作
	include_once libfile('function/common');
	$rid=intval($_GET['rid']);
	$jid=$_GET['jid'];
	$perm = getPermByUid($_G['uid']);
	if(empty($jid)){
		exit(json_encode(array('error' => lang('chose_jilu'))));
	}
	if(!$jilu=C::t('jilu')->fetch($jid)){
		exit(json_encode(array('error'=>lang('jilu_not_exist'))));
	}
	if(C::t('jilu_user')->fetch_perm_by_uid(getglobal('uid'),$jid)<2 && $perm < 2){
		exit(json_encode(array('error'=>lang('privilege'))));
	}
	if(!$item=C::t('jilu_item')->fetch($rid)){
		exit(json_encode(array('error'=>lang('jilu_not_exist'))));
	}
	if(C::t('jilu_user')->fetch_perm_by_uid(getglobal('uid'),$item['jid'])<2 && $perm < 2){
		exit(json_encode(array('error'=>lang('privilege'))));
	}
	if($jilu['deletetime'] > 0) exit(json_encode(array('error'=>lang('recycle_file_can_not_edit'))));
	if(C::t('jilu_item')->update($rid,array('jid'=>$jid))){
		C::t('jilu')->increase($item['jid'],array('num'=>-1));
		C::t('jilu')->increase($jid,array('num'=>1,'updatetime'=>array($_G['timestamp']),'lastactive'=>array(serialize(array('username'=>$_G['username'],'uid'=>$_G['uid'],'type'=>$item['type'],'content'=>getstr($item['message'],30))))));
		exit(json_encode(array('msg'=>'success','jid'=>$jid,'title'=>$jilu['title'])));
	}else{
		exit(json_encode(array('nochange'=>1, 'error' => lang('move_nochange'))));
	}
	
}elseif($do=='setLabel'){
	$rid=intval($_GET['rid']);
	$pow=intval($_GET['pow']);
	$isadd=intval($_GET['isadd']);
	$jid=trim($_GET['jid']);
	$jilu=C::t('jilu')->fetch($jid);
	if($jilu['deletetime'] > 0) $json?exit(json_encode(array('error'=>lang('recycle_file_can_not_edit')))):showmessage(lang('recycle_file_can_not_edit'));
	if(C::t('jilu_item')->setLabel($rid,$pow,$isadd)){
		exit(json_encode(array('msg'=>'success')));	
	}else{
		exit(json_encode(array('error'=>lang('privilege'))));	
	}	
}elseif($do=='item_edit'){//编辑记录
	include_once libfile('function/common');
	$rid=intval($_GET['rid']);
	$data=C::t('jilu_item')->fetch($rid);
	$ismy = $_GET['ismy'];
	$type=$data['type'];
	$jilu=C::t('jilu')->fetch($data['jid']); 
	$perm=getVPermByUid($data['jid']);
	if( $jilu['inarchive']>0 || ($_G['uid']!=$data['authorid'] && $perm<2)){
		showmessage(lang('privilege'));
	}
	if($jilu['deletetime'] > 0) $json?exit(json_encode(array('error'=>lang('recycle_file_can_not_edit')))):showmessage(lang('recycle_file_can_not_edit'));
	if(!submitcheck('editsubmit')){
		$at_users = C::t('jilu_user')->fetch_all_by_perm($data['jid'],array('1', '2','3'));//能够提醒的用户（包含自己）
		foreach ($at_users as $key => $value) {
			if($value['uid'] == $_G['uid']) unset($at_users[$key]);//去除提醒自己
		}
		$space=dzzgetspace($_G['uid']);
		$space['attachextensions'] = $space['attachextensions']?explode(',',$space['attachextensions']):array();
		$space['maxattachsize'] =intval($space['maxattachsize']);
		if($data['type']=='list'){
			$data['todos']=C::t('jilu_todolist')->fetch_all_by_rid($rid);
		}else{
			$data['attachs']=C::t('jilu_attach')->fetch_all_by_rid($rid);
		}
		if($data['ats']) $data['ats']=explode(',',$data['ats']);
	}else{
		$message=censor($_GET['content']);
		//获得提醒用户
		$at_users = array();
		$message=preg_replace_callback("/@\[(.+?):(.+?)\]/i","atreplacement",$message);
		$setarr=array('content'=>getstr($message),'ats'=>$at_users?implode(',',$at_users):'');
		if($ret=C::t('jilu_item')->update($rid,$setarr)){
			if($at_users){
				if($insets=$at_users){
					//发送提醒通知
					$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=jilu',1);
					foreach($insets as $uid){
						if($uid!=getglobal('uid')){
							//发送通知
							$notevars=array(
											'from_id'=>$appid,
											'from_idtype'=>'app',
											'url'=>MOD_URL.'&id='.$data['jid'].'&optrid='.$rid,
											'author'=>getglobal('username'),
											'authorid'=>getglobal('uid'),
											'dataline'=>dgmdate(TIMESTAMP),
											'content'=>getstr($message,30).($type!='text'?('['.($publish_type[$data['type']]).']'):''),
											
											);
										
								$action='jilu_item_at';
								$type='jilu_item_at_'.$rid;
							
							dzz_notification::notification_add($uid, $type, $action, $notevars, 0, MOD_PATH);
						}
					}
				}
			}
		}
		//插入附件
		if($data['type']=='list'){
			$ret+=C::t('jilu_todolist')->update_by_rid($rid,$_GET['todo']);
		}else{
			$ret+=C::t('jilu_attach')->update_by_rid($rid,$_GET['attach']);
		}
		showmessage('do_success',dreferer(),array('rid'=>$rid,'ret'=>$ret, 'ismy' => $ismy),array());
		
	}
}elseif($do=='follow'){
	if(!$_G['uid']) exit(json_encode(array('error'=>lang('logined_fllow'))));
	$jid=trim($_GET['jid']);
	if(($perm=C::t('jilu_user')->fetch_perm_by_uid($_G['uid'],$jid))>1){
		exit(json_encode(array('error'=>lang('already_jilu_member'))));
	}
	$setarr=array('jid'=>$jid,
				  'uid'=>$_G['uid'],
				  'username'=>$_G['username'],
				  'perm'=>($perm==1?0:1),
				  'dateline'=>TIMESTAMP
				  );
	if(C::t('jilu_user')->insert($setarr)){
		exit(json_encode(array('msg'=>'success','follow'=>$setarr['perm'])));
	}


}elseif($do=='jilu_delete'){//彻底删除

	include_once libfile('function/common');
	
	$jid=trim($_GET['jid']);
	$perm=getPermByUid($_G['uid']);
	if($perm>2 && C::t('jilu')->delete_by_jid($jid)){
		exit(json_encode(array('msg'=>'success')));
	}else{
		exit(json_encode(array('error'=>lang('privilege'))));
	}
}elseif($do=='jilu_pin'){
	include_once libfile('function/common');
	$display = intval($_GET['display']);
	$jid = trim($_GET['id']);
	$perm = getPermByUid($_G['uid']);
	$jilu = C::t('jilu')->fetch($jid);
	if(!in_array($display, array(0,1)) || empty($jilu)){
		exit(json_encode(array('msg'=>lang('param_error'))));
	}
	if($perm > 1){
		if($display > 0){
			$count = DB::result_first('select count(*) from %t where type = 1 and pin_type = 1 and uid = %d', array('jilu_pin', $_G['uid']));
			if($count >= 5){
				exit(json_encode(array('msg' => lang('beyond_display_limit'))));
			}
			C::t('jilu_pin')->addPin(1, 1, $jid);
		} else {
			C::t('jilu_pin')->cancelPin(1, 1, $jid);
		}
		exit(json_encode(array('msg'=>'success')));
	} else {
		if($display > 0){
			$count = DB::result_first('select count(*) from %t where type = 1 and pin_type = 1 and uid = %d', array('jilu_pin', $_G['uid']));
			if($count >= 5){
				exit(json_encode(array('msg' => lang('beyond_display_limit'))));
			}
			C::t('jilu_pin')->addPin(1, 1, $jid);
		} else {
			C::t('jilu_pin')->cancelPin(1, 1, $jid);
		}
		exit(json_encode(array('msg'=>'success')));
	}
}elseif($do=='jilu_pin_default'){//全员置顶
	include_once libfile('function/common');
	$perm=getPermByUid($_G['uid']);
	$display=intval($_GET['display']);
	$jid=trim($_GET['jid']);
	$jilu = C::t('jilu')->fetch($jid);
	if($jilu['inarchive'] > 0 || $jilu['deletetime'] > 0) {
		exit(json_encode(array('msg'=>lang('archived_or_deleted'))));
	}
	if($perm>1){
		if ($display) {
			$count = DB::result_first('select count(*) from %t where type = 1 and pin_type = 2', array('jilu_pin'));
			if ($count >= 5) {
				exit(json_encode(array('msg' => lang('beyond_display_limit'))));
			}
			C::t('jilu_pin')->deletePin(1, $jid);
			C::t('jilu_pin')->addPin(1, 2, $jid);
		} else {
			C::t('jilu_pin')->cancelPin(1, 2, $jid);
		}
		exit(json_encode(array('msg'=>'success')));
	}else{
		exit(json_encode(array('error'=>lang('privilege'))));
	}
}elseif($do=='cmt'){//添加评论
	include_once libfile('function/code');
	include_once libfile('function/common');
	$rid=intval($_GET['rid']);
	$pcid=intval($_GET['pcid']) ? intval($_GET['pcid']) : 0;//回复的评论ID
	$pauthorid = intval($_GET['pauthorid']) ? intval($_GET['pauthorid']) : 0;
	$jid = DB::result_first('select jid from %t where rid = %d', array('jilu_item', $rid));
	$jilu = C::t('jilu')->fetch($jid);
	if($jilu['deletetime'] > 0 || $jilu['inarchive']) $json?exit(json_encode(array('error'=>lang('can_not_add_cmt')))):showmessage(lang('can_not_add_cmt'));

	if(submitcheck('cmtsubmit')){
		$message=censor($_GET['message']);
		if(empty($message) && empty($_GET['votestatus'])){
			showmessage(lang('please_input_comment'));
		}
		//处理@
		$at_users=array();
		$message=preg_replace_callback("/@\[(.+?):(.+?)\]/i","atreplacement",$message);
		$setarr=array(  'author'=>$_G['username'],
						'authorid'=>$_G['uid'],
						'rid'=>$rid,
						'pcid'=>$pcid,
						'pauthorid'=>$pauthorid,
						'ismobile'=>($ismobile=helper_browser::ismobile())?$ismobile:'',
						'ip'=>$_G['clientip'],
						'dateline'=>TIMESTAMP,
						'message'=>$message,
					);
	
		if(!$setarr['cid']=C::t('jilu_comment')->insert_by_rid($setarr,$at_users)){
			showmessage(lang('server_error'));
		}

		//通知处理
		$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=jilu',1);
		$item=C::t('jilu_item')->fetch($rid);
		$notevars=array(
						'from_id'=>$appid,
						'from_idtype'=>'app',
						'url'=>MOD_URL.'&id='.$jid.'&optrid='.$rid,
						'author'=>$_G['username'],
						'authorid'=>$_G['uid'],
						'dataline'=>dgmdate(TIMESTAMP)
					   );

		// }
		//处理@
		if($at_users){
			//发送通知
			$notevars['comment'] = stripsAT($message);
			foreach($at_users as $k => $value){
				if($value==$_G['uid']) continue;
				dzz_notification::notification_add($value, 'comment_at', 'comment_at', $notevars, 0, MOD_PATH);
			}
		}
		//通知相关人员
		if($ruids=C::t('jilu_item')->fetch_uids_by_rid($rid)){
			$notevars['comment'] = stripsAT($message);
			foreach($ruids as $value){
				if($value==$_G['uid']) continue;
				dzz_notification::notification_add($value, 'comment', 'comment', $notevars, 0, MOD_PATH);
			}
		}
		showmessage('do_success',MOD_URL,array('cid'=>$setarr['cid']));
	}else{
		$perpage=10;
		$nexttime=TIMESTAMP;
		$list=array();
		foreach(DB::fetch_all("select * from %t where rid=%d order by dateline DESC limit $perpage",array('jilu_comment',$rid)) as $value){
			$value['message']=dzzcode($value['message']);
			$list[]=$value;
		};
		$nexttime=$value['dateline'];
	}
}elseif($do=='cmt_more'){
	include_once libfile('function/code');
	$perpage=10;
	$rid=intval($_GET['rid']);
	$time=intval($_GET['t']);
	$list=array();
	foreach(DB::fetch_all("select * from %t where rid=%d and dateline<%d  order by dateline DESC limit $perpage",array('jilu_comment',$rid,$time)) as $value){
		$value['message']=dzzcode($value['message']);
		$list[]=$value;
	};
	$nexttime=$value['dateline'];
}elseif($do=='getCmt'){
	include_once libfile('function/code');
	$cid=intval($_GET['cid']);
	$value=C::t('jilu_comment')->fetch($cid);
	if($value['pauthorid']){
		$author = getuserbyuid($value['pauthorid']);
		$value['pauthor'] = $author['username'];
	}
	$value['message']=dzzcode($value['message']);
}elseif($do=='cmt_del'){
	$cid=intval($_GET['cid']);
	$cmt=C::t('jilu_comment')->fetch($cid);
	$item = C::t('jilu_item')->fetch($cmt['rid']);
	$perm = C::t('jilu_user')->getUserPermByJid($item['jid'], $_G['uid']);
	if($cmt['authorid']!=$_G['uid'] && $perm < 2) exit(json_encode(array('error'=>lang('privilege'))));
	if(C::t('jilu_comment')->delete_by_cid($cid,$cmt['rid'])){
		DB::delete('jilu_comment', array('pcid' => $cid));//删除评论下的回复
		if(!$cmt['pcid']) C::t('jilu_item')->increase($cmt['rid'],array('comments'=>-1));//删除回复评论，评论数不减一
		C::t('jilu_comment_at')->delete_by_cid($cid);
		exit(json_encode(array('msg'=>'success')));
	}else{
		exit(json_encode(array('error'=>lang('delete_error'))));
	}
}elseif($do=='getAtList'){
	$jid=trim($_GET['jid']);
	$keyword = trim($_GET['keyword']);
	$list=array();
	if($jid){
		 $param_user=array('jilu_user','user');
		 $sql_user="where j.jid=%s";
		 $param_user[]=$jid;
		 if($keyword){
		 	$sql_user .= ' and u.username like %s';
		 	$param_user[] = '%'.$keyword.'%';
		 }
		  foreach(DB::fetch_all("select u.uid,u.username,j.perm  from %t j LEFT JOIN %t u on u.uid=j.uid  $sql_user",$param_user) as $value){
			if($value['uid'] == $_G['uid']) continue;
			$list[]=array('name'=>$value['username'],
						   'searchkey'=> pinyin::encode($value['username']).$value['username'],
						   'id'=>'u'.$value['uid'],
						   'icon'=>'avatar.php?uid='.$value['uid'].'&size=small',
						   'title'=>$value['username'].':'.'u'.$value['uid'],
						   'avatar'=>avatar_block($value['uid'])
						);
		  }
	}
	exit(json_encode($list));
}elseif($do=='getReply'){
	$cid = intval($_GET['cid']);
	$common = C::t('jilu_comment')->fetch($cid);
	$item = C::t('jilu_item')->fetch($common['rid']);
	$jilu = C::t('jilu')->fetch($item['jid']);
	$pageSize = 5;
	$next = false;
	$start = intval($_GET['start']) ? intval($_GET['start']) : 0;
	$nextStart = $start + $pageSize;
	$count = DB::result_first('select count(*) from %t where pcid = %d', array('jilu_comment', $cid));
	if($count > $nextStart) $next = true;
	$limit = $start.'-'.$pageSize;
	$replys = C::t('jilu_comment')->fetch_reply_by_cid($cid,$limit);
	foreach ($replys as $k => $v) {
		$pauthor = getuserbyuid($v['pauthorid']);
		$replys[$k]['pauthor'] = $pauthor['username'];
	}
} elseif ($do == 'getMoreCmt') {
	include_once libfile('function/common');
	$perm = getPermByUid($_G['uid']);
	$rid = intval($_GET['rid']);
	$item = C::t('jilu_item')->fetch($rid);
	$jilu = C::t('jilu')->fetch($item['jid']);
	$next = false;
	$pageSize = 5;
	$start = intval($_GET['start']) ? intval($_GET['start']) : 0;
	$nextStart = $start + $pageSize;
	$count = DB::result_first('select count(*) from %t where rid = %d and pcid < 1', array('jilu_comment', $rid));
	if($count > $nextStart) $next = true;
	$limit = $start.','.$pageSize;
	$cmts = C::t('jilu_comment')->fetch_cmt_by_rid($rid,$limit);
} elseif ($do == 'getusers') {
	$name = $_GET['name'];
	$orgid = DB::result_first('select orgid from %t where orgname = %s',array('organization', $name));
	if($orgid){
		$uids = C::t('organization_user')->fetch_user_by_orgid($orgid);
		if($uids){
			foreach ($uids as $v) {
				$users[] = array('id' => $v['uid'], 'text' => $v['username']);
			}
		}	
	} else {
		$param = array('user');
		if ($name) {
			$searchsql = ' username like %s';
			$param[] = '%'.$name.'%';
			$param[] = '%'.$name.'%';
			$uids = DB::fetch_all('select uid,username from %t where'.$searchsql.' limit 5', $param, 'uid');
		} else {
			$uids = DB::fetch_all('select uid,username from %t limit 5', $param, 'uid');
		}
		foreach ($uids as $k => $v) {
			$orgids = C::t('organization_user')->fetch_orgids_by_uid($k);
			$orgnames = array();
			if($orgids){
				$orgnames = array();
				foreach(DB::fetch_all('select orgname from %t where orgid IN (%n)', array('organization', $orgids)) as $vv) {
					$orgnames[] = $vv['orgname'];
				} 
			}
			// $users[] = array('uid' => $k, 'org' => implode($orgnames, '-'),'name' => $uids[$k]['username']);
			$users[] = array('id' => $k, 'text' => $uids[$k]['username']);  
		}
	}
	exit(json_encode(array('total_count' => count($users),'items' => $users)));
} elseif ($do == 'getjilus') {
	$title = $_GET['title'];
	if($_GET['method'] == 'recycle') {
		$jilus = array();
		$jids = array();
		$param = array('jilu');
		if(!$_G['adminid']){
			$param[] = $_G['uid'];
			$searchsql = ' and authorid = %d and recycledel <= 0';
		}
		if($title){
			$param[] = '%'.$title.'%';
			$searchsql .= ' and title like %s';
		}
		foreach (DB::fetch_all('select jid,title from %t where deletetime > 0'.$searchsql.' LIMIT 5', $param) as $key => $value) {
			$jilus[] = array('id' => $value['jid'], 'text' => $value['title']);
			$jids[] = $value['jid'];
		}
		if(count($jilus) < 5){
			$iparam = array('jilu_item', 'jilu');
			if(!$_G['adminid']){
				$iparam[] = $_G['uid'];
				$isearchsql = ' and i.authorid = %d and i.recycledel <= 0';
			}
			if($title){
				$iparam[] = '%'.$title.'%';
				$isearchsql .= ' and j.title like %s';
			}
			$limit = ' LIMIT '.(5-count($jids));
			if(!empty($jilus)){
				$isearchsql .= ' and i.jid not in (%n)';
				$iparam[] = $jids;
			}
			foreach(DB::fetch_all('select j.jid,j.title from %t i left join %t j on j.jid = i.jid where i.deletetime > 0 and j.jid is not null'.$isearchsql.' group by i.jid'.$limit, $iparam) as $key => $value){
				$jilus[] = array('id' => $value['jid'], 'text' => $value['title']);
			}
		}
	}
	exit(json_encode(array('total_count' => count($jilus),'items' => $jilus)));
} elseif ($do == 'getsearchval') {
	if (isset($_GET['uids'])) {
		$uids = is_array($_GET['uids']) ? $_GET['uids'] : explode(',', $_GET['uids']);
		$user = array();
	    foreach(DB::fetch_all("select uid,username from %t where uid in(%n)", array('user',$uids)) as $v){
	        $user[$v['uid']] = $v['username'];
	    }
	}
	if (isset($_GET['jids'])) {
		$jids = is_array($_GET['jids']) ? $_GET['jids'] : explode(',', $_GET['jids']);
		$jilu = array();
		foreach (DB::fetch_all("select jid,title from %t where jid in(%n)", array('jilu', $jids)) as $v) {
			$jilu[$v['jid']] = $v['title'];
		}
	}
	if ($_GET['jid'] && $_GET['labels']){
		include_once libfile('function/common');
		$alllabel = getLabelsByjid($_GET['jid']);
		$label = array();
		foreach ($alllabel as $v) {
			if(in_array($v['pow'], $_GET['labels'])){
				$label[] = array($v['pow'], $v['title']);
			}
		}
	}
	exit(json_encode(array('jilu' => $jilu, 'user' => $user, 'label' => $label)));
} elseif ($do == 'parseinputcondition') {
	if(isset($_GET['jilu'])){
        $jiluarr = is_array($_GET['jilu']) ? $_GET['jilu'] : explode(',',$_GET['jilu']);
        $jids = array();
        $jilu = array();
        $notename = array();
        foreach(DB::fetch_all("select jid,title from %t where title in(%n)", array('jilu',$jiluarr)) as $v){
            $jids[]= $v['jid'];
            $jilu[] = array('id' => $v['jid'], 'text' => $v['title']);
            $notename[] = $v['title'];
        }
    }
	if(isset($_GET['username'])){
        $usernamearr = is_array($_GET['username']) ? $_GET['username'] : explode(',',$_GET['username']);
        $user = array();
        $uids = array();
        $owner = array();
        foreach(DB::fetch_all("select uid,username from %t where username in(%n)", array('user',$usernamearr)) as $v){
            $uids[]= $v['uid'];
            $user[] = array('id' => $v['uid'], 'text' => $v['username']);
            $owner[] = $v['username'];
        }
    }
    if($_GET['jid'] && isset($_GET['labelname'])){
    	$labelnames = is_array($_GET['labelname']) ? $_GET['labelname'] : explode(',',$_GET['labelname']);
    	include_once libfile('function/common');
    	$alllabel = getLabelsByjid($_GET['jid']);
    	$labels = array();
    	$labelname = array();
    	foreach ($alllabel as $v) {
    		if(in_array($v['title'], $labelnames)){
    			$labels[] = $v['pow'];
    			$labelname[] = $v['title'];
    		}
    	}
    }
    exit(json_encode(array('jids'=>$jids, 'notename' => $notename,'uids'=>$uids, 'user' => $user, 'owner' => $owner, 'jilu' => $jilu, 'labels' => $labels, 'labelname' => $labelname)));
}
include template('ajax');
?>
