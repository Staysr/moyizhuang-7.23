<?php
/*
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
include_once libfile('function/wx');
if(!$_G['cache']['news:setting']) loadcache('news:setting');
$setting=$_G['cache']['news:setting'];
$weObj=new qyWechat(array('token'=>$setting['token'],'appid'=>getglobal('setting/CorpID'),'appsecret'=>getglobal('setting/CorpSecret'),'agentid'=>$setting['agentid'],'encodingaeskey'=>$setting['encodingaeskey']));
$weObj->valid(); //注意, 企业号与普通公众号不同，必须打开验证，不要注释掉
$type = $weObj->getRev()->getRevType();
switch($type) {
    case qyWechat::MSGTYPE_TEXT://文本消息
           // $weObj->text($weObj->getRev()->getRevContent())->reply();
            break;
	case qyWechat::MSGTYPE_IMAGE://图片消息
			/*$imageinfo=$weObj->getRev()->getRevPic();
	 		$weObj->image($imageinfo['mediaid'])->reply();*/
			break;
	case qyWechat::MSGTYPE_VOICE://语音消息
			/*$imageinfo=$weObj->getRev()->getRevPic();
	 		$weObj->image($imageinfo['mediaid'])->reply();*/
			break;
	case qyWechat::MSGTYPE_VIDEO://视频消息
			/*$voice=$weObj->getRev()->getRevVoice();
	 		$weObj->image($voice['mediaid'])->reply();*/
			break;
	case qyWechat::MSGTYPE_LOCATION://地理位置消息
			/*$location=$weObj->getRev()->getRevGeo();
	 		$weObj->text('X:'.$location['x'].'Y:'.$location['y'].'label:'.$location['label'])->reply();*/
			break;
				
    case qyWechat::MSGTYPE_EVENT:
			$data=$weObj->getRev()->getRevData();//{"ToUserName":"wx735f8743226a8656","FromUserName":"dzz-1","CreateTime":"1413865073","MsgType":"event","AgentID":"0","Event":"unsubscribe","EventKey":{}
			///runlog('wxlog',json_encode($data));
			if($data['Event']=='unsubscribe'){
				DB::update('user',array('wechat_status'=>4),"wechat_userid='{$data[FromUserName]}'");
			}elseif($data['Event']=='subscribe'){
				DB::update('user',array('wechat_status'=>1),"wechat_userid='{$data[FromUserName]}'");
				//发送关注成功消息
				 $weObj->text($_G['setting']['sitename'].lang('send_to_here'))->reply();
			}elseif($data['Event']=='view'){
				 $weObj->text($data['url'])->reply();
			}elseif($data['Event']=='click'){
				$key=$data['EventKey'];
				switch($key){
					case 'latest'://最新新闻
						if($newsdata=getLatestData($wx,ltrim($data['FromUserName'],'dzz-'))){
							$weObj->news($newsdata)->reply();
						}else{
							$weObj->text(lang('no_relevant_content'))->reply();
						}
						break;
				}
			}
            break;
    
    default:
           /* $weObj->text("help info")->reply();*/
}
exit();
?>