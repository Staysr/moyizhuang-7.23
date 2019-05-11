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
@set_time_limit(0);
require_once 'conf.php';
require_once libfile('function/user','','user');

if($_GET['do']=='unbind'){
	if(DB::query("delete from %t where uid=%d and openid=%s and appid=%s",array('user_wechat',$_GET['uid'],trim($_GET['openid']),$setting['AppID']))){
		dsetcookie('auth', '', 0);
		exit('success');
	}
	exit('error');
}elseif(submitcheck('loginsubmit')){
	if(!$_GET['password'] || $_GET['password'] != addslashes($_GET['password'])) {
		showmessage(lang('fill_in_the_password'));
	}
	$result = userlogin($_GET['email'], $_GET['password'], '', '','auto', $_G['clientip']);
	$uid = $result['ucresult']['uid'];
	if($result['status']==0){
		showmessage(lang('username_or_password_incorrect'));
	}elseif($result['status']==-1){
		showmessage(lang('user_does_not_exist'));
	}elseif($result['status']==-2){
		showmessage(lang('user_has_been_disused'));
	}
	$setarr=array('uid'=>$uid,'openid'=>trim($_GET['openid']),'unionid'=>trim($_GET['unionid']),'appid'=>$setting['AppID'],'dateline'=>TIMESTAMP);
	if(C::t('user_wechat')->insert($setarr,1,1)){
		//判断用户头像状态
		/*if($_GET['headimgurl'] && $result['member']['avatarstatus']<1 && save_avatar($_GET['headimgurl'],$uid)){
			C::t('user')->update($uid,array('avatarstatus'=>1));
		}*/
		dsetcookie('auth', authcode("{$result[member][password]}\t{$uid}", 'ENCODE'), 365*24*60*60, 1, true);
		showmessage('do_success',MOD_URL,array());
	}else{
		showmessage(lang('bind_failed'));
	}
}elseif(submitcheck('registersubmit')){
	//验证用户姓名
		$username=trim($_GET['username']);
		$usernamelen = dstrlen($username);
		if($usernamelen < 3) {
			showmessage('profile_username_tooshort');
		}
		if($usernamelen > 30) {
			showmessage('profile_username_toolong');
		}
		
	//验证用户名
		if($nickname = (trim($_GET['nickname']))){
			$nicknamelen = dstrlen($nickname);
			if($nicknamelen < 3) {
				showmessage('profile_nickname_tooshort');
			}
			if($nicknamelen > 30) {
				showmessage('profile_nickname_toolong');
			}
		}else{
			$nickname='';
		}
		
		//验证邮箱
		$email = strtolower(trim($_GET['email']));
		checkemail($email);
		
		//验证密码长度
		if($_G['setting']['pwlength']) {
			if(strlen($_GET['password']) < $_G['setting']['pwlength']) {
				showmessage('profile_password_tooshort', '', array('pwlength' => $_G['setting']['pwlength']));
			}
		}
		//验证密码强度
		if($_G['setting']['strongpw']) {
			$strongpw_str = array();
			if(in_array(1, $_G['setting']['strongpw']) && !preg_match("/\d+/", $_GET['password'])) {
				$strongpw_str[] = lang('user/template', 'strongpw_1');
			}
			if(in_array(2, $_G['setting']['strongpw']) && !preg_match("/[a-z]+/", $_GET['password'])) {
				$strongpw_str[] = lang('user/template', 'strongpw_2');
			}
			if(in_array(3, $_G['setting']['strongpw']) && !preg_match("/[A-Z]+/", $_GET['password'])) {
				$strongpw_str[] = lang('user/template', 'strongpw_3');
			}
			if(in_array(4, $_G['setting']['strongpw']) && !preg_match("/[^a-zA-z0-9]+/", $_GET['password'])) {
				$strongpw_str[] = lang('user/template', 'strongpw_4');
			}
			if($strongpw_str) {
				showmessage(lang('user/template', 'password_weak').implode(',', $strongpw_str));
			}
		}
		//验证两次密码一致性
		if($_GET['password'] !== $_GET['password2']) {
			showmessage(lang('two_cipher_mismatches'));
		}

		
		$password = $_GET['password'];
		$ctrlip = $_G['clientip'];
			$setregip = null;
			$groupinfo = array();
				$addorg=0;
				if($_G['setting']['regverify']) {
					$groupinfo['groupid'] = 8;
				} else {
					$groupinfo['groupid'] = $_G['setting']['newusergroupid'];
					$addorg=1;
				}
				$result = uc_user_register(addslashes($username), $password, $email,addslashes($nickname),'', '', $_G['clientip'],$addorg);
				if(is_array($result)){
					$uid=$result['uid'];
					$password=$result['password'];
				}else{
					$uid=$result;
				}
				if($uid <= 0) {
					if($uid == -1) {
						showmessage('profile_nickname_illegal');
					} elseif($uid == -2) {
						showmessage('profile_nickname_protect');
					} elseif($uid == -3) {
						showmessage('profile_nickname_duplicate');
					} elseif($uid == -4) {
						showmessage('profile_email_illegal');
					} elseif($uid == -5) {
						showmessage('profile_email_domain_illegal');
					} elseif($uid == -6) {
						showmessage('profile_email_duplicate');
					} elseif($uid == -7) {
						showmessage('profile_username_illegal');
					} else {
						showmessage('undefined_action');
					}
				}
			$profile=array('gender'=>intval($_GET['sex']));
			$init_arr = array('profile'=>$profile);
			C::t('user')->insert($uid, $_G['clientip'], $groupinfo['groupid'], $init_arr);
			/*require_once libfile('cache/userstats', 'function');
			build_cache_userstats();*/
			$setarr=array('uid'=>$uid,'openid'=>trim($_GET['openid']),'unionid'=>trim($_GET['unionid']),'appid'=>$setting['AppID'],'dateline'=>TIMESTAMP);
			if(C::t('user_wechat')->insert($setarr,1,1)){
				//判断用户头像状态
				/*if($_GET['headimgurl'] && save_avatar($_GET['headimgurl'],$uid)){
					C::t('user')->update($uid,array('avatarstatus'=>1));
				}*/
				dsetcookie('auth', authcode("{$password}\t{$uid}", 'ENCODE'), 365*24*60*60, 1, true);
				showmessage('do_success',MOD_URL,array());
			}else{
				showmessage(lang('bind_failed'));
			}
		exit();	
}else{
	$drefer=urldecode($_GET['drefer']);
	if(!empty($_GET['code'])){
		$weObj=new Wechat(array('token'=>$setting['token_mp'],'encodingaeskey'=>$setting['encodingaeskey_mp'],'appid'=>$setting['AppID'],'appsecret'=>$setting['AppSecret']));
		if(!$result=$weObj->getOauthAccessToken()){
			runlog('wxlog','getOauthAccessToken:'.$weObj->errCode.':'.$weObj->errMsg);
			$error=array('code'=>'getOauthAccessToken','msg'=>$weObj->errCode.':'.$weObj->errMsg);
			include template('bind');
			exit();
		}
		$openid=$result['openid'];
		if(!$userinfo=$weObj->getOauthUserinfo($result['access_token'],$result['openid'])){
			runlog('wxlog','getOauthUserinfo:'.$weObj->errCode.':'.$weObj->errMsg);
			$error=array('code'=>'getOauthUserinfo','msg'=>$weObj->errCode.':'.$weObj->errMsg);
			include template('bind');
			exit();
		}
		//生成登录cookie
		if(($wechatuser=C::t('user_wechat')->fetch_by_openid($openid,$setting['AppID'])) && ($user=C::t('user')->fetch($wechatuser['uid']))){
			$error=array('code'=>'bined','msg'=>lang('user_has_been_bound'));
			dsetcookie('auth', authcode("{$user['password']}\t{$user['uid']}", 'ENCODE'), 365*24*60*60, 1, true);
			
		}
	}
	include template('bind');
}

