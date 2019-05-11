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

function getPermByUid($uid){ //获取用户权限； 0:无权限；1：有发布记录本权限；2：应用管理员;3:系统管理员
	global $_G;
	if($_G['uid']<1) return 0;
	if($_G['adminid']==1) return 3;
	if(!$_G['cache']['jilu:setting']) loadcache('jilu:setting');
	$setting=$_G['cache']['jilu:setting'];
	if(in_array($_G['uid'],$setting['moderators'])) return 2;
	elseif($setting['allownew'] && in_array($_G['uid'],$setting['posters'])) return 1;
	elseif($setting['allownew']<1) return 1;
	else return 0;
}
function getVPermByUid($jid){ //获取用户权限； 0:无权限；1：有查看权限；2：有发布权限;3:有管理权限；4:应用管理员；5：系统管理员
    global $_G;
	$jilu=C::t('jilu')->fetch($jid);
	
	if($_G['uid']<1){//游客
		if($jilu['privacy']>0) return 0;
		else return 1;
	}else{//登陆用户
		if($_G['adminid']==1){
			//if($jilu['inarchive']) return 1; //归档的没有发布权限
			 return 5;
		}
		/*if($jilu['authorid']==$_G['uid']){
			//if($jilu['inarchive']) return 1; //归档的没有发布权限
			 return 3;
		}*/
		if(!$_G['cache']['jilu:setting']) loadcache('jilu:setting');
		$setting=$_G['cache']['jilu:setting'];
		if(in_array($_G['uid'],$setting['moderators'])){
			//if($jilu['inarchive']) return 1; //归档的没有发布权限
			 return 4;//应用管理员有权限；
		}
		$perm=C::t('jilu_user')->fetch_perm_by_uid($_G['uid'],$jid);
	    $perm=max($jilu['perm'],$perm);
		if($perm){
			//if($perm>2 && $jilu['inarchive']) return 1; //归档的没有发布权限
			return $perm;
		}else{
			if($jilu['privacy']<2) return 1;
		}
	}
	return 0;
}

function atreplacement($matches){
	global $at_users;
	include_once libfile('function/code');
	$uid=str_replace('u','',$matches[2]);
	if(($user=C::t('user')->fetch($uid)) && $user['uid']!=$_G['uid']){
		$at_users[]=$user['uid'];
		return '[uid='.$user['uid'].']@'.$user['username'].'[/uid]';
	}else{
		return $matches[0];
	}
}
function stripsAT($message,$all=0){ //$all>0 时去除包裹的内容
	if($all) {
		$message= preg_replace("/\[uid=(\d+)\](.+?)\[\/uid\]/i", '', $message);
		$message= preg_replace("/\[org=(\d+)\](.+?)\[\/org\]/i", '', $message);
	}else {
		$message= preg_replace("/\[uid=(\d+)\]/i", '', $message);
		$message= preg_replace("/\[\/uid\]/i", '', $message);
		$message= preg_replace("/\[org=(\d+)\]/i", '', $message);
		$message= preg_replace("/\[\/org\]/i", '', $message);
	}
	return $message;
}
function getLabels($val,$jid){//根据二进制值获取labels数组
	if(!$jid) return array();
	$labels=getLabelsByjid($jid);
	$ret=array();
	foreach($labels as $value){
		if(($val & $value['pow'])>0) $ret[$value['pow']]=$value;
	}
	return $ret;
}
function getAllLabels(){
	$labels=array(array('pow'=>1,'title'=>'blue','color'=>'blue'),
				  array('pow'=>2,'title'=>'green','color'=>'green'),
				  array('pow'=>4,'title'=>'orange','color'=>'orange'),
				  array('pow'=>8,'title'=>'purple','color'=>'purple'),
				  array('pow'=>16,'title'=>'red','color'=>'red'),
				  array('pow'=>32,'title'=>'yellow','color'=>'yellow')
				);
   return $labels;
}
function getLabelsByjid($jid){
	$jilu=C::t('jilu')->fetch($jid);
	$alllabels=getAllLabels();
    $labels=unserialize($jilu['labels']);
	$labelarr=array();
	foreach($alllabels as $key =>$value){
		if(isset($labels[$value['pow']])){
			 $value['title']=$labels[$value['pow']];
			 $labelarr[$value['pow']]=$value;
		}
	}
	return $labelarr;
}

