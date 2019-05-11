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
$ismobile=helper_browser::ismobile();
//error_reporting(E_ALL);
$newid=empty($_GET['newid'])?0:intval($_GET['newid']);
if(!$news=C::t('news')->fetch($newid)){
	showmessage(lang('this_news_has_been_moved'),dreferer());
}

include libfile('function/news');
//根据信息发布权限判断用户是否有查看权限
$perm=getPermByUid($_G['uid']);
if(!getViewPerm($news)){
	showmessage(lang('have_no_right_contact_your_administrator'),dreferer());
}
//获取分类名称
if($news['catid']) $news['catname']=DB::result_first("select name from %t where catid=%d",array('news_cat',$news['catid']));
if($news['opuid'] && $opuser=getuserbyuid($news['opuid'])){
	$news['opauthor']=$opuser['username'];
}
if( $news['moduid'] && $moduser=getuserbyuid($news['moduid'])){
	$news['modusername']=$moduser['username'];
}
$navtitle=$news['subject'];
$navlast=getstr($news['subject'],15);
$refer=empty($_GET['refer'])?dreferer():$_GET['refer'];

//获取信息的发布范围	
	$sel=array();
	$sel_org=array();
	$sel_user=array();
	if($news['orgids']){
		$orgids=explode(',',$news['orgids']);
		$sel_org=C::t('organization')->fetch_all($orgids);
		foreach($sel_org as $value){
			$sel[]=$value['orgid'];
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
	}

if($news['type']==1){ //图片内容时，获取图片数组
	$pics=C::t('news_pic')->fetch_all_by_newid($newid);
}

$catlist=getCatList();
//更新查阅
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
include template('news_view');


?>