<?php

namespace addons\kdniao\controller;

use addons\kdniao\library\Kdniao;
use think\addons\Controller;
use think\Db;
use think\response\Json;

class Index extends Controller
{

    public function index()
    {
        if ($this->request->isPost()) {
            $code = $this->request->post('code');
            $company = $this->request->post('company');
            $kdniao = new Kdniao();
            $wuliu = $kdniao->getOrderTracesByJson($company, $code);

            if ($wuliu == -1) {
                $json = [
                    'code' => 0,
                    'msg'  => '未设置接口配置！请在插件管理中配置！',
                    'data' => '',
                ];
                return Json($json);
            }

            $wuliu = json_decode($wuliu, true);

            $json = [
                'code' => 1,
                'msg'  => '获取成功',
                'data' => isset($wuliu['Traces']) && count($wuliu['Traces']) ? array_reverse($wuliu['Traces']) : [['AcceptStation' => '暂无物流信息', 'AcceptTime' => date('Y-m-d H:i:s', time())]]
            ];
            //物流信息倒序
            return Json($json);
        } else {
            $data = Db::name('kdniao')->select();
            $this->assign('data', $data);
            return $this->view->fetch();
        }
    }

    /**
     * 查询
     */
    public function query()
    {
        $code = $this->request->param('code');
        $company = $this->request->param('company');
        $kdniao = new Kdniao();
        $wuliu = $kdniao->getOrderTracesByJson($company, $code);

        $wuliu = json_decode($wuliu, true);

        /*if (isset($wuliu['Traces']) && count($wuliu['Traces'])) {
            $this->assign('data', array_reverse($wuliu['Traces']));
        }*/

        $this->assign('data', isset($wuliu['Traces']) && count($wuliu['Traces']) ? array_reverse($wuliu['Traces']) : '');
        return $this->view->fetch();
    }

}
