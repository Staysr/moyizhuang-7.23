<?php
/*
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
//include_once libfile('function/wx');

$weObj=new Wechat(array('token'=>$setting['token_mp'],'encodingaeskey'=>$setting['encodingaeskey_mp'],'appid'=>$setting['AppID'],'appsecret'=>$setting['AppSecret']));
$weObj->valid(); //注意, 企业号与普通公众号不同，必须打开验证，不要注释掉
$type = $weObj->getRev()->getRevType();
$openid=$weObj->getRev()->getRevFrom();

if($type!=Wechat::MSGTYPE_EVENT && (!$user=C::t('user_wechat')->fetch_by_openid($openid,$setting['AppID']))){
	$oauthurl=$weObj->getOauthRedirect(getglobal('siteurl').MOD_URL.'&op=bind');
	$weObj->text(lang('click_to_bind').$oauthurl)->reply();
	exit();
}

$uid=$user['uid'];
switch($type) {
    case Wechat::MSGTYPE_TEXT://文本消息
			$content=$weObj->getRev()->getRevContent();
            if($ret=C::t('jilu_item')->publish_wx($content,'text',$uid,$weObj)){
				if($ret['combined']){
					$weObj->text(lang('merged_with_the_previous_one'))->reply();
				}else{
					$weObj->text(lang('new_record_and_merged'))->reply();
				}
			}
            break;
	case Wechat::MSGTYPE_IMAGE://图片消息
			$imageinfo=$weObj->getRev()->getRevPic();
	 		if($ret=C::t('jilu_item')->publish_wx($imageinfo,'image',$uid,$weObj)){
				if($ret['combined']){
					$weObj->text(lang('merged_with_the_previous_one_have').$ret['imagesum'].lang('create_new_exceed_9'))->reply();
				}else{
					$weObj->text(lang('new_record_and_merged_image'))->reply();
				}
			}
			break;
	case Wechat::MSGTYPE_VOICE://语音消息
			//$voice=$weObj->getRev()->getRevVoice();
			//$weObj->text(json_encode($voice))->reply();
	 		/*if(C::t('jilu_item')->publish_wx($voice,'voice',$uid,$weObj)){
				$weObj->text('已保存到我的记录')->reply();
			}*/
			break;
	case Wechat::MSGTYPE_VIDEO://视频消息
			$video=$weObj->getRev()->getRevVideo();
			if($ret=C::t('jilu_item')->publish_wx($video,'video',$uid,$weObj)){
				if($ret['combined']){
					$weObj->text(lang('merged_with_the_previous_one'))->reply();
				}else{
					$weObj->text(lang('new_record_and_merged_text'))->reply();
				}
			}
	 		
			break;
	case Wechat::MSGTYPE_LOCATION://地理位置消息
			$location=$weObj->getRev()->getRevGeo();
			if($ret=C::t('jilu_item')->publish_wx($location,'location',$uid,$weObj)){
				if($ret['combined']){
					$weObj->text(lang('merged_with_the_previous_one'))->reply();
				}else{
					$weObj->text(lang('new_record_and_merged_other_mes'))->reply();
				}
			}
			break;
				
    case Wechat::MSGTYPE_EVENT:
			$data=$weObj->getRev()->getRevData();//{"ToUserName":"wx735f8743226a8656","FromUserName":"dzz-1","CreateTime":"1413865073","MsgType":"event","AgentID":"0","Event":"unsubscribe","EventKey":{}
			///runlog('wxlog',json_encode($data));
			if($data['Event']=='unsubscribe'){
				//DB::update('user',array('wechat_status'=>4),"wechat_userid='{$data[FromUserName]}'");
			}elseif($data['Event']=='subscribe'){
				//DB::update('user',array('wechat_status'=>1),"wechat_userid='{$data[FromUserName]}'");
				//发送关注成功消息
				$oauthurl=$wxobj->getOauthRedirect(getglobal('siteurl').MOD_URL.'&op=bind','mp');
				$weObj->text($_G['setting']['sitename'].lang('thank_to_use').$oauthurl)->reply();
				//$weObj->text('此处发送的文字消息、图片、视频（小视频还不支持）会自动放入到“我的记录中”,连续发送的消息系统会自动组合。比如：发送一段文字，接着发送几张图片，再发送地理位置，那么这些内容会合成一条记录，连续发送的同一类型的消息（图片除外）不合并')->reply();
			}elseif($data['Event']=='view'){
				// $weObj->text($data['url'])->reply();
			}elseif($data['Event']=='click'){
				//$key=$data['EventKey'];
			}
            break;
    
    default:
           // $weObj->text($type)->reply();
}
exit();
?>