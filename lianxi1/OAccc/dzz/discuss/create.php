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
loadcache('discuss_setting');
$ismobile=helper_browser::ismobile();
require_once libfile('function/discuss');
$setting=$_G['cache']['discuss_setting'];
if($setting['allownewboard']>0){
	$muids=$setting['moderators']?explode(',',$setting['moderators']):array();
	if(!in_array($_G['uid'],$muids)) exit(lang('only_appoint_member'));
}
if($setting['maxboard'] && !C::t('discuss')->checkMaxBoard($_G['uid'])){
	exit(lang('exceed_max_discuss'));
}

if(submitcheck('discusssubmit')){
	$setarr=array('name'=>emoji_encode(str_replace('...','',getstr($_GET['name'],80))),
				  'perm'=>1,//0表示公开 1表示隐私（默认全为隐私）
				  );
	$field=array(
				 'icon'=>intval($_GET['aid']),
				 'rules'=>$_GET['rules'],
				 'iconcolor' => $_GET['iconcolor'] ? $_GET['iconcolor'] : '#00b8c4',
				 'allowshare'=>intval($_GET['allowshare']),
				 'source'=>$ismible ? $ismible : 'PC',
				 );
	
		$setarr['dateline']=TIMESTAMP;
		$setarr['uid']=$_G['uid'];
		$setarr['username']=$_G['username'];
		if($fid=C::t('discuss')->insert_by_fid($setarr,$field)){
			$my_forum_showtype = C::t('discuss_setting')->fetch('my_forum_showtype_'.$_G['uid']);
			$my_forum_showtype = $my_forum_showtype ? $my_forum_showtype : 'module';
			$list[$fid] = C::t('discuss')->fetch_by_fid($fid);
			include template('my_forum');
			exit();
		}else{
			exit(lang('create_failed'));
		}
}else{
	$refer=dreferer();
	$discuss=array();
	$navtitle=lang('create_discuss').' - '.lang('appname');	
	$covers=C::t('discuss_setting')->getCovers();
	$left=-1;
	$discuss['icon']=$covers[0]['aid'];
	$left=0;
}
include template('discuss_create');

?>
