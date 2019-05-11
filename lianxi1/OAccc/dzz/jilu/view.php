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
require_once 'conf.php';
$space=dzzgetspace($_G['uid']);
$space['attachextensions'] = $space['attachextensions']?explode(',',$space['attachextensions']):array();
$space['maxattachsize'] =intval($space['maxattachsize']);
$jid=trim($_GET['id']);
if(!$jilu=C::t('jilu')->fetch($jid)){
	showmessage(lang('jilu_not_exist'),dreferer());
}

$_GET['jilu'] = $jilu;
$navtitle=$jilu['title'].' - '.lang('record_book');
include_once libfile('function/common');
//判断查看权限:0:无权限，1：查看权限；2：发布权限
$perm=getVPermByUid($jid);
$_GET['perm'] = $perm;
if($perm<1){ //没有查看权限
	showmessage(lang('privilege'),$_G['uid'] ? dreferer() : MOD_URL);
}
if(($perm < 3 && $jilu['deletetime'] > 0) || ($jilu['authorid'] == $_G['uid'] && $jilu['recycledel'])) {
	showmessage(lang('file_not_exist'), dreferer());
}

//调用jssdk

if($ismobile=='wechat' ){
	if($setting['AppID'] && $setting['AppSecret']){
		$jssdk=new JSSDK(array('appid'=>$setting['AppID'],'appsecret'=>$setting['AppSecret']));
		$SignPackage=$jssdk->getSignPackage();
	}elseif(getglobal('setting/CorpID') && getglobal('setting/CorpSecret')){
		$jssdk=new JSSDK(getglobal('setting/CorpID'),getglobal('setting/CorpSecret'));
		$SignPackage=$jssdk->getSignPackage();
	}
}
$refer=dreferer();
$refer=(strpos($refer,'mod=jilu')!==false)?$refer:MOD_URL;
$userperm=C::t('jilu_user')->fetch_perm_by_uid($_G['uid'],$jid);
//获取记录列表
$jilu['follows']=DB::result_first("select COUNT(*) from %t where jid=%s and perm='1'",array('jilu_user',$jid));
$jilu['members']=DB::result_first("select COUNT(*) from %t where jid=%s and perm>1",array('jilu_user',$jid));
//更新浏览数
C::t('jilu')->increase($jid,array('views'=>1));
//更新用户活动时间
if($_G['uid']) C::t('jilu_user')->setLastvisit($jid,$_G['uid']);
$_GET['jid'] = $jid;
$alllabels = getLabelsByjid($jilu['jid']);
$_GET['alllabels'] = $alllabels;
$users = C::t('jilu_user')->fetch_all_by_perm($jid,array('2','3'));
$at_users = C::t('jilu_user')->fetch_all_by_perm($jid,array('1', '2','3'));
foreach ($at_users as $key => $value) {
	if($value['uid'] == $_G['uid']){
		unset($at_users[$key]);
	}
}
$_GET['users'] = $users;
include template('view');
exit();

?>
