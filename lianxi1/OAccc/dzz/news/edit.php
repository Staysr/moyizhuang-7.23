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
//error_reporting(E_ALL);
include libfile('function/news');
include libfile('function/organization');
$perm=getPermByUid($_G['uid']);
$ismobile=helper_browser::ismobile();
if($perm<1) showmessage(lang('have_no_right'),dreferer());
/*if(empty($_G['uid'])) {
	include template('common/header_reload');
	echo "<script type=\"text/javascript\">";
	echo "try{top._login.logging();}catch(e){}";
	echo "try{win.Close();}catch(e){}";
	echo "</script>";	
	include template('common/footer_reload');
	exit('<a href="user.php?mod=logging&action=login">需要登录</a>');
}*/


if(submitcheck('edit')){
	$news=$_GET['news'];
	$news['subject']=getstr($news['subject'],80);
	if(empty($news['subject'])){
		showmessage(lang('message_header_cannot_be_empty'),dreferer(),array('data'=>rawurlencode(json_encode(array('error'=>lang('message_header_cannot_be_empty'))))),array('showmsg'=>true));
	}
	
	if($news['type']==0){//文本内容时
		$news['content']=helper_security::checkhtml($news['content']);//str_replace(array("\r\n", "\r", "\n"), "",$_GET['message']); //去除换行
		//获取文档内附件
		$news['attachs']=implode(',',getAidsByMessage($news['content']));
		//unset($news['url']); //删除链接地址
	}elseif($news['type']==1){ //图片内容时
	    $pics=array();
		$newpics=array();
		foreach($_GET['picnew']['aid'] as $key=>$aid){
			$newpics[]=array('aid'=>$aid,'title'=>$_GET['picnew']['title'][$key],'dateline'=>TIMESTAMP);
		}
		$pics=$_GET['pic'];
		
	}elseif($news['type']==2){ //超链接内容
		
	}
	
	//处理发布状态

	if($_GET['isdraft']){
		 $news['status']=3;
	}else{
		if(empty($news['status']) || $news['status']==3){
			if(!$_G['cache']['news:setting']) loadcache('news:setting');
			if($perm>1 || $_G['cache']['news:setting']['newsmod']<1) $news['status']=1; //管理员或者不用审核时直接发布，不需要审核
			else $news['status']=2; //非管理员需要等待审核；
		}
	}
	
	//处理阅读范围
	$orgids=array();
	$uids=array();
	if($news['orgids']){
		$orgid_arr=explode(',',$news['orgids']);
		foreach($orgid_arr as $value){
			if(is_numeric($value)){
				$orgids[]=$value;
			}elseif($value=='other'){
				$orgids[]=$value;
			}elseif(strpos($value,'uid_')==0){
				$uids[]=str_replace('uid_','',$value);
			}
		}
		$news['uids']=implode(',',$uids);
		$news['orgids']=implode(',',$orgids);
	}
	if($news['newid']){
	
		$news['updatetime']=TIMESTAMP;
	
		$news['opuid']=$_G['uid'];
		
		C::t('news')->update_by_newid($news);
		if($news['type']==1){
			C::t('news_pic')->insert_by_newid($news['newid'],$newpics,$pics);
		}
		$forward=$_GET['refer']?$_GET['refer']:dreferer();
	}else{
		$news['dateline']=TIMESTAMP;
		$news['updatetime']=TIMESTAMP;
		$news['author']=$_G['username'];
		$news['authorid']=$_G['uid'];
		if($news['newid']=C::t('news')->insert_by_newid($news)){
			if($news['type']==1){
				C::t('news_pic')->insert_by_newid($news['newid'],$newpics,$pics);
			}
		}
		if($news['status']==1){
			$forward=DZZSCRIPT.'?mod=news';
		}else{
			$forward=DZZSCRIPT.'?mod=news&status='.$news['status'];
		}
		
	}
	
	if($news['newid']){
		
		//处理投票
		if($news['votestatus']){
			$voteid=empty($_GET['voteid'])?0:intval($_GET['voteid']);
			
			$vote=$_GET['vote'];
			$vote['type']=$vote['type']?intval($vote['type']):1;
			$vote['endtime']=strtotime($vote['endtime']);
			$vote['subject']=getstr($_GET['vote_subject_'.$vote['type']]);
			$vote['module']='news';
			$vote['idtype']='news';
			$vote['id']=$news['newid'];
			$vote['uid']=$_G['uid'];
			
			
			//过滤投票项目
			$item=$_GET['voteitem'];
			$itemnew=array();
			foreach($_GET['voteitemnew']['content'] as $key =>$value){
				if(empty($value) && $vote['type']==1) continue; //文字投票时项目文本为空，略过；
				elseif($vote['type']==2 && !$_GET['voteitemnew']['aid'][$key]) continue;
				$itemnew[]=array('content'=>getstr($value),
								 'aid'=>intval($_GET['voteitemnew']['aid'][$key])
								 );
			}
			
			if($voteid){ //编辑时
				C::t('vote')->update_by_voteid($voteid,$vote,$item,$itemnew);
				
			}else{ //新增加
				$vote['starttime']=TIMESTAMP;
				C::t('vote')->insert_by_voteid($vote,$itemnew);
			}
		}
		
		$news['forward']=$forward;
		showmessage('do_success',$forward,array('data'=>rawurlencode(json_encode($news))),array('showmsg'=>true));
	}else{
		showmessage('do_success',$forward,array('data'=>rawurlencode(json_encode(array('error'=>lang('tape_release_failure'),'forward'=>$forward)))),array('showmsg'=>true));
	}
}else{
	$navtitle='';
	$refer=empty($_GET['refer'])?dreferer():$_GET['refer'];
	$newid=empty($_GET['newid'])?0:intval($_GET['newid']);
	
	$sel=array();
	$sel_org=array();
	$sel_user=array();
	if($newid){
		$navtitle=lang('compile');
		$navlast=lang('compile');
		$news=C::t('news')->fetch($newid);
		$open=array();
		if($news['orgids']){
			$orgids=explode(',',$news['orgids']);
			$sel_org=C::t('organization')->fetch_all($orgids);
			foreach($sel_org as $key=> $value){
				$orgpath=getPathByOrgid($value['orgid']);
				$sel_org[$key]['orgname']=implode('-',($orgpath));
				$sel[]=$value['orgid'];
			}
			$arr=(array_keys($orgpath));
			array_pop($arr);
			$count=count($arr);
			if($open[$arr[$count-1]]){
				if(count($open1[$arr[$count-1]])>$count) $open[$arr[count($arr)-1]]=$arr;
			}else{
				$open[$arr[$count-1]]=$arr;
			}
			if(in_array('other',$orgids)){
				$sel[]='other';
				$sel_org[]=array('orgname'=>lang('non_agency_personnel'),'orgid'=>'other','forgid'=>1);
			}
		}
		if($news['uids']){
			$uids=explode(',',$news['uids']);
			$sel_user=C::t('user')->fetch_all($uids);
			foreach($sel_user as $value){
				$sel[]='uid_'.$value['uid'];
			}
			if($aorgids=C::t('organization_user')->fetch_orgids_by_uid($uids)){
				foreach($aorgids as $orgid){
					$arr= C::t('organization')->fetch_parent_by_orgid($orgid,true);
					$count=count($arr);
					if($open[$arr[$count-1]]){
						if(count($open[$arr[$count-1]])>$count) $open[$arr[count($arr)-1]]=$arr;
					}else{
						$open[$arr[$count-1]]=$arr;
					}
				 }
			}
		}
		$openarr=json_encode(array('orgids'=>$open));
		$pics=C::t('news_pic')->fetch_all_by_newid($newid);
	}else{
		$navtitle=lang('create');
		$navlast=lang('create');
		$news=array('votestatus'=>0,'commentstatus'=>'0','catid'=>intval($_GET['catid']),'type'=>0);
	}
	$sel=implode(',',$sel);
	$catoptions=getCatOptions(0,$news['catid']);
	
	include template('news_edit');
}
function getAidsByMessage($message){
	$aids=array();
	if(preg_match_all("/path=\"attach::(\d+)\"/i",$message,$matches)){
		$aids=$matches[1];
	}
	if(preg_match_all("/path=\"".rawurlencode('attach::')."(\d+)\"/i",$message,$matches1)){
		$aids=array_merge($aids,$matches1[1]);
	}
	return array_unique($aids);
}


?>