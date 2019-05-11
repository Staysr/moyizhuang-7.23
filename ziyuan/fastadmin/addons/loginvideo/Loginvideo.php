<?php

namespace addons\loginvideo;

use app\admin\library\Auth;
use think\Addons;

/**
 * 登录背景视频插件
 */
class Loginvideo extends Addons
{

    /**
     * 插件安装方法
     * @return bool
     */
    public function install()
    {

        return true;
    }

    /**
     * 插件卸载方法
     * @return bool
     */
    public function uninstall()
    {

        return true;
    }

    /**
     * 插件启用方法
     * @return bool
     */
    public function enable()
    {

        return true;
    }

    /**
     * 插件禁用方法
     * @return bool
     */
    public function disable()
    {

        return true;
    }

    /**
     * 响应输出前
     */
    public function responseSend(\think\Response $params)
    {
        $request = \think\Request::instance();
        $module = strtolower($request->module());
        $controller = strtolower($request->controller());
        $action = strtolower($request->action());
        $config = $this->getConfig();
        if (!$request->isAjax() && $module == 'admin' && $controller == 'index' && $action == 'login') {
            $auth = Auth::instance();
            if (!$auth->isLogin()) {
                $config['background-image'] = $config['background-image'] ? cdnurl($config['background-image']) : '';
                if ($config['background-video']) {
                    $videoArr = explode(',', $config['background-video']);
                    $videoCount = count($videoArr);
                    if ($videoCount > 1) {
                        $index = date("d") % $videoCount;
                        $config['background-video'] = isset($videoArr[$index]) ? $videoArr[$index] : $videoArr[0];
                    }
                    $config['background-video'] = $config['background-video'] ? cdnurl($config['background-video']) : '';
                    // 手机端禁用视频背景
                    if ($request->isMobile()) {
                        $config['background-video'] = '';
                    }
                }
                $this->view->assign('config', $config);
                $content = $params->getContent();
                $this->view->engine->layout(false);
                $background = $this->view->fetch('view/background');
                $content = str_replace('<body>', '<body>' . $background, $content);
                $params->content($content);
            }
        }
    }

}
