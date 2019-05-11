<?php
include ('./inc/aik.config.php');
?>
<?php
/**
 *
 * wechat php test
 */

//define your token
//1.修改自己的token
define("TOKEN", "此处替换成你的token");
$wechatObj = new wechatCallbackapiTest();

$wechatObj->responseMsg();
//$wechatObj->valid();
//exit;

class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];


        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }


    public function responseMsg()
    {

		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];


		if (!empty($postStr)){

                libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);

				$event = $postObj->Event;			
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";    
				


				switch($postObj->MsgType)
				{
					case 'event':

						if($event == 'subscribe')
						{
						//2.修改自己的关注后的回复
												$contentStr = 'hi,感谢关注我们公众号，想看什么大片，就直接回复影片名称吧！';


							$msgType = 'text';
							$textTpl = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
							echo $textTpl;

						}
						break;
					case 'text':
						{
							$newsTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>1</ArticleCount>
							<Articles>
							<item>
							<Title><![CDATA[%s]]></Title> 
							<Description><![CDATA[%s]]></Description>
							<PicUrl><![CDATA[%s]]></PicUrl>
							<Url><![CDATA[%s]]></Url>
							</item>							
							</Articles>
							</xml>";	
 						if($keyword<>"")
						{
										$title = '您要看的《'.$keyword.'》,给您找到以下结果：点击进入观看>>';
										
									    $des1 =  $_SERVER['SERVER_NAME'];
										//3.修改自己的图片地址
										$picUrl1 = 'http://wxdy.gouagou.com/images/djgk.jpg';
										//修改自己的跳转链接（一般勿动）
										$url= $_SERVER['SERVER_NAME'].'/wxseacher.php?wd='.$keyword;

										$resultStr= sprintf($newsTpl, $fromUsername, $toUsername, $time, $title, $des1, $picUrl1, $url) ;
									
										echo $resultStr; 	
						}
												$contentStr = " \r\n 输入电影名如：画江湖之不良人 即可在线观看！\r\n ";


							$msgType = 'text';
							$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
							echo $resultStr;
						}					
						break;
					default:
						break;
				}						

        }else {
        	echo "你好！欢迎进入影院微信公众号";
        	exit;
        }
    }
		
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>