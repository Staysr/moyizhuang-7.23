<?php
/*
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
	
if(!defined('IN_DZZ')) {
	exit('Access Denied');
}

$redirecturl=dzzdecode(rawurldecode($_GET['url']));
if(empty($redirecturl)) $redirecturl=dzzdecode(rawurldecode($_GET['url']),'',4);

$weObj=new Wechat(array('token'=>$setting['token_mp'],'encodingaeskey'=>$setting['encodingaeskey_mp'],'appid'=>$setting['AppID'],'appsecret'=>$setting['AppSecret']));
$result=$weObj->getOauthAccessToken();
$openid=$result['openid'];
@session_start();
$_SESSION['ismp']=1;

//生成登录cookie
if(($wechatuser=C::t('user_wechat')->fetch_by_openid($openid,$setting['AppID'])) && ($user=C::t('user')->fetch($wechatuser['uid']))){
	dsetcookie('auth', authcode("{$user['password']}\t{$user['uid']}", 'ENCODE'), 365*24*60*60, 1, true);
}
@header("Location: $redirecturl");
exit();
?>