function save_avatar($imageurl,$uid){
	
   if(!$img = file_get_contents($imageurl)){
	   return false;
   }
   $temp=getglobal('setting/attachdir').'cache/'.random(5).'.png';
  //移动文件
	if (!(file_put_contents($temp, $img))) { //移动失败
		return false;
	} else { //移动成功,生成3种尺寸头像
		
		$home = get_home($uid);
		if(!is_dir(DZZ_ROOT.'./data/avatar/'.$home)) {
			set_home($uid, DZZ_ROOT.'./data/avatar');
		}
		$bigavatarfile = DZZ_ROOT.'./data/avatar/'.get_avatar($uid, 'big');
		$middleavatarfile =DZZ_ROOT.'./data/avatar/'.get_avatar($uid, 'middle');
		$smallavatarfile = DZZ_ROOT.'./data/avatar/'.get_avatar($uid, 'small');
		include_once libfile('class/image');
		$image=new image();
		$success=0;
		if($thumb = $image->Thumb($temp,$smallavatarfile,48, 48,1)){
			$success++;
	   }
	   if($thumb = $image->Thumb($temp,$middleavatarfile,120, 120,1)){
			$success++;
	   }
		 if($thumb = $image->Thumb($temp,$bigavatarfile,200, 200,1)){
			$success++;
	   }
	   if($success) C::t('user')->update($uid,array('avatarstatus'=>1)); 
	   @unlink($temp);
	   return $success;
	}
}
function get_home($uid) {
		$uid = sprintf("%09d", $uid);
		$dir1 = substr($uid, 0, 3);
		$dir2 = substr($uid, 3, 2);
		$dir3 = substr($uid, 5, 2);
		return $dir1.'/'.$dir2.'/'.$dir3;
}
function set_home($uid, $dir = '.') {
	$uid = sprintf("%09d", $uid);
	$dir1 = substr($uid, 0, 3);
	$dir2 = substr($uid, 3, 2);
	$dir3 = substr($uid, 5, 2);
	!is_dir($dir.'/'.$dir1) && mkdir($dir.'/'.$dir1, 0777);
	!is_dir($dir.'/'.$dir1.'/'.$dir2) && mkdir($dir.'/'.$dir1.'/'.$dir2, 0777);
	!is_dir($dir.'/'.$dir1.'/'.$dir2.'/'.$dir3) && mkdir($dir.'/'.$dir1.'/'.$dir2.'/'.$dir3, 0777);
}
function get_avatar($uid, $size = 'big', $type = '') {
		$size = in_array($size, array('big', 'middle', 'small')) ? $size : 'big';
		$uid = abs(intval($uid));
		$uid = sprintf("%09d", $uid);
		$dir1 = substr($uid, 0, 3);
		$dir2 = substr($uid, 3, 2);
		$dir3 = substr($uid, 5, 2);
		$typeadd = $type == 'real' ? '_real' : '';
		return  $dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).$typeadd."_avatar_$size.jpg";
	}
?>
