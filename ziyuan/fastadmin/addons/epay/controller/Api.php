<?php

namespace addons\epay\controller;

use addons\epay\library\Service;
use Endroid\QrCode\QrCode;
use think\addons\Controller;
use think\Response;
use Yansongda\Pay\Pay;

/**
 * API接口控制器
 *
 * @package addons\epay\controller
 */
class Api extends Controller
{

    protected $layout = 'default';
    protected $config = [];

    /**
     * 默认方法
     */
    public function index()
    {
        $this->error();
    }

    /**
     * 外部提交
     */
    public function submit()
    {
        $out_trade_no = $this->request->request("out_trade_no");
        $title = $this->request->request("title");
        $amount = $this->request->request('amount');
        $type = $this->request->request('type');
        $method = $this->request->request('method', 'web');
        $openid = $this->request->request('openid', '');
        $auth_code = $this->request->request('auth_code', '');
        $notifyurl = $this->request->request('notifyurl', '');
        $returnurl = $this->request->request('returnurl', '');

        if (!$amount || $amount < 0) {
            $this->error("支付金额必须大于0");
        }

        if (!$type || !in_array($type, ['alipay', 'wechat'])) {
            $this->error("支付类型错误");
        }

        $params = [
            'type'         => $type,
            'out_trade_no' => $out_trade_no,
            'title'        => $title,
            'amount'       => $amount,
            'method'       => $method,
            'openid'       => $openid,
            'auth_code'    => $auth_code,
            'notifyurl'    => $notifyurl,
            'returnurl'    => $returnurl,
        ];
        return Service::submitOrder($params);
    }

    /**
     * 微信支付扫码支付
     * @return string
     */
    public function wechat()
    {
        $config = Service::getConfig('wechat');

        $body = $this->request->request("body");
        $code_url = $this->request->request("code_url");
        $out_trade_no = $this->request->request("out_trade_no");
        $return_url = $this->request->request("return_url");
        $total_fee = $this->request->request("total_fee");

        $sign = $this->request->request("sign");

        $data = [
            'body'         => $body,
            'code_url'     => $code_url,
            'out_trade_no' => $out_trade_no,
            'return_url'   => $return_url,
            'total_fee'    => $total_fee,
        ];
        if ($sign != md5(implode('', $data) . $config['appid'])) {
            $this->error("签名不正确");
        }

        if ($this->request->isAjax()) {
            $wechat = Pay::wechat($config);
            $order = [
                'out_trade_no' => $out_trade_no
            ];
            $result = $wechat->find($order);
            if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
                $this->success("", "", ['trade_state' => $result->trade_state]);
            } else {
                $this->error("查询失败");
            }
        }
        $data['sign'] = $sign;
        $this->view->assign("isWechat", stripos($this->request->server('HTTP_USER_AGENT'), 'MicroMessenger') !== false);
        $this->view->assign("isMobile", $this->request->isMobile());
        $this->view->assign("data", $data);
        $this->view->assign("title", "微信支付");
        return $this->view->fetch();
    }

    /**
     * 支付成功回调
     */
    public function notifyx()
    {
        $type = $this->request->param('type');
        $pay = Service::checkNotify($type);
        if (!$pay) {
            echo '签名错误';
            return;
        }
        //你可以在这里你的业务处理逻辑,比如处理你的订单状态、给会员加余额等等功能
        //下面这句必须要执行,且在此之前不能有任何输出
        echo $pay->success();
        return;
    }

    /**
     * 支付成功返回
     */
    public function returnx()
    {
        $type = $this->request->param('type');
        $result = Service::checkReturn($type);
        if (!$result) {
            $this->error('签名错误');
        }
        //你可以在这里定义你的提示信息,但切记不可在此编写逻辑
        $this->success("恭喜你！支付成功!", addon_url("epay/index/index"));

        return;
    }

    /**
     * 生成二维码
     * @return Response
     */
    public function qrcode()
    {
        $text = $this->request->get('text', 'hello world');
        $size = $this->request->get('size', 250);
        $padding = $this->request->get('padding', 15);
        $errorcorrection = $this->request->get('errorcorrection', 'medium');
        $foreground = $this->request->get('foreground', "#ffffff");
        $background = $this->request->get('background', "#000000");
        $logo = $this->request->get('logo');
        $logosize = $this->request->get('logosize');
        $label = $this->request->get('label');
        $labelfontsize = $this->request->get('labelfontsize');
        $labelhalign = $this->request->get('labelhalign');
        $labelvalign = $this->request->get('labelvalign');

        // 前景色
        list($r, $g, $b) = sscanf($foreground, "#%02x%02x%02x");
        $foregroundcolor = ['r' => $r, 'g' => $g, 'b' => $b];

        // 背景色
        list($r, $g, $b) = sscanf($background, "#%02x%02x%02x");
        $backgroundcolor = ['r' => $r, 'g' => $g, 'b' => $b];

        $qrCode = new QrCode();
        $qrCode
            ->setText($text)
            ->setSize($size)
            ->setPadding($padding)
            ->setErrorCorrection($errorcorrection)
            ->setForegroundColor($foregroundcolor)
            ->setBackgroundColor($backgroundcolor)
            ->setLogoSize($logosize)
            ->setLabelFontPath(ROOT_PATH . 'public/assets/fonts/fzltxh.ttf')
            ->setLabel($label)
            ->setLabelFontSize($labelfontsize)
            ->setLabelHalign($labelhalign)
            ->setLabelValign($labelvalign)
            ->setImageType(QrCode::IMAGE_TYPE_PNG);
        //也可以直接使用render方法输出结果
        //$qrCode->render();
        return new Response($qrCode->get(), 200, ['Content-Type' => $qrCode->getContentType()]);
    }

}
