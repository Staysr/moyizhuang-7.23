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
@session_start();
$ismobile=helper_browser::ismobile();
require_once 'conf.php';
require_once libfile('function/common');
$navtitle=lang('w_my_jilu').' - '.lang('record_book');
if(!$_G['uid']){
	if($_SESSION['ismp']){
		$weObj=new Wechat(array('token'=>$setting['token_mp'],'encodingaeskey'=>$setting['encodingaeskey_mp'],'appid'=>$setting['AppID'],'appsecret'=>$setting['AppSecret']));
		$oauthurl=$weObj->getOauthRedirect(getglobal('siteurl').MOD_URL.'&op=bind&drefer='.urlencode(MOD_URL.'&op=item'));
		@header("Location: $oauthurl");exit();
	}else{
	 	showmessage('to_login','user.php?mod=logging');
	}
}
$perm=3;
//调用jssdk
if($ismobile=='wechat'){
	if($setting['AppID'] && $setting['AppSecret']){
		$jssdk=new JSSDK($setting['AppID'],$setting['AppSecret'],0);
		$SignPackage=$jssdk->getSignPackage();
	}elseif(getglobal('setting/CorpID') && getglobal('setting/CorpSecret')){
		$jssdk=new JSSDK(getglobal('setting/CorpID'),getglobal('setting/CorpSecret'));
		$SignPackage=$jssdk->getSignPackage();
	}
}
//筛选
$jilus=array();
foreach(DB::fetch_all("select j.jid,j.title from %t j LEFT JOIN %t u ON j.jid=u.jid where u.uid=%d and u.perm>1 and j.deletetime <= 0 and j.inarchive < 1",array('jilu','jilu_user',$_G['uid'])) as $value){
	$jilus[]=$value;
}
$_GET['jilus'] = $jilus;
include template('myitem');
exit();

?>
