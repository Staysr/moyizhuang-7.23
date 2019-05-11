<?php
/*
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
include_once libfile('function/wx');

$weObj=new qyWechat(array('token'=>$setting['token'],'appid'=>getglobal('setting/CorpID'),'appsecret'=>getglobal('setting/CorpSecret'),'agentid'=>$setting['agentid'],'encodingaeskey'=>$setting['encodingaeskey']));
$weObj->valid(); //注意, 企业号与普通公众号不同，必须打开验证，不要注释掉
$type = $weObj->getRev()->getRevType();
//$data=$weObj->getRev()->getRevData();
$userid=$weObj->getRev()->getRevFrom();
$uid=intval(str_replace('dzz-','',$userid));
switch($type) {
    case qyWechat::MSGTYPE_TEXT://文本消息
			$content=$weObj->getRev()->getRevContent();
            if($ret=C::t('jilu_item')->publish_wx($content,'text',$uid,$weObj)){
				if($ret['combined']){
					$weObj->text(lang('merged_with_the_previous_one'))->reply();
				}else{
					$weObj->text(lang('new_record_and_merged'))->reply();
				}
			}
            break;
	case qyWechat::MSGTYPE_IMAGE://图片消息
			$imageinfo=$weObj->getRev()->getRevPic();
	 		if($ret=C::t('jilu_item')->publish_wx($imageinfo,'image',$uid,$weObj)){
				if($ret['combined']){
					$weObj->text(lang('merged_with_the_previous_one_have').$ret['imagesum'].lang('create_new_exceed_9'))->reply();
				}else{
					$weObj->text(lang('new_record_and_merged_image'))->reply();
				}
			}
			break;
	case qyWechat::MSGTYPE_VOICE://语音消息
			//$voice=$weObj->getRev()->getRevVoice();
			//$weObj->text(json_encode($voice))->reply();
	 		/*if(C::t('jilu_item')->publish_wx($voice,'voice',$uid)){
				$weObj->text('已保存到我的记录')->reply();
			}*/
			break;
	case qyWechat::MSGTYPE_VIDEO://视频消息
			$video=$weObj->getRev()->getRevVideo();
			if($ret=C::t('jilu_item')->publish_wx($video,'video',$uid,$weObj)){
				if($ret['combined']){
					$weObj->text(lang('merged_with_the_previous_one'))->reply();
				}else{
					$weObj->text(lang('new_record_and_merged_text'))->reply();
				}
			}
	 		
			break;
	case qyWechat::MSGTYPE_LOCATION://地理位置消息
			$location=$weObj->getRev()->getRevGeo();
			if($ret=C::t('jilu_item')->publish_wx($location,'location',$uid,$weObj)){
				if($ret['combined']){
					$weObj->text(lang('merged_with_the_previous_one'))->reply();
				}else{
					$weObj->text(lang('new_record_and_merged_other_mes'))->reply();
				}
			}
	 		//$weObj->text('X:'.$location['x'].'Y:'.$location['y'].'label:'.$location['label'])->reply();
			break;
				
    case qyWechat::MSGTYPE_EVENT:
			$data=$weObj->getRev()->getRevData();//{"ToUserName":"wx735f8743226a8656","FromUserName":"dzz-1","CreateTime":"1413865073","MsgType":"event","AgentID":"0","Event":"unsubscribe","EventKey":{}
			///runlog('wxlog',json_encode($data));
			//$weObj->text(json_encode($data))->reply();exit();
			if($data['Event']=='unsubscribe'){
				DB::update('user',array('wechat_status'=>4),"wechat_userid='{$data[FromUserName]}'");
			}elseif($data['Event']=='subscribe'){
				DB::update('user',array('wechat_status'=>1),"wechat_userid='{$data[FromUserName]}'");
				//发送关注成功消息
				 $weObj->text($_G['setting']['sitename'].lang('setting_sitename'))->reply();
			}elseif($data['Event']=='view'){
				 $weObj->text($data['url'])->reply();
			}elseif($data['Event']=='click'){
				$key=$data['EventKey'];
			}elseif($data['Event']=='enter_agent'){
				if($userinfo=DB::fetch_first("select id,enter_agent from %t where jid='' and uid=%d",array('jilu_user',$uid))){
					if(!$userinfo['enter_agent']){
						$weObj->text($_G['setting']['sitename'].lang('setting_sitename'))->reply();
						C::t('jilu_user')->update($userinfo['id'],array('enter_agent'=>1));
					}
				}else{
					$weObj->text($_G['setting']['sitename'].lang('setting_sitename'))->reply();
				}
				
				
			}
            break;
    
    default:
           // $weObj->text($type)->reply();
}
exit();
?>