<?php
include('system/inc.php');
include('system/simple_html_dom.php');
error_reporting(0); //禁用错误报告
define('TOKEN', $mkcms_token); //定义常量
define('DOMAIN', $mkcms_domain); //定义常量
define('WEI', $mkcms_wei); //定义常量
define('GUANZHU', $mkcms_guanzhu); //定义常量
$wechatObj = new wechatCallbackapiTest();//实例化类                                                                                                                   
if (isset($_GET['echostr'])) { //如果随机字符串存在
    $wechatObj->valid(); //执行wechatObj类下的valid函数
}else{
    $wechatObj->responseMsg(); //如果未得到随机字符串，执行wechatObj类下的responseMsg函数
}

class wechatCallbackapiTest  //定义类
{
    //验证签名
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if($tmpStr == $signature){
            echo $echoStr;
            exit;
        }
    }
  
  	//响应消息
    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        //$postStr = 'huihui';      //调试用
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);
            // $RX_TYPE = "text";//gnagcai  zhege  meiqudiao
            //消息类型分离
            switch ($RX_TYPE)
            {
                case "event":
                    $result = $this->receiveEvent($postObj);
                    break;
                case "text":
                    $result = $this->receiveText($postObj);
                    break;
                case "image":
                    $result = $this->receiveImage($postObj);
                    break;
                default:
                    $result = "unknown msg type: ".$RX_TYPE;
                    break;
            }
            echo $result;
        }else {
            echo "";
            exit;
        }
    }
  	
  	//接收事件消息
    private function receiveEvent($object)
    {
        $content = "";
        global $webname;
        switch ($object->Event)
        {
            //关注公众号事件
            case "subscribe":
                $content = GUANZHU;
                //$content .= (!empty($object->EventKey))?("\n来自二维码场景 ".str_replace("qrscene_","",$object->EventKey)):"";
                break;
            //取消关注
            case "unsubscribe":
                $content = "取消关注";
                break;
        }

        if(is_array($content)){
            $result = $this->transmitNews($object, $content);
        }else{
            $result = $this->transmitText($object, $content);
        }
        return $result;
    }

    //接收文本消息
    private function receiveText($object)
    {

        $a = ($object->Content);
        $keyword = trim($a);//关键字
        $html = file_get_html('http://m.360kan.com/search/index?kw='.$keyword);
        foreach($html->find('section[class=longlist]') as $longlist)
        foreach($longlist->find('div[class=search-item]') as $search_item)
        {if($i<5)
        {
          foreach($search_item->find('img') as $img)
          foreach($search_item->find('h3') as $h3)
          foreach($h3->find('a') as $a)
          $title = $a->innertext;
          $title=str_replace('<b>','',$title);
          $title=str_replace('</b>','',$title);
          $href = $a->href;
          $href=str_replace('/va/','/va/',$href);
          $href=str_replace('/m/','/m/',$href);
          $href=str_replace('/tv/','/tv/',$href);
          $href=str_replace('/ct/','/ct/',$href);
          if(WEI==1){
			 $jiamiurl =  DOMAIN.'vod'.$href;
          }else{
          	 $jiamiurl =  DOMAIN.'play.php?play='.$href;
          }
         
          $arr[] = array(
                        "Title" => "【".$title."】点击在线观看",
                        "Description" => $title,
                        "PicUrl" => $img->src,
                        "Url" => $jiamiurl
                    );
        }
        else{break;}
                $i++;
            }
		if(count($arr)<0){

}		
        $result="";



        if (is_array($arr)) {
            if (isset($arr[0])) {
                $result = $this->transmitNews($object, $arr);
            }
        } else {
            $result = $this->transmitText($object, $arr);
        }
        return $result;
    }

    //接收图片消息
    private function receiveImage($object)
    {
        $content = array("MediaId"=>$object->MediaId);
        $result = $this->transmitImage($object, $content);
        return $result;
    }

    //回复文本消息
    private function transmitText($object, $content)
    {
        if (!isset($content) || empty($content)){
            return "";
        }
        $xmlTpl = "<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[text]]></MsgType>
    <Content><![CDATA[%s]]></Content>
</xml>";
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), $content);

        return $result;
    }

    //回复图文消息
    private function transmitNews($object, $newsArray)
    {
        if(!is_array($newsArray)){
            return "";
        }
        $itemTpl = "        <item>
            <Title><![CDATA[%s]]></Title>
            <Description><![CDATA[%s]]></Description>
            <PicUrl><![CDATA[%s]]></PicUrl>
            <Url><![CDATA[%s]]></Url>
        </item>";
        $item_str = "";
        foreach ($newsArray as $item){
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $xmlTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[news]]></MsgType>
                            <ArticleCount>%s</ArticleCount>
                            <Articles>
                        $item_str    </Articles>
                        </xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray));
        return $result;
    }

       //回复图片消息
    private function transmitImage($object, $imageArray)
    {
        $itemTpl = "<Image>
        <MediaId><![CDATA[%s]]></MediaId>
    </Image>";

        $item_str = sprintf($itemTpl, $imageArray['MediaId']);

        $xmlTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[image]]></MsgType>
                            $item_str
                        </xml>";
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

}
?>