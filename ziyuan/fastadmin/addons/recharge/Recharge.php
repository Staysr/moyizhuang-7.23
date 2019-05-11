<?php

namespace addons\recharge;

use app\common\library\Menu;
use think\Addons;
use think\Request;

/**
 * 插件
 */
class Recharge extends Addons
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
     * 会员中心边栏后
     * @return mixed
     * @throws \Exception
     */
    public function userSidenavAfter()
    {
        $request = Request::instance();
        $actionname = strtolower($request->action());
        $data = [
            'actionname' => $actionname
        ];
        return $this->fetch('view/hook/user_sidenav_after', $data);
    }

}
