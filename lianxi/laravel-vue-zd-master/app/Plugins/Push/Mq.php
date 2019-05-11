<?php
/**
 * zdapp
 * Mq.php.
 * @author luffyzhao@vip.126.com
 */
namespace App\Plugins\Push;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

/**
 * Class Mq
 * @package App\Plugins\Push
 * @author luffyzhao@vip.126.com
 */
class Mq {
    protected static $instance;

    protected $config;
    /**
     * @var AMQPStreamConnection
     * @author luffyzhao@vip.126.com
     */
    private $connection;
    /**
     * @var AMQPChannel
     * @author luffyzhao@vip.126.com
     */
    private $channel;
    private $header;
    private $queue;

    /**
     * @param mixed $queue
     * @return Mq
     */
    public function setQueue($queue)
    {
        $this->queue = $queue;

        return $this;
    }


    protected function __clone()
    {
    }

    protected function __construct()
    {
        $this->config = config('queue.rabbitmq');
        $this->connection();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new static;
        }

        return self::$instance;
    }

    /**
     * 初始化
     * @method connection
     * @author luffyzhao@vip.126.com
     */
    protected function connection(){
        $this->connection = new AMQPStreamConnection(
            $this->config['host'],
            $this->config['port'],
            $this->config['login'],
            $this->config['password']
        );
        $this->channel = $this->connection->channel();
        $this->header = new AMQPTable(
            [
                '__TypeId__' => 'java.lang.String',
            ]
        );
        $this->queue = $this->config['queue'];
    }

    /**
     * 发送短信
     * @method send
     * @param array $content
     * @author luffyzhao@vip.126.com
     */
    public function send(array $content){
        $message = $this->formatMessage($content);
        $this->channel->queue_declare($this->queue, false, true, false, false);
        $this->channel->basic_publish($message, '', $this->queue);
    }

    /**
     * 格式化message
     * @method formatMessage
     * @param array $content
     * @return AMQPMessage
     * @author luffyzhao@vip.126.com
     */
    protected function formatMessage(array $content){
        return new AMQPMessage(
            '"'.addcslashes(json_encode($content), '"').'"',
            [
                'delivery_mode' => 2,
                'content_encoding' => 'UTF-8',
                'priority' => 0,
                'content_type' => 'application/json',
                'application_headers' => $this->header,
            ]
        );
    }

    public function __destruct()
    {
        $this->connection->close();
        $this->channel->close();
    }
}