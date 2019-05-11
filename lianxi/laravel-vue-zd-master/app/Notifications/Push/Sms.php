<?php

namespace App\Notifications\Push;

use App\Channels\MqChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Sms extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [MqChannel::class];
    }

    /**
     * 获取mq队列名称
     * @method getQueue
     * @return string
     * @author luffyzhao@vip.126.com
     */
    public function getQueue(){
        return 'queues.sms.message';
    }

    /**
     * toVoice
     * @method toVoice
     * @param $notifiable
     * @return array
     * @author luffyzhao@vip.126.com
     */
    public function toVoice($notifiable){
        return [
            'id' => $notifiable->id,
            'mobile' => $notifiable->mobile,
            'contents' => $notifiable->contents,
            'status'=>1
        ];
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
