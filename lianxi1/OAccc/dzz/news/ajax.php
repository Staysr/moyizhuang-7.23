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
 
if($_GET['do']=='imageupload'){
		include libfile('class/uploadhandler');
		$options=array( 'accept_file_types' => '/\.(gif|jpe?g|png)$/i',
						'upload_dir' =>$_G['setting']['attachdir'].'cache/',
						'upload_url' => $_G['setting']['attachurl'].'cache/',
						'thumbnail'=>array('max-width'=>240,'max-height'=>160)
						);
		$upload_handler = new uploadhandler($options);
		exit();

}
elseif($_GET['do']=='updateview'){
	$newid=intval($_GET['newid']);
	C::t('news')->increase($newid,array('views'=>1));
	if($_G['uid']){
		if($vid=DB::result_first("select vid from %t where newid=%d and uid=%d",array('news_viewer',$newid,$_G['uid']))){
			DB::query("update %t SET views=views+1 where vid=%d",array('news_viewer',$vid));
		}else{
			$addviewer=array('newid'=>$newid,
							 'uid'=>$_G['uid'],
							 'username'=>$_G['username'],
							 'dateline'=>TIMESTAMP
							 );
			C::t('news_viewer')->insert($addviewer);
		}
	}
	exit('success');
}
elseif($_GET['do']=='sendModNotice'){
	if(!$_G['cache']['news:setting']) loadcache('news:setting');
	$setting=$_G['cache']['news:setting'];
	
	//通知管理员审核
	$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=news',1);
	foreach($setting['moderators'] as $muid){
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
		
		dzz_notification::notification_add($muid, $type, $action, $notevars, 0,'dzz/news');
	}
	exit(json_encode(array('msg'=>lang('alert_messages_to_be_sent_successfully'))));
}
elseif($_GET['do']=='news_delete'){
	include_once libfile('function/news');
	$newid=!empty($_GET['newid'])?intval($_GET['newid']):0;
	$data=C::t('news')->fetch($newid);
	$perm=getPermByUid($_G['uid']);
	if($perm<2 && $data['authorid']!=$_G['uid']) exit(json_encode(array('error'=>lang('have_no_right'))));
	if(C::t('news')->delete_by_newid($newid)){
		exit(json_encode(array('msg'=>'success')));
	}else{
		exit(json_encode(array('error'=>lang('delete_failure'))));
	}
}
elseif($_GET['do']=='getViewerByNewid'){
	$newid=empty($_GET['newid'])?0:intval($_GET['newid']);
	//查阅情况
	$page = empty($_GET['page'])?1:intval($_GET['page']);
	$perpage=21;
	$gets = array(
			'mod'=>'news',
			'op'=>'ajax',
			'do'=>'getViewerByNewid',
			'newid'=>$newid
		);
	$theurl = DZZSCRIPT."?".url_implode($gets);
	$start=($page-1)*$perpage;
	$limit=($page-1)*$perpage.'-'.$perpage;
	if($count=C::t('news_viewer')->fetch_all_by_newid($newid,$limit,1)){
		$list=C::t('news_viewer')->fetch_all_by_newid($newid,$limit);
		$multi=multi($count, $perpage, $page, $theurl,'pull-right');
	}
	include template('news_ajax');
}
elseif($_GET['do']=='editcat'){ 
	$catname = getstr($_GET['catname']);
	$cid = isset($_GET['cid']) ? intval($_GET['cid']):0;
	if($cid){
		if( !$catname){
			error(lang('name_cannot_be_empty') );
		}
		if(DB::result_first("select count(*) from %t where name = %s and status=1",array('news_cat',$catname)) > 0){ 
			error(lang('the_name_cannot_be_repeated'),array("id"=>$cid));
		}
		if(C::t('news_cat')->update_by_catid($cid,array('name'=>$catname))){
			success(lang('modify_successfully'),array("id"=>$cid,'isadd'=>0));
		}
	}else{
		if( !$catname){
			error(lang('name_cannot_be_empty') );
		}
        if(DB::result_first("select count(*) from %t where name = %s and status=1",array('news_cat',$catname)) > 0){ 
			error(lang('the_name_cannot_be_repeated'),array("id"=>$cid));
        }
		
        if($insertid = C::t('news_cat')->insert_by_catid(array('name'=>$catname))){
            success(lang('new_success'),array("id"=>$insertid,'isadd'=>1));
		}
	}
}
elseif($_GET['do']=='delcat'){
	$cid = isset($_GET['cid']) ? intval($_GET['cid']):0;
	if($cid){
		$result = C::t('news_cat')->update($cid,array('status'=>-1));//$C::tp_t('news_cat')->where(array("catid"=>$cid))->setField("status",-1);
		if($result){
			success(lang('successfully_delete'));
		} 
	}
	error(lang('delete_failure'));
}
elseif($_GET['do']=='setorder'){
	$catid = $_GET["disp"]; 
	if($catid){
		foreach($catid as $k=>$v ){
			if( $v ){
				$result = C::t('news_cat')->update($v,array('disp'=>$k));//C::tp_t('news_cat')->where(array("catid"=>$v))->setField("disp",$k);
			}
		} 
	}
	success(lang('printf'));
}
?>