function getLinkInfo($link){
	global $_G;
	
	$data=array();
	//检查网址合法性
	if(!preg_match("/^(http|ftp|https|mms)\:\/\/.{5,300}$/i", ($link))){
		$link='http://'.preg_replace("/^(http|ftp|https|mms)\:\/\//i",'',$link);
	}
	$match = '/^(((ht|f)tps?)|mms):\/\/[\w\-]+(\.[\w\-]+)+([\w\-\.,@?^=%&:\/~\+#!]*[\w\-\@?^=%&\/~\+#!])?$/';
	if(!preg_match($match,($link))) return array('error'=>lang('url_format_error'));
	$ext=strtolower(substr(strrchr($link, '.'), 1, 10));
		//static $videoext  = array('swf', 'flv');
		//static $videohost  = array('tudou.com', 'youku.com','56.com','ku6.com');
	$imageexts = array('JPG', 'JPEG', 'GIF', 'PNG', 'BMP');
	$isimage= in_array(strtoupper($ext), $imageexts) ? 1 : 0;
	//是图片时处理
	if($isimage){
		$filename=substr(strrchr($link, '/'), 1, 50);
		if($cimage=DB::fetch_first("select * from ".DB::table('collect')." where ourl='{$link}' and type = 'img'")){
			$cdata = unserialize($cimage['data']);
			$attach=C::t('attachment')->fetch($cdata['aid']);
			$data['aid']=$attach['aid'];
			$data['title']=$filename;
			$data['ext']=$ext;
			$data['img']=C::t('attachment')->getThumbByAid($attach['aid'],256,256);
			$data['type']='image';
			$data['msg']='success';
			@unlink($file_path);
			return $data;
		}
		if($target=imagetolocal($link,'dzz')){
			//判断空间大小
			$file_path=$_G['setting']['attachdir'].$target;
			$md5=md5_file($file_path);
			$filesize=@filesize($file_path);
			if($md5 && $attach=DB::fetch_first("select * from %t where md5=%s and filesize=%d",array('attachment',$md5,$filesize))){
				$data['aid']=$attach['aid'];
				$data['title']=$filename;
				$data['ext']=$ext;
				$data['img']=C::t('attachment')->getThumbByAid($attach['aid'],256,256);
				$data['type']='image';
				$data['msg']='success';
				@unlink($file_path);
				return $data;
			}else{
				$unrun=0;
				$remote=0;
				$attach=array(
					'filesize'=>$filesize,
					'attachment'=>$target,
					'filetype'=>strtolower($ext),
					'filename' =>$filename,
					'remote'=>$remote,
					'copys' => 0,
					'md5'=>$md5,
					'unrun'=>$unrun,
					'dateline' => $_G['timestamp'],
				);
				
				if($attach['aid']=C::t('attachment')->insert($attach,1)){
					C::t('local_storage')->update_usesize_by_remoteid($attach['remote'],$attach['filesize']);
					dfsockopen($_G['siteurl'].'misc.php?mod=movetospace&aid='.$attach['aid'].'&remoteid=0',0, '', '', FALSE, '',1);
					$data = array('type'=>'img','aid'=>$attach['aid'],'title'=>$filename,'desc'=>'');
					$cimage=array(	
								'ourl'=>$link,
								'data'=>serialize($data),
								'copys'=>0,
                                'type'=>'img',
								'dateline'=>$_G['timestamp']
								);
					$cimage['cid']=DB::insert('collect',($cimage),1);
					$data['img']=C::t('attachment')->getThumbByAid($attach['aid'],256,256);
					$data['ext']=$ext;
					$data['msg']='success';
					$data['type']='image';
					return $data;
				}else{
					return array('error'=>lang('image_download_error'));
				}
			}
			
		}else{
			return array('error'=>lang('image_download_error'));
		}
	}else{
		//试图作为视频处理

		if(!$cvideo=DB::fetch_first("select * from ".DB::table('collect')." where ourl='{$link}' and type='video'")){
			$arr=array();
			// require_once dzz_libfile('function/video');
			require_once libfile('function/code');
			if($arr=parseflv($link)){
				//采集标题和描述
				if(!$arr['title'] || !$arr['description']){
					require_once dzz_libfile('class/caiji');
					$caiji=new caiji($link);
					$arr['title']=$caiji->getTitle();
					$arr['description']=$caiji->getDescription();
				}
				$data = array(
						'type'=>'video',
						'url'=>$arr['url'],
						'img'=>$arr['img'],
					    'desc' =>$arr['description'],
					    'title' => $arr['title'],
					);
				$cvideo=array(	
								'ourl'=>$link,
								'data'=>serialize($data),
								'copys' => 0,
								'type' => 'video',
								'dateline'=>$_G['timestamp']
								);
				$cvideo['cid']=DB::insert('collect',($cvideo),1);
				$data['img']=$arr['img'];
				$data['aid']=0;
				$data['url']=$arr['url'];
				$data['title']=$arr['title'];
				$data['desc']=$arr['description'];
				$data['ext']='swf';
				$data['type']='video';
				$data['msg']='success';
				return ($data);
			}
		}else{
			$data['img']=$cvideo['img'];
			$data['aid']=0;
			$data['url']=$cvideo['url'];
			$data['title']=$cvideo['title'];
			$data['desc']=$cvideo['description'];
			$data['ext']='swf';
			$data['type']='video';
			$data['msg']='success';
			return $data;
		}
		
		//作为网址处理
		if(!$clink=DB::fetch_first("select * from ".DB::table("collect")." where ourl='{$link}' and type='link'")){
			$arr = array();
            require_once dzz_libfile('class/caiji');
            $caiji = new caiji($link);
            $arr['title'] = $caiji->getTitle();
            $arr['desc'] = $caiji->getDescription();
            $arr['url'] = $link;
            $arr['type'] = 'url';
            $arr['img'] = '';
            $data = array(
                'type' => 'url',
                'url' => $arr['url'],
                'img' => $arr['img'],
                'desc' => $arr['desc'],
                'title' => $arr['title'],
            );
            $clink = array(
                'ourl'=>$link,
                'data' => serialize($data),
                'copys' => 0,
                'type' => 'link',
                'dateline' => $_G['timestamp']
            );
            $clink['cid'] = DB::insert('collect', ($clink), 1);
		}
		$cdata = unserialize($clink['data']);
		$clink['title']=$cdata['title']?$cdata['title']:$link;
		$icondata=getUrlIcon($link);
		
		$data['img']=str_replace('dzz/images/default/e.png',MOD_PATH.'/images/link_default.png',$icondata['img']);
		$data['aid']=0;
		$data['url']=$link;
		$data['title']=$clink['title'];
		$data['desc']=$cdata['desc'];
		$data['ext']='';
		$data['type']='link';
		$data['msg']='success';
		return $data;
	}
}

?>
