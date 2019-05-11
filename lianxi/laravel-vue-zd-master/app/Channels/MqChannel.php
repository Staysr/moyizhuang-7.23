<?php
/**
 * zdapp
 * MqChannel.php.
 * @author luffyzhao@vip.126.com
 */

namespace App\Channels;


use App\Plugins\Push\Mq;
use Illuminate\Notifications\Notification;

class MqChannel
{
    public function send($notifiable, Notification $notification){
        $array = $notification->toVoice($notifiable);
        $mq = Mq::getInstance();
        if(method_exists($notification, 'getQueue')){
            $mq->setQueue($notification->getQueue());
        }else{
            $mq->setQueue('default');
        }
        $mq->send($array);
    }
}