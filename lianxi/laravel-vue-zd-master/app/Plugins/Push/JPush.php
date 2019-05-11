<?php
/**
 * new-zhoudao
 * JPush.php.
 * @author luffyzhao@vip.126.com
 */

namespace App\Plugins\Push;


use Illuminate\Support\Facades\Log;
use JPush\Client;
use JPush\Exceptions\JPushException;

class JPush
{
    protected static $instance;

    protected $client;
    protected $config;

    protected $push;

    protected $messages = [
        'categoryType' => 1,
        'flags' => 5,
        'content_type' => 'text',
        'extra' => ['message' => []],
    ];

    protected function __clone()
    {
    }

    protected function __construct()
    {
        $this->config = config('database.connections.jpush');
        $this->client = new Client(
            $this->config['merchant_app_key'],
            $this->config['merchant_master_secret'],
            storage_path().DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR.date('Ymd').'-jpush.log'
        );
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new static;
        }

        return self::$instance;
    }

    public function send(array $messages)
    {
        $this->setPush();

        $this->setAlert($messages);

        $this->setRegistrationId($messages);

        $this->setMessages($messages);

        $this->setOther($messages);

        $response = $this->push->send();

        $this->log($response);
    }

    protected function setPush()
    {
        $this->push = $this->client->push()->setPlatform(['ios', 'android']);
    }

    /**
     * 设置弹窗
     * @method setAlert
     * @param array $messages
     *
     * @author luffyzhao@vip.126.com
     */
    protected function setAlert(array $messages)
    {
        if (isset($messages['title'])) {
            $messages['title'] = '新消息！';
        }
        if (isset($messages['center'])) {
            $messages['center'] = '您有一条新消息，请进入App查看！';
        }
        $this->push->setNotificationAlert($messages['title'])
            ->addAndroidNotification($messages['title'], null, null)
            ->addIosNotification($messages['title'], 'default', null, null, null);
    }

    /**
     * 设置推送人群
     * @method setRegistrationId
     * @param $messages
     *
     * @author luffyzhao@vip.126.com
     */
    protected function setRegistrationId($messages)
    {
        $this->push->addRegistrationId($messages['token']);
    }

    /**
     * 设置其他内容
     * @method setOther
     * @param $messages
     *
     * @author luffyzhao@vip.126.com
     */
    protected function setOther($messages)
    {
        $this->push->options(['apns_production' => $this->config['apns_production']]);
    }

    /**
     * 设置消息体
     * @method setMessages
     * @param $messages
     *
     * @author luffyzhao@vip.126.com
     */
    protected function setMessages($messages)
    {
        $message = json_encode( [
            'msgType' => $messages['type'],
            'content' => $messages['title'],
            'categoryType' => 1,
            'flags' => 5,
            'content_type' => 'text',
            'extra' => ['message' => $messages['extends']],
        ] );

        $this->push->message($message);
    }

    /**
     * 记录日志
     * @method log
     * @param $response
     *
     * @author luffyzhao@vip.126.com
     */
    public function log($response)
    {
        Log::info('[推送返回信息]：'.json_encode($response, JSON_UNESCAPED_UNICODE));
    }
}