<?php
/**
 * new-zhoudao
 * JpushChannel.php.
 * @author luffyzhao@vip.126.com
 */

namespace App\Channels;

use App\Plugins\Push\JPushDriver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;

class JpushDriverChannel
{
    /**
     * 发送给定通知.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toVoice($notifiable);

        if($notifiable instanceof Model){
            $message['token'] = $notifiable->getAttribute('device_token');
        }else{
            $message['token'] = $notifiable;
        }

        JPushDriver::getInstance()->send($message);
    }
}